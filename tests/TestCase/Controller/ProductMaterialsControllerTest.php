<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProductMaterialsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProductMaterialsController Test Case
 */
class ProductMaterialsControllerTest extends IntegrationTestCase
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
