<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cartproducts Controller
 *
 * @property \App\Model\Table\CartproductsTable $Cartproducts
 */
class CartproductsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Shoppingcarts', 'Products']
        ];
        $this->set('cartproducts', $this->paginate($this->Cartproducts));
        $this->set('_serialize', ['cartproducts']);
    }

    /**
     * View method
     *
     * @param string|null $id Cartproduct id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
	

    public function view($id = null)
    {
        $cartproduct = $this->Cartproducts->get($id, [
            'contain' => ['Shoppingcarts', 'Products']
        ]);
        $this->set('cartproduct', $cartproduct);
        $this->set('_serialize', ['cartproduct']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cartproduct = $this->Cartproducts->newEntity();
        if ($this->request->is('post')) {
            $cartproduct = $this->Cartproducts->patchEntity($cartproduct, $this->request->data);
            if ($this->Cartproducts->save($cartproduct)) {
                $this->Flash->success(__('The cartproduct has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cartproduct could not be saved. Please, try again.'));
            }
        }
        $shoppingcarts = $this->Cartproducts->Shoppingcarts->find('list', ['limit' => 200]);
        $products = $this->Cartproducts->Products->find('list', ['limit' => 200]);
        $this->set(compact('cartproduct', 'shoppingcarts', 'products'));
        $this->set('_serialize', ['cartproduct']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cartproduct id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cartproduct = $this->Cartproducts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cartproduct = $this->Cartproducts->patchEntity($cartproduct, $this->request->data);
            if ($this->Cartproducts->save($cartproduct)) {
                $this->Flash->success(__('The cartproduct has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cartproduct could not be saved. Please, try again.'));
            }
        }
        $shoppingcarts = $this->Cartproducts->Shoppingcarts->find('list', ['limit' => 200]);
        $products = $this->Cartproducts->Products->find('list', ['limit' => 200]);
        $this->set(compact('cartproduct', 'shoppingcarts', 'products'));
        $this->set('_serialize', ['cartproduct']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cartproduct id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cartproduct = $this->Cartproducts->get($id);
        if ($this->Cartproducts->delete($cartproduct)) {
            $this->Flash->success(__('The cartproduct has been deleted.'));
        } else {
            $this->Flash->error(__('The cartproduct could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

      public function isAuthorized($user)
{
    
        return true;
 
}
}
