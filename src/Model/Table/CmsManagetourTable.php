<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CmsManagetourTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('cms_managetour');
		$this->hasOne('TblsTourPages', [
            'foreignKey' => 'id',
            'className' => 'TblsTourPages',
        ]);
    }
}
