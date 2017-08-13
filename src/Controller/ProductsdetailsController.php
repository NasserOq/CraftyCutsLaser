<?php
namespace App\Controller;

use App\Controller\AppController;
/**
 * Productsdetails Controller
 *
 * @property \App\Model\Table\ProductsdetailsTable $Productsdetails
 */
class ProductsdetailsController extends AppController

    {
    /**
     * Index method
     *
     * @return void
     */
    public

    function index()
        {
        $this->paginate = ['contain' => ['Products', 'Colors', 'Sizes', 'Materials', 'Finishes']];
        $this->set('productsdetails', $this->paginate($this->Productsdetails));
        $this->set('_serialize', ['productsdetails']);
        }

    /**
     * View method
     *
     * @param string|null $id Productsdetail id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public

    function view($id = null)
        {
        $productsdetail = $this->Productsdetails->get($id, ['contain' => ['Products', 'Colors', 'Sizes', 'Materials', 'Finishes']]);
        $this->set('productsdetail', $productsdetail);
        $this->set('_serialize', ['productsdetail']);
        $this->set('_serialize', ['colors']);
        }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
     public function add()
    {
      
       
        //store all the possible product details in to the system
        if ($this->request->is('post')) {
          
            //store all the avaliable colors
            for ($i = 0; $i< count($this->request->data['color_ids']); $i++){
             
                for ($a = 0; $a< count($this->request->data['size_ids']); $a++){  
                 //store all the avaliable finishes
                 for ($c = 0; $c< count($this->request->data['finish_ids']); $c++){
                     $productsdetail = $this->Productsdetails->newEntity();
                     $productsdetails = $this->Productsdetails->patchEntity($productsdetail, $this->request->data);
             
                     $productsdetail['material_id'] = $productsdetail['material_id'];
                     $productsdetail['color_id'] = $productsdetail['color_ids'][$i];

                            if ($productsdetail['color_id'] == 0)
                                {
                               
                if( $i < (count($this->request->data['color_ids'])-1)){  $i++; 
                                 $productsdetail['color_id'] = $productsdetail['color_ids'][$i]; 
                             }
                                else{break;}
                                 //debug($productsdetail['color_id']);
                                 $productsdetail['size_id'] = $productsdetail['size_ids'][$a];
                                }else
                                {
                                $productsdetail['size_id'] = $productsdetail['size_ids'][$a];
                                }

                            if ($productsdetail['size_id'] == 0)
                                {
                            if( $a < (count($this->request->data['size_ids'])-1)){
                                    $a++; 
                                    $productsdetail['size_id'] = $productsdetail['size_ids'][$a]; }
                                else{

                                break;}
                                }

                                $productsdetail['finish_id'] = $productsdetail['finish_ids'][$c];
                                

                                if ($productsdetail['finish_id'] == Null)
                                {
                          
                                 if( $c < (count($this->request->data['finish_id'])-1)){
                                    $c++; 
                                    $productsdetail['finish_id'] = $productsdetail['finish_id'][$c]; }
                                    else{break;}
                               

                                 
                                }              
             //calculate price for each combination products
                    $productsdetail['price']= $productsdetail['price'];
                                //color
                    $colorprice= $this->Productsdetails->colors->find('all')->where (['colors.id'=> $productsdetail['color_id']]);
                    $colorprice=$colorprice->toArray()[0]['Extra_price'];
                    $productsdetail['price']= $productsdetail['price'] + $colorprice;
                   
                    //size
                    $sizeprice= $this->Productsdetails->sizes->find('all')->where (['sizes.id'=> $productsdetail['size_id']]);
                    $sizeprice=$sizeprice->toArray()[0]['Extra_price'];
                    $productsdetail['price']= $productsdetail['price'] + $sizeprice;
                    // debug($productsdetail['price']);
                    //finish
                    $finishprice= $this->Productsdetails->Finishes->find('all')->where (['Finishes.id'=> $productsdetail['finish_id']]);
                    $finishprice=$finishprice->toArray()[0]['Extra_price'];
                    $productsdetail['price']= $productsdetail['price'] + $finishprice;
                    

              if ($this->Productsdetails->save($productsdetail)) {
               // debug($productsdetail);
                
                $this->Flash->success(__('The productsdetail has been saved.'));
       
               // return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The productsdetail could not be saved. Please, try again.'));
            }
            
           }
       }
   
            } 
         
           
        }


        $products = $this->Productsdetails->Products->find('list',['keyField' => 'id', 'valueField' => 'productName', 'order' => ['products.id' => 'asc']]);
        $products = $products->toArray();
        $colors = $this->Productsdetails->Colors->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['colors.id' => 'asc']]);
        $colors = $colors->toArray();
        $sizes = $this->Productsdetails->Sizes->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['sizes.id' => 'asc']]);
        $sizes = $sizes->toArray();
        $materials = $this->Productsdetails->Materials->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['materials.id' => 'asc']]);
        $materials = $materials->toArray();
        $finishes = $this->Productsdetails->Finishes->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['finishes.id' => 'asc']]);
        $finishes = $finishes->toArray();
       $this->set(compact('productsdetail', 'products', 'colors', 'sizes', 'materials', 'finishes'));
        $this->set('_serialize', ['productsdetail']);
        $this->set('_serialize', ['colors']);
}

    /**
     * Edit method
     *
     * @param string|null $id Productsdetail id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public

    function edit($id = null)
        {
        $productsdetail = $this->Productsdetails->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put']))
            {
            $productsdetail = $this->Productsdetails->patchEntity($productsdetail, $this->request->data);
            if ($this->Productsdetails->save($productsdetail))
                {
                $this->Flash->success(__('The productsdetail has been saved.'));
                return $this->redirect(['action' => 'index']);
                }
              else
                {
                $this->Flash->error(__('The productsdetail could not be saved. Please, try again.'));
                }
            }

        $products = $this->Productsdetails->Products->find('list', ['limit' => 200]);
        $colors = $this->Productsdetails->Colors->find('list', ['limit' => 200]);
        $sizes = $this->Productsdetails->Sizes->find('list', ['limit' => 200]);
        $materials = $this->Productsdetails->Materials->find('list', ['limit' => 200]);
        $finishes = $this->Productsdetails->Finishes->find('list', ['limit' => 200]);
        $this->set(compact('productsdetail', 'products', 'colors', 'sizes', 'materials', 'finishes'));
        $this->set('_serialize', ['productsdetail']);
        }

    /**
     * Delete method
     *
     * @param string|null $id Productsdetail id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public

    function delete($id = null)
        {
        $this->request->allowMethod(['post', 'delete']);
        $productsdetail = $this->Productsdetails->get($id);
        if ($this->Productsdetails->delete($productsdetail))
            {
            $this->Flash->success(__('The productsdetail has been deleted.'));
            }
          else
            {
            $this->Flash->error(__('The productsdetail could not be deleted. Please, try again.'));
            }

        return $this->redirect(['action' => 'index']);
        }

    public

    function isAuthorized($user)
        {
        return true;
        }
    }