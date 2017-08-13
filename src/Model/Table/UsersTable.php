<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {    //id is numeric always
           $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email','Please type in your email address');
         //password validation 
        $validator
            ->add('password', [
        'minLength' => [
            'rule' => ['minLength', 8],
            'message' => 'Password must more than 8 digits'
        ],
        'maxLength' => [
            'rule' => ['maxLength', 16],
            'message' => 'Password should less than 16 digits'
        ]])
            ->notEmpty('password','Oops, you forgot to set a password!');
      //id should not be shown in the registration page
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

            
        //confirm password
        $validator
            ->add('Confirm_password', 'compareWith',[
        'rule' => ['compareWith', 'password'],
        'message' => 'Passwords are not equal',
    ])
            ->notEmpty('Confirm_password', 'Please type your password again');
        // fist name can not be a number or symbol except ''
        $validator
            ->requirePresence('First_Name', 'create')
            ->notEmpty('First_Name','Please type your First Name');
    
        $validator
            ->add('First_Name','validFormat',[
                'rule'=>array('custom','/^[a-z ,.\'-]+$/i'),
                'message' => 'Please enter a valid First Name'
                ]);
         // fist name can not be a number or symbol except ''
        $validator
            ->requirePresence('Last_Name', 'create')
            ->notEmpty('Last_Name','Please type your Last name');
        
        $validator
            ->add('Last_Name','validFormat',[
                'rule'=>array('custom','/^[a-z ,.\'-]+$/i'),
                'message' => 'Please enter a valid last Name'
                ]);
         // address can not be empty ''
        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address','Please type your address');
         // phone number can only be numeric
        $validator
            ->add('phone', 'create', ['rule' => 'numeric','message'=>'Phone number must be a numeric number'])
            ->notEmpty('phone','Please type your phone number');
        // phone number can only be numeric
        $validator
            ->add('post_code', 'create', ['rule' => 'numeric', 'message'=>'Postcode must be a numeric number'])
            ->notEmpty('post_code','Pliease type in your post code');
        // validate new password when changning password
            $validator
            ->add('New_password', [
        'minLength' => [
            'rule' => ['minLength', 8],
            'message' => 'Password must more than 8 digits'
        ],
        'maxLength' => [
            'rule' => ['maxLength', 16],
            'message' => 'Password should less than 16 digits'
        ]])
            ->notEmpty('New_password','Oops, you forgot to set a password!');
     //confirm your new password
        $validator
        ->notEmpty('Confirm_your_new_password', 'Please type your password again')
        ->add('Confirm_your_new_password', 'compareWith',[
        'rule' => ['compareWith', 'New_password'],
        'message' => 'Passwords are not equal', ]);

        

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
        $rules->add($rules->isUnique(['email']));
 
        return $rules;
    }
   

}
