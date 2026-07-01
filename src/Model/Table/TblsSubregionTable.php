<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TblsSubregionTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('tbls_subregion');
		
		$this->hasOne('TblTourCategory', [
            'foreignKey' => 'tour_page_id',
            'className' => 'TblTourCategory',
        ]);
		
		 
    }
}
