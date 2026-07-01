<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CmsContentVideosTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cms_content_videos'); // DB table name
        $this->setPrimaryKey('id');

        $this->belongsTo('CmsContents', [
            'foreignKey' => 'cms_content_id',
        ]);
    }
}