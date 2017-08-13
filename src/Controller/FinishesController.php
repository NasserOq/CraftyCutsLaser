<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Finishes Controller
 *
 * @property \App\Model\Table\FinishesTable $Finishes
 */
class FinishesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('finishes', $this->paginate($this->Finishes));
        $this->set('_serialize', ['finishes']);
    }

    /**
     * View method
     *
     * @param string|null $id Finish id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $finish = $this->Finishes->get($id, [
            'contain' => ['Products']
        ]);
        $this->set('finish', $finish);
        $this->set('_serialize', ['finish']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $finish = $this->Finishes->newEntity();
        if ($this->request->is('post')) {
            $finish = $this->Finishes->patchEntity($finish, $this->request->data);
            if ($this->Finishes->save($finish)) {
                $this->Flash->success(__('The finish has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The finish could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('finish'));
        $this->set('_serialize', ['finish']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Finish id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $finish = $this->Finishes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $finish = $this->Finishes->patchEntity($finish, $this->request->data);
            if ($this->Finishes->save($finish)) {
                $this->Flash->success(__('The finish has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The finish could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('finish'));
        $this->set('_serialize', ['finish']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Finish id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $finish = $this->Finishes->get($id);
        if ($this->Finishes->delete($finish)) {
            $this->Flash->success(__('The finish has been deleted.'));
        } else {
            $this->Flash->error(__('The finish could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user)
{
    
        return true;
 
}
}
