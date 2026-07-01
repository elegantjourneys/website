<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CmsPageSeoTagsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cms_page_seo_tags');
        $this->setPrimaryKey('id');

        $this->belongsTo('CmsPages', [
            'foreignKey' => 'cms_page_id'
        ]);
    }
}

?>