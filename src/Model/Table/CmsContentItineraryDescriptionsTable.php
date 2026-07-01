<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CmsContentItineraryDescriptionsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cms_content_itinerary_descriptions');
        $this->setPrimaryKey('id');

        $this->belongsTo('CmsContentItineraryDays', [
            'foreignKey' => 'cms_content_itinerary_day_id',
        ]);

        $this->belongsTo('CmsContents', [
            'foreignKey' => 'cms_content_id',
        ]);
    }
}