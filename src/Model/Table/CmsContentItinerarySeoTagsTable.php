<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CmsContentItinerarySeoTagsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cms_content_itinerary_seo_tags');
       
    }
}

?>