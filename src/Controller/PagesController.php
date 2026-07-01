<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Service\IpLocatorService;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
  {
    parent::beforeFilter($event);
    
  }

  private function generateCaptcha(): string
     {
         $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Avoid 0, O, I, 1 for clarity
         return substr(str_shuffle($characters), 0, 5); // Generate a 5-character CAPTCHA
     }
 
     public function getCaptcha()
     {
         $captcha = $this->generateCaptcha();
         $this->request->getSession()->write('captcha_code', $captcha);
         $this->set('captcha', $captcha);
         $this->viewBuilder()->setOption('serialize', ['captcha']);
     }
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
	
	public function index_old()
    {
        $tabHomePageTourGroups = $this->fetchTable('TblsHomePageTourGroups');
        $tblWebsiteSections = $this->fetchTable('TblWebsiteSections');
        $tblsTripadvisorReviews = $this->fetchTable('TblsTripadvisorReviews');

        $filterHomePageTourGroups = array();
        $filterHomePageTourGroups['order'] = array(
                                                        "order_sequence"  =>    "asc"
                                                );

        $homePageTourGroups = $tabHomePageTourGroups->find('all',$filterHomePageTourGroups)->toArray();

		$filterTripadvisorReviews = array();
		$filterTripadvisorReviews['order'] = array(
                                                        "id"  =>    "desc"
                                                );
		$filterTripadvisorReviews['limit'] = 3;

		$tripadvisorReviews = $tblsTripadvisorReviews->find('all',$filterTripadvisorReviews)->toArray();

		foreach($tripadvisorReviews as $tripadvisorReview)
		{
			
	


		}

		$this->set("homePageTourGroups",$homePageTourGroups);
	}
	
	public function index(){
	     $this->viewBuilder()->setLayout('version1/default');
	    
	}
  
  	public function indexDemo()
	{
	    $this->viewBuilder()->setLayout('version2/default');
		
		$this->loadComponent('Seo');
		 
		$data = array();
		$schemaTags = array();
		$seoTags = array();
		
		$seoTags['meta_title'] = "Bespoke Luxury Travel | Private Tours Across India & Beyond";
		$seoTags['meta_description'] = "Elegant Journeys offers curated private tours in India, Bhutan, Nepal & beyond. Experience bespoke luxury travel tailored for discerning global travelers.";
		$seoTags['meta_keyword'] = "";
		$seoTags['canonical_url'] = WEBROOT;
		$seoTags['itemprop_name'] = 'Elegant Jounreys';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
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
	
	
	public function indexTest()
	{
	    $this->viewBuilder()->setLayout('version2/default');
		
		$this->loadComponent('Seo');
		 
		$data = array();
		$schemaTags = array();
		$seoTags = array();
		
		$seoTags['meta_title'] = "Bespoke Luxury Travel | Private Tours Across India & Beyond";
		$seoTags['meta_description'] = "Elegant Journeys offers curated private tours in India, Bhutan, Nepal & beyond. Experience bespoke luxury travel tailored for discerning global travelers.";
		$seoTags['meta_keyword'] = "";
		$seoTags['canonical_url'] = WEBROOT;
		$seoTags['itemprop_name'] = 'Elegant Jounreys';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
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
	
	
	public function toc()
	{
	     $this->loadComponent('Seo');
		$this->viewBuilder()->setLayout('version2/default');
		
		$data = array();
		
		$seoTags['meta_title'] = "Terms & Privacy Policy | Elegant Journeys";
		$seoTags['meta_description'] = "Review Elegant Journeys' Terms of Service and Privacy Policy to understand how we protect your data and ensure a secure travel booking experience.";
		$seoTags['meta_keyword'] = "Elegant Journeys, Terms of Service, Privacy Policy, data protection, travel website policies, user agreement, security, personal information";
		$seoTags['canonical_url'] = WEBROOT."faq";
		$seoTags['itemprop_name'] = 'Terms and Privacy';
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
								"label"			=>		"Terms and Privacy",
								"link"			=>		WEBROOT.'terms-privacy',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		
		
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$articleSchemaTags = array();
		$articleSchemaTags['page_url']=WEBROOT.'terms-privacy';
		$articleSchemaTags['date_created']=date("Y-m-d",strtotime("-1 years"));
		$articleSchemaTags['date_modified']=date("Y-m-d",strtotime("-1 months"));
		$articleSchemaTags['headline'] = 'STANDARD TERMS and CONDITIONS';
		$articleSchemaTags['name'] = 'STANDARD TERMS and CONDITIONS';
		$articleSchemaTags['description'] = $metaTags['meta_description'];
		$articleSchemaTags['image'] = $metaTags['image'];
		$articleSchemaTags['schema_category_type'] = 'article';
		
		$articleSchema = $this->Seo->getSchema($articleSchemaTags);
		$schemaTags[] = $articleSchema;
		
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);
	    
	}
	public function faq()
	{
		$this->loadComponent('Seo');
		$this->viewBuilder()->setLayout('version2/default');
		
		$tabFaqs = $this->fetchTable('Faqs');
		$tabFaqAnswers = $this->fetchTable('FaqAnswers');
		
		$data = array();
		
		$filterFaqs = array();
		$filterFaqs['order'] = array(
										"order_sequence"	=>	"asc"
								);
		
		$faqs = $tabFaqs->find('all',$filterFaqs)->toArray();
		
		$faqList = array();
		foreach($faqs as $faq)
		{
			$faqAnswerInfo = $tabFaqAnswers->findByFaqId($faq['id'])->toArray();
			$faqAnswerInfo = $faqAnswerInfo[0];
			
			$faqList[] = array(
									"id"			=>			$faq['id'],
									"question"		=>			$faq['question'],
									"answer"		=>			$faqAnswerInfo['answer']
						);
						
		}
		
		$data['faqs'] = $faqList;
		
		$tripadvisorReviewList = array();
		$tripadvisorReviewList = $this->getTopFiveTripAdvisorReview();
		
		$data['tripadvisor_review_list'] = $tripadvisorReviewList;
		
		
		$schemaTags = array();
		
		$faqSchemaTags = array();
		$faqSchemaTags['faq_list'] = $faqList;
		$faqSchemaTags['schema_category_type'] = 'faq';
		$faqSchema = $this->Seo->getSchema($faqSchemaTags);
		$schemaTags[] = $faqSchema;
		
		
		#### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"FAQ",
								"link"			=>		WEBROOT.'faq',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$data['schema'] = $schemaTags;
		
		$seoTags['meta_title'] = "Frequently Asked Questions | Elegant Journeys";
		$seoTags['meta_description'] = "Find answers to the most commonly asked questions about Elegant Journeys, luxury travel packages, booking processes, cancellation policies, and more.";
		$seoTags['meta_keyword'] = "Elegant Journeys FAQ, luxury travel help, booking questions, Elegant Journeys policies, travel support, customer service";
		$seoTags['canonical_url'] = WEBROOT."faq";
		$seoTags['itemprop_name'] = 'FAQ';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
		$this->set("data",$data);
	    
	}
	
	public function travelGuide()
	{
		$this->loadComponent('Seo');
		$this->viewBuilder()->setLayout('version2/default');
		
		$data = array();
		
		$seoTags['meta_title'] = "Travel Guide | Elegant Journeys";
		$seoTags['meta_description'] = "Expert tips, destination highlights, and travel inspiration from Elegant Journeys. Plan smarter and travel better.";
		$seoTags['meta_keyword'] = "travel guide, Elegant Journeys, travel tips, luxury destinations, travel planning, travel inspiration, destination guide";
		$seoTags['canonical_url'] = WEBROOT."faq";
		$seoTags['itemprop_name'] = 'Travel Guide';
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
								"label"			=>		"Travel Guide",
								"link"			=>		WEBROOT.'travel-guide',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		
		
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$articleSchemaTags = array();
		$articleSchemaTags['page_url']=WEBROOT.'travel-guide';
		$articleSchemaTags['date_created']=date("Y-m-d",strtotime("-1 years"));
		$articleSchemaTags['date_modified']=date("Y-m-d",strtotime("-1 months"));
		$articleSchemaTags['headline'] = 'Travel Guide';
		$articleSchemaTags['name'] = 'Travel Guide';
		$articleSchemaTags['description'] = $metaTags['meta_description'];
		$articleSchemaTags['image'] = $metaTags['image'];
		$articleSchemaTags['schema_category_type'] = 'article';
		
		$articleSchema = $this->Seo->getSchema($articleSchemaTags);
		$schemaTags[] = $articleSchema;
		
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);
		
	}
	public function aboutUs()
	{
		$this->loadComponent('Seo');
	    $this->viewBuilder()->setLayout('version2/default');
		
		
		$data = array();
		
		$seoTags['meta_title'] = "About Us | Elegant Journeys";
		$seoTags['meta_description'] = "Learn about Elegant Journeys—our passion for curating luxury travel experiences, personalized service, and unforgettable adventures around the world.";
		$seoTags['meta_keyword'] = "About Elegant Journeys, luxury travel company, travel experts, curated experiences, travel agency, personalized journeys";
		$seoTags['canonical_url'] = WEBROOT."about-us";
		$seoTags['itemprop_name'] = 'About Elegant Journeys';
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
								"label"			=>		"About Us",
								"link"			=>		WEBROOT.'about-us',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		
		
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$articleSchemaTags = array();
		$articleSchemaTags['page_url']=WEBROOT.'about-us';
		$articleSchemaTags['date_created']=date("Y-m-d",strtotime("-1 years"));
		$articleSchemaTags['date_modified']=date("Y-m-d",strtotime("-1 months"));
		$articleSchemaTags['headline'] = 'About Us';
		$articleSchemaTags['name'] = 'About Us';
		$articleSchemaTags['description'] = $metaTags['meta_description'];
		$articleSchemaTags['image'] = $metaTags['image'];
		$articleSchemaTags['schema_category_type'] = 'article';
		
		$articleSchema = $this->Seo->getSchema($articleSchemaTags);
		$schemaTags[] = $articleSchema;
		
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);
	}
	public function pdfTest(){
	    $this->viewBuilder()->enableAutoLayout(false); 
	   //$this->render("pdf_test"); 
	}

    public function terms($termsType="")
    {
		if($termsType!='palace-on-wheel')
		{
				header('location:https://www.elegantjourneys.com/terms-privacy');
				exit();
		}
        $this->viewBuilder()->setLayout('version2/default');
        
        $this->render("terms-palace-on-wheel");
    }
	
	public function privacyPolicy()
	{
	    $this->viewBuilder()->setLayout('version2/default');
        
	}
	
	public function refundAndCancellation()
	{
		$this->viewBuilder()->setLayout('version2/default');
		
	}
  public function clientPayment()
	{
		$this->loadComponent('Seo');
	    $this->viewBuilder()->setLayout('version2/default');
		
		
		$data = array();
		
		$seoTags['meta_title'] = "Pay Now | Elegant Journeys";
		$seoTags['meta_description'] = "Learn about Elegant Journeys—our passion for curating luxury travel experiences, personalized service, and unforgettable adventures around the world.";
		$seoTags['meta_keyword'] = "About Elegant Journeys, luxury travel company, travel experts, curated experiences, travel agency, personalized journeys";
		$seoTags['canonical_url'] = WEBROOT."pay-now";
		$seoTags['itemprop_name'] = 'PAy Now Elegant Journeys';
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
								"label"			=>		"Pay Now",
								"link"			=>		WEBROOT.'pay-now',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		
		
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$articleSchemaTags = array();
		$articleSchemaTags['page_url']=WEBROOT.'pay-now';
		$articleSchemaTags['date_created']=date("Y-m-d",strtotime("-1 years"));
		$articleSchemaTags['date_modified']=date("Y-m-d",strtotime("-1 months"));
		$articleSchemaTags['headline'] = 'Pay Now';
		$articleSchemaTags['name'] = 'Pay Now';
		$articleSchemaTags['description'] = $metaTags['meta_description'];
		$articleSchemaTags['image'] = $metaTags['image'];
		$articleSchemaTags['schema_category_type'] = 'article';
		
		$articleSchema = $this->Seo->getSchema($articleSchemaTags);
		$schemaTags[] = $articleSchema;
		
		$data['schema'] = $schemaTags;
		$this->set("data",$data);
		
	}
	
	public function affiliations()
	{
		$this->loadComponent('Seo');
		
		$this->viewBuilder()->setLayout('version2/default');
		
		$data = array();
		
		$seoTags['meta_title'] = "Affiliations & Accreditations | Elegant Journeys";
		$seoTags['meta_description'] = "Discover the trusted associations and travel industry accreditations of Elegant Journeys, reflecting our commitment to quality, safety, and luxury travel standards.";
		$seoTags['meta_keyword'] = "elegant journeys affiliations, travel industry accreditations, IATO member, India tour operator certifications, trusted travel partners india";
		$seoTags['canonical_url'] = WEBROOT."affiliations-and-accreditations";
		$seoTags['itemprop_name'] = 'Trusted Affiliations and Certifications';
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
								"label"			=>		"Affiliations & Accreditations",
								"link"			=>		WEBROOT.'affiliations',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
		
		$schemaTags = array();
		
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);
	}
}
