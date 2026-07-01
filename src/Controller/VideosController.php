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
	  //Configure::write('debug',true);
	  // Configure the login action to not require authentication, preventing
	  // the infinite redirect loop issue
	  //$this->Authentication->addUnauthenticatedActions(['index']);
	}

	
	
	public function index($limit="39")
    {
		// Set the layout.
		$this->viewBuilder()->setLayout('version2/default');
		$this->loadComponent('Seo');
		
		$sectionCode = 'VIDEO_TESTIMONIAL';
		
		$tblVideoTestimonial = $this->fetchTable('TblsVideoTestimonial');
		$tblVideoTestimonialDet = $this->fetchTable('TblsVideoTestimonialDetails');
	

		$options['limit'] = $limit;
        $options['order']= array(
									"id"	=>  "asc"
							);
        $videoTestimonials = $tblVideoTestimonial->find('all',$options)->toArray();

		
		$data = array();
		
		$requestWebsiteData = array(
										"section_code"		=>	$sectionCode
								);
								
		$websiteSectionData=$this->getWebsiteContentData($requestWebsiteData);
		
		$data['faq'] = $websiteSectionData['faq'];
		$data['content'] = $websiteSectionData['content'];
		
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
			
			$contentUrl = WEBROOT."repositery/video/".$videoTestimonial['video'];
			
			if($videoTestimonial['active_link']=='yes')
			{
				$contentUrl = WEBROOT."video-testimonial/".$videoTestimonial['page_url'];
			}
			
			$videoSchmaTags['videos'][] = array(
													"name"				=> 		"Video testimonial by ".$videoTestimonial['client_name']." from ".$videoTestimonial['country'],
													"description"		=>		$videoTestimonial['client_name']." from the ".$videoTestimonial['country']." share their heartfelt journey, highlighting seamless service and unforgettable moments across India. Their testimonial captures the personal touch and exceptional care they experienced.",
													"thumbnail_url"		=>		WEBROOT."repositery/video/image/".$videoTestimonial['thumbnails'],
													"upload_date"		=>		$videoTestimonial['modified']->i18nFormat('yyyy-MM-dd'),
													"duration_minute"	=>		floor($videoTestimonialDetInfo['duration']/60),
													"duration_second"	=>		$videoTestimonialDetInfo['duration']%60,
													"video_url"			=>		WEBROOT."repositery/video/".$videoTestimonial['video'],
													"content_url"		=>		$contentUrl
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
		
		$faqSchemaTags = array();
		$faqSchemaTags['faq_list'] = $websiteSectionData['faq']['faq_list'];
		$faqSchemaTags['schema_category_type'] = 'faq';
		$faqSchema = $this->Seo->getSchema($faqSchemaTags);
		$schemaTags[] = $faqSchema;
						
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);





		$this->set("videoData",$videoTestimonials);



	}
	
	private function getTripSnapShots($data=array())
	{
		$tabVideoTripSnapshots = $this->fetchTable('TblsVideoTestimonialTripSnapshots');
		
		$filterTripSnapshots = array();
		$filterTripSnapshots['conditions'] = array(
														"video_testimonial_id"		=>		$data['video_testimonial_id']
											);
		$filterTripSnapshots['order'] = array(
														"order_sequence"		=>		"asc"
										);
										
		$videoSnapshots = $tabVideoTripSnapshots->find('all',$filterTripSnapshots)->toArray();
		
		$snapshotList = array();
		
		foreach($videoSnapshots as $videoSnapshot)
		{
			switch($videoSnapshot['snapshot_type'])
			{
				case 'duration':
						$snapshotName = 'Duration';
					break;
				case 'best_time':
						$snapshotName = 'Best Time';
					break;
				case 'style':
						$snapshotName = 'Style';
					break;
				case 'regions':
						$snapshotName = 'Regions';
					break;
			}
			
			$snapshotList[] = array(
									"name"		=>		$snapshotName,
									"value"		=>		$videoSnapshot['snapshot_value']
							);
							
		}
		
		return $snapshotList;
	}
	
	public function detail($pageUrl="")
    {
		// Set the layout.
		
		$this->viewBuilder()->setLayout('version2/default');
		$this->loadComponent('Seo');
		
		$sectionCode = 'VIDEO_TESTIMONIAL_DET';
		
		$data = array();
		
		$tabVideoTestimonial = $this->fetchTable('TblsVideoTestimonial');
		$tabVideoTestimonialDet = $this->fetchTable('TblsVideoTestimonialDetails');
		$tabVideoTestimonialDesc = $this->fetchTable('TblsVideoTestimonialDescriptions');
		$tabVideoTestimonialSeoTags = $this->fetchTable('TblsVideoTestimonialSeoTags');
		$tabVideoIntroductions = $this->fetchTable('TblsVideoTestimonialIntroductions');
		
		
		
		
		$videoTestimonialInfo = $tabVideoTestimonial->findByPageUrl($pageUrl)->toArray();
		$videoTestimonialInfo = $videoTestimonialInfo[0];
		
		$videoTestimonialDetInfo = $tabVideoTestimonialDet->findByVideoTestimonialId($videoTestimonialInfo['id'])->toArray();
		$videoTestimonialDetInfo = $videoTestimonialDetInfo[0];
		
		
		$videoTestimonialDescInfo = $tabVideoTestimonialDesc->findByVideoTestimonialId($videoTestimonialInfo['id'])->toArray();
		$videoTestimonialDescInfo = $videoTestimonialDescInfo[0];
		
		
		
		$videoTestimonialSeoTagInfo = $tabVideoTestimonialSeoTags->findByVideoTestimonialId($videoTestimonialInfo['id'])->toArray(); 
		$videoTestimonialSeoTagInfo = $videoTestimonialSeoTagInfo[0];
		
		$videoIntroInfo = $tabVideoIntroductions->findByVideoTestimonialId($videoTestimonialInfo['id'])->toArray();
		$videoIntroInfo = $videoIntroInfo[0];
		
		$data['general'] = array(
									  "title"				=>	 $videoTestimonialDescInfo['title'],
									  "short_introduction"	=>	 $videoTestimonialDescInfo['short_introduction'],	
									  "id"					=>	 $videoTestimonialInfo['id'],
									  "page_url"			=>	 $videoTestimonialInfo['page_url'],
									  "thumbnail_url"		=> 	 WEBROOT."repositery/video/image/".$videoTestimonialInfo['thumbnails'],
									  "video_url"			=>	 WEBROOT."repositery/video/".$videoTestimonialInfo['video']
									  
							);
							
								
		$data['description'] = $videoTestimonialDescInfo['description'];
		
		$seoTags = array();
		$seoTags['meta_title'] = $videoTestimonialSeoTagInfo['meta_title'];
		$seoTags['meta_description'] = $videoTestimonialSeoTagInfo['meta_description'];
		$seoTags['meta_keyword'] = $videoTestimonialSeoTagInfo['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT."video-testimonial/".$videoTestimonialInfo['page_url'];
		$seoTags['itemprop_name'] = $videoTestimonialDescInfo['title'];
		$seoTags['image'] = WEBROOT."repositery/video/image/".$videoTestimonialInfo['thumbnails'];
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
								"link_url"		=>		true
				);
				
		$breadcrumbs[]=array(
								"label"			=>		$videoTestimonialDescInfo['title'],
								"link"			=>		WEBROOT.'video-testimonial/'.$videoTestimonialInfo['page_url'],
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		$schemaTags= array();
		
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
				
		$videoTestimonialSchemaTags = array();
		$videoTestimonialSchemaTags['tour_name'] = $videoTestimonialDescInfo['title'];
		$videoTestimonialSchemaTags['thumbnail_url'] = WEBROOT."repositery/video/image/".$videoTestimonialInfo['thumbnails'];
		if($videoTestimonialDescInfo['modified']!="")
		{
			$videoTestimonialSchemaTags['upload_date'] = $videoTestimonialDescInfo['modified']->i18nFormat('yyyy-MM-dd');
		}
		$videoTestimonialSchemaTags['duration_minute'] = floor($videoTestimonialDetInfo['duration']/60);
		$videoTestimonialSchemaTags['duration_second'] = $videoTestimonialDetInfo['duration']%60;
		$videoTestimonialSchemaTags['page_url'] = WEBROOT.'video-testimonial/'.$videoTestimonialInfo['page_url'];
		$videoTestimonialSchemaTags['video_url'] = WEBROOT."repositery/video/".$videoTestimonialInfo['video'];
		$videoTestimonialSchemaTags['video_description'] = $videoIntroInfo['short_introduction'];
		
		$videoTestimonialSchemaTags['schema_category_type'] = 'video_single_testimonial_tour';
		$videoTestimonialSchema = $this->Seo->getSchema($videoTestimonialSchemaTags);
		
		$schemaTags[] = $videoTestimonialSchema;
		
		$data['schema'] = $schemaTags;
		
		$requestDataTripSnapshots = array(
												"video_testimonial_id"	=>	$videoTestimonialInfo['id']
									);
									
		$tripSnapshotList = $this->getTripSnapShots($requestDataTripSnapshots);
		
		$data['trip_snapshot'] = $tripSnapshotList;
		
		$this->set("data",$data);
		
	}

}

