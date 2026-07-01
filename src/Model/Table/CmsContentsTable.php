<?php
    declare(strict_types=1);

    namespace App\Model\Table;

    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    class CmsContentsTable extends Table
    {
        public function initialize(array $config): void
        {
            parent::initialize($config);
            $this->setTable('cms_contents');
          
          $this->hasMany('CmsContentItineraries', [
            'foreignKey' => 'cms_content_id',
        ]);
          
            $this->hasMany('CmsContentDescriptions', [
                'foreignKey' => 'cms_content_id',
            ]);
        }
        
    }