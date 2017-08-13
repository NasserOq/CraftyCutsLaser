<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsdetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsdetailsTable Test Case
 */
class ProductsdetailsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.productsdetails',
        'app.products',
        'app.cartproducts',
        'app.shoppingcarts',
        'app.orderdetails',
        'app.orders',
        'app.productsimages',
        'app.colors',
        'app.product_colors',
        'app.sizes',
        'app.materials',
        'app.finishes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Productsdetails') ? [] : ['className' => 'App\Model\Table\ProductsdetailsTable'];
        $this->Productsdetails = TableRegistry::get('Productsdetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Productsdetails);

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
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
