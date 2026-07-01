<?php
declare(strict_types=1);

namespace Admin\View;

use Cake\View\View;


class AppView extends View
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadHelper('Html');
        $this->loadHelper('Form');
        $this->loadHelper('Paginator');

        $this->Paginator->setTemplates([
            'number' => '<li class="paginate_button page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'current' => '<li class="paginate_button page-item active"><a class="page-link" href="#">{{text}}</a></li>',
            'prevActive' => '<li class="paginate_button page-item previous"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'prevDisabled' => '<li class="paginate_button page-item previous disabled"><a class="page-link" href="#">{{text}}</a></li>',
            'nextActive' => '<li class="paginate_button page-item next"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'nextDisabled' => '<li class="paginate_button page-item next disabled"><a class="page-link" href="#">{{text}}</a></li>',
        ]);
    }
}