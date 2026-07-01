<?php
declare(strict_types=1);

namespace Admin\Controller;

use App\Controller\AppController as BaseController;
use Admin\View\AppView;

class AppController extends BaseController
{
	public function initialize(): void
	  {
		  parent::initialize();
      	// Load Admin Plugin AppView
         $this->viewBuilder()->setClassName(AppView::class);
		  // Load the Authentication component
		  $this->loadComponent('Authentication.Authentication');
	  }

	public function beforeFilter(\Cake\Event\EventInterface $event)
	  {
		parent::beforeFilter($event);
	  }
}
