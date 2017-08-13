<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductMaterialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductMaterialsTable Test Case
 */
class ProductMaterialsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product_materials',
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
        $config = TableRegistry::exists('ProductMaterials') ? [] : ['className' => 'App\Model\Table\ProductMaterialsTable'];
        $this->ProductMaterials = TableRegistry::get('ProductMaterials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductMaterials);

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
