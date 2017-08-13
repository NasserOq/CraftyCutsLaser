<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Productsimages Controller
 *
 * @property \App\Model\Table\ProductsimagesTable $Productsimages
 */
class ProductsimagesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products']
        ];
        $this->set('productsimages', $this->paginate($this->Productsimages));
        $this->set('_serialize', ['productsimages']);
    }

    /**
     * View method
     *
     * @param string|null $id Productsimage id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productsimage = $this->Productsimages->get($id, [
            'contain' => ['Products']
        ]);
        $this->set('productsimage', $productsimage);
        $this->set('_serialize', ['productsimage']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productsimage = $this->Productsimages->newEntity();
        if ($this->request->is('post')) {
            $productsimage = $this->Productsimages->patchEntity($productsimage, $this->request->data);
            $file = $this->request->data['image_url']; //put the data into a var
         
             $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
               $arr_ext = array('jpg', 'jpeg', 'gif','JPG','png'); //set allowed extensions
                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext)){
                            debug('123');
                                //upload file and move to img/uploads/itemsImages
                            move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/productsimages/' . $file['name']);
                    //prepare the filename for database entry
                            $productsimage['image_url'] = 'productsimages/' . $file['name'];

                              if ($this->Productsimages->save($productsimage)) {
                $this->Flash->success(__('The productsimage has been saved.'));
              return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The productsimage could not be saved. Please, try again.'));
            }

                        }
                        else{
                            echo $this->Flash->Error('The image could not be saved');
                        }
          
        }
        $products = $this->Productsimages->Products->find('list',['keyField' => 'id', 'valueField' => 'productName', 'order' => ['products.id' => 'asc']]);
        $this->set(compact('productsimage', 'products'));
        $this->set('_serialize', ['productsimage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Productsimage id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productsimage = $this->Productsimages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productsimage = $this->Productsimages->patchEntity($productsimage, $this->request->data);
            if ($this->Productsimages->save($productsimage)) {
                $this->Flash->success(__('The productsimage has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The productsimage could not be saved. Please, try again.'));
            }
        }
        $products = $this->Productsimages->Products->find('list', ['limit' => 200]);
        $this->set(compact('productsimage', 'products'));
        $this->set('_serialize', ['productsimage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Productsimage id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productsimage = $this->Productsimages->get($id);
        if ($this->Productsimages->delete($productsimage)) {
            $this->Flash->success(__('The productsimage has been deleted.'));
        } else {
            $this->Flash->error(__('The productsimage could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

      public function isAuthorized($user)
{
    
        return true;
 
}
}
