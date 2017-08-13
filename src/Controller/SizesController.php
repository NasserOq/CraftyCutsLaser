<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sizes Controller
 *
 * @property \App\Model\Table\SizesTable $Sizes
 */
class SizesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('sizes', $this->paginate($this->Sizes));
        $this->set('_serialize', ['sizes']);
    }

    /**
     * View method
     *
     * @param string|null $id Size id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $size = $this->Sizes->get($id, [
            'contain' => ['Products']
        ]);
        $this->set('size', $size);
        $this->set('_serialize', ['size']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $size = $this->Sizes->newEntity();
        if ($this->request->is('post')) {
            $size = $this->Sizes->patchEntity($size, $this->request->data);
            if ($this->Sizes->save($size)) {
                $this->Flash->success(__('The size has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The size could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('size'));
        $this->set('_serialize', ['size']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Size id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $size = $this->Sizes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $size = $this->Sizes->patchEntity($size, $this->request->data);
            if ($this->Sizes->save($size)) {
                $this->Flash->success(__('The size has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The size could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('size'));
        $this->set('_serialize', ['size']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Size id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $size = $this->Sizes->get($id);
        if ($this->Sizes->delete($size)) {
            $this->Flash->success(__('The size has been deleted.'));
        } else {
            $this->Flash->error(__('The size could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
{
    
        return true;
 
}
}
