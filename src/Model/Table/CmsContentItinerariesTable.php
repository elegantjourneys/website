<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CmsContentItinerariesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cms_content_itineraries');
        $this->setPrimaryKey('id');

        $this->belongsTo('CmsContents', [
            'foreignKey' => 'cms_content_id',
        ]);

        $this->hasMany('CmsContentItineraryDays', [
            'foreignKey' => 'cms_content_itinerary_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }
}