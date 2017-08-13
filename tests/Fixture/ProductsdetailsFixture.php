<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsdetailsFixture
 *
 */
class ProductsdetailsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'product_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'color_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'size_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'material_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'finish_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'price' => ['type' => 'string', 'length' => 9, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'quantity' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'MaxOrder' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tax_amount' => ['type' => 'string', 'length' => 9, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'product_id_fk' => ['type' => 'index', 'columns' => ['product_id'], 'length' => []],
            'color_id_fk' => ['type' => 'index', 'columns' => ['color_id'], 'length' => []],
            'finishes_id_fk' => ['type' => 'index', 'columns' => ['finish_id'], 'length' => []],
            'material_id_fk' => ['type' => 'index', 'columns' => ['material_id'], 'length' => []],
            'Size_id_fk' => ['type' => 'index', 'columns' => ['size_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'productsdetails_ibfk_1' => ['type' => 'foreign', 'columns' => ['product_id'], 'references' => ['products', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'productsdetails_ibfk_2' => ['type' => 'foreign', 'columns' => ['color_id'], 'references' => ['colors', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'productsdetails_ibfk_3' => ['type' => 'foreign', 'columns' => ['finish_id'], 'references' => ['finishes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'productsdetails_ibfk_4' => ['type' => 'foreign', 'columns' => ['material_id'], 'references' => ['materials', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'productsdetails_ibfk_5' => ['type' => 'foreign', 'columns' => ['size_id'], 'references' => ['sizes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'product_id' => 1,
            'color_id' => 1,
            'size_id' => 1,
            'material_id' => 1,
            'finish_id' => 1,
            'price' => 'Lorem i',
            'quantity' => 1,
            'MaxOrder' => 1,
            'tax_amount' => 'Lorem i'
        ],
    ];
}
