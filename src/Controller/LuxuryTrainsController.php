<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;

class LuxuryTrainsController extends AppController

{
	public function initialize(): void
    {
        parent::initialize();
		//$this->loadComponent('Email'); // Load the EmailComponent
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);	
		//Configure::write('debug',true);
    }
	
	
    public function index($page=1)
    {

        $this->loadComponent('Seo');
        $this->viewBuilder()->setLayout('version2/train');

        $seoTags = array();
		$seoTags['meta_title'] = "Palace on Wheels | Official Luxury Train Tour Across Rajasthan, India";
		$seoTags['meta_description'] = "Experience royal India aboard the Palace on Wheels. 7 nights of luxurious travel, heritage tours & gourmet dining. Book now!";
		$seoTags['meta_keyword'] = "Palace on Wheels, luxury trains India, Rajasthan royal train, India heritage tours, luxury rail journeys";
		$seoTags['canonical_url'] = WEBROOT.'luxury-trains';
		$seoTags['itemprop_name'] = 'Luxury Trains';
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
								"label"			=>		"Luxury Trains",
								"link"			=>		WEBROOT.'luxury-trains',
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

        $tblsCmsContents = $this->fetchTable('CmsContents');

        $query = $tblsCmsContents->find()
    ->contain(['CmsContentDescriptions','CmsContentItineraries'])
    ->order([
        'CmsContents.id' => 'ASC'
    ])
    ->toArray();

        

    $contents = [];

    foreach ($query as $row) {

    $tblsCmsContentItineraries = $this->fetchTable('CmsContentItineraries');

        $code = $row["code"];
        $contents[$code] = [
            'id' => $row["id"],
            'title' => $row["cms_content_descriptions"][0]["title"] ?? '',
            'description' => $row["cms_content_descriptions"][0]["description"] ?? '',
          	'city' => $row["cms_content_itineraries"][0]["city_covered"] ?? '',
        ];
    }

      
      
        $this->set(compact('contents', 'data'));

    }
	
	function list()
	{
		$this->loadComponent('Seo');
        $this->viewBuilder()->setLayout('version2/train');
		
		$data=array();
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Luxury Trains in India",
								"link"			=>		WEBROOT.'india-luxury-trains',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
		
		
		$seoTags = array();
		$seoTags['meta_title'] = "Luxury Trains in India | Palace on Wheels & Maharajas’ Express | Elegant Journeys";
		$seoTags['meta_description'] = "Discover India’s most luxurious train journeys aboard the Palace on Wheels and Maharajas Express. Experience royal hospitality, heritage cities, fine dining, and curated cultural tours on India’s iconic luxury trains.";
		$seoTags['meta_keyword'] = "luxury trains in india, palace on wheels train, maharajas express train, india luxury train tours, royal train journey india, rajasthan luxury train, heritage train india, luxury rail travel india";
		$seoTags['canonical_url'] = WEBROOT.'india-luxury-trains';
		$seoTags['itemprop_name'] = 'Luxury Trains in India';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
		 $this->set("data",$data);
		
	}
	
	
	 public function detail($pageUrl="")
    {
		
        $this->loadComponent('Seo');
        $this->viewBuilder()->setLayout('version2/train');
		
		
		$tblsCmsPages = $this->fetchTable('CmsPages');
		$tblsCmsPageSeoTags = $this->fetchTable('CmsPageSeoTags');
		$tblsCmsContents = $this->fetchTable('CmsContents');
		$tblsCmsContentDescriptions = $this->fetchTable('CmsContentDescriptions');
		$tblsCmsContentItineraries = $this->fetchTable('CmsContentItineraries');
		
		$data = array();
		
		$cmsPageInfo = $tblsCmsPages->findByPageUrl($pageUrl)->toArray();
		$cmsPageInfo = $cmsPageInfo[0];
		
		
		
		$data['general'] = array(
									"name"			=>		$cmsPageInfo['name'],
									"page_url"		=>		$cmsPageInfo['page_url']
							);
		
		
		
		$filterCmsContents = array();
		$filterCmsContents['conditions'] = array(
													"page_id"		=>		$cmsPageInfo['id']
											);
								
		$cmsContents = $tblsCmsContents->find('all',$filterCmsContents)->toArray();
		
		$contentList = array();
		foreach($cmsContents as $cmsContent)
		{
			switch($cmsContent['content_category_id'])
			{
				case '1':
						$cmsContentDescInfo = $tblsCmsContentDescriptions->findByCmsContentId($cmsContent['id'])->toArray();
						$cmsContentDescInfo = $cmsContentDescInfo[0];
                		$cmsContentItineraryInfo = $tblsCmsContentItineraries->findByCmsContentId($cmsContent['id'])->toArray();
						$cmsContentItineraryInfo = $cmsContentItineraryInfo[0];
						
						$contentList[$cmsContent['code']] = array(
																	"id"			=>		$cmsContent['id'],
																	"type"			=>		"GENERAL",
																	"title"			=>		$cmsContentDescInfo['title'],
																	"description"	=>		$cmsContentDescInfo['description'],
                          											"city"			=>		$cmsContentItineraryInfo['city_covered']
															);
					break;
				case '5':
						$cmsContentDescInfo = $tblsCmsContentDescriptions->findByCmsContentId($cmsContent['id'])->toArray();
						$cmsContentDescInfo = $cmsContentDescInfo[0];
						
						$cmsContentItineraryInfo = $tblsCmsContentItineraries->findByCmsContentId($cmsContent['id'])->toArray();
						$cmsContentItineraryInfo = $cmsContentItineraryInfo[0];
						
					
						$contentList[$cmsContent['code']] = array(
																	"id"			=>		$cmsContent['id'],
																	"type"			=>		"ITINERARY",
																	"title"			=>		$cmsContentDescInfo['title'],
																	"description"	=>		$cmsContentDescInfo['description'],
                          											"city"			=>		$cmsContentItineraryInfo['city_covered'],
																	"page_url"		=>		WEBROOT.'india-luxury-trains/'.$pageUrl.'/'.$cmsContentItineraryInfo['page_url']
															);
					break;
						
			}
		}
		
		
		$data['content'] = $contentList;
		
		$cmsPageSeoTagInfo = $tblsCmsPageSeoTags->findByCmsPageId($cmsPageInfo['id'])->toArray();
		$cmsPageSeoTagInfo = $cmsPageSeoTagInfo[0];
		
		#### SEO TAGS
		$seoTags['meta_title'] = $cmsPageSeoTagInfo['meta_title'];
		$seoTags['meta_description'] = $cmsPageSeoTagInfo['meta_description'];
		$seoTags['meta_keyword'] =  $cmsPageSeoTagInfo['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT.'india-luxury-train/'.$pageUrl;
		$seoTags['itemprop_name'] = $cmsPageSeoTagInfo['title'];
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
								"label"			=>		"Luxury Trains",
								"link"			=>		WEBROOT.'luxury-trains',
								"link_url"		=>		true
				);
				
		$breadcrumbs[]=array(
								"label"			=>		$cmsPageInfo['name'],
								"link"			=>		WEBROOT.'india-luxury-trains/'.$cmsPageInfo['page_url'],
								"link_url"		=>		true
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

        $this->set("data",$data);

    }
	
	public function itinerary($trainPageUrl="",$itineraryPageUrl="")
	{
		$this->loadComponent('Seo');
        //$this->viewBuilder()->setLayout('version2/train');
		
		$tblsCmsPages = $this->fetchTable('CmsPages');
		$tblsCmsContents = $this->fetchTable('CmsContents');
		$tblsCmsContentDescriptions = $this->fetchTable('CmsContentDescriptions');
		$tblsCmsContentItineraries = $this->fetchTable('CmsContentItineraries');
		$tblsCmsContentItineraryDays = $this->fetchTable('CmsContentItineraryDays');
		$tblsCmsContentItineraryDesc = $this->fetchTable('CmsContentItineraryDescriptions');
		$tblsCmsContentItinerarySeoTags = $this->fetchTable('CmsContentItinerarySeoTags');
		
		$data = array();
		
		$pageInfo = $tblsCmsPages->findByPageUrl($trainPageUrl)->toArray();
		$pageInfo = $pageInfo[0];
		
		$itineraryInfo = $tblsCmsContentItineraries->findByPageUrl($itineraryPageUrl)->toArray();
		$itineraryInfo = $itineraryInfo[0];
      
      	$cmsContentDescriptionsInfo = $tblsCmsContentDescriptions->findByCmsContentId($itineraryInfo['cms_content_id'])->toArray();
		$cmsContentDescriptionsInfo = $cmsContentDescriptionsInfo[0];
		
		$data['general'] = array(
										"id"				=>		$itineraryInfo['id'],
										"title"				=>		$itineraryInfo['title'],
										"itinerary_url"		=>		$itineraryInfo['page_url'],
          								"itinerary_desc"	=>		$cmsContentDescriptionsInfo['description'],
										"page_id"			=>		$pageInfo['id'],
										"page_name"			=>		$pageInfo['name'],
										"page_url"			=>		$pageInfo['page_url'],
										"total_days"		=>		$itineraryInfo['total_days'],
										"total_nights"		=>		($itineraryInfo['total_days']-1),
										"city_covered"		=>		$itineraryInfo['city_covered']
							);
      
		
		$itineraryList = array();
		for($i=1;$i<=$itineraryInfo['total_days'];$i++)
		{
			
			$itineraryDayInfo =  $tblsCmsContentItineraryDays->findByCmsContentItineraryIdAndDayCount($itineraryInfo['id'],$i)->toArray();
			$itineraryDayInfo = $itineraryDayInfo[0];
			  
			$itineraryDayDesc = $tblsCmsContentItineraryDesc->findByCmsContentItineraryDayId($itineraryDayInfo['id'])->toArray();
			$itineraryDayDesc = $itineraryDayDesc[0];
		
			$itineraryList[$i] = array(
											"day_count"			=>		$i,
											"week_day"			=>		$itineraryDayInfo['week_day'],
											"city"				=>		$itineraryDayInfo['city'],
											"description"		=>		$itineraryDayDesc['description']
								);
											
		}
		
		$data['itinerary_list'] = $itineraryList;
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Luxury Trains",
								"link"			=>		WEBROOT.'luxury-trains',
								"link_url"		=>		true
				);
				
		$breadcrumbs[]=array(
								"label"			=>		$pageInfo['name'],
								"link"			=>		WEBROOT.'india-luxury-trains/'.$pageInfo['page_url'],
								"link_url"		=>		true
				);
				
		$breadcrumbs[]=array(
								"label"			=>		$itineraryInfo['title'],
								"link"			=>		WEBROOT.'india-luxury-trains/'.$pageInfo['page_url']."/".$itineraryInfo['page_url'],
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
		
		$itinerarySeoContentInfo = $tblsCmsContentItinerarySeoTags->findByCmsContentItineraryId($itineraryInfo['id'])->toArray();
		$itinerarySeoContentInfo = $itinerarySeoContentInfo[0];
		
		#### SEO TAGS
		$seoTags['meta_title'] = $itinerarySeoContentInfo['meta_title'];
		$seoTags['meta_description'] = $itinerarySeoContentInfo['meta_description'];
		$seoTags['meta_keyword'] =  $itinerarySeoContentInfo['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT.'india-luxury-trains/'.$pageInfo['page_url']."/".$itineraryInfo['page_url'];
		$seoTags['itemprop_name'] = $itineraryInfo['title'];
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
	
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		$data['meta_tags'] = $metaTags;
		
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
		
		$this->set("data",$data);
      	if ($this->request->is('ajax')) {
    $this->viewBuilder()->setLayout('ajax');

    // ✅ Force exact file (THIS WILL FIX YOUR ISSUE)
    return $this->render('/LuxuryTrains/itinerary_ajax');
}

// fallback
return $this->render('/LuxuryTrains/itinerary');

        }
}    