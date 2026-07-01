<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CmsPagesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('cms_page');

        $this->hasOne('CmsPageSeoTags', [
            'foreignKey' => 'cms_page_id',
            'propertyName' => 'cms_page_seo_tag', // IMPORTANT
            'dependent' => true,
            'saveStrategy' => 'replace'
        ]);
    }
}
