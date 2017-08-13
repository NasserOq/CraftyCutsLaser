<?php
namespace App\Model\Table;

use App\Model\Entity\Productsdetail;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Productsdetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Products
 * @property \Cake\ORM\Association\BelongsTo $Colors
 * @property \Cake\ORM\Association\BelongsTo $Sizes
 * @property \Cake\ORM\Association\BelongsTo $Materials
 * @property \Cake\ORM\Association\BelongsTo $Finishes
 */
class ProductsdetailsTable extends Table
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

        $this->table('productsdetails');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Colors', [
            'foreignKey' => 'color_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Sizes', [
            'foreignKey' => 'size_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Finishes', [
            'foreignKey' => 'finish_id',
            'joinType' => 'INNER'
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
            ->add('price', [
        'maxLength' => [
            'rule' => ['maxLength', 2],
            'message' => 'price should lower than 100'
        ]])
            ->requirePresence('price', ['rule' => 'numeric'])
            ->requirePresence('price', 'You can no leave this blank')
            ->notEmpty('price');

  
        $validator
            ->add('quantity', [
        'minLength' => [
            'rule' => ['minLength', 1],
            'message' => 'please enter the quantity number'
        ],
        'maxLength' => [
            'rule' => ['maxLength', 4],
            'message' => 'Quantity is incorrect, please tey again'
        ]])
            ->add('quantity', 'valid', ['rule' => 'numeric',])
            ->requirePresence('quantity', 'You have to enter a valid numer,please try again')
            ->notEmpty('quantity');

       
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->existsIn(['color_id'], 'Colors'));
        $rules->add($rules->existsIn(['size_id'], 'Sizes'));
        $rules->add($rules->existsIn(['material_id'], 'Materials'));
        $rules->add($rules->existsIn(['finish_id'], 'Finishes'));
        return $rules;
    }
}
