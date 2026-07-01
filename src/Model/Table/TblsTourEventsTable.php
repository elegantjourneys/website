<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TblsTourEventsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('tbls_tour_events');
		
		
		
		$this->belongsTo('TblsSubregion', [
			'foreignKey' => 'subregion_id',
			'joinType' => 'INNER',
		]);
				
		 
    }
}
