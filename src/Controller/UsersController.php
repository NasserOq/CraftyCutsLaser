<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Tools\View\Helper\FormatHelper;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Network\Exception\NotFoundException;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

   

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {   
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);

    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your details has been saved, you can try to login with your account.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('There is some thing wrong with your details. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
             
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('There is some thing wrong with your details. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        debug($user);
        $currentUser = $this->request->session()->read('Auth.User.id');
        if($currentUser!==$user){
            if ($this->Users->delete($user) ) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('There is some thing wrong with your details. Please, try again'));
        }
             
        }
            else{
        $this->Flash->error(__('You can not delete yourself. Please select another user and try again'));
    }
        return $this->redirect(['action' => 'index']);
    }


    public function login()
{
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl('/'));
        }
        $this->Flash->error(__('Your username or password is incorrect. Please, try again.'));
    }
}

public function forgot()
    {
		
       
    }
	
	public function sender()
    {
		$email = $_POST['email'];
		$msg = md5(uniqid($email, true));
		$headers =  'MIME-Version: 1.0' . "\r\n"; 
		$headers .= 'From: Crafty Cut Laser <CraftyCutsLaser@CraftyCuts.com>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
      mail($email,"Password Changed",$msg,$headers);
	 
       
    }

  public function isAuthorized($user)
{
    $action = $this->request->params['action'];

    // The add and index actions are always allowed.
    if (in_array($action, [  'index','login'])) {
        if ($user['email']==="fiona95821@gmail.com") {
  
        return true;
    } else
        return false;
    }
    else
    { 
        return true;}
    

   // Check if its admin
    

    return parent::isAuthorized($user);
}


public function logout()
{
     $this->Flash->success(__('You are now logged out.'));
    return $this->redirect($this->Auth->logout());
}


 public function changePassword()
{
    $user = $this->request->session()->read('Auth.User');
    $user = $this->Users->get($user['id']);
   
       if($this->request->is(['patch', 'post', 'put'])){
  
            //check if te new password is equal to the confirm_password
             $user = $this->Users->patchEntity($user,$this->request->data);
       
              
                    $user['password']=$this->request->data['New_password'];
                    if($this->Users->save($user)){
                         $this->Flash->success(__('Your password has been changed'));
                         return $this->redirect(['action' => 'logout']);
                    } else {
                       $this->Flash->error(__('Something wrong with your new password, Please try again'));
                     
                    }
               
          
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
}

public function contactus(){
//if user wish to submit the form
if ($this->request->is('post')) {
            $data = $this->request->data;
            $name = $data['name'];
            $emailaddress = $data['Your_email'];
            $subject = $data['subject'];
            $message = $data['message'];
                 
            try {
                               $email = new Email('default');
                $email->transport();
                $email->from($emailaddress)
               ->to('fiona95821@gmail.com')
               ->subject($subject)
               ->send($message);

                            } catch (Exception $e) {

                                echo 'Exception : ', $e->getMessage(), "\n";

                            }
                        
                

                $this->Flash->success(__('Your enquiry has been send, we will contact you us soon as possible.'));
                return $this->redirect(['action' => 'contactus']);
           
        }




}

public function beforeFilter(\Cake\Event\Event $event)
{
    $this->Auth->allow(['add','contactus', 'forgot']);

    if($this->Auth->user())
     {
        $this->Auth->deny('add');
        return false;
     }
}


}
