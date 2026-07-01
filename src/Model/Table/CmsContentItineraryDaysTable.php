<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CmsContentItineraryDaysTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cms_content_itinerary_days');
        $this->setPrimaryKey('id');

        $this->belongsTo('CmsContentItineraries', [
            'foreignKey' => 'cms_content_itinerary_id',
        ]);

        $this->hasMany('CmsContentItineraryDescriptions', [
            'foreignKey' => 'cms_content_itinerary_day_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }
}