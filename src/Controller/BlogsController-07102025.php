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
		Configure::write('debug',true);
    }
	public function index()

    {
        $this->viewBuilder()->setLayout('version1/default');
		$blogs = $this->fetchTable('Blogs');
				
		$options['fields']=array("id"=>"Blogs.id",
		"title"=>"title",
		"image"=>"image",
		"page_url"=>"page_url",
		"modified"=>"Blogs.modified",
		"description"=>"BlogDescriptions.description",
		"meta_title"=>"BlogSeoTags.meta_title",
		"meta_keyword"=>"BlogSeoTags.meta_keyword",
		"meta_description"=>"BlogSeoTags.meta_description");
		$options['limit']=100;
		$options['contain'] =array("BlogDescriptions","BlogSeoTags");
		$this->paginate =$options;
		// Perform the query, disabling hydration
		$query = $blogs->find()
        ->enableHydration(false) // Disable hydration to get results as arrays
        ->contain($options['contain'])
        ->select($options['fields']);
    
		// Paginate the query
		$data = $this->paginate($query)->toArray();
		
		$this->set("data",$data);

	}
	
	private function getBlogByUrl($pageUrl=""){

		

		$blogTbl = $this->fetchTable('Blogs');

		$options['conditions'] =array("Blogs.page_url"=>$pageUrl);	

		return $blogInfo = $blogTbl->find("all",$options)->enableHydration(false)->first();	

	}
	public function detail($pageUrl="")

    {
        $this->viewBuilder()->setLayout('version1/default');
		$blogs = $this->fetchTable('Blogs');
		$blogInfo = $this->getBlogByUrl($pageUrl);
		
		
		$options['fields']=array(
		"title"=>"title",
		"image"=>"image",
		"page_url"=>"page_url",
		"modified"=>"Blogs.modified",
		"description"=>"BlogDescriptions.description",
		"meta_title"=>"BlogSeoTags.meta_title",
		"meta_keyword"=>"BlogSeoTags.meta_keyword",
		"meta_description"=>"BlogSeoTags.meta_description");
		$options['limit']=100;
		$options['contain'] =array("BlogDescriptions","BlogSeoTags");
		$options['conditions'] = array("Blogs.id"=>$blogInfo['id']);
		
		$query = $blogs->find()
        ->enableHydration(false) // Disable hydration to get results as arrays
        ->contain($options['contain'])
		->where($options['conditions'])
        ->select($options['fields'])
		->first();
		//->toArray();
    
		//echo "<pre>";
		//print_r($query);exit;
		
		$this->set("data",$query);
		
		

	}

	
}

