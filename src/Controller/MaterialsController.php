<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Materials Controller
 *
 * @property \App\Model\Table\MaterialsTable $Materials
 */
class MaterialsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('materials', $this->paginate($this->Materials));
        $this->set('_serialize', ['materials']);
    }

    /**
     * View method
     *
     * @param string|null $id Material id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => ['Products']
        ]);
        $this->set('material', $material);
        $this->set('_serialize', ['material']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $material = $this->Materials->newEntity();
        if ($this->request->is('post')) {
            $material = $this->Materials->patchEntity($material, $this->request->data);
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The material could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('material'));
        $this->set('_serialize', ['material']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Material id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $material = $this->Materials->patchEntity($material, $this->request->data);
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The material could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('material'));
        $this->set('_serialize', ['material']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Material id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $material = $this->Materials->get($id);
        if ($this->Materials->delete($material)) {
            $this->Flash->success(__('The material has been deleted.'));
        } else {
            $this->Flash->error(__('The material could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
{
    
        return true;
 
}
}
