<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;

//use Cake\Mailer\Mailer;

class ToursController extends AppController
{

	public function initialize(): void
	{
		parent::initialize();
		$this->loadComponent('Email'); // Load the EmailComponent
		$this->loadComponent('UserIpLocator'); // Load the IpLocatorComponent
	}


	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		//Configure::write('debug',true);
	}

	public function index($pageUrl = "")
	{
		$this->loadComponent('Seo');

		$this->viewBuilder()->setLayout('version2/default');
		
		$this->response = $this->response
							->withHeader('Cache-Control', 'public, max-age=3600, must-revalidate')
							->withHeader('Pragma', '')
							->withHeader('Expires', gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
	
	
		$tabCategory = $this->fetchTable('TblCategory');
		$tabTourCategory = $this->fetchTable('TblTourCategory');
		$tabTourPages = $this->fetchTable('TblsTourPages');
		$tabTourPageDescription = $this->fetchTable('TblsTourPageDescription');
		$tabCmsManagetour = $this->fetchTable('CmsManagetour');
		$tabTourPrices = $this->fetchTable('TourPrices');
		$tabCategorySeoTags = $this->fetchTable('TblCategorySeoTags');
		$tabCategoryDescription = $this->fetchTable('TblCategoryDescriptions');
		$tabCategoryFaqs = $this->fetchTable('TblCategoryFaqs');
		$tabCategoryFaqAnswers = $this->fetchTable('TblCategoryFaqAnswers');
		$tabTblCategorySeoExtensions = $this->fetchTable('TblCategorySeoExtensions');

		$categoryInfo = $tabCategory->findByPageUrl($pageUrl)->toArray();
		$categoryInfo = $categoryInfo[0];


		$data['general'] = array(
									"category_id"		=>	$categoryInfo['id'],
									"category_page_url"	=>	$categoryInfo['page_url'],
									"name"				=>	$categoryInfo['name'],
									"image"				=>	WEBSITE_REPOSITORY. "category/" . $categoryInfo['image'],
          							"mobile_image"		=>	WEBSITE_REPOSITORY. "category/" . $categoryInfo['mobile_image']
							);



		$filterTourCategories = array();
		$filterTourCategories['conditions'] = array(
			"category_id"	=>	$categoryInfo['id']
		);
		$filterTourCategories['order']	= array(
			"tour_duration"	=>	"asc"
		);


		$tourCategories = $tabTourCategory->find('all', $filterTourCategories)->toArray();

		$tourCategoryList = array();

		$requestDataCurrency = array(
			"currency_code"		=>		"INR"
		);
		$currencyInfo = $this->getCurrencyInfo($requestDataCurrency);


		foreach ($tourCategories as $tourCategory) {

			$tourPageInfo = $tabTourPages->findById($tourCategory['tour_page_id'])->toArray();
			$tourPageInfo = $tourPageInfo[0];

			if ($tourPageInfo['tour_id'] == "") {
				continue;
			}

			$tourPageDescInfo = $tabTourPageDescription->findByTourPageId($tourCategory['tour_page_id'])->toArray();
			$tourPageDescInfo = $tourPageDescInfo[0];


			$tourInfo = $tabCmsManagetour->findById($tourPageInfo['tour_id'])->toArray();
			$tourInfo = $tourInfo[0];

			$tourPriceInfo = array();

			if ($tourPageInfo['id'] != "" && $tourInfo['id'] != "") {
				$tourPriceInfo = $tabTourPrices->findByTourPageIdAndTourId($tourPageInfo['id'], $tourInfo['id'])->toArray();
				$tourPriceInfo = $tourPriceInfo[0];
			}

			if ($tourPriceInfo['low_season_price'] > 0) {
				$tourPriceInfo['low_season_price'] = $this->calculateCurrencyRate($tourPriceInfo['low_season_price'], $currencyInfo['currency_value']);
			}

			if ($tourPriceInfo['low_season_discount_price'] > 0) {
				$tourPriceInfo['low_season_discount_price'] = $this->calculateCurrencyRate($tourPriceInfo['low_season_discount_price'], $currencyInfo['currency_value']);
			}

			$tourCategoryList[] = array(
				"tour_id"			=>		$tourInfo['id'],
				"tour_page_id"		=>		$tourPageInfo['id'],
				"name"				=>		$tourPageInfo['title'],
				"tour_code"			=>		$tourPageInfo['tour_code'],
				"duration"			=>		$tourInfo['tour_duration'],
				"price"				=>		$tourPriceInfo['low_season_price'],
				"discount_price"	=>		$tourPriceInfo['low_season_discount_price'],
				"image"				=>		ADMIN_REPOSITORY_PATH . "tours/" . $tourPageDescInfo['thumbnail'],
				"destinations"		=>		unserialize($tourPageDescInfo['destinations']),
				/*"specialities"		=>		unserialize($tourPageDescInfo['specialities']),*/
				"specialities"		=>		array(),
				"tour_page_url"		=>		CATEGORY_URL_PREFIX . "-" . $categoryInfo['page_url'] . '/' . $tourPageInfo['page_url']
			);
		}


		$data['category_list'] = $tourCategoryList;

		#### READING CATEGORY description
		$categoryContent = array();
		$categoryDescriptionInfo = $tabCategoryDescription->findByCategoryId($categoryInfo['id'])->toArray();
		
		if (@$categoryDescriptionInfo[0]['description'] != "") {
			$categoryDescriptionInfo = $categoryDescriptionInfo[0];
			$categoryContent['title'] = $categoryDescriptionInfo['title'];
			$categoryContent['description'] = $categoryDescriptionInfo['description'];
			$categoryContent['top_description'] = $categoryDescriptionInfo['top_description'];
		}
		
		$data['content'] = $categoryContent;

		#### READING FAQs

		$filterCategoryFaqs = array();
		$filterCategoryFaqs['conditions'] = array(
			"category_id"		=>		$categoryInfo['id']
		);
		$filterCategoryFaqs['order'] = array(
			"order_sequence"	=>		"asc"
		);

		$faqs = $tabCategoryFaqs->find('all', $filterCategoryFaqs)->toArray();
		$faqData = array();
		//$faqData['title'] = 'Golden Triangle Tour – FAQs';
		$faqData['title'] = 'Frequently Asked Questions for '.$categoryInfo['name'];
		$faqData['description'] = 'Quick answers about itinerary, inclusions, customization, and bookings.';
		$faqList = array();
		foreach ($faqs as $faq) {
			$categoryFaqAnswerInfo = $tabCategoryFaqAnswers->findByCategoryFaqId($faq['id'])->toArray();
			$categoryFaqAnswerInfo = $categoryFaqAnswerInfo[0];

			$faqList[] = array(
				"question"		=>		$faq['question'],
				"answer"		=>		$categoryFaqAnswerInfo['answer']
			);
		}
		$faqData['faq_list'] = $faqList;

		$data['faq'] = $faqData;

		#### SEO KEYWORD TAGS FOR HEADING AND SUBHEADING
		$categorySeoExtensionInfo = $tabTblCategorySeoExtensions->findByCategoryId($categoryInfo['id'])->toArray();
		$categorySeoExtensionInfo = $categorySeoExtensionInfo[0];

		$data['seo'] = array(
			"page_heading"		=>		$categorySeoExtensionInfo['page_heading'],
			"page_sub_heading"	=>		$categorySeoExtensionInfo['page_sub_heading']
		);

		$categorySeoTagInfo = $tabCategorySeoTags->findByCategoryId($categoryInfo['id'])->toArray();
		$categorySeoTagInfo = $categorySeoTagInfo[0];

		#### SEO TAGS

		$seoTags['meta_title'] = $categorySeoTagInfo['meta_title'];
		$seoTags['meta_description'] = $categorySeoTagInfo['meta_description'];
		$seoTags['meta_keyword'] =  $categorySeoTagInfo['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT . $pageUrl;
		$seoTags['itemprop_name'] = 'Terms and Privacy';
		$seoTags['date_published'] = date("Y-m-d", strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d", strtotime("-1 months"));

		$metaTags = $this->Seo->getSeoTags($seoTags, 'general');
		$data['meta_tags'] = $metaTags;


		#### SETTING BREADCRUMB

		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[] = array(
			"label"			=>		"Home",
			"link"			=>		WEBROOT,
			"link_url"		=>		true
		);

		$breadcrumbs[] = array(
			"label"			=>		$categoryInfo['name'],
			"link"			=>		WEBROOT . 'tours-' . $categoryInfo['page_url'],
			"link_url"		=>		false
		);


		$data['breadcrumbs'] = $breadcrumbs;

		$schemaTags = array();

		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;

		$organisationSchemaTags = array();
		$organisationSchemaTags['schema_category_type'] = 'organisation';
		$organisationSchema = $this->Seo->getSchema($organisationSchemaTags);
		$schemaTags[] = $organisationSchema;

		$websiteSchemaTags = array();
		$websiteSchemaTags['schema_category_type'] = 'website';
		$websiteSchema = $this->Seo->getSchema($websiteSchemaTags);
		$schemaTags[] = $websiteSchema;

		$reviewSchemaTags = array();
		$reviewSchemaTags['schema_category_type'] = 'review';
		$reviewSchema = $this->Seo->getSchema($reviewSchemaTags);
		$schemaTags[] = $reviewSchema;

		$tripAgreegateRating = array();
		$tripAgreegateRating['tour_name'] = $categoryInfo['name'];

		$tripAgreegateRating['schema_category_type'] = 'trip_agreegate_rating';
		$tripAgreegateSchema = $this->Seo->getSchema($tripAgreegateRating);
		$schemaTags[] = $tripAgreegateSchema;

		$faqSchemaTags = array();
		$faqSchemaTags['faq_list'] = $faqList;
		$faqSchemaTags['schema_category_type'] = 'faq';
		$faqSchema = $this->Seo->getSchema($faqSchemaTags);
		$schemaTags[] = $faqSchema;

		$data['schema'] = $schemaTags;

		$this->set("data", $data);
	}

	public function details($categoryPageUrl = "", $tourPageUrl = "")
	{
		$this->loadComponent('Seo');

		$this->viewBuilder()->setLayout('version2/default');
		$this->set('showEnquiryModal', false);

		$tabCategory = $this->fetchTable('TblCategory');
		$tabTourPages = $this->fetchTable('TblsTourPages');
		$tabTourPageDescription = $this->fetchTable('TblsTourPageDescription');
		$tabCmsManagetour = $this->fetchTable('CmsManagetour');
		$tabTourPrices = $this->fetchTable('TourPrices');
		$tabTourPageMetaDescription = $this->fetchTable('TblsTourPageMetaDescription');
		$tabTourPageFaqs = $this->fetchTable('TblsTourPageFaqs');
		$tabTourPageFaqAnswers = $this->fetchTable('TblsTourPageFaqAnswers');
		$tabTourPageOverviews = $this->fetchTable('TblsTourPageOverviews');

		$tabTblsTourEvents = $this->fetchTable('TblsTourEvents');


		$requestData = array();
		$requestData['page_url'] = $tourPageUrl;
		$requestData['category_page_url'] = $categoryPageUrl;

		$categoryInfo = $tabCategory->findByPageUrl($categoryPageUrl)->toArray();
		$categoryInfo = $categoryInfo[0];



		$tourPageInfo = $tabTourPages->findByPageUrl($requestData['page_url'])->toArray();
		$tourPageInfo = $tourPageInfo[0];

		$tourPageDescInfo = $tabTourPageDescription->findByTourPageId($tourPageInfo['id'])->toArray();
		$tourPageDescInfo = $tourPageDescInfo[0];


		$tourInfo = $tabCmsManagetour->findById($tourPageInfo['tour_id'])->toArray();
		$tourInfo = $tourInfo[0];

		$tourPriceInfo = $tabTourPrices->findByTourPageIdAndTourId($tourPageInfo['id'], $tourInfo['id'])->toArray();
		$tourPriceInfo = $tourPriceInfo[0];

		$tourOverviewInfo = $tabTourPageOverviews->findByTourPageId($tourPageInfo['id'])->toArray();
		$tourOverviewInfo = $tourOverviewInfo[0];

		#### READING FAQs

		$filterCategoryFaqs = array();
		$filterCategoryFaqs['conditions'] = array(
			"tour_page_id"		=>		$tourPageInfo['id']
		);
		$filterCategoryFaqs['order'] = array(
			"order_sequence"	=>		"asc"
		);

		$faqs = $tabTourPageFaqs->find('all', $filterCategoryFaqs)->toArray();
		$faqData = array();
		//$faqData['title'] = 'Golden Triangle Tour – FAQs';
		$faqData['title'] = 'Frequently Asked Questions for '.$tourPageInfo['title'];
		$faqData['description'] = 'Quick answers about itinerary, inclusions, customization, and bookings.';

		foreach ($faqs as $faq) {
			$tourPageFaqAnswerInfo = $tabTourPageFaqAnswers->findByTourPageFaqId($faq['id'])->toArray();
			$tourPageFaqAnswerInfo = $tourPageFaqAnswerInfo[0];

			$faqList[] = array(
				"question"		=>		$faq['question'],
				"answer"		=>		$tourPageFaqAnswerInfo['answer']
			);
		}
		$faqData['faq_list'] = $faqList;

		$data['faq'] = $faqData;

		$pageMetaDescription = $tabTourPageMetaDescription->findByTourPageId($tourPageInfo['id'])->toArray();
		$pageMetaDescription = $pageMetaDescription[0];


		if ($tourPageInfo['view_type'] == "") {
			$tourPageInfo['view_type'] = 'day_view';
		}

		$requestDataCurrency = array(
			"currency_code"		=>		"INR"
		);
		$currencyInfo = $this->getCurrencyInfo($requestDataCurrency);

		$data['general'] = array(
			"tour_page_id"			=>	$tourPageInfo['id'],
			"tour_id"				=>	$tourPageInfo['tour_id'],
			"name"					=>	$tourPageInfo['title'],
			"tour_code"				=>	$tourPageInfo['tour_code'],
			"price"					=>	$this->calculateCurrencyRate($tourPriceInfo['low_season_price'], $currencyInfo['currency_value']),
			"discount_price"		=>	$this->calculateCurrencyRate($tourPriceInfo['low_season_discount_price'], $currencyInfo['currency_value']),
			"destinations"			=>	unserialize($tourPageDescInfo['destinations']),
			"duration"				=>	$tourInfo['tour_duration'],
			"view_type"				=>	$tourPageInfo['view_type'],
			"tour_token"			=>	$tourInfo['tour_token'],
			"encrypted_tour_token"	=>	TOKEN_PREFIX . $tourInfo['tour_token'] . TOKEN_POSTFIX,
			"page_url"				=>	$this->getPageUrl()

		);



		/* GETTING CITY DESCRIPTION AND IMAGE */
		$requestDataItinerary = array(
			"tour_id"	=>	$tourPageInfo['tour_id'],
			"duration"	=>	$tourInfo['tour_duration']
		);

		if ($tourPageInfo['view_type'] == 'day_view') {
			$tourSummary = $this->getTourItineraryDayView($requestDataItinerary);
		} else if ($tourPageInfo['view_type'] == 'city_view') {
			$tourSummary = $this->getTourItineraryCityView($requestDataItinerary);
		}



		$data['tour_summary'] = $tourSummary;

		$requestDataHotels = array(
			"tour_id"		=>	$tourPageInfo['tour_id'],
			"tour_page_id"	=>	$tourPageInfo['id'],
			"duration"		=>	$tourInfo['tour_duration']
		);

		$tourHotels = $this->getTourHotels($requestDataHotels);
		$data['tour_hotels'] = $tourHotels;

		$requestDataInclusionExclusion = array(
			"tour_id"		=>		$tourPageInfo['tour_id']
		);

		$inclusionExclusions = $this->getTourInclusionExlusion($requestDataInclusionExclusion);
		$data['inclusion_exclusion'] = $inclusionExclusions;

		$requestDataTourPrice = array(
			"tour_page_id"			=>	$tourPageInfo['id'],
			"tour_id"				=>	$tourPageInfo['tour_id'],
			"currency_code"			=>	"INR"
		);

		$tourPrices = $this->getTourHotelPrice($requestDataTourPrice);
		$data['tour_prices'] = $tourPrices;

		#### TESTIMONIAL VIDEO

		$requestVideoData = array();
		$requestVideoData['video_testimonial_id'] = $tourPageDescInfo['video_testimonial_id'];
		$videoTestimonialInfo = $this->getTourReviewVideo($requestVideoData);

		$data['video_testimonial'] = $videoTestimonialInfo;

		#### TRIPADVISOR TESTIMONIAL 
		$requestSingleTestimonial = array();
		$requestSingleTestimonial['tripadvisor_review_id'] = $tourPageDescInfo['tripadvisor_review_id'];
		$tripAdvisorReviewInfo = $this->getSingleTripadvisorReview($requestSingleTestimonial);

		$data['client_review'] = array();
		$data['client_review']['single_tripadvisor_review'] = $tripAdvisorReviewInfo;
		
		$requestTestimonial = array();
		$requestTestimonial['number_of_record'] = 6;
		$testimonialList = $this->getTripAdvisorReview($requestTestimonial);
		
		$data['client_review']['testimonials'] = $testimonialList;

		$currencyList = $this->getCurrencyList();
		$data['master']['currency_list'] = $currencyList;

		$countryList = $this->getAllCountryList();
		$this->set("countryList", $countryList);

		/*$tripadvisorReviewList = array();
		$tripadvisorReviewList = $this->getTopFiveTripAdvisorReview();
		
		$data['tripadvisor_review_list'] = $tripadvisorReviewList;*/

		#### TOUR OVERVIEW
		$data['content'] = array();
		if ($tourOverviewInfo['description'] != "") {
			$data['content']['tour_overview'] = $tourOverviewInfo['description'];
		}

		$hotelGroups = $this->getTourHotelGroupsByTourId($tourPageInfo['tour_id']);
		$data['hotel_groups'] = $hotelGroups;

		#### SEO TAGS

		$seoTags['meta_title'] = $pageMetaDescription['meta_title'];
		$seoTags['meta_description'] = $pageMetaDescription['meta_description'];
		$seoTags['meta_keyword'] = $pageMetaDescription['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT . $tourPageUrl;
		$seoTags['itemprop_name'] = $tourPageInfo['title'];
		$seoTags['date_published'] = date("Y-m-d", strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d", strtotime("-1 months"));

		$metaTags = $this->Seo->getSeoTags($seoTags, 'general');
		$data['meta_tags'] = $metaTags;

		#### SETTING SHARING URLS
		$sharingUrls = array();
		$sharingUrls['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u=' . WEBROOT . $tourPageUrl;
		$sharingUrls['twitter'] = 'https://twitter.com/intent/tweet?url=' . WEBROOT . $tourPageUrl . '&text=' . $seoTags['meta_title'];
		$sharingUrls['whatsapp'] = 'https://api.whatsapp.com/send?text=' . WEBROOT . $tourPageUrl . '&text=' . $seoTags['meta_title'];
		$sharingUrls['linkedin'] = 'https://www.linkedin.com/sharing/share-offsite/?url=' . WEBROOT . $tourPageUrl;

		$data['sharing_urls'] = $sharingUrls;

		#### SETTING BREADCRUMB

		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[] = array(
			"label"			=>		"Home",
			"link"			=>		WEBROOT,
			"link_url"		=>		true
		);

		$breadcrumbs[] = array(
			"label"			=>		$categoryInfo['name'],
			"link"			=>		WEBROOT . 'tours-' . $categoryInfo['page_url'],
			"link_url"		=>		true
		);

		$breadcrumbs[] = array(
			"label"			=>		$tourPageInfo['title'],
			"link"			=>		WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'],
			"link_url"		=>		true
		);

		$data['breadcrumbs'] = $breadcrumbs;

		$schemaTags = array();

		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;

		$organisationSchemaTags = array();
		$organisationSchemaTags['schema_category_type'] = 'organisation';
		$organisationSchema = $this->Seo->getSchema($organisationSchemaTags);
		$schemaTags[] = $organisationSchema;

		$websiteSchemaTags = array();
		$websiteSchemaTags['schema_category_type'] = 'website';
		$websiteSchema = $this->Seo->getSchema($websiteSchemaTags);
		$schemaTags[] = $websiteSchema;

		$reviewSchemaTags = array();
		$reviewSchemaTags['schema_category_type'] = 'review';
		$reviewSchema = $this->Seo->getSchema($reviewSchemaTags);
		$schemaTags[] = $reviewSchema;

		$touristTripSchemaTags = array();
		$touristTripSchemaTags['name'] = $pageMetaDescription['meta_title'];
		$touristTripSchemaTags['description'] = $pageMetaDescription['meta_description'];
		$touristTripSchemaTags['image'] = ADMIN_REPOSITORY_PATH . "tours/" . $tourPageDescInfo['thumbnail'];

		$cityList = array();
		foreach ($data['general']['destinations'] as $cityInfo) {
			$cityList[] = $cityInfo['city'];
		}


		$touristTripSchemaTags['cities'] = $cityList;
		$touristTripSchemaTags['currency'] = 'INR';
		$touristTripSchemaTags['price'] = $tourPrices['hotel_price']['minimum_price'][0]['profit_price'];
		$touristTripSchemaTags['page_url'] = WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'];
		$touristTripSchemaTags['schema_category_type'] = 'tourist_trip';
		$touristTripSchema = $this->Seo->getSchema($touristTripSchemaTags);
		$schemaTags[] = $touristTripSchema;

		### product schema tag
		$productSchemaTags = array();
		$productSchemaTags['name'] = $tourPageInfo['title'];
		$productSchemaTags['description'] = $pageMetaDescription['meta_description'];
		$productSchemaTags['image'] = ADMIN_REPOSITORY_PATH . "tours/" . $tourPageDescInfo['thumbnail'];

		$primaryTourPrice = str_replace(',', '', $tourPrices['hotel_price']['minimum_price'][0]['profit_price']); // remove commas
		$floatTourPrice = (float) $primaryTourPrice;               // convert to float
		$formattedTourPrice = number_format($floatTourPrice, 2, '.', '');

		$productSchemaTags['tour_price'] = $formattedTourPrice;
		$productSchemaTags['currency'] = "INR";
		$productSchemaTags['page_url'] = WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'];

		$productSchemaTags['schema_category_type'] = 'product_services';
		$productSchema = $this->Seo->getSchema($productSchemaTags);
		$schemaTags[] = $productSchema;


		$tripAgreegateRating = array();
		$tripAgreegateRating['tour_name'] = $tourPageInfo['title'];

		$tripAgreegateRating['schema_category_type'] = 'trip_agreegate_rating';
		$tripAgreegateSchema = $this->Seo->getSchema($tripAgreegateRating);
		$schemaTags[] = $tripAgreegateSchema;

		if ($faqList[0]['question'] != "") {
			$faqSchemaTags = array();
			$faqSchemaTags['faq_list'] = $faqList;
			$faqSchemaTags['schema_category_type'] = 'faq';
			$faqSchema = $this->Seo->getSchema($faqSchemaTags);
			$schemaTags[] = $faqSchema;
		}

		$videoTestimonialSchemaTags = array();
		$videoTestimonialSchemaTags['tour_name'] = $tourPageInfo['title'];
		$videoTestimonialSchemaTags['thumbnail_url'] = $videoTestimonialInfo['thumbnail'];
		$videoTestimonialSchemaTags['upload_date'] = $videoTestimonialInfo['upload_date'];
		$videoTestimonialSchemaTags['duration_minute'] = $videoTestimonialInfo['duration_minute'];
		$videoTestimonialSchemaTags['duration_second'] = $videoTestimonialInfo['duration_second'];
		$videoTestimonialSchemaTags['page_url'] = WEBROOT.'video-testimonial/'.$videoTestimonialInfo['page_url'];
		$videoTestimonialSchemaTags['video_url'] = $videoTestimonialInfo['video'];

		$videoTestimonialSchemaTags['schema_category_type'] = 'video_single_testimonial_tour';
		$videoTestimonialSchema = $this->Seo->getSchema($videoTestimonialSchemaTags);
		$schemaTags[] = $videoTestimonialSchema;

		#### TRIPADVISOR REVIEW SCHEMA
		$tripadvisorReviewSchemaTags = array();
		$tripadvisorReviewSchemaTags['reviewer_name'] = $tripAdvisorReviewInfo['name'];
		$tripadvisorReviewSchemaTags['review_date'] = $tripAdvisorReviewInfo['review_date'];
		$tripadvisorReviewSchemaTags['review_description'] = $tripAdvisorReviewInfo['full_description'];
		$tripadvisorReviewSchemaTags['review_rating'] = '5';
		$tripadvisorReviewSchemaTags['trip_name'] = $tourPageInfo['title'];

		$tripadvisorReviewSchemaTags['schema_category_type'] = 'single_client_trip_testimonial';
		$tripadvisorReviewSchema = $this->Seo->getSchema($tripadvisorReviewSchemaTags);
		$schemaTags[] = $tripadvisorReviewSchema;

		$data['schema'] = $schemaTags;


		$this->set("data", $data);
	}

	public function detailsNew($categoryPageUrl = "", $tourPageUrl = "")
	{
		$this->loadComponent('Seo');

		$this->viewBuilder()->setLayout('version2/default');
		$this->set('showEnquiryModal', false);

		$tabCategory = $this->fetchTable('TblCategory');
		$tabTourPages = $this->fetchTable('TblsTourPages');
		$tabTourPageDescription = $this->fetchTable('TblsTourPageDescription');
		$tabCmsManagetour = $this->fetchTable('CmsManagetour');
		$tabTourPrices = $this->fetchTable('TourPrices');
		$tabTourPageMetaDescription = $this->fetchTable('TblsTourPageMetaDescription');
		$tabTourPageFaqs = $this->fetchTable('TblsTourPageFaqs');
		$tabTourPageFaqAnswers = $this->fetchTable('TblsTourPageFaqAnswers');
		$tabTourPageOverviews = $this->fetchTable('TblsTourPageOverviews');

		$tabTblsTourEvents = $this->fetchTable('TblsTourEvents');


		$requestData = array();
		$requestData['page_url'] = $tourPageUrl;
		$requestData['category_page_url'] = $categoryPageUrl;

		$categoryInfo = $tabCategory->findByPageUrl($categoryPageUrl)->toArray();
		$categoryInfo = $categoryInfo[0];



		$tourPageInfo = $tabTourPages->findByPageUrl($requestData['page_url'])->toArray();
		$tourPageInfo = $tourPageInfo[0];

		$tourPageDescInfo = $tabTourPageDescription->findByTourPageId($tourPageInfo['id'])->toArray();
		$tourPageDescInfo = $tourPageDescInfo[0];


		$tourInfo = $tabCmsManagetour->findById($tourPageInfo['tour_id'])->toArray();
		$tourInfo = $tourInfo[0];

		$tourPriceInfo = $tabTourPrices->findByTourPageIdAndTourId($tourPageInfo['id'], $tourInfo['id'])->toArray();
		$tourPriceInfo = $tourPriceInfo[0];

		$tourOverviewInfo = $tabTourPageOverviews->findByTourPageId($tourPageInfo['id'])->toArray();
		$tourOverviewInfo = $tourOverviewInfo[0];

		#### READING FAQs

		$filterCategoryFaqs = array();
		$filterCategoryFaqs['conditions'] = array(
			"tour_page_id"		=>		$tourPageInfo['id']
		);
		$filterCategoryFaqs['order'] = array(
			"order_sequence"	=>		"asc"
		);

		$faqs = $tabTourPageFaqs->find('all', $filterCategoryFaqs)->toArray();
		$faqData = array();
		//$faqData['title'] = 'Golden Triangle Tour – FAQs';
		$faqData['title'] = 'FAQs';
		$faqData['description'] = 'Quick answers about itinerary, inclusions, customization, and bookings.';

		foreach ($faqs as $faq) {
			$tourPageFaqAnswerInfo = $tabTourPageFaqAnswers->findByTourPageFaqId($faq['id'])->toArray();
			$tourPageFaqAnswerInfo = $tourPageFaqAnswerInfo[0];

			$faqList[] = array(
				"question"		=>		$faq['question'],
				"answer"		=>		$tourPageFaqAnswerInfo['answer']
			);
		}
		$faqData['faq_list'] = $faqList;

		$data['faq'] = $faqData;

		$pageMetaDescription = $tabTourPageMetaDescription->findByTourPageId($tourPageInfo['id'])->toArray();
		$pageMetaDescription = $pageMetaDescription[0];


		if ($tourPageInfo['view_type'] == "") {
			$tourPageInfo['view_type'] = 'day_view';
		}

		$requestDataCurrency = array(
			"currency_code"		=>		"INR"
		);
		$currencyInfo = $this->getCurrencyInfo($requestDataCurrency);

		$data['general'] = array(
			"tour_page_id"			=>	$tourPageInfo['id'],
			"tour_id"				=>	$tourPageInfo['tour_id'],
			"name"					=>	$tourPageInfo['title'],
			"tour_code"				=>	$tourPageInfo['tour_code'],
			"price"					=>	$this->calculateCurrencyRate($tourPriceInfo['low_season_price'], $currencyInfo['currency_value']),
			"discount_price"		=>	$this->calculateCurrencyRate($tourPriceInfo['low_season_discount_price'], $currencyInfo['currency_value']),
			"destinations"			=>	unserialize($tourPageDescInfo['destinations']),
			"duration"				=>	$tourInfo['tour_duration'],
			"view_type"				=>	$tourPageInfo['view_type'],
			"tour_token"			=>	$tourInfo['tour_token'],
			"encrypted_tour_token"	=>	TOKEN_PREFIX . $tourInfo['tour_token'] . TOKEN_POSTFIX,
			"page_url"				=>	$this->getPageUrl()

		);



		/* GETTING CITY DESCRIPTION AND IMAGE */
		$requestDataItinerary = array(
			"tour_id"	=>	$tourPageInfo['tour_id'],
			"duration"	=>	$tourInfo['tour_duration']
		);

		if ($tourPageInfo['view_type'] == 'day_view') {
			$tourSummary = $this->getTourItineraryDayView($requestDataItinerary);
		} else if ($tourPageInfo['view_type'] == 'city_view') {
			$tourSummary = $this->getTourItineraryCityView($requestDataItinerary);
		}



		$data['tour_summary'] = $tourSummary;

		$requestDataHotels = array(
			"tour_id"		=>	$tourPageInfo['tour_id'],
			"tour_page_id"	=>	$tourPageInfo['id'],
			"duration"		=>	$tourInfo['tour_duration']
		);

		$tourHotels = $this->getTourHotels($requestDataHotels);
		$data['tour_hotels'] = $tourHotels;

		$requestDataInclusionExclusion = array(
			"tour_id"		=>		$tourPageInfo['tour_id']
		);

		$inclusionExclusions = $this->getTourInclusionExlusion($requestDataInclusionExclusion);
		$data['inclusion_exclusion'] = $inclusionExclusions;

		$requestDataTourPrice = array(
			"tour_page_id"			=>	$tourPageInfo['id'],
			"tour_id"				=>	$tourPageInfo['tour_id'],
			"currency_code"			=>	"INR"
		);

		$tourPrices = $this->getTourHotelPrice($requestDataTourPrice);
		$data['tour_prices'] = $tourPrices;

		#### TESTIMONIAL VIDEO

		$requestVideoData = array();
		$requestVideoData['video_testimonial_id'] = $tourPageDescInfo['video_testimonial_id'];
		$videoTestimonialInfo = $this->getTourReviewVideo($requestVideoData);

		$data['video_testimonial'] = $videoTestimonialInfo;

		#### TRIPADVISOR TESTIMONIAL 
		$requestSingleTestimonial = array();
		$requestSingleTestimonial['tripadvisor_review_id'] = $tourPageDescInfo['tripadvisor_review_id'];
		$tripAdvisorReviewInfo = $this->getSingleTripadvisorReview($requestSingleTestimonial);

		$data['client_review'] = array();
		$data['client_review']['single_tripadvisor_review'] = $tripAdvisorReviewInfo;

		$currencyList = $this->getCurrencyList();
		$data['master']['currency_list'] = $currencyList;

		$countryList = $this->getAllCountryList();
		$this->set("countryList", $countryList);

		/*$tripadvisorReviewList = array();
		$tripadvisorReviewList = $this->getTopFiveTripAdvisorReview();
		
		$data['tripadvisor_review_list'] = $tripadvisorReviewList;*/

		#### TOUR OVERVIEW
		$data['content'] = array();
		if ($tourOverviewInfo['description'] != "") {
			$data['content']['tour_overview'] = $tourOverviewInfo['description'];
		}

		$hotelGroups = $this->getTourHotelGroupsByTourId($tourPageInfo['tour_id']);
		$data['hotel_groups'] = $hotelGroups;

		#### SEO TAGS

		$seoTags['meta_title'] = $pageMetaDescription['meta_title'];
		$seoTags['meta_description'] = $pageMetaDescription['meta_description'];
		$seoTags['meta_keyword'] = $pageMetaDescription['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT . $tourPageUrl;
		$seoTags['itemprop_name'] = $tourPageInfo['title'];
		$seoTags['date_published'] = date("Y-m-d", strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d", strtotime("-1 months"));

		$metaTags = $this->Seo->getSeoTags($seoTags, 'general');
		$data['meta_tags'] = $metaTags;

		#### SETTING SHARING URLS
		$sharingUrls = array();
		$sharingUrls['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u=' . WEBROOT . $tourPageUrl;
		$sharingUrls['twitter'] = 'https://twitter.com/intent/tweet?url=' . WEBROOT . $tourPageUrl . '&text=' . $seoTags['meta_title'];
		$sharingUrls['whatsapp'] = 'https://api.whatsapp.com/send?text=' . WEBROOT . $tourPageUrl . '&text=' . $seoTags['meta_title'];
		$sharingUrls['linkedin'] = 'https://www.linkedin.com/sharing/share-offsite/?url=' . WEBROOT . $tourPageUrl;

		$data['sharing_urls'] = $sharingUrls;

		#### SETTING BREADCRUMB

		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[] = array(
			"label"			=>		"Home",
			"link"			=>		WEBROOT,
			"link_url"		=>		true
		);

		$breadcrumbs[] = array(
			"label"			=>		$categoryInfo['name'],
			"link"			=>		WEBROOT . 'tours-' . $categoryInfo['page_url'],
			"link_url"		=>		true
		);

		$breadcrumbs[] = array(
			"label"			=>		$tourPageInfo['title'],
			"link"			=>		WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'],
			"link_url"		=>		true
		);

		$data['breadcrumbs'] = $breadcrumbs;

		$schemaTags = array();

		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;

		$organisationSchemaTags = array();
		$organisationSchemaTags['schema_category_type'] = 'organisation';
		$organisationSchema = $this->Seo->getSchema($organisationSchemaTags);
		$schemaTags[] = $organisationSchema;

		$websiteSchemaTags = array();
		$websiteSchemaTags['schema_category_type'] = 'website';
		$websiteSchema = $this->Seo->getSchema($websiteSchemaTags);
		$schemaTags[] = $websiteSchema;

		$reviewSchemaTags = array();
		$reviewSchemaTags['schema_category_type'] = 'review';
		$reviewSchema = $this->Seo->getSchema($reviewSchemaTags);
		$schemaTags[] = $reviewSchema;

		$touristTripSchemaTags = array();
		$touristTripSchemaTags['name'] = $pageMetaDescription['meta_title'];
		$touristTripSchemaTags['description'] = $pageMetaDescription['meta_description'];
		$touristTripSchemaTags['image'] = ADMIN_REPOSITORY_PATH . "tours/" . $tourPageDescInfo['thumbnail'];

		$cityList = array();
		foreach ($data['general']['destinations'] as $cityInfo) {
			$cityList[] = $cityInfo['city'];
		}


		$touristTripSchemaTags['cities'] = $cityList;
		$touristTripSchemaTags['currency'] = 'INR';
		$touristTripSchemaTags['price'] = $tourPrices['hotel_price']['minimum_price'][0]['profit_price'];
		$touristTripSchemaTags['page_url'] = WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'];
		$touristTripSchemaTags['schema_category_type'] = 'tourist_trip';
		$touristTripSchema = $this->Seo->getSchema($touristTripSchemaTags);
		$schemaTags[] = $touristTripSchema;

		### product schema tag
		$productSchemaTags = array();
		$productSchemaTags['name'] = $tourPageInfo['title'];
		$productSchemaTags['description'] = $pageMetaDescription['meta_description'];
		$productSchemaTags['image'] = ADMIN_REPOSITORY_PATH . "tours/" . $tourPageDescInfo['thumbnail'];

		$primaryTourPrice = str_replace(',', '', $tourPrices['hotel_price']['minimum_price'][0]['profit_price']); // remove commas
		$floatTourPrice = (float) $primaryTourPrice;               // convert to float
		$formattedTourPrice = number_format($floatTourPrice, 2, '.', '');

		$productSchemaTags['tour_price'] = $formattedTourPrice;
		$productSchemaTags['currency'] = "INR";
		$productSchemaTags['page_url'] = WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'];

		$productSchemaTags['schema_category_type'] = 'product_services';
		$productSchema = $this->Seo->getSchema($productSchemaTags);
		$schemaTags[] = $productSchema;


		$tripAgreegateRating = array();
		$tripAgreegateRating['tour_name'] = $tourPageInfo['title'];

		$tripAgreegateRating['schema_category_type'] = 'trip_agreegate_rating';
		$tripAgreegateSchema = $this->Seo->getSchema($tripAgreegateRating);
		$schemaTags[] = $tripAgreegateSchema;

		if ($faqList[0]['question'] != "") {
			$faqSchemaTags = array();
			$faqSchemaTags['faq_list'] = $faqList;
			$faqSchemaTags['schema_category_type'] = 'faq';
			$faqSchema = $this->Seo->getSchema($faqSchemaTags);
			$schemaTags[] = $faqSchema;
		}

		$videoTestimonialSchemaTags = array();
		$videoTestimonialSchemaTags['tour_name'] = $tourPageInfo['title'];
		$videoTestimonialSchemaTags['thumbnail_url'] = $videoTestimonialInfo['thumbnail'];
		$videoTestimonialSchemaTags['upload_date'] = $videoTestimonialInfo['upload_date'];
		$videoTestimonialSchemaTags['duration_minute'] = $videoTestimonialInfo['duration_minute'];
		$videoTestimonialSchemaTags['duration_second'] = $videoTestimonialInfo['duration_second'];
		$videoTestimonialSchemaTags['page_url'] = WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'];
		$videoTestimonialSchemaTags['video_url'] = $videoTestimonialInfo['video'];

		$videoTestimonialSchemaTags['schema_category_type'] = 'video_single_testimonial_tour';
		$videoTestimonialSchema = $this->Seo->getSchema($videoTestimonialSchemaTags);
		$schemaTags[] = $videoTestimonialSchema;

		#### TRIPADVISOR REVIEW SCHEMA
		$tripadvisorReviewSchemaTags = array();
		$tripadvisorReviewSchemaTags['reviewer_name'] = $tripAdvisorReviewInfo['name'];
		$tripadvisorReviewSchemaTags['review_date'] = $tripAdvisorReviewInfo['review_date'];
		$tripadvisorReviewSchemaTags['review_description'] = $tripAdvisorReviewInfo['full_description'];
		$tripadvisorReviewSchemaTags['review_rating'] = '5';
		$tripadvisorReviewSchemaTags['trip_name'] = $tourPageInfo['title'];

		$tripadvisorReviewSchemaTags['schema_category_type'] = 'single_client_trip_testimonial';
		$tripadvisorReviewSchema = $this->Seo->getSchema($tripadvisorReviewSchemaTags);
		$schemaTags[] = $tripadvisorReviewSchema;

		$data['schema'] = $schemaTags;


		$this->set("data", $data);
	}

	function getSingleTripadvisorReview($requestData = array())
	{
		if ($requestData['tripadvisor_review_id'] == "") {
			$requestData['tripadvisor_review_id'] = 1;
		}

		$tblsTripadvisorReviews = $this->fetchTable('TblsTripadvisorReviews');
		$tblsTripadvisorReviewDetails = $this->fetchTable('TblsTripadvisorReviewDetails');

		$tripadvisorReviewInfo = $tblsTripadvisorReviews->findById($requestData['tripadvisor_review_id'])->toArray();
		$tripadvisorReviewInfo = $tripadvisorReviewInfo[0];

		$tripadvisorReviewDetInfo = $tblsTripadvisorReviewDetails->findByReviewId($tripadvisorReviewInfo['id'])->toArray();
		$tripadvisorReviewDetInfo = $tripadvisorReviewDetInfo[0];


		$reviewData = array(
			"id"				=>		$tripadvisorReviewInfo['id'],
			"name"				=>		$tripadvisorReviewInfo['name'],
			"place"				=>		$tripadvisorReviewInfo['place'],
			"review_date"		=>		$tripadvisorReviewInfo['review_date']->i18nFormat('yyyy-MM-dd'),
			"short_description"	=>		$tripadvisorReviewDetInfo['short_description'],
			"description"		=>		substr($tripadvisorReviewDetInfo['long_description'], 0, 150),
			"full_description"	=>		$tripadvisorReviewDetInfo['long_description']
		);



		return $reviewData;
	}

	function getTourReviewVideo($requestData = array())
	{
		if ($requestData['video_testimonial_id'] == "") {
			$requestData['video_testimonial_id'] = 1;
		}
		$tabVideoTestimonial = $this->fetchTable('TblsVideoTestimonial');
		$tabVideoTestimonialDet = $this->fetchTable('TblsVideoTestimonialDetails');

		$videoTestimonialInfo = $tabVideoTestimonial->findById($requestData['video_testimonial_id'])->toArray();
		$videoTestimonialInfo = $videoTestimonialInfo[0];

		if ($videoTestimonialInfo['id'] == "") {
			$filterVideoTestimonial = array();
			$filterVideoTestimonial['order'] = array(
				"id"	=>		"desc"
			);
			$filterVideoTestimonial['limit'] = 1;

			$videoTestimonialInfo = $tabVideoTestimonial->find('all', $filterVideoTestimonial)->toArray();
			$videoTestimonialInfo = $videoTestimonialInfo[0];
		}

		$responseData = array();
		$responseData['client_name'] = $videoTestimonialInfo['client_name'];
		$responseData['country'] = $videoTestimonialInfo['country'];
		$responseData['thumbnail'] = WEBROOT . "repositery/video/image/" . $videoTestimonialInfo['thumbnails'];
		$responseData['video'] = WEBROOT . "repositery/video/" . $videoTestimonialInfo['video'];
		$responseData['page_url'] = $videoTestimonialInfo['page_url'];
		$responseData['upload_date'] = $videoTestimonialInfo['modified']->i18nFormat('yyyy-MM-dd');


		if ($videoTestimonialInfo['id'] != "") {
			$videoTestimonialDetInfo =  $tabVideoTestimonialDet->findByVideoTestimonialId($videoTestimonialInfo['id'])->toArray();
			$videoTestimonialDetInfo = $videoTestimonialDetInfo[0];

			$responseData['duration'] = $videoTestimonialDetInfo['duration'];
			$responseData['duration_minute'] = floor($videoTestimonialDetInfo['duration'] / 60);
			$responseData['duration_second'] = $videoTestimonialDetInfo['duration'] % 60;
		}


		return $responseData;
	}

	private function getTourHotelPrice($data = array())
	{

		$tabTourPrices = $this->fetchTable('TourPrices');
		$tabTourPriceDetails = $this->fetchTable('TourPriceDetails');
		$tabTourPagesHotels	 = $this->fetchTable('TblsTourPagesHotels');

		$currencyCode = 'INR';

		if ($data['currency_code'] == "") {
			$data['currency_code'] = $currencyCode;
		}

		$filterTourPageHotels = array();
		$filterTourPageHotels['conditions'] = array(
			"tour_page_id"		=>		$data['tour_page_id']
		);

		$tourPageHotels = $tabTourPagesHotels->find('all', $filterTourPageHotels)->toArray();

		$tourPageHotelList = array();
		foreach ($tourPageHotels as $tourPageHotel) {
			$tourPageHotelList[] = $tourPageHotel['hotel_type_id'];
		}


		$tourPriceInfo = $tabTourPrices->findByTourIdAndTourPageId($data['tour_id'], $data['tour_page_id'])->toArray();
		$tourPriceInfo = $tourPriceInfo[0];

		$filterTourPriceDetails = array();
		$filterTourPriceDetails['order'] = array(
			"id"		=>		"desc"
		);
		$filterTourPriceDetails['limit'] = 1;
		$filterTourPriceDetails['conditions'] = array(
			"tour_id"		=>		$data['tour_id'],
			"tour_page_id"	=>		$data['tour_page_id']
		);

		//$tourPriceDetInfo = $tabTourPriceDetails->findByTourIdAndTourPageId($data['tour_id'],$data['tour_page_id'])->toArray();
		//$tourPriceDetInfo = $tabTourPriceDetails->findAllByTourIdAndTourPageId($data['tour_id'],$data['tour_page_id'])->toArray();
		$tourPriceDetInfo = $tabTourPriceDetails->find('all', $filterTourPriceDetails)->toArray();


		$tourPriceDetInfo = $tourPriceDetInfo[0];

		$requestDataCurrency = array(
			"currency_code"		=>		$data['currency_code']
		);


		$currencyInfo = $this->getCurrencyInfo($requestDataCurrency);

		$hotelPrices = unserialize($tourPriceDetInfo['price_data']);


		$basePrice = array(
			"price"				=>		$this->calculateCurrencyRate($tourPriceInfo['low_season_price'], $currencyInfo['currency_value']),
			"discount_price"	=>		$this->calculateCurrencyRate($tourPriceInfo['low_season_discount_price'], $currencyInfo['currency_value']),
			"currency_code"		=>		$currencyInfo['currency_code']
		);

		$hotelPriceList = array();


		$bestPriceList = array();
		$minimumPriceList = array();

		foreach ($hotelPrices['best_price'] as $bestPrice) {


			if (!in_array($bestPrice['hotel_type_id'], $tourPageHotelList)) {
				continue;
			}
			$bestPrice['currency_code'] = $currencyInfo['currency_code'];


			$bestPrice['profit_price'] = $this->calculateCurrencyRate($bestPrice['profit_price'], $currencyInfo['currency_value']);
			$bestPrice['discount_price'] = $this->calculateCurrencyRate($bestPrice['discount_price'], $currencyInfo['currency_value']);
			$bestPrice['price_exception'] = $bestPrice['price_exception'];

			$bestPriceList[] = $bestPrice;
		}

		foreach ($hotelPrices['minimum_price'] as $minimumPrice) {

			if (!in_array($minimumPrice['hotel_type_id'], $tourPageHotelList)) {
				continue;
			}

			$minimumPrice['currency_code'] = $currencyInfo['currency_code'];

			$minimumPrice['profit_price'] = $this->calculateCurrencyRate($minimumPrice['profit_price'], $currencyInfo['currency_value']);
			$minimumPrice['discount_price'] = $this->calculateCurrencyRate($minimumPrice['discount_price'], $currencyInfo['currency_value']);
			$minimumPrice['price_exception'] = $minimumPrice['price_exception'];

			$minimumPriceList[] = $minimumPrice;
		}

		$hotelPriceList = array(
			"best_price"		=>		$bestPriceList,
			"minimum_price"		=>		$minimumPriceList
		);



		$responseData = array(
			"base_price"	=>	$basePrice,
			"hotel_price"	=>	$hotelPriceList
		);


		return $responseData;
	}

	function calculateCurrencyRate($price, $currencyValue)
	{
		$tourPrice = str_replace(",", "", strval($price));
		$tourPrice = $tourPrice / $currencyValue;
		$tourPrice = ceil($tourPrice);
		$tourPrice = ceil($tourPrice / 10) * 10;
		$tourPrice = number_format($tourPrice);

		return $tourPrice;
	}

	private function getTourInclusionExlusion($data = array())
	{
		$tabCmsTourInclusion = $this->fetchTable('CmsTourInclusion');
		$tabCmsTourExclusion = $this->fetchTable('CmsTourExclusion');
		$tabInclusionExclusion = $this->fetchTable('TblsInclusionExclusion');
		$tabCmsTourDayPlan = $this->fetchTable('CmsTourDayPlan');
		$tabEventInclusionExclusion = $this->fetchTable('TblsEventInclusionExclusion');
		


		$filterCmsTourInclusion = array();
		$filterCmsTourInclusion['conditions'] = array(
														"tour_id"		=>		$data['tour_id']
												);
		$filterCmsTourInclusion['order'] = array(
													"order_no"	=>	"asc"
											);

		$cmsTourInclusions = $tabCmsTourInclusion->find('all', $filterCmsTourInclusion)->toArray();

		$inclusionList = array();
		
		$standardInclusionList = array();
		
		foreach ($cmsTourInclusions as $cmsTourInclusion) 
		{
			$inclusionInfo = $tabInclusionExclusion->findById($cmsTourInclusion['inclusion_id'])->toArray();
			$inclusionInfo = $inclusionInfo[0];

			$standardInclusionList[] = $inclusionInfo['incexcdesc'];
		}
		
		#### GETTING EVENT INCLUSION
		$tourDayPlans = $tabCmsTourDayPlan->findAllByTourId($data['tour_id'])->toArray();
		$tourEventInclusionIds = array();
		
		foreach($tourDayPlans as $tourDayPlan)
		{
			$tourEventInclusions = $tabEventInclusionExclusion->findAllByEventIdAndInclusionType($tourDayPlan['event_id'],'tour')->toArray();
			
			foreach($tourEventInclusions as $tourEventInclusion)
			{
				$tourEventInclusionIds[] = $tourEventInclusion['inclusion_exclusion_id'];
			}
		}
		
		

		$tourEventInclusionIds = array_unique($tourEventInclusionIds);
		
		$eventInclusionList = array();
		
		foreach($tourEventInclusionIds as $tourEventInclusionId)
		{
			$inclusionInfo = $tabInclusionExclusion->findById($tourEventInclusionId)->toArray();
			$inclusionInfo = $inclusionInfo[0];

			$eventInclusionList[] = $inclusionInfo['incexcdesc'];
		
		}
		
		$countStandarInclusion = 1;
		foreach($standardInclusionList as $standarInclusion)
		{
			$inclusionList[] = $standarInclusion;
			if($countStandarInclusion==5)
			{
				foreach($eventInclusionList as $eventInclusion)
				{
					$inclusionList[] = $eventInclusion;
				}
			}
			$countStandarInclusion++;
		}
		
		#### ADDING EXTRA LOOP IF STANDARD INCLUSION IS LESS THEN FIVE
		
		if($countStandarInclusion<5)
		{
			foreach($eventInclusionList as $eventInclusion)
			{
				$inclusionList[] = $eventInclusion;
			}
		}
		

		$filterCmsTourExclusion = array();
		$filterCmsTourExclusion['conditions'] = array(
			"tour_id"		=>		$data['tour_id']
		);
		$filterCmsTourExclusion['order'] = array(
			"order_no"	=>	"asc"
		);

		$cmsTourExclusions = $tabCmsTourExclusion->find('all', $filterCmsTourExclusion)->toArray();


		$exclusionList = array();
		foreach ($cmsTourExclusions as $cmsTourExclusion) {

			$exclusionInfo = $tabInclusionExclusion->findById($cmsTourExclusion['exclusion_id'])->toArray();
			$exclusionInfo = $exclusionInfo[0];



			$exclusionList[] = $exclusionInfo['incexcdesc'];
		}


		$inclusionExclusionList = array(
			"inclusion"		=>		$inclusionList,
			"exclusion"		=>		$exclusionList
		);

		return $inclusionExclusionList;
	}

	private function getTourHotels($data = array())
	{
		$tabCity	 = $this->fetchTable('TblsCity');
		$tabTourPagesHotels	 = $this->fetchTable('TblsTourPagesHotels');
		$tabCmsHotelGroup = $this->fetchTable('CmsHotelGroup');
		$tabHotelType = $this->fetchTable('TblsHotelType');
		$tabCmsTourHotel = $this->fetchTable('CmsTourHotel');
		$tabHotel = $this->fetchTable('TblsHotel');
		$tabHotelRoom = $this->fetchTable('TblsHotelRoom');



		$filterTourPageHotels = array();
		$filterTourPageHotels['conditions'] = array(
			"tour_page_id"		=>		$data['tour_page_id']
		);

		$tourPageHotels = $tabTourPagesHotels->find('all', $filterTourPageHotels)->toArray();

		$tourPageHotelTypes = array();
		foreach ($tourPageHotels as $tourPageHotel) {
			$tourPageHotelTypes[] = $tourPageHotel['hotel_type_id'];
		}

		$filterHotelGroup = array();
		$filterHotelGroup['conditions'] = array(
			"hotel_type in"		=>		$tourPageHotelTypes,
			"tour_id"			=>		$data['tour_id']
		);
		$filterHotelGroup['order'] = array(
			"order_sequence"	=>		"asc"
		);

		$cmsHotelGroups = $tabCmsHotelGroup->find('all', $filterHotelGroup)->toArray();


		foreach ($cmsHotelGroups as $cmsHotelGroup) {
			$hotelTypeInfo = $tabHotelType->findById($cmsHotelGroup['hotel_type'])->toArray();
			$hotelTypeInfo = $hotelTypeInfo[0];

			$dayInformation = array();
			for ($i = 1; $i <= $data['duration']; $i++) {
				$filterCmsTourHotel = array();
				$filterCmsTourHotel['conditions'] = array(
					"group_id"		=>		$cmsHotelGroup['id'],
					"day_count"		=>		$i
				);

				$cmsTourHotels = $tabCmsTourHotel->find('all', $filterCmsTourHotel)->toArray();


				$dayHotelList = array();
				foreach ($cmsTourHotels as $tourHotel) {
					$hotelInfo = $tabHotel->findById($tourHotel['hotel_id'])->toArray();
					$hotelInfo = $hotelInfo[0];

					$hotelRoomInfo = $tabHotelRoom->findById($tourHotel['room_id'])->toArray();
					$hotelRoomInfo = $hotelRoomInfo[0];

					$dayHotelList[] = array(
						"id"			=>		$tourHotel['id'],
						"hotel_id"		=>		$tourHotel['hotel_id'],
						"day_count"		=>		$tourHotel['day_count'],
						"room_id"		=>		$tourHotel['room_id'],
						"hotel_name"	=>		$hotelInfo['hotel_name'],
						"room_name"		=>		$hotelRoomInfo['room_name']
					);
				}

				if ($cmsTourHotels[0]['city_id'] == "") {
					continue;
				}

				$cityInfo = $tabCity->findById($cmsTourHotels[0]['city_id'])->toArray();
				$cityInfo = $cityInfo[0];


				$dayInformation[] = array(
					"day_count"		=>		$i,
					"city_name"		=>		$cityInfo['city_name'],
					"city_id"		=>		$cityInfo['id'],
					"hotel_list"	=>		$dayHotelList
				);
			}

			$hotelGroupList[] = array(
				"group_id"				=>		$cmsHotelGroup['id'],
				"hotel_type_id"			=>		$hotelTypeInfo['id'],
				"hotel_type_name"		=>		$hotelTypeInfo['hotel_type'],
				"hotel_alias_name"		=>		$hotelTypeInfo['hotel_alias'],
				"hotel_rating"			=>		$hotelTypeInfo['rating'],
				"hotels"				=>		$dayInformation
			);
		}

		return $hotelGroupList;
	}

	private function getTourItineraryDayView($data = array())
	{
		$tabCmsTourDayPlan = $this->fetchTable('CmsTourDayPlan');
		$tabTourEvents	 = $this->fetchTable('TblsTourEvents');
		$tabTourEventDescriptions	 = $this->fetchTable('TblsTourEventDescriptions');
		$tabCity	 = $this->fetchTable('TblsCity');
		$tabCityDetail	 = $this->fetchTable('TblsCityDetail');

		$responseData = array();



		$filterTourDayPlan = array();
		$filterTourDayPlan['conditions'] = array(
			"tour_id"		=>		$data['tour_id']
		);
		$filterTourDayPlan['order']	= array(
			"day_count"	=>	"asc"
		);
		//$filterTourDayPlan['fields'] = array("event_id");
		$eventIds = $tabCmsTourDayPlan->find('all', $filterTourDayPlan)->toArray();

		$cmsToureventIdList = array();
		foreach ($eventIds as $eventId) {
			if (in_array($eventId['event_id'], $cmsToureventIdList)) {
				continue;
			}
			$cmsToureventIdList[] = $eventId['event_id'];
		}


		$city = array();
		$summary = array();
		$itineraryPlans = array();


		foreach ($cmsToureventIdList as $cmsTourEventId) {

			$filterCmsEventStartDay = array();
			$filterCmsEventStartDay['conditions'] = array(
				"event_id"		=>		$cmsTourEventId,
				"tour_id"		=>		$data['tour_id']
			);
			$filterCmsEventStartDay['order'] = array(
				"day_count"		=>	"asc"
			);
			$filterCmsEventStartDay['limit'] = 1;

			$cmsTourStartDay = $tabCmsTourDayPlan->find('all', $filterCmsEventStartDay)->toArray();
			$cmsTourStartDay = $cmsTourStartDay[0];



			$filterCmsEventEndDay = array();
			$filterCmsEventEndDay['conditions'] = array(
				"event_id"		=>		$cmsTourEventId,
				"tour_id"		=>		$data['tour_id']
			);
			$filterCmsEventEndDay['order'] = array(
				"day_count"		=>	"desc"
			);
			$filterCmsEventEndDay['limit'] = 1;

			$cmsTourEndDay = $tabCmsTourDayPlan->find('all', $filterCmsEventEndDay)->toArray();
			$cmsTourEndDay = $cmsTourEndDay[0];


			$infoTourEvent = $tabTourEvents->findById($cmsTourEndDay['event_id'])->toArray();
			$infoTourEvent = $infoTourEvent[0];

			$eventDescriptionInfo = $tabTourEventDescriptions->findByTourEventIdAndViewType($cmsTourEndDay['event_id'], 'city_view')->toArray();
			$eventDescriptionInfo = $eventDescriptionInfo[0];

			$cityInfo = $tabCity->findById($infoTourEvent['subregion_id'])->toArray();
			$cityInfo = $cityInfo[0];

			$cityDetailInfo = $tabCityDetail->findByCityId($cityInfo['id'])->toArray();
			$cityDetailInfo = $cityDetailInfo[0];

			$addCityList = true;

			foreach ($city as $subregion) {
				if ($subregion['id'] == $cityInfo['id']) {
					$addCityList = false;
				}
			}

			if ($addCityList) {

				$city[] = array(
					"id"		=>		$cityInfo['id'],
					"name"		=>		$cityInfo['city_name']
				);

				
				

				$summary[] = array(
					"cms_tour_plan_id"		=>		$cmsTourStartDay['id'],
					"event_id"				=>		$infoTourEvent['id'],
					"city_name"				=>		$cityInfo['city_name'],
					"image"					=>		WEBROOT_REPOSITORY . 'city/' . $cityInfo['image'],
					"start_day"				=>		$cmsTourStartDay['day_count'],
					"end_day"				=>		$cmsTourEndDay['day_count'],
					"city_description"		=>		($cityDetailInfo['description'])?mb_strimwidth($cityDetailInfo['description'], 0, 90, "...."):''

				);
			}

			$lastIndex = count($summary);

			$summary[($lastIndex - 1)]['end_day'] = $cmsTourEndDay['day_count'];
		}

		$itineraryPlans = array();
		$summary = array();

		for ($i = 1; $i <= $data['duration']; $i++) {

			$filterCmsEvent = array();
			$filterCmsEvent['conditions'] = array(
				"tour_id"		=>		$data['tour_id'],
				"day_count"		=>		$i
			);
			$filterCmsEvent['order'] = array(
				"day_orderno"		=>	"asc"
			);


			$cmsTours = $tabCmsTourDayPlan->find('all', $filterCmsEvent)->toArray();

			$dayDescriptions = array();
			$dayShortDescriptions = array();
			$cities = array();
			foreach ($cmsTours as $cmsTour) {
				$infoTourEvent = $tabTourEvents->findById($cmsTour['event_id'])->toArray();
				$infoTourEvent = $infoTourEvent[0];

				$filterEventDescription = array();
				$filterEventDescription['conditions'] = array(
					"tour_event_id"		=>	$infoTourEvent['id'],
					"view_type"			=>	"day_view",
					"day_count"			=>	$cmsTour['event_day']
				);


				$eventDescriptionInfo = $tabTourEventDescriptions->find('all', $filterEventDescription)->toArray();
				$eventDescriptionInfo = $eventDescriptionInfo[0];

				$cityInfo = $tabCity->findById($infoTourEvent['subregion_id'])->toArray();
				$cityInfo = $cityInfo[0];

				$addCity = true;

				foreach ($cities as $city) {
					if ($city['id'] == $cityInfo['id']) {
						$addCity = false;
						break;
					}
				}

				if ($addCity) {
					$cities[] = array(
						"id"		=>		$cityInfo['id'],
						"name"		=>		$cityInfo['city_name']
					);
				}

				$dayDescriptions[] = array(
					"event_id"			=>		$infoTourEvent['id'],
					"cms_event_id"		=>		$cmsTour['id'],
					"city_id"			=>		$infoTourEvent['city_id'],
					"name"				=>		$infoTourEvent['name'],
					"short_description"	=>		$eventDescriptionInfo['short_description'],
					"description"		=>		$eventDescriptionInfo['description'],
					"highlight"			=>		$eventDescriptionInfo['tour_highlight']

				);

				$dayShortDescriptions[] = array(

					"short_description"	=>		$eventDescriptionInfo['short_description'],

				);
			}

			$itineraryPlans[] = array(
				"day"		=>		$i,
				"cities"	=>		$cities,
				"events"	=>		$dayDescriptions
			);

			$summary[] = array(
				"day"		=>		$i,
				"cities"	=>		$cities,
				"events"	=>		$dayShortDescriptions
			);
		}

		$responseData = array(
			"city"				=>		$cities,
			"summary"			=>		$summary,
			"itinerary_plans"	=>		$itineraryPlans
		);

		return $responseData;
	}

	private function getTourItineraryCityView($data = array())
	{
		$tabCmsTourDayPlan = $this->fetchTable('CmsTourDayPlan');
		$tabTourEvents	 = $this->fetchTable('TblsTourEvents');
		$tabTourEventDescriptions	 = $this->fetchTable('TblsTourEventDescriptions');
		$tabCity	 = $this->fetchTable('TblsCity');
		$tabCityDetail	 = $this->fetchTable('TblsCityDetail');

		$responseData = array();



		$filterTourDayPlan = array();
		$filterTourDayPlan['conditions'] = array(
			"tour_id"		=>		$data['tour_id']
		);
		$filterTourDayPlan['order']	= array(
			"day_count"	=>	"asc"
		);
		$filterTourDayPlan['fields'] = array("event_id");
		$eventIds = $tabCmsTourDayPlan->find('all', $filterTourDayPlan)->toArray();


		$cmsToureventIdList = array();
		foreach ($eventIds as $eventId) {
			if (in_array($eventId['event_id'], $cmsToureventIdList)) {
				continue;
			}
			$cmsToureventIdList[] = $eventId['event_id'];
		}


		$city = array();
		$summary = array();
		$itineraryPlans = array();

		foreach ($cmsToureventIdList as $cmsTourEventId) {

			$filterCmsEventStartDay = array();
			$filterCmsEventStartDay['conditions'] = array(
				"event_id"		=>		$cmsTourEventId,
				"tour_id"		=>		$data['tour_id']
			);
			$filterCmsEventStartDay['order'] = array(
				"day_count"		=>	"asc"
			);
			$filterCmsEventStartDay['limit'] = 1;

			$cmsTourStartDay = $tabCmsTourDayPlan->find('all', $filterCmsEventStartDay)->toArray();
			$cmsTourStartDay = $cmsTourStartDay[0];



			$filterCmsEventEndDay = array();
			$filterCmsEventEndDay['conditions'] = array(
				"event_id"		=>		$cmsTourEventId,
				"tour_id"		=>		$data['tour_id']
			);
			$filterCmsEventEndDay['order'] = array(
				"day_count"		=>	"desc"
			);
			$filterCmsEventEndDay['limit'] = 1;

			$cmsTourEndDay = $tabCmsTourDayPlan->find('all', $filterCmsEventEndDay)->toArray();
			$cmsTourEndDay = $cmsTourEndDay[0];

			$infoTourEvent = $tabTourEvents->findById($cmsTourEndDay['event_id'])->toArray();
			$infoTourEvent = $infoTourEvent[0];

			$eventDescriptionInfo = $tabTourEventDescriptions->findByTourEventIdAndViewType($cmsTourEndDay['event_id'], 'city_view')->toArray();
			$eventDescriptionInfo = $eventDescriptionInfo[0];



			$cityInfo = $tabCity->findById($infoTourEvent['subregion_id'])->toArray();
			$cityInfo = $cityInfo[0];

			$cityDetailInfo = $tabCityDetail->findByCityId($cityInfo['id'])->toArray();
			$cityDetailInfo = $cityDetailInfo[0];
			$addData = true;

			foreach ($summary as $summaryInfo) {

				if ($cityInfo['id'] == $summaryInfo['city_id']) {
					if ($summaryInfo['end_day'] < $cmsTourEndDay['day_count']) {
						continue;
					}
					$addData = false;
				}
			}

			if (!$addData) {
				continue;
			}

			$city[] = array(
				"id"		=>		$cityInfo['id'],
				"name"		=>		$cityInfo['city_name']
			);

			$eventShortDescription = "";
			if ($eventDescriptionInfo['short_description'] != "") {
				$eventShortDescription = $eventDescriptionInfo['short_description'];
				$eventShortDescription = mb_strimwidth(stripslashes($eventShortDescription), 0, 175, "....");
			}

			$summary[] = array(
				"cms_tour_plan_id"		=>		$cmsTourStartDay['id'],
				"event_id"				=>		$infoTourEvent['id'],
				"city_name"				=>		$cityInfo['city_name'],
				"city_id"				=>		$cityInfo['id'],
				"start_day"				=>		$cmsTourStartDay['day_count'],
				"end_day"				=>		$cmsTourEndDay['day_count'],
				"city_description"		=>		$eventShortDescription

			);



			$eventDescription = "";
			if ($eventDescriptionInfo['description'] != "") {
				$eventDescription = $eventDescriptionInfo['description'];
			}

			$itineraryPlans[] = array(
				"cms_tour_plan_id"		=>		$cmsTourStartDay['id'],
				"event_id"				=>		$infoTourEvent['id'],
				"city_name"				=>		$cityInfo['city_name'],
				"start_day"				=>		$cmsTourStartDay['day_count'],
				"end_day"				=>		$cmsTourEndDay['day_count'],
				"description"			=>		stripslashes($eventDescription),
				"tour_highlight"		=>		$eventDescriptionInfo['tour_highlight'],
				"duration"				=>		$infoTourEvent['duration']

			);
		}

		$responseData = array(
			"city"				=>		$city,
			"summary"			=>		$summary,
			"itinerary_plans"	=>		$itineraryPlans
		);

		return $responseData;
	}


	public function changeTourPriceByCurrency()
	{
		$this->viewBuilder()->disableAutoLayout();
		$this->autoRender = false;

		$receivedData = array();
		$receivedData['tour_id'] = $this->request->getData("tour_id");
		$receivedData['tour_page_id'] = $this->request->getData("tour_page_id");
		$receivedData['currency_code'] = $this->request->getData("currency_code");

		$requestDataTourPrice = array(
			"tour_page_id"			=>	$receivedData['tour_page_id'],
			"tour_id"				=>	$receivedData['tour_id'],
			"currency_code"				=>	$receivedData['currency_code']
		);

		$tourPrices = $this->getTourHotelPrice($requestDataTourPrice);

		$json = array(
			"result"	=>		"success",
			"message"	=>		"",
			"data"		=>		$tourPrices
		);

		echo json_encode($json);
		exit();
	}

	private function getAllCountryList()

	{

		$tabTblsCountry = $this->fetchTable('TblsCountry');



		$options['order'] = array("TblsCountry.name" => "ASC");



		$countryInfo = $tabTblsCountry->find('list', [

			'keyField' => 'id',      // The field to use for the key (usually primary key)

			'valueField' => 'name'   // The field to use for the value (name or other field)

		], $options)->toArray();



		return $countryInfo;
	}

	public function getTourHotelGroupsByTourId($tourId)
	{
		// Load tables
		//$tourSettingsTable = $this->fetchTable('CmsTourSettings');
		$hotelGroupsTable  = $this->fetchTable('CmsHotelGroup');
		$hotelTypesTable   = $this->fetchTable('TblsHotelType');

		// ===== GETTING EXCLUDED HOTEL TYPE =====
		/*  $setting = $tourSettingsTable
        ->find()
        ->select(['hide_hotel'])
        ->where(['tour_id' => $tourId])
        ->first();

    $excludedHotels = [];

    if (!empty($setting->hide_hotel)) {
        $excludedHotels = unserialize($setting->hide_hotel);
        if (!is_array($excludedHotels)) {
            $excludedHotels = [];
        }
    } */

		// ===== GET HOTEL GROUPS =====
		$groupsQuery = $hotelGroupsTable
			->find()
			->where(['tour_id' => $tourId])
			->order(['order_sequence' => 'ASC']);

		$groups = [];

		foreach ($groupsQuery as $group) {

			// Get hotel type name
			$hotelType = $hotelTypesTable
				->find()
				->select(['hotel_type', 'hotel_alias'])
				->where(['id' => $group->hotel_type])
				->first();

			/*  $inclusionType = in_array($group->hotel_type, $excludedHotels)
            ? 'excluded'
            : 'included'; */

			$groups[] = [
				'group_id'         => $group->id,
				'group_name'       => $group->group_name,
				'hotel_type'       => $group->hotel_type,
				'order_sequence'   => $group->order_sequence,
				'hotel_type_name'  => $hotelType->hotel_alias ?? '',
				/* 'inclusion_type'   => $inclusionType */
			];
		}

		return $groups;
	}
	/*
public function saveBrochureEnquiry($tourId = null)
{
	$this->viewBuilder()->disableAutoLayout();
	$this->autoRender = false;
	
	$tourData = array();
	
	$json = array(
							"result"	=>		"success",
							"message"	=>		"",
							"data"		=>		$tourData
				);

		echo json_encode($json);
		exit();
}
*/
	public function pdf($id = null)
	{
		$this->viewBuilder()->enableAutoLayout(false);

		$tourDetails = array();


		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, // This can be omitted if "filename" is specified.
				//'filename' => 'Report_' . $id . '.pdf' //// This can be omitted if you want file name based on URL.
				'filename' => 'TourSummary.pdf',
			]
		);

		$this->set('tourDetails', $tourDetails);
	}


	public function tourEnquiry()
	{
		$tblEnquiry  = $this->fetchTable('TblsEnquiry');
		$tblEnquiryDetail  = $this->fetchTable('TblsEnquiryDetail');

		if ($this->request->is('post')) {

			$data = $this->request->getData();
			if (isset($data['rooms']['__KEY__'])) {
				unset($data['rooms']['__KEY__']);
			}

			// Optional: Clean & reindex rooms numerically (if needed)
			$rooms = [];
			foreach ($data['rooms'] as $key => $room) {
				$rooms[$key] = [
					'adults' => $room['adults'] ?? 0,
					'childs' => $room['childs'] ?? 0,
					'childAges' => $room['childAges'] ?? [],
				];
			}

			$hotelPreference = implode(",", $this->request->getData('hotel_preferences'));



			$data = $tblEnquiry->newEntity($this->request->getData());
			$data->name = $this->request->getData("fullName");
			$data->email = $this->request->getData("email");
			$data->phone = $this->request->getData("phone");
			$data->country = $this->request->getData("country");
			$data->tour_code = $this->request->getData("tour_code");
			$data->page_url = $this->request->getData("page_url");
			$data->tour_title = $this->request->getData("tour_title");
			$data->enquiry_source = 'tour_enquiry';


			if ($tblEnquiry->save($data)) {
				$other_information = array(
					"nationality" => '',
					'room_data' => $rooms,
					'currency' => '',
					'travel_budget' => '',
					'travel_date' => $this->request->getData('tourStartDate'),
					'no_of_rooms' => '', //$this->request->getData('no_of_rooms'),
					'star_hotel' => $hotelPreference
				);
				$other_information = serialize($other_information);
				$edata = $tblEnquiryDetail->newEntity($this->request->getData());
				$edata->enquiry_id = $data->id;
				$edata->message = $this->request->getData("specialRequests");
				$edata->page_url = '';
				$edata->tour_id = 0;
				$edata->tour_name = '';
				$edata->user_ip = $_SERVER['REMOTE_ADDR'];
				$edata->other_information = $other_information;
				$tblEnquiryDetail->save($edata);
				//send mail
				$emailData = array();
				$emailData["tour_code"] = $this->request->getData("tour_code");
				$emailData["page_url"] = $this->request->getData("page_url");
				$emailData["tour_title"] = $this->request->getData("tour_title");
				$emailData["name"] = $this->request->getData("fullName");
				$emailData["email"] = $this->request->getData("email");
				$emailData["phone"] = $this->request->getData("phone");
				$emailData["country"] = $this->request->getData("country");
				$emailData["travel_date"] = $this->request->getData("tourStartDate");
				$emailData["hotelPreference"] = $hotelPreference;
				$emailData["roomsData"] = $rooms;
				$emailData["message"] = $this->request->getData("specialRequests");

				if ($this->sendEmail($emailData)) {
					$this->sendAckMail($emailData);
					$this->redirect(array("controller" => "Tours", "action" => "confirmation"));
				} else {
					$this->Flash->error('Failed to send email.');
				}
			}
		}
	}

	public function confirmation()
	{
		$this->viewBuilder()->setLayout('version2/default');
		$confirmationPageParameter = array(
			"title" =>  "Thank You",
			"description"	=>	"<h3>Your query has been received.</h3><div>Thank you for contacting us. Your query has been received to us.</div><div> We will contact you shortly.</div>"
		);
		$this->set("confirmationPageParameter", $confirmationPageParameter);
	}


	function formatRoomsForEmail(array $rooms): string
	{
		$output = "<h4>Room Details:</h4><ul style='padding-left: 20px;'>";

		foreach ($rooms as $roomKey => $room) {
			$output .= "<li><strong>" . ucfirst(str_replace('_', ' ', $roomKey)) . ":</strong><ul>";

			$output .= "<li><strong>Adults:</strong> " . h($room['adults']) . "</li>";
			$output .= "<li><strong>Children:</strong> " . h($room['childs']) . "</li>";

			if (!empty($room['childAges'])) {
				$output .= "<li><strong>Children Ages:</strong> ";
				$output .= implode(', ', array_map('h', $room['childAges']));
				$output .= "</li>";
			}

			$output .= "</ul></li>";
		}

		$output .= "</ul>";
		return $output;
	}



	public function sendEmail($data)
	{
		$userIp = $_SERVER['REMOTE_ADDR'];
		$ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);
		// Example data
		//$to = 'sales2@elegantjourneys.co';
		$subject = 'Tour Enquiry';
		// HTML content
		$htmlContent = '
			<html>
			<head>
			<title>Tour Enquiry From Website</title>
			</head>
			<body>
			<p>Here are the details of enquiry submitted by visitors!</p>
			<table padding="2" border="1">
				<tr>
				<th style="text-align:left;">Tour Code</th>
				<td>' . $data['tour_code'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Tour Title</th>
				<td>' . $data['tour_title'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Page URL</th>
				<td>' . $data['page_url'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Name</th>
				<td>' . $data['name'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Email</th>
				<td>' . $data['email'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Phone</th>
				<td>' . $data['phone'] . '</th>
				</tr>
				
				<tr>
				<th style="text-align:left;">Nationality</th>
				<td>' . $data['country'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Room Details</th>
				<td>' . $this->formatRoomsForEmail($data['roomsData']) . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Travel Date</th>
				<td>' . $data['travel_date'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Hotels Preference</th>
				<td>' . $data['hotelPreference'] . '</th>
				</tr>
				<tr>
				<th style="text-align:left;">Message</th>
				<td>' . $data['message'] . '</th>
				</tr>
				<tr>
					<td colspan="2"><strong> Details retrieve from IP address</strong></td>
				</tr>			
				<tr>
					<td>IP Address</td>
					<td>' . $_SERVER['REMOTE_ADDR'] . '</td>
				</tr>
				<tr>
					<td>Country</td>
					<td>' . $ipInformation['countryName'] . '</td>
				</tr>
				<tr>
					<td>Region</td>
					<td>' . $ipInformation['regionName'] . '</td>
				</tr>
				<tr>
					<td>City</td>
					<td>' . $ipInformation['cityName'] . '</td>
				</tr>
				<tr>
					<td>Time Zone</td>
					<td>' . $ipInformation['timeZone'] . '</td>
				</tr>
			</table>
			</body>
			</html>';
		// Send the email
		$result = $this->Email->sendHTMLEmail($to = "sales2@elegantjourneys.co", $subject, $htmlContent);
		//$result = $this->Email->sendHTMLEmail($to = "mr.ujjwal.kumar@gmail.com", $subject, $htmlContent);
		if ($result === true) {
			return true;
		} else {
			return false;
		}
	}

	public function sendAckMail($data)
	{
		$subject = 'Thank You for Your Inquiry';
		$name = htmlspecialchars($data['name']);
		$to = $data['email'];

		$htmlContent = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f6f6f6; color: #333; }
            .email-wrapper { background: #fff; padding: 20px; max-width: 600px; margin: auto; border-radius: 8px; }
            .content { padding: 20px; }
            .call-style {font-size:11px; color:red;}
        </style>
    </head>
    <body>
        <div class='email-wrapper'>
            <div class='content'>
                <h2>Dear {$name},</h2>
                <p>Thank you for reaching out to us and submitting the inquiry form. We are delighted that you have chosen Elegant Journeys for your upcoming travel plans. Our team is currently reviewing your request and will provide you with a detailed itinerary and pricing information shortly.</p>
                <p>Should you need any immediate assistance or have additional questions, please feel free to contact us:</p>
                <p><strong>Call Us:</strong></p>
                <ul>
                    <li>Australia: +61-02-8488-0900</li>
                    <li>USA/Canada: +1-332-213-8200</li>
                    <li>United Kingdom: +44-20-3769-7001</li>
                    <li>India: +91-99100-78975</li>
                    <span class='call-style'>* Call with International dialing code</span>
                </ul>
                <p><strong>Whatsapp:</strong> +91-98115-39696</p>  
                <p><strong>Email:</strong> sales@elegantjourneys.com</p>  
                <p><strong>Website:</strong> www.elegantjourneys.com</p>  
                <p>We look forward to assisting you in planning a truly memorable and luxurious journey.</p>
                <p>Best regards,<br><strong>Team Elegant Journeys</strong></p>
            </div>
        </div>
    </body>
    </html>
    ";

		$result = $this->Email->sendHTMLEmail($to, $subject, $htmlContent);

		return $result === true;
	}
	
	
	public function details1($categoryPageUrl = "", $tourPageUrl = "")
	{
		$this->loadComponent('Seo');

		$this->viewBuilder()->setLayout('version2/default-test');
		$this->set('showEnquiryModal', false);

		$tabCategory = $this->fetchTable('TblCategory');
		$tabTourPages = $this->fetchTable('TblsTourPages');
		$tabTourPageDescription = $this->fetchTable('TblsTourPageDescription');
		$tabCmsManagetour = $this->fetchTable('CmsManagetour');
		$tabTourPrices = $this->fetchTable('TourPrices');
		$tabTourPageMetaDescription = $this->fetchTable('TblsTourPageMetaDescription');
		$tabTourPageFaqs = $this->fetchTable('TblsTourPageFaqs');
		$tabTourPageFaqAnswers = $this->fetchTable('TblsTourPageFaqAnswers');
		$tabTourPageOverviews = $this->fetchTable('TblsTourPageOverviews');

		$tabTblsTourEvents = $this->fetchTable('TblsTourEvents');


		$requestData = array();
		$requestData['page_url'] = $tourPageUrl;
		$requestData['category_page_url'] = $categoryPageUrl;

		$categoryInfo = $tabCategory->findByPageUrl($categoryPageUrl)->toArray();
		$categoryInfo = $categoryInfo[0];



		$tourPageInfo = $tabTourPages->findByPageUrl($requestData['page_url'])->toArray();
		$tourPageInfo = $tourPageInfo[0];

		$tourPageDescInfo = $tabTourPageDescription->findByTourPageId($tourPageInfo['id'])->toArray();
		$tourPageDescInfo = $tourPageDescInfo[0];


		$tourInfo = $tabCmsManagetour->findById($tourPageInfo['tour_id'])->toArray();
		$tourInfo = $tourInfo[0];

		$tourPriceInfo = $tabTourPrices->findByTourPageIdAndTourId($tourPageInfo['id'], $tourInfo['id'])->toArray();
		$tourPriceInfo = $tourPriceInfo[0];

		$tourOverviewInfo = $tabTourPageOverviews->findByTourPageId($tourPageInfo['id'])->toArray();
		$tourOverviewInfo = $tourOverviewInfo[0];

		#### READING FAQs

		$filterCategoryFaqs = array();
		$filterCategoryFaqs['conditions'] = array(
			"tour_page_id"		=>		$tourPageInfo['id']
		);
		$filterCategoryFaqs['order'] = array(
			"order_sequence"	=>		"asc"
		);

		$faqs = $tabTourPageFaqs->find('all', $filterCategoryFaqs)->toArray();
		$faqData = array();
		//$faqData['title'] = 'Golden Triangle Tour – FAQs';
		$faqData['title'] = 'Frequently Asked Questions for '.$tourPageInfo['title'];
		$faqData['description'] = 'Quick answers about itinerary, inclusions, customization, and bookings.';

		foreach ($faqs as $faq) {
			$tourPageFaqAnswerInfo = $tabTourPageFaqAnswers->findByTourPageFaqId($faq['id'])->toArray();
			$tourPageFaqAnswerInfo = $tourPageFaqAnswerInfo[0];

			$faqList[] = array(
				"question"		=>		$faq['question'],
				"answer"		=>		$tourPageFaqAnswerInfo['answer']
			);
		}
		$faqData['faq_list'] = $faqList;

		$data['faq'] = $faqData;

		$pageMetaDescription = $tabTourPageMetaDescription->findByTourPageId($tourPageInfo['id'])->toArray();
		$pageMetaDescription = $pageMetaDescription[0];


		if ($tourPageInfo['view_type'] == "") {
			$tourPageInfo['view_type'] = 'day_view';
		}

		$requestDataCurrency = array(
			"currency_code"		=>		"INR"
		);
		$currencyInfo = $this->getCurrencyInfo($requestDataCurrency);

		$data['general'] = array(
			"tour_page_id"			=>	$tourPageInfo['id'],
			"tour_id"				=>	$tourPageInfo['tour_id'],
			"name"					=>	$tourPageInfo['title'],
			"tour_code"				=>	$tourPageInfo['tour_code'],
			"price"					=>	$this->calculateCurrencyRate($tourPriceInfo['low_season_price'], $currencyInfo['currency_value']),
			"discount_price"		=>	$this->calculateCurrencyRate($tourPriceInfo['low_season_discount_price'], $currencyInfo['currency_value']),
			"destinations"			=>	unserialize($tourPageDescInfo['destinations']),
			"duration"				=>	$tourInfo['tour_duration'],
			"view_type"				=>	$tourPageInfo['view_type'],
			"tour_token"			=>	$tourInfo['tour_token'],
			"encrypted_tour_token"	=>	TOKEN_PREFIX . $tourInfo['tour_token'] . TOKEN_POSTFIX,
			"page_url"				=>	$this->getPageUrl()

		);



		/* GETTING CITY DESCRIPTION AND IMAGE */
		$requestDataItinerary = array(
			"tour_id"	=>	$tourPageInfo['tour_id'],
			"duration"	=>	$tourInfo['tour_duration']
		);

		if ($tourPageInfo['view_type'] == 'day_view') {
			$tourSummary = $this->getTourItineraryDayView($requestDataItinerary);
		} else if ($tourPageInfo['view_type'] == 'city_view') {
			$tourSummary = $this->getTourItineraryCityView($requestDataItinerary);
		}



		$data['tour_summary'] = $tourSummary;

		$requestDataHotels = array(
			"tour_id"		=>	$tourPageInfo['tour_id'],
			"tour_page_id"	=>	$tourPageInfo['id'],
			"duration"		=>	$tourInfo['tour_duration']
		);

		$tourHotels = $this->getTourHotels($requestDataHotels);
		$data['tour_hotels'] = $tourHotels;

		$requestDataInclusionExclusion = array(
			"tour_id"		=>		$tourPageInfo['tour_id']
		);

		$inclusionExclusions = $this->getTourInclusionExlusion($requestDataInclusionExclusion);
		$data['inclusion_exclusion'] = $inclusionExclusions;

		$requestDataTourPrice = array(
			"tour_page_id"			=>	$tourPageInfo['id'],
			"tour_id"				=>	$tourPageInfo['tour_id'],
			"currency_code"			=>	"INR"
		);

		$tourPrices = $this->getTourHotelPrice($requestDataTourPrice);
		$data['tour_prices'] = $tourPrices;

		#### TESTIMONIAL VIDEO

		$requestVideoData = array();
		$requestVideoData['video_testimonial_id'] = $tourPageDescInfo['video_testimonial_id'];
		$videoTestimonialInfo = $this->getTourReviewVideo($requestVideoData);

		$data['video_testimonial'] = $videoTestimonialInfo;

		#### TRIPADVISOR TESTIMONIAL 
		$requestSingleTestimonial = array();
		$requestSingleTestimonial['tripadvisor_review_id'] = $tourPageDescInfo['tripadvisor_review_id'];
		$tripAdvisorReviewInfo = $this->getSingleTripadvisorReview($requestSingleTestimonial);

		$data['client_review'] = array();
		$data['client_review']['single_tripadvisor_review'] = $tripAdvisorReviewInfo;
		
		$requestTestimonial = array();
		$requestTestimonial['number_of_record'] = 6;
		$testimonialList = $this->getTripAdvisorReview($requestTestimonial);
		
		$data['client_review']['testimonials'] = $testimonialList;
		

		$currencyList = $this->getCurrencyList();
		$data['master']['currency_list'] = $currencyList;

		$countryList = $this->getAllCountryList();
		$this->set("countryList", $countryList);

		/*$tripadvisorReviewList = array();
		$tripadvisorReviewList = $this->getTopFiveTripAdvisorReview();
		
		$data['tripadvisor_review_list'] = $tripadvisorReviewList;*/

		#### TOUR OVERVIEW
		$data['content'] = array();
		if ($tourOverviewInfo['description'] != "") {
			$data['content']['tour_overview'] = $tourOverviewInfo['description'];
		}

		$hotelGroups = $this->getTourHotelGroupsByTourId($tourPageInfo['tour_id']);
		$data['hotel_groups'] = $hotelGroups;

		#### SEO TAGS

		$seoTags['meta_title'] = $pageMetaDescription['meta_title'];
		$seoTags['meta_description'] = $pageMetaDescription['meta_description'];
		$seoTags['meta_keyword'] = $pageMetaDescription['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT . $tourPageUrl;
		$seoTags['itemprop_name'] = $tourPageInfo['title'];
		$seoTags['date_published'] = date("Y-m-d", strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d", strtotime("-1 months"));

		$metaTags = $this->Seo->getSeoTags($seoTags, 'general');
		$data['meta_tags'] = $metaTags;

		#### SETTING SHARING URLS
		$sharingUrls = array();
		$sharingUrls['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u=' . WEBROOT . $tourPageUrl;
		$sharingUrls['twitter'] = 'https://twitter.com/intent/tweet?url=' . WEBROOT . $tourPageUrl . '&text=' . $seoTags['meta_title'];
		$sharingUrls['whatsapp'] = 'https://api.whatsapp.com/send?text=' . WEBROOT . $tourPageUrl . '&text=' . $seoTags['meta_title'];
		$sharingUrls['linkedin'] = 'https://www.linkedin.com/sharing/share-offsite/?url=' . WEBROOT . $tourPageUrl;

		$data['sharing_urls'] = $sharingUrls;

		#### SETTING BREADCRUMB

		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[] = array(
			"label"			=>		"Home",
			"link"			=>		WEBROOT,
			"link_url"		=>		true
		);

		$breadcrumbs[] = array(
			"label"			=>		$categoryInfo['name'],
			"link"			=>		WEBROOT . 'tours-' . $categoryInfo['page_url'],
			"link_url"		=>		true
		);

		$breadcrumbs[] = array(
			"label"			=>		$tourPageInfo['title'],
			"link"			=>		WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'],
			"link_url"		=>		true
		);

		$data['breadcrumbs'] = $breadcrumbs;

		$schemaTags = array();

		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;

		$organisationSchemaTags = array();
		$organisationSchemaTags['schema_category_type'] = 'organisation';
		$organisationSchema = $this->Seo->getSchema($organisationSchemaTags);
		$schemaTags[] = $organisationSchema;

		$websiteSchemaTags = array();
		$websiteSchemaTags['schema_category_type'] = 'website';
		$websiteSchema = $this->Seo->getSchema($websiteSchemaTags);
		$schemaTags[] = $websiteSchema;

		$reviewSchemaTags = array();
		$reviewSchemaTags['schema_category_type'] = 'review';
		$reviewSchema = $this->Seo->getSchema($reviewSchemaTags);
		$schemaTags[] = $reviewSchema;

		$touristTripSchemaTags = array();
		$touristTripSchemaTags['name'] = $pageMetaDescription['meta_title'];
		$touristTripSchemaTags['description'] = $pageMetaDescription['meta_description'];
		$touristTripSchemaTags['image'] = ADMIN_REPOSITORY_PATH . "tours/" . $tourPageDescInfo['thumbnail'];

		$cityList = array();
		foreach ($data['general']['destinations'] as $cityInfo) {
			$cityList[] = $cityInfo['city'];
		}


		$touristTripSchemaTags['cities'] = $cityList;
		$touristTripSchemaTags['currency'] = 'INR';
		$touristTripSchemaTags['price'] = $tourPrices['hotel_price']['minimum_price'][0]['profit_price'];
		$touristTripSchemaTags['page_url'] = WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'];
		$touristTripSchemaTags['schema_category_type'] = 'tourist_trip';
		$touristTripSchema = $this->Seo->getSchema($touristTripSchemaTags);
		$schemaTags[] = $touristTripSchema;

		### product schema tag
		$productSchemaTags = array();
		$productSchemaTags['name'] = $tourPageInfo['title'];
		$productSchemaTags['description'] = $pageMetaDescription['meta_description'];
		$productSchemaTags['image'] = ADMIN_REPOSITORY_PATH . "tours/" . $tourPageDescInfo['thumbnail'];

		$primaryTourPrice = str_replace(',', '', $tourPrices['hotel_price']['minimum_price'][0]['profit_price']); // remove commas
		$floatTourPrice = (float) $primaryTourPrice;               // convert to float
		$formattedTourPrice = number_format($floatTourPrice, 2, '.', '');

		$productSchemaTags['tour_price'] = $formattedTourPrice;
		$productSchemaTags['currency'] = "INR";
		$productSchemaTags['page_url'] = WEBROOT . 'tours-' . $categoryInfo['page_url'] . "/" . $tourPageInfo['page_url'];

		$productSchemaTags['schema_category_type'] = 'product_services';
		$productSchema = $this->Seo->getSchema($productSchemaTags);
		$schemaTags[] = $productSchema;


		$tripAgreegateRating = array();
		$tripAgreegateRating['tour_name'] = $tourPageInfo['title'];

		$tripAgreegateRating['schema_category_type'] = 'trip_agreegate_rating';
		$tripAgreegateSchema = $this->Seo->getSchema($tripAgreegateRating);
		$schemaTags[] = $tripAgreegateSchema;

		if ($faqList[0]['question'] != "") {
			$faqSchemaTags = array();
			$faqSchemaTags['faq_list'] = $faqList;
			$faqSchemaTags['schema_category_type'] = 'faq';
			$faqSchema = $this->Seo->getSchema($faqSchemaTags);
			$schemaTags[] = $faqSchema;
		}

		$videoTestimonialSchemaTags = array();
		$videoTestimonialSchemaTags['tour_name'] = $tourPageInfo['title'];
		$videoTestimonialSchemaTags['thumbnail_url'] = $videoTestimonialInfo['thumbnail'];
		$videoTestimonialSchemaTags['upload_date'] = $videoTestimonialInfo['upload_date'];
		$videoTestimonialSchemaTags['duration_minute'] = $videoTestimonialInfo['duration_minute'];
		$videoTestimonialSchemaTags['duration_second'] = $videoTestimonialInfo['duration_second'];
		$videoTestimonialSchemaTags['page_url'] = WEBROOT.'video-testimonial/'.$videoTestimonialInfo['page_url'];
		$videoTestimonialSchemaTags['video_url'] = $videoTestimonialInfo['video'];

		$videoTestimonialSchemaTags['schema_category_type'] = 'video_single_testimonial_tour';
		$videoTestimonialSchema = $this->Seo->getSchema($videoTestimonialSchemaTags);
		$schemaTags[] = $videoTestimonialSchema;

		#### TRIPADVISOR REVIEW SCHEMA
		$tripadvisorReviewSchemaTags = array();
		$tripadvisorReviewSchemaTags['reviewer_name'] = $tripAdvisorReviewInfo['name'];
		$tripadvisorReviewSchemaTags['review_date'] = $tripAdvisorReviewInfo['review_date'];
		$tripadvisorReviewSchemaTags['review_description'] = $tripAdvisorReviewInfo['full_description'];
		$tripadvisorReviewSchemaTags['review_rating'] = '5';
		$tripadvisorReviewSchemaTags['trip_name'] = $tourPageInfo['title'];

		$tripadvisorReviewSchemaTags['schema_category_type'] = 'single_client_trip_testimonial';
		$tripadvisorReviewSchema = $this->Seo->getSchema($tripadvisorReviewSchemaTags);
		$schemaTags[] = $tripadvisorReviewSchema;

		$data['schema'] = $schemaTags;


		$this->set("data", $data);
	}
}
