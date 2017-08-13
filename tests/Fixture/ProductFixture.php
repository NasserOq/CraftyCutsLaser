<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductFixture
 *
 */
class ProductFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'product';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'product_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'color_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'size_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'material_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'price' => ['type' => 'string', 'length' => 9, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'tax_amount' => ['type' => 'string', 'length' => 9, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'image_url' => ['type' => 'binary', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'color_id_fk' => ['type' => 'index', 'columns' => ['color_id'], 'length' => []],
            'material_id_fk' => ['type' => 'index', 'columns' => ['material_id'], 'length' => []],
            'Size_id_fk' => ['type' => 'index', 'columns' => ['size_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['product_id'], 'length' => []],
            'product_ibfk_1' => ['type' => 'foreign', 'columns' => ['color_id'], 'references' => ['color', 'color_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'product_ibfk_2' => ['type' => 'foreign', 'columns' => ['material_id'], 'references' => ['material', 'material_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'product_ibfk_3' => ['type' => 'foreign', 'columns' => ['size_id'], 'references' => ['size', 'size_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'product_id' => 1,
            'color_id' => 1,
            'size_id' => 1,
            'material_id' => 1,
            'price' => 'Lorem i',
            'tax_amount' => 'Lorem i',
            'image_url' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
