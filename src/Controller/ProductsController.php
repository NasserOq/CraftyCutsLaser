<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use cake\libs\model\model;
use Cake\Controller\Component\PaginatorComponent;
use Cake\Database\Expression\QueryExpression;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

   
        $this->set('products', $this->paginate($this->Products));
        $this->set('_serialize', ['products']);
    }
    

    public function displayproducts()

    {
      $Details = TableRegistry::get('Productsdetails'); 
      $prices = $Details->find()->all();
      $prices=$prices->toArray();

      $images = TableRegistry::get('Productsimages'); 
      $pictures = $images->find()->all();
      $pictures=$pictures->toArray();

      $query = $this->Products->find('all')->where(['status' => 'Active']);
      $this->set('products', $this->paginate($query));
        $this->set('_serialize', ['products']);
        $this->set(compact('prices','pictures'));


    }


     public function active($id = null)
    {
         $this->autoRender = false;
        $product = $this->Products->get($id, [
            'contain' => []
        ]);

        $product->set('status', 'Active' );
        if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been actived.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
       
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }

    public function hide($id = null)
    {
         $this->autoRender = false;
        $product = $this->Products->get($id, [
            'contain' => []
        ]);

        $product->set('status', 'InActive' );
        if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has hide from view.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be change. Please, try again.'));
            }
       
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }
    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Cartproducts', 'Orderdetails', 'Productsdetails', 'Productsimages']
        ]);
       $Details = TableRegistry::get('Productsdetails');
      
        $coloroptions = $Details->find("all")
                       ->where (['productsdetails.product_id'=> $id])
                       ->contain (['Colors'])
                        ->group (['color_id']);
                 
        $sizeoptions = $Details->find("all")
                       ->where (['productsdetails.product_id'=> $id])
                       ->contain (['Sizes'])
                        ->group (['size_id']);
                   
       $materialoptions = $Details->find("all")
                       ->where (['productsdetails.product_id'=> $id])
                       ->contain (['Materials'])
                        ->group (['material_id']);
      
       $finishoptions = $Details->find("all")
                       ->where (['productsdetails.product_id'=> $id])
                       ->contain (['Finishes'])
                        ->group (['finish_id']);

       $price = $Details->find('all')->where (['productsdetails.product_id'=> $id]);

       $price=$price->all();
                $price = $price->first();
                $priceinitial = $price['price'];



        $this->set('product', $product);
        $this->set('_serialize', ['product']);
        $this->set(compact('Details'));
        $this->set(compact('coloroptions'));
        $this->set(compact('sizeoptions'));
        $this->set(compact('materialoptions'));
        $this->set(compact('finishoptions','price','priceinitial'));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
   public function add()
    { $Productsdetails = TableRegistry::get('Productsdetails');
      $Productsimages = TableRegistry::get('Productsimages');
        $product = $this->Products->newEntity();

        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            
              // debug($product);
            if ($this->Products->save($product)) {
                //get the last produu=ct id prepare to store product details
                $productlist = $this->Products->find('all')->all();
                $lastproduct = $productlist->last();
                $lastproductid = $lastproduct['id'];
            //start to insert product details into the product details table
               if ($product['material_id']=='6'||$product['material_id']=='7'||$product['material_id']=='8'){ 
               for ($c = 0; $c< count($this->request->data['finish_id']); $c++){
                 $productsdetail = $Productsdetails->newEntity();
                 $productsdetails = $Productsdetails->patchEntity($productsdetail, $this->request->data);
                  $productsdetail['product_id']= (int)$lastproductid;
                  $productsdetail['finish_id'] = $product['finish_id'][$c];
                  //debug($productsdetail['finish_id']);
                  $productsdetail['price']=$product['price'];
                  $productsdetail['quantity']=$product['quantity'];
                  //calculate price for each combination products
                    $productsdetail['price']= $product['price'];
                     $finishprice= $this->Products->Productsdetails->Finishes->find('all')->where (['Finishes.id'=> $productsdetail['finish_id']]);
                    $finishprice=$finishprice->toArray()[0]['Extra_price'];
                    $productsdetail['price']= $productsdetail['price'] + $finishprice;
                    
                 // debug($productsdetail);
             //store each record one by one into the table
             if ($this->Products->Productsdetails->save($productsdetails)) {
                $this->Flash->success(__('The productsdetail has been saved.'));
       
               // return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The productsdetail could not be saved. Please, try again.'));
            } }
             } else{

              for ($i = 0; $i< count($this->request->data['color_ids']); $i++){
             
                for ($a = 0; $a< count($this->request->data['size_ids']); $a++){  
                 //store all the avaliable finishes
                 for ($c = 0; $c< count($this->request->data['finish_id']); $c++){
                     $productsdetail = $Productsdetails->newEntity();
                     $productsdetails = $Productsdetails->patchEntity($productsdetail, $this->request->data);
                 
                     $productsdetail['product_id']= (int)$lastproductid;
                     $productsdetail['color_id'] = $product['color_ids'][$i];

                            if ($productsdetail['color_id'] == 0)
                                {
                               
                if( $i < (count($this->request->data['color_ids'])-1)){  $i++; 
                                 $productsdetail['color_id'] = $product['color_ids'][$i]; 
                             }
                                else{break;}
                                 //debug($productsdetail['color_id']);
                                 $productsdetail['size_id'] = $product['size_ids'][$a];
                                }else
                                {
                                $productsdetail['size_id'] = $product['size_ids'][$a];
                                }

                            if ($productsdetail['size_id'] == 0)
                                {
                            if( $a < (count($this->request->data['size_ids'])-1)){
                                    $a++; 
                                    $productsdetail['size_id'] = $product['size_ids'][$a]; }
                                else{

                                break;}
                                }

                                $productsdetail['finish_id'] = $product['finish_id'][$c];
                                

                                if ($productsdetail['finish_id'] == Null)
                                {
                          
                                 if( $c < (count($this->request->data['finish_id'])-1)){
                                    $c++; 
                                    $productsdetail['finish_id'] = $product['finish_id'][$c]; }
                                    else{break;}
                               

                                 
                                }
                //calculate price for each combination products
                    $productsdetail['price']= $product['price'];
                                //color
                    $colorprice= $this->Products->Productsdetails->colors->find('all')->where (['colors.id'=> $productsdetail['color_id']]);
                    $colorprice=$colorprice->toArray()[0]['Extra_price'];
                    $productsdetail['price']= $productsdetail['price'] + $colorprice;
                   
                    //size
                    $sizeprice= $this->Products->Productsdetails->sizes->find('all')->where (['sizes.id'=> $productsdetail['size_id']]);
                    $sizeprice=$sizeprice->toArray()[0]['Extra_price'];
                    $productsdetail['price']= $productsdetail['price'] + $sizeprice;
                    // debug($productsdetail['price']);
                    //finish
                    $finishprice= $this->Products->Productsdetails->Finishes->find('all')->where (['Finishes.id'=> $productsdetail['finish_id']]);
                    $finishprice=$finishprice->toArray()[0]['Extra_price'];
                    $productsdetail['price']= $productsdetail['price'] + $finishprice;
                    



                    
          
              if ($this->Products->Productsdetails->save($productsdetail)) {
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
               
              //insert image   
            $productsimage = $Productsimages->newEntity();
        
            $productsimage = $Productsimages->patchEntity($productsimage, $this->request->data);
            $productsimage['product_id'] = $lastproductid;
            $file = $product['image_url']; //put the data into a var
            debug($file);
             $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
               $arr_ext = array('jpg', 'jpeg', 'gif','JPG','png'); //set allowed extensions
                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext)){
                                //upload file and move to img/uploads/itemsImages
                            move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/productsimages/' . $file['name']);
                              //prepare the filename for database entry
                            $productsimage['image_url'] = 'productsimages/' . $file['name'];
                            if ($this->Products->Productsimages->save($productsimage)) {
                                $this->Flash->success(__('The productsimage has been saved.'));
              
                                } else {
                               $this->Flash->error(__('The productsimage could not be saved. Please, try again.'));
                               $product = $this->Products->get($lastproductid);
                             $this->Products->delete($product);
                             return $this->redirect(['action' => 'add']);
                                  }
                        }
                        else{
                            echo $this->Flash->Error('The image could not be saved. You can reupload it via the viewing the Item.');
                            $product = $this->Products->get($lastproductid);
                             $this->Products->delete($product);
                             return $this->redirect(['action' => 'add']);
                        }
            
        

                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));

            } 
        
}


        $colors = $this->Products->Productsdetails->Colors->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['colors.id' => 'asc']]);
        $colors = $colors->toArray();
        $sizes = $this->Products->Productsdetails->Sizes->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['sizes.id' => 'asc']]);
        $sizes = $sizes->toArray();
        $materials = $this->Products->Productsdetails->Materials->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['materials.id' => 'asc']]);
        $materials = $materials->toArray();
        $finishes = $this->Products->Productsdetails->Finishes->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['finishes.id' => 'asc']]);
        $finishes = $finishes->toArray(); 
        $this->set(compact('productsdetails', 'colors', 'sizes', 'materials', 'finishes','colorprice'));
        $this->set('_serialize', ['productsdetail']);
        $this->set('_serialize', ['colors']);      
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
        $this->set('_serialize', ['colorprice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */


    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);

        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function isAuthorized($user)
{
    
        return true;
 
}
//give guest authorise to access the product details
public function beforeFilter(\Cake\Event\Event $event)
{
    $this->Auth->allow(['view','displayproducts']);

   
}

}


