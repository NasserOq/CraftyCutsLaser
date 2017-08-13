<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductSizesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductSizesTable Test Case
 */
class ProductSizesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product_sizes',
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
        $config = TableRegistry::exists('ProductSizes') ? [] : ['className' => 'App\Model\Table\ProductSizesTable'];
        $this->ProductSizes = TableRegistry::get('ProductSizes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductSizes);

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
