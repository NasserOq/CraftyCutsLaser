<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Colors Controller
 *
 * @property \App\Model\Table\ColorsTable $Colors
 */
class ColorsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('colors', $this->paginate($this->Colors));
        $this->set('_serialize', ['colors']);
    }

    /**
     * View method
     *
     * @param string|null $id Color id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $color = $this->Colors->get($id, [
            'contain' => ['Products']
        ]);
        $this->set('color', $color);
        $this->set('_serialize', ['color']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $color = $this->Colors->newEntity();
        if ($this->request->is('post')) {
            $color = $this->Colors->patchEntity($color, $this->request->data);
            if ($this->Colors->save($color)) {
                $this->Flash->success(__('The color has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The color could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('color'));
        $this->set('_serialize', ['color']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Color id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $color = $this->Colors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $color = $this->Colors->patchEntity($color, $this->request->data);
            if ($this->Colors->save($color)) {
                $this->Flash->success(__('The color has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The color could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('color'));
        $this->set('_serialize', ['color']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Color id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $color = $this->Colors->get($id);
        if ($this->Colors->delete($color)) {
            $this->Flash->success(__('The color has been deleted.'));
        } else {
            $this->Flash->error(__('The color could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user)
{
    
        return true;
 
}
}
