<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

class AffiliateController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }


    public function inboundTourOperator()
    {
        $this->viewBuilder()->setLayout('version2/default');
        
    }
}
