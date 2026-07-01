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
				$singleTestimonialTags['review_description'] = stripslashes($tripadvisorReview['long_description']);
				$singleTestimonialTags['review_rating'] = '5';
				$singleTestimonialTags['schema_category_type'] = 'single_client_testimonial';
				$singleTestimonialSchema = $this->Seo->getSchema($singleTestimonialTags);
				$schemaTags[] = $singleTestimonialSchema;
			}
		}
		
		
		$data['schema'] = $schemaTags;
		
		$this->set('data',$data);
	}
	
	
	public function indexTest()    
	{
		$this->loadComponent('Seo');
		$this->viewBuilder()->setLayout('version2/default');		
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



}

