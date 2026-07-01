<?php

declare(strict_types=1);

namespace App\Controller;



use Cake\Core\Configure;

use Cake\Http\Exception\ForbiddenException;

use Cake\Http\Exception\NotFoundException;

use Cake\Http\Response;

use Cake\View\Exception\MissingTemplateException;





class VideosController extends AppController

{
	public function initialize(): void
    {
        parent::initialize();
		
        
    }

	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
	  parent::beforeFilter($event);
	  // Configure the login action to not require authentication, preventing
	  // the infinite redirect loop issue
	  //$this->Authentication->addUnauthenticatedActions(['index']);
	}

	public function index($limit="15")
    {
		// Set the layout.
		$this->viewBuilder()->setLayout('version2/default');
		$this->loadComponent('Seo');
		
		$tblVideoTestimonial = $this->fetchTable('TblsVideoTestimonial');
	

		$options['limit'] = $limit;
        $options['order']= array(
									"id"	=>  "asc"
							);
        $videoTestimonials = $tblVideoTestimonial->find('all',$options)->toArray();

		
		$data = array();
		
		$seoTags['meta_title'] = "Video Testimonials | Elegant Journeys";
		$seoTags['meta_description'] = "Watch real stories from Elegant Journeys travelers. Discover how our curated travel experiences created unforgettable memories.";
		$seoTags['meta_keyword'] = "Elegant Journeys reviews, video testimonials, customer stories, luxury travel feedback, client experiences, travel stories";
		$seoTags['canonical_url'] = WEBROOT."video-testimonial";
		$seoTags['itemprop_name'] = 'Video Testimonial';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
		#### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Video Testimonial",
								"link"			=>		WEBROOT.'video-testimonial',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		
		
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
				
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);





		$this->set("videoData",$videoTestimonials);



	}
	
	
	public function index1($limit="24")
    {
		// Set the layout.
		$this->viewBuilder()->setLayout('version2/default');
		$this->loadComponent('Seo');
		
		$tblVideoTestimonial = $this->fetchTable('TblsVideoTestimonial');
		$tblVideoTestimonialDet = $this->fetchTable('TblsVideoTestimonialDetails');
	

		$options['limit'] = $limit;
        $options['order']= array(
									"id"	=>  "asc"
							);
        $videoTestimonials = $tblVideoTestimonial->find('all',$options)->toArray();

		
		$data = array();
		
		$seoTags['meta_title'] = "Travel Video Testimonials – Real Experiences from Happy Customers | Elegant Journeys";
		$seoTags['meta_description'] = "Watch real travelers share their unforgettable journeys across India through our video testimonials. Discover tours in Delhi, Agra, Jaipur, Rajasthan, and beyond.";
		$seoTags['meta_keyword'] = "Travel Video Testimonials, Customer Reviews, Tour Experiences India, Delhi Agra Jaipur Tours, Rajasthan Travel Reviews, Elegant Journeys Testimonials";
		$seoTags['canonical_url'] = WEBROOT."video-testimonial";
		$seoTags['itemprop_name'] = 'Travel Video Testimonials – Real Experiences from Happy Customers';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
		#### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Video Testimonial",
								"link"			=>		WEBROOT.'video-testimonial',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		$schemaTags= array();
		
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		#### SETTING VIDEO SCHEMA TAG
		$videoSchemaTags = array();
		$videoSchmaTags['videos'] = array();
		foreach($videoTestimonials as $videoTestimonial)
		{
			$videoTestimonialDetInfo = $tblVideoTestimonialDet->findByVideoTestimonialId($videoTestimonial['id'])->toArray();
			$videoTestimonialDetInfo = $videoTestimonialDetInfo[0];
			
			$videoSchmaTags['videos'][] = array(
													"name"				=> 		"Video testimonial by ".$videoTestimonial['client_name']." from ".$videoTestimonial['country'],
													"description"		=>		$videoTestimonial['client_name']." from the ".$videoTestimonial['country']." share their heartfelt journey, highlighting seamless service and unforgettable moments across India. Their testimonial captures the personal touch and exceptional care they experienced.",
													"thumbnail_url"		=>		WEBROOT."repositery/video/image/".$videoTestimonial['thumbnails'],
													"upload_date"		=>		$videoTestimonial['modified']->i18nFormat('yyyy-MM-dd'),
													"duration_minute"	=>		floor($videoTestimonialDetInfo['duration']/60),
													"duration_second"	=>		$videoTestimonialDetInfo['duration']%60,
													"video_url"			=>		WEBROOT."repositery/video/".$videoTestimonial['video']
										);
		}
		$videoSchmaTags['schema_category_type'] = 'video_object_list';
		$videoSchema = $this->Seo->getSchema($videoSchmaTags);
		$schemaTags[] = $videoSchema;
		
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
		
		$this->set("data",$data);





		$this->set("videoData",$videoTestimonials);



	}

}

