<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlogSeoTags Model
 *
 * @property \Admin\Model\Table\BlogsTable&\Cake\ORM\Association\BelongsTo $Blogs
 *
 * @method \Admin\Model\Entity\BlogSeoTag newEmptyEntity()
 * @method \Admin\Model\Entity\BlogSeoTag newEntity(array $data, array $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Admin\Model\Entity\BlogSeoTag[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BlogSeoTagsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('blog_seo_tags');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Blogs', [
            'foreignKey' => 'blog_id',
            'className' => 'Blogs',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('blog_id')
            ->allowEmptyString('blog_id');

        $validator
            ->scalar('meta_title')
            ->maxLength('meta_title', 200)
            ->allowEmptyString('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->allowEmptyString('meta_keyword');

        $validator
            ->scalar('meta_description')
            ->allowEmptyString('meta_description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('blog_id', 'Blogs'), ['errorField' => 'blog_id']);

        return $rules;
    }
}
