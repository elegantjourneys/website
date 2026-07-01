<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;

class BlogsController extends AppController

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
		
        $this->viewBuilder()->setLayout('version2/default');
		$tabBlogs = $this->fetchTable('Blogs');
		$tabBlogShortDesc = $this->fetchTable('BlogShortDescriptions');
		
		$filterBlogs = array();
		$filterBlogs['order'] = array(
										"id"		=>		"desc"
								);
		$filterBlogs['limit'] =  '30';
		$filterBlogs['offset'] = ($page-1)*30;
				
		$blogs = $tabBlogs->find('all',$filterBlogs)->toArray();
		
		$blogList = array();
		foreach($blogs as $blog)
		{
			$blogShortDescInfo = $tabBlogShortDesc->findByBlogId($blog['id'])->toArray();
			$blogShortDescInfo = $blogShortDescInfo[0];
			
			$blogList[] = array(
									"id"				=>	$blog['id'],
									"title"				=>	$blog['title'],
									"page_url"			=>	WEBROOT.'blog/'.$blog['page_url'],
									"image"				=>	WEBROOT.'repositery/blog/'.$blog['image'],
									"short_description"	=>	$blogShortDescInfo['description'],
									"publication_date"	=>	$blog['publication_date']->i18nFormat('MMMM dd yyyy')
						);
		}
		
		$data['blog_list'] = $blogList;
		#### SEO TAGS
		
		$seoTags['meta_title'] = "Luxury India Travel Blog | Golden Triangle Tour, Rajasthan Palaces & Safari Experiences";
		$seoTags['meta_description'] = "Discover India’s most iconic routes and royal stays with Elegant Journeys. Explore expert travel blogs on the Golden Triangle, luxury Rajasthan hotels, and wildlife safaris in Ranthambore.";
		$seoTags['meta_keyword'] =  "Luxury India Tours, Golden Triangle Blog, Rajasthan Travel Guide, Luxury Palace Hotels, Ranthambore Safari, India Heritage Tours, Elegant Journeys Blog";
		$seoTags['canonical_url'] = WEBROOT.'blog';
		$seoTags['itemprop_name'] = 'Elegant Journeys Blog';
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
								"label"			=>		'Elegant Jounryes Blog',
								"link"			=>		WEBROOT.'blog',
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
		
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);

	}
	
	private function getBlogByUrl($pageUrl=""){

		

		$blogTbl = $this->fetchTable('Blogs');

		$options['conditions'] =array("Blogs.page_url"=>$pageUrl);	

		return $blogInfo = $blogTbl->find("all",$options)->enableHydration(false)->first();	

	}
	
	public function detail($pageUrl="")
    {
		$this->loadComponent('Seo');
        $this->viewBuilder()->setLayout('version2/default');
		$tabBlogs = $this->fetchTable('Blogs');
		$tabBlogDescriptions = $this->fetchTable('BlogDescriptions');
		$tabBlogSeoTags = $this->fetchTable('BlogSeoTags');
		
		$blogInfo = $tabBlogs->findByPageUrl($pageUrl)->toArray();
		$blogInfo = $blogInfo[0];
		
		$blogDescInfo = $tabBlogDescriptions->findByBlogId($blogInfo['id'])->toArray();
		$blogDescInfo = $blogDescInfo[0];
		
		$blogSeoTagInfo = $tabBlogSeoTags->findByBlogId($blogInfo['id'])->toArray();
		$blogSeoTagInfo = $blogSeoTagInfo[0];
		
		$data['general'] = array(
										"id"				=>		$blogInfo['id'],
										"title"				=>		$blogInfo['title'],
										"page_url"			=>		WEBROOT.'blog/'.$blogInfo['page_url'],
										"image"				=>		WEBROOT.'repositery/blog/'.$blogInfo['image'],
										"description"		=>		$blogDescInfo['description'],
										"publication_date"	=>		$blogInfo['publication_date']->i18nFormat('MMMM dd yyyy')
							);
		
		
		#### SEO TAGS
		$seoTags['meta_title'] = $blogSeoTagInfo['meta_title'];
		$seoTags['meta_description'] = $blogSeoTagInfo['meta_description'];
		$seoTags['meta_keyword'] =  $blogSeoTagInfo['meta_keyword'];
		$seoTags['canonical_url'] = WEBROOT.'blog/'.$pageUrl;
		$seoTags['itemprop_name'] = $blogInfo['title'];
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
								"label"			=>		'Elegant Jounryes Blog',
								"link"			=>		WEBROOT.'blog',
								"link_url"		=>		true
				);
				
		
		$breadcrumbs[]=array(
								"label"			=>		$blogInfo['title'],
								"link"			=>		WEBROOT.'blog/'.$blogInfo['page_url'],
								"link_url"		=>		false
				);
				
		
		$data['breadcrumbs'] = $breadcrumbs;
		
		$schemaTags = array();
		
		$blogPostingSchemaTags = array();
		$blogPostingSchemaTags['page_url'] = WEBROOT.'blog/'.$blogInfo['page_url'];
		$blogPostingSchemaTags['title'] = $blogInfo['title'];
		$blogPostingSchemaTags['description'] = $blogSeoTagInfo['meta_description'];
		$blogPostingSchemaTags['image'] = WEBROOT.'repositery/blog/'.$blogInfo['image'];
		$blogPostingSchemaTags['keyword'] = $blogSeoTagInfo['meta_keyword'];
		$blogPostingSchemaTags['word_count'] = strlen($blogDescInfo['description']);
		$blogPostingSchemaTags['date_published'] = $blogInfo['publication_date']->i18nFormat('yyyy-MM-dd');
		$blogPostingSchemaTags['date_modified'] = $blogInfo['publication_date']->i18nFormat('yyyy-MM-dd');
		$blogPostingSchemaTags['author_url'] = 'https://www.elegantjourneys.com';
		$blogPostingSchemaTags['schema_category_type'] = 'blog_posting';
		$blogPostingSchema = $this->Seo->getSchema($blogPostingSchemaTags);
		$schemaTags[] = $blogPostingSchema;
		
		$articleSchemaTags = array();
		$articleSchemaTags['page_url'] = WEBROOT.'blog/'.$blogInfo['page_url'];
		$articleSchemaTags['name'] = $blogInfo['title'];
		$articleSchemaTags['headline'] = $blogInfo['title'];
		$articleSchemaTags['image'] = WEBROOT.'repositery/blog/'.$blogInfo['image'];
		$articleSchemaTags['author_url'] = 'https://www.elegantjourneys.com';
		$articleSchemaTags['date_created'] = $blogInfo['publication_date']->i18nFormat('yyyy-MM-dd');
		$articleSchemaTags['date_modified'] = $blogInfo['publication_date']->i18nFormat('yyyy-MM-dd');
		$articleSchemaTags['schema_category_type'] = 'article';
		$articleSchema = $this->Seo->getSchema($articleSchemaTags);
		$schemaTags[] = $articleSchema;
		
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
		
		$organisationSchemaTags = array();
		$organisationSchemaTags['schema_category_type'] = 'organisation';
		$organisationSchema = $this->Seo->getSchema($organisationSchemaTags);
		$schemaTags[] = $organisationSchema;
		
		$websiteSchemaTags = array();
		$websiteSchemaTags['schema_category_type'] = 'website';
		$websiteSchema = $this->Seo->getSchema($websiteSchemaTags);
		$schemaTags[] = $websiteSchema;
		
		$data['schema'] = $schemaTags;
		
		$this->set("data",$data);
		
		

	}

	
}

