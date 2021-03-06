<?php
namespace App\Model\Table;

use App\Model\Entity\Finish;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Finishes Model
 *
 * @property \Cake\ORM\Association\HasMany $Productsdetails
 */
class FinishesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('finishes');
        $this->displayField('description');
        $this->primaryKey('id');

        $this->hasMany('Productsdetails', [
            'foreignKey' => 'finish_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->add('Extra_price', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('Extra_price');

        return $validator;
    }
}
