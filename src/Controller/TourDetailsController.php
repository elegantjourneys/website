<?php

declare(strict_types=1);

namespace App\Controller;



use Cake\Core\Configure;

use Cake\Http\Exception\ForbiddenException;

use Cake\Http\Exception\NotFoundException;

use Cake\Http\Response;

use Cake\View\Exception\MissingTemplateException;





class TourDetailsController extends AppController

{

	public function beforeFilter(\Cake\Event\EventInterface $event)
  {
    parent::beforeFilter($event);
    
  }

	public function index()

    {

		// Set the layout.

		$this->viewBuilder()->setLayout('version1/default');





	}

}

