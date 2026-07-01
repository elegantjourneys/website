<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

class ReviewsController extends AppController
{
	public function initialize(): void
    {
        parent::initialize();
    }

	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
	  parent::beforeFilter($event);
	  //Configure::write('debug',true);
	}
	

	public function index()    
	{
		$this->loadComponent('Seo');
		
		$this->viewBuilder()->setLayout('version2/default');
		
		$sectionCode = 'TRIP_REVIEW';
		
		$tblsTripadvisorReviews = $this->fetchTable('TblsTripadvisorReviews');		
		$tblsTripadvisorReviewDetails = $this->fetchTable('TblsTripadvisorReviewDetails');
		
		$data = array();
		
        $tripadvisorReviews = $tblsTripadvisorReviews->find('all')->toArray();
		$tripadvisorReviewList = array();
		if(!empty($tripadvisorReviews))
		{
			foreach($tripadvisorReviews as $tripReviews)
			{
				
				$options['fields']= array('short_description','long_description');
				$options['conditions']= array("TblsTripadvisorReviewDetails.review_id"=>$tripReviews['id']);    
				$tripadvisorReviewDetails = $tblsTripadvisorReviewDetails->find('all',$options)->toArray();
				
				if($tripadvisorReviewDetails[0]["long_description"]=="")
				{
					continue;
				}

				$childcategoryAllInfo["id"]         		=  $tripReviews["id"];
				$childcategoryAllInfo["name"]  				=  $tripReviews["name"];
				$childcategoryAllInfo["place"]       		=  $tripReviews["place"];
				$childcategoryAllInfo["image"]   			=  $tripReviews["image"];
				$childcategoryAllInfo["review_date"]      	=  $tripReviews["review_date"];
				$childcategoryAllInfo["short_description"]  =  @$tripadvisorReviewDetails[0]["short_description"];
				$childcategoryAllInfo["long_description"]   =  @$tripadvisorReviewDetails[0]["long_description"];

				$tripadvisorReviewList["trip_advisor"][] = $childcategoryAllInfo;
			}
		}
		
		
		$data['review_list'] = $tripadvisorReviewList;
		
		$requestWebsiteData = array(
										"section_code"		=>	$sectionCode
								);
								
		$websiteSectionData=$this->getWebsiteContentData($requestWebsiteData);
		
		$data['faq'] = $websiteSectionData['faq'];
		$data['content'] = $websiteSectionData['content'];
	
		$seoTags['meta_title'] = "Elegant Journeys TripAdvisor Reviews | Luxury Tour Feedback";
		$seoTags['meta_description'] = "Read authentic TripAdvisor reviews of Elegant Journeys. Travelers love our luxury tours in India, Golden Triangle trips, expert guides, and seamless service.";
		$seoTags['meta_keyword'] = "Elegant Journeys TripAdvisor reviews, customer testimonials, travel experiences, luxury travel feedback, client opinions, trip reviews, Elegant Journeys ratings";
		$seoTags['canonical_url'] = WEBROOT."review";
		$seoTags['itemprop_name'] = 'Guest Email Testimonial';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
		
		$schemaTags = array();
		
		#### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Tripadvisor Review",
								"link"			=>		WEBROOT.'tripadvisor-review',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
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
		
		### SINGLE REVIEW SCHEMA LIST
		
		foreach($tripadvisorReviewList["trip_advisor"] as $tripadvisorReview)
		{
			
			if($tripadvisorReview['review_date'])
			{
				$singleTestimonialTags = array();
				$singleTestimonialTags['reviewer_name'] = $tripadvisorReview['name'];
				$singleTestimonialTags['review_date'] = $tripadvisorReview['review_date']->i18nFormat('yyyy-MM-dd');
				$singleTestimonialTags['review_description'] = str_replace('"','',stripslashes($tripadvisorReview['long_description']));
				$singleTestimonialTags['review_rating'] = '5';
				$singleTestimonialTags['schema_category_type'] = 'single_client_testimonial';
				$singleTestimonialSchema = $this->Seo->getSchema($singleTestimonialTags);
				$schemaTags[] = $singleTestimonialSchema;
			}
		}
		
		$faqSchemaTags = array();
		$faqSchemaTags['faq_list'] = $websiteSectionData['faq']['faq_list'];
		$faqSchemaTags['schema_category_type'] = 'faq';
		$faqSchema = $this->Seo->getSchema($faqSchemaTags);
		$schemaTags[] = $faqSchema;
		
		
		$data['schema'] = $schemaTags;
		
		$this->set('data',$data);
	}
	
	
	
	public function indexTest()    
	{
		$this->loadComponent('Seo');
		$this->viewBuilder()->setLayout('version2/default');		
		$tblsTripadvisorReviews = $this->fetchTable('TblsTripadvisorReviews');		
		$tblsTripadvisorReviewDetails = $this->fetchTable('TblsTripadvisorReviewDetails');
		
		$sectionCode = 'TRIP_REVIEW';
		
		$data = array();
		
        $tripadvisorReviews = $tblsTripadvisorReviews->find('all')->toArray();
		$tripadvisorReviewList = array();
		if(!empty($tripadvisorReviews))
		{
			foreach($tripadvisorReviews as $tripReviews)
			{
				
				$options['fields']= array('short_description','long_description');
				$options['conditions']= array("TblsTripadvisorReviewDetails.review_id"=>$tripReviews['id']);    
				$tripadvisorReviewDetails = $tblsTripadvisorReviewDetails->find('all',$options)->toArray();
				
				if($tripadvisorReviewDetails[0]["long_description"]=="")
				{
					continue;
				}

				$childcategoryAllInfo["id"]         		=  $tripReviews["id"];
				$childcategoryAllInfo["name"]  				=  $tripReviews["name"];
				$childcategoryAllInfo["place"]       		=  $tripReviews["place"];
				$childcategoryAllInfo["page_url"]       	=  $tripReviews["page_url"];
				$childcategoryAllInfo["image"]   			=  $tripReviews["image"];
				$childcategoryAllInfo["review_date"]      	=  $tripReviews["review_date"];
				$childcategoryAllInfo["short_description"]  =  @$tripadvisorReviewDetails[0]["short_description"];
				$childcategoryAllInfo["long_description"]   =  @$tripadvisorReviewDetails[0]["long_description"];

				$tripadvisorReviewList["trip_advisor"][] = $childcategoryAllInfo;
			}
		}
		
		$data['review_list'] = $tripadvisorReviewList;
		
		$requestWebsiteData = array(
										"section_code"		=>	$sectionCode
								);
		
		$websiteSectionData=$this->getWebsiteContentData($requestWebsiteData);
		
		$data['faq'] = $websiteSectionData['faq'];
		$data['content'] = $websiteSectionData['content'];
		
		$seoTags['meta_title'] = "Elegant Journeys TripAdvisor Reviews | Luxury Tour Feedback";
		$seoTags['meta_description'] = "Read authentic TripAdvisor reviews of Elegant Journeys. Travelers love our luxury tours in India, Golden Triangle trips, expert guides, and seamless service.";
		$seoTags['meta_keyword'] = "Elegant Journeys TripAdvisor reviews, customer testimonials, travel experiences, luxury travel feedback, client opinions, trip reviews, Elegant Journeys ratings";
		$seoTags['canonical_url'] = WEBROOT."review";
		$seoTags['itemprop_name'] = 'Guest Email Testimonial';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
		
		$schemaTags = array();
		
		#### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Tripadvisor Review",
								"link"			=>		WEBROOT.'tripadvisor-review',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
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
		
		$faqSchemaTags = array();
		$faqSchemaTags['faq_list'] = $websiteSectionData['faq']['faq_list'];
		$faqSchemaTags['schema_category_type'] = 'faq';
		$faqSchema = $this->Seo->getSchema($faqSchemaTags);
		$schemaTags[] = $faqSchema;
		
		$data['schema'] = $schemaTags;
		
		$this->set('data',$data);
	}


	

	

	

	public function emailTestimonial()
    {
		$this->loadComponent('Seo');
		
		$this->viewBuilder()->setLayout('version2/default');
		$tabTblTestimonial = $this->fetchTable('TblTestimonial');
		
		$data = array();
		
		$filterTblTestimonial = array();
		$filterTblTestimonial['order'] = array(
													"id"		=>		"desc"
										);
		$filterTblTestimonial['limit'] = 50;
		
		$testimonials = $tabTblTestimonial->find("all",$filterTblTestimonial)->toArray();
		
		$data['testimonials'] = $testimonials;
		
		
		$schemaTags = array();
		
		#### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Guest Email Testimonial",
								"link"			=>		WEBROOT.'review',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$data['schema'] = $schemaTags;
		
		$seoTags['meta_title'] = "Elegant Journeys Reviews - Real Travel Experiences & Testimonials";
		$seoTags['meta_description'] = "Read genuine reviews and testimonials from our delighted travelers. Discover why Elegant Journeys is a trusted name in curated luxury travel.";
		$seoTags['meta_keyword'] = "Elegant Journeys reviews, customer testimonials, travel experiences, luxury travel feedback, client opinions, trip reviews, Elegant Journeys ratings";
		$seoTags['canonical_url'] = WEBROOT."review";
		$seoTags['itemprop_name'] = 'Guest Email Testimonial';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;

		$this->set("data",$data);

	}

	

	public function emailTestimonialView($id="")

    {

      

		$this->viewBuilder()->setLayout('version1/default');

		$tblsTblTestimonial = $this->fetchTable('TblTestimonial');

		$options['fields'] = array(

							"id"=>"TblTestimonial.id",

							"name"=>"TblTestimonial.name",

							"country"=>"TblTestimonial.country",	

							"text"=>"TblTestimonial.text"

							);	

		$options['conditions'] = array("TblTestimonial.id"=> $id);

		

		

		

		$tblsTblTestimonialInfo = $tblsTblTestimonial->find("all",$options)->enableHydration(false);

		$result = $tblsTblTestimonialInfo->first();

		

		echo '<h6 class="wsbold">'.$result["name"].'</h6>';

		echo '<div style="font-size:14px;">'.$result["country"].'</div>';

		echo '<div class="mt-4">'.$result['text'].'</div>'; 

		exit;

	

	}
	
	public function pdf($id = null)
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		
		
		//echo ROOT . DS . 'webroot' . DS . 'wkhtmltopdf';
		//phpinfo();

		$tblsTripadvisorReviews = $this->fetchTable('TblsTripadvisorReviews');
		$tblsTripadvisorReviewDetails = $this->fetchTable('TblsTripadvisorReviewDetails');
		$tripadvisorReviews = $tblsTripadvisorReviews->find('all')->toArray();
		$tripadvisorReviewList = array();
		if(!empty($tripadvisorReviews)){
			foreach($tripadvisorReviews as $tripReviews){
				$options['fields']= array('short_description','long_description');
				$options['conditions']= array("TblsTripadvisorReviewDetails.review_id"=>$tripReviews['id']);    
				$tripadvisorReviewDetails = $tblsTripadvisorReviewDetails->find('all',$options)->toArray();
				$childcategoryAllInfo["id"]         		=  $tripReviews["id"];
				$childcategoryAllInfo["name"]  				=  $tripReviews["name"];
				$childcategoryAllInfo["place"]       		=  $tripReviews["place"];
				$childcategoryAllInfo["image"]   			=  $tripReviews["image"];
				$childcategoryAllInfo["review_date"]      	=  $tripReviews["review_date"];
				$childcategoryAllInfo["short_description"]  =  @$tripadvisorReviewDetails[0]["short_description"];
				$childcategoryAllInfo["long_description"]   =  @$tripadvisorReviewDetails[0]["long_description"];
				$tripadvisorReviewList["tripAdvisor"][] = $childcategoryAllInfo;

			}
		}
		
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, // This can be omitted if "filename" is specified.
				//'filename' => 'Report_' . $id . '.pdf' //// This can be omitted if you want file name based on URL.
				'filename' => 'Report.pdf', 
			]
		);
	   
	   $this->set('tripadvisorReviewList',$tripadvisorReviewList);
	   
	}
	
	
	public function tripadvisorDetail($pageUrl = null)
	{
		$this->loadComponent('Seo');
		$this->viewBuilder()->setLayout('version2/default');

		if (empty($pageUrl)) {
			throw new NotFoundException(__('Review not found.'));
		}

		$tblsTripadvisorReviews       = $this->fetchTable('TblsTripadvisorReviews');
		$tblsTripadvisorReviewDetails = $this->fetchTable('TblsTripadvisorReviewDetails');

		// ── 1. Load the requested review by page_url ──────────────────────────
		$currentReview = $tblsTripadvisorReviews->find('all', [
			'conditions' => ['TblsTripadvisorReviews.page_url' => $pageUrl],
		])->first();

		if (empty($currentReview)) {
			throw new NotFoundException(__('Review not found.'));
		}

		// ── 2. Load its detail (short + long description) ─────────────────────
		$detailOptions = [
			'fields'     => ['short_description', 'long_description'],
			'conditions' => ['TblsTripadvisorReviewDetails.review_id' => $currentReview['id']],
		];
		$reviewDetailRows = $tblsTripadvisorReviewDetails->find('all', $detailOptions)->toArray();
		$reviewDetail     = !empty($reviewDetailRows) ? $reviewDetailRows[0] : [];

		// ── 3. Build the $review array the view expects ───────────────────────
		$review = [
			'id'                => $currentReview['id'],
			'name'              => $currentReview['name'],
			'location'          => $currentReview['place'],
			'page_url'          => $currentReview['page_url'],
			'image'             => $currentReview['image'],
			'tripadvisor_link'  => $currentReview['tripadvisor_link'],
			'time_spend'        => $currentReview['time_spend'],
			'review_date'       => $currentReview['review_date'],
			'date'              => !empty($currentReview['review_date'])
									? $currentReview['review_date']->i18nFormat('MMM yyyy')
									: '',
			'rating'            => 5,
			'trip_type'         => 'Couples',
			'trip_icon'         => '👫',
			'title'             => @$reviewDetail['short_description'],
			'body'              => @$reviewDetail['long_description'],
			'photos'            => [],
		];

		// ── 4. Load ALL reviews to build prev / next / more ───────────────────
		$allReviews = $tblsTripadvisorReviews->find('all')->toArray();

		// Filter to only reviews that have a page_url (detail page exists)
		$navigableReviews = array_values(array_filter($allReviews, function($r) {
			return !empty($r['page_url']);
		}));

		// Find current position in navigable list
		$currentIndex = null;
		foreach ($navigableReviews as $idx => $r) {
			if ($r['page_url'] === $pageUrl) {
				$currentIndex = $idx;
				break;
			}
		}

		// ── 5. Prev / Next ────────────────────────────────────────────────────
		$prevReview = null;
		$nextReview = null;

		if ($currentIndex !== null) {
			if ($currentIndex > 0) {
				$prevRow = $navigableReviews[$currentIndex - 1];
				// Fetch short_description for the prev title
				$prevDetail = $tblsTripadvisorReviewDetails->find('all', [
					'fields'     => ['short_description'],
					'conditions' => ['TblsTripadvisorReviewDetails.review_id' => $prevRow['id']],
				])->first();
				$prevReview = [
					'slug'  => $prevRow['page_url'],
					'title' => !empty($prevDetail['short_description'])
								? $prevDetail['short_description']
								: $prevRow['name'],
				];
			}

			if ($currentIndex < count($navigableReviews) - 1) {
				$nextRow = $navigableReviews[$currentIndex + 1];
				$nextDetail = $tblsTripadvisorReviewDetails->find('all', [
					'fields'     => ['short_description'],
					'conditions' => ['TblsTripadvisorReviewDetails.review_id' => $nextRow['id']],
				])->first();
				$nextReview = [
					'slug'  => $nextRow['page_url'],
					'title' => !empty($nextDetail['short_description'])
								? $nextDetail['short_description']
								: $nextRow['name'],
				];
			}
		}

		// ── 6. "More reviews" sidebar cards (up to 3 others) ─────────────────
		$moreReviews = [];
		foreach ($navigableReviews as $r) {
			if ($r['page_url'] === $pageUrl) {
				continue; // skip current
			}
			$moreDetail = $tblsTripadvisorReviewDetails->find('all', [
				'fields'     => ['short_description', 'long_description'],
				'conditions' => ['TblsTripadvisorReviewDetails.review_id' => $r['id']],
			])->first();

			if (empty($moreDetail['long_description'])) {
				continue; // skip reviews without content
			}

			$moreReviews[] = [
				'slug'     => $r['page_url'],
				'name'     => $r['name'],
				'location' => $r['place'],
				'rating'   => 5,
				'title'    => @$moreDetail['short_description'],
				'snippet'  => mb_strimwidth(strip_tags(@$moreDetail['long_description']), 0, 120, '…'),
			];

			if (count($moreReviews) >= 3) {
				break;
			}
		}

		// ── 7. Total review count (for sidebar display) ───────────────────────
		$totalReviews = $tblsTripadvisorReviews->find('all')->count();

		// ── 8. SEO tags ───────────────────────────────────────────────────────
		$reviewerName  = $review['name'];
		$reviewerPlace = $review['location'];
		$reviewTitle   = $review['title'];

		$seoTags['meta_title']       = h($reviewTitle) . ' | Elegant Journeys TripAdvisor Review';
		$seoTags['meta_description'] = 'Read ' . h($reviewerName) . '\'s TripAdvisor review of Elegant Journeys. '
									 . mb_strimwidth(strip_tags($review['body']), 0, 140, '…');
		$seoTags['meta_keyword']     = 'Elegant Journeys review, ' . h($reviewerName) . ', TripAdvisor, India tour operator, luxury travel';
		$seoTags['canonical_url']    = WEBROOT . 'tripadvisor-review/' . $pageUrl;
		$seoTags['itemprop_name']    = h($reviewTitle);
		$seoTags['date_published']   = !empty($review['review_date'])
									 ? $review['review_date']->i18nFormat('yyyy-MM-dd')
									 : date('Y-m-d');
		$seoTags['date_modified']    = date('Y-m-d');

		$metaTags = $this->Seo->getSeoTags($seoTags, 'general');

		// ── 9. Schema ─────────────────────────────────────────────────────────
		$schemaTags = [];

		$breadcrumbs = [
			['label' => 'Home',               'link' => WEBROOT,                        'link_url' => true],
			['label' => 'Tripadvisor Reviews', 'link' => WEBROOT . 'tripadvisor-review', 'link_url' => true],
			['label' => h($reviewerName),      'link' => WEBROOT . 'tripadvisor-review/' . $pageUrl, 'link_url' => false],
		];

		$breadCrumbSchemaTags = ['breadcrumbs' => $breadcrumbs, 'schema_category_type' => 'breadcrumb'];
		$schemaTags[] = $this->Seo->getSchema($breadCrumbSchemaTags);

		$schemaTags[] = $this->Seo->getSchema(['schema_category_type' => 'organisation']);
		$schemaTags[] = $this->Seo->getSchema(['schema_category_type' => 'website']);

		if (!empty($review['review_date'])) {
			$singleTestimonialTags = [
				'reviewer_name'       => $reviewerName,
				'review_date'         => $review['review_date']->i18nFormat('yyyy-MM-dd'),
				'review_description'  => str_replace('"', '', stripslashes($review['body'])),
				'review_rating'       => '5',
				'schema_category_type'=> 'single_client_testimonial',
			];
			$schemaTags[] = $this->Seo->getSchema($singleTestimonialTags);
		}

		// ── 10. Pass data to view ─────────────────────────────────────────────
		$data = [
			'review'       => $review,
			'prevReview'   => $prevReview,
			'nextReview'   => $nextReview,
			'moreReviews'  => $moreReviews,
			'totalReviews' => $totalReviews,
			'breadcrumbs'  => $breadcrumbs,
			'meta_tags'    => $metaTags,
			'schema'       => $schemaTags,
		];

		$this->set('data',        $data);
		$this->set('review',      $review);
		$this->set('prevReview',  $prevReview);
		$this->set('nextReview',  $nextReview);
		$this->set('moreReviews', $moreReviews);
		$this->set('totalReviews',$totalReviews);
	}



}

