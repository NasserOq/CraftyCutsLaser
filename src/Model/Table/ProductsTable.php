<?php
namespace App\Model\Table;

use App\Model\Entity\Product;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \Cake\ORM\Association\HasMany $Cartproducts
 * @property \Cake\ORM\Association\HasMany $Orderdetails
 * @property \Cake\ORM\Association\HasMany $Productsdetails
 * @property \Cake\ORM\Association\HasMany $Productsimages
 */
class ProductsTable extends Table
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

        $this->table('products');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Cartproducts', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Orderdetails', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Productsdetails', [
            'dependent' => true,
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Productsimages', [
            'dependent' => true,
            'foreignKey' => 'product_id'
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
            ->requirePresence('productName', 'This field cannot be left empty')
            ->notEmpty('productName');

        $validator
            ->requirePresence('status', 'This field cannot be left empty')
            ->notEmpty('status');

        $validator
            ->requirePresence('Description', 'This field cannot be left empty')
            ->notEmpty('Description');

       

        $validator
            ->requirePresence('image_url', 'create')
            ->notEmpty('image_url');

        $validator
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
}
