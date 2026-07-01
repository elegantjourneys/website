<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CmsContentImagesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cms_content_images');
        $this->setPrimaryKey('id');

        $this->belongsTo('CmsContents', [
            'foreignKey' => 'cms_content_id',
        ]);
    }
}