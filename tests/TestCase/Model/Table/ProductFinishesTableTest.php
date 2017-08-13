<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductFinishesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductFinishesTable Test Case
 */
class ProductFinishesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product_finishes',
        'app.products',
        'app.colors',
        'app.sizes',
        'app.materials',
        'app.finishes',
        'app.cartproducts',
        'app.shoppingcarts',
        'app.orderdetails',
        'app.orders',
        'app.productsimages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProductFinishes') ? [] : ['className' => 'App\Model\Table\ProductFinishesTable'];
        $this->ProductFinishes = TableRegistry::get('ProductFinishes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductFinishes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
