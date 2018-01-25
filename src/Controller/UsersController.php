<?php
namespace App\Controller;  

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Mailchimp\Mailchimp;
use Cake\Auth\DefaultPasswordHasher;

/**

 * Users Controller

 *

 * @property \App\Model\Table\UsersTable $Users

 *

 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])

 */
class UsersController extends AppController {

    public function beforeFilter(Event $event) {

        parent::beforeFilter($event);



        $this->Auth->allow(['add', 'login', 'forgot', 'reset', 'contact',
            'newsletter','capchaverify' ,'gplogin', 'signup','fblogin','referearn',
            'invitecode','paymenthistory','emailverify']);  

        $this->authcontent();   
    } 

 
    /**

     * View method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|void

     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.

     */
    public function view($id = null) {

        $user = $this->Users->get($id, [

            'contain' => []
        ]);



        $this->set('user', $user);

        $this->set('_serialize', ['user']);
    }

    /**

     * Add method

     *

     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.

     */
    public function add() {

        if ($this->Auth->user()) {

            return $this->redirect('/');
        }

        $user = $this->Users->newEntity();


        if ($this->request->is('post')) {

            $this->request->data['username'] = $this->request->data['email'];

            $post = $this->request->getData();   

            $post['status'] = '0';
            $post['role'] = 'user';  

            $user = $this->Users->patchEntity($user, $post);

            $new_user = $this->Users->save($user);

            if ($new_user) {

                if (isset($user)) { 
                    $burl = Router::fullbaseUrl();
                    $hash = md5(time() . rand(111999999999999999999999999, 99999999999999999999999999999999999999999));
                    $url = Router::url(['controller' => 'users', 'action' => 'emailverify'. '/' . $user->id . '/' . $hash]);
                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                    $refer_link =  $burl . $url ; 
                     $email = new Email('default');   

                 $send = $email->from(['rupak@avainfotech.com' => 'Earth Vendors']) 
                        ->emailFormat('html')
                        ->template('invite')
                        ->to($user->email)
                        ->subject('Welcome to Earth Vendors')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))    
                        ->send();   

                        
                        $this->Flash->success(__('Registration done successfully. We have sent a verification mail to your registered email address, Please verify your account. Please be patient, as it may take some time to reach your inbox.'));   
                    
                }
                
                
                

//                if (!filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL) === false) {
//
//                    $this->Auth->config('authenticate', [
//
//                        'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
//                    ]);
//                    $this->Auth->constructAuthenticate();
//                    $this->request->data['email'] = $this->request->data['email'];
//
//                }
//
//                $user = $this->Auth->identify();
//
//                if ($user) {
//                    $this->Auth->setUser($user);
//                  
//                  $this->Flash->success(__('You have been registered successfully.'));   
//                    return $this->redirect($this->Auth->redirectUrl());   
//                }
//    
            } else {

                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }



        $this->set(compact('user'));

        $this->set('_serialize', ['user']);
    }
    
        public function emailverify ($user_id = null,$token = null){ 

           if(!empty($user_id)){

             $useractive = $this->Users->find('all',['conditions'=>['Users.id'=>$user_id]]);
             
             $useractive = $useractive->first();
             if($useractive['status']==1){
               return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
             }
             
             if($useractive['tokenhash'] ==  $token){  
             $this->Users->updateAll(array('tokenhash' =>' ','status'=>1), array('id' => $user_id));    
             $this->Flash->success(__('Your account has been activated, go for login.'));  
              return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
             }else{ 
             $this->Flash->error(__('Token has been expired. Please, try again.'));        
             } 
               
           }
        }
        
        public function signup() {

        $response = array();

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {

            if ($this->request->data['name'] == '' || $this->request->data['email'] == '' || $this->request->data['password1'] == '' || $this->request->data['password'] == '') {
                $response['isSucess'] = "false";
                $response['msg'] = "<div class='alert alert-danger'><strong>Please fill all the fields</strong></div>";
            } else if ($this->request->data['password1'] != $this->request->data['password']) {
                $response['isSucess'] = "false";
                $response['msg'] = "<div class='alert alert-danger'><strong>Password and confirm password does not match.</strong></div>";
            } else {

                $user_check = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);
                $user_check = $user_check->first();
                if (!empty($user_check)) {
                    $response['isSucess'] = "false";
                    $response['msg'] = "<div class='alert alert-danger'><strong>Email address already exists. Please try with another Email Address..</strong></div>";
                } else {

                    $post = $this->request->data;

                    $post['status'] = '1';
                    $post['role'] = 'user';
                    $post['name'] = $post['name'];
                    $post['username'] = $post['email'];

                    $user = $this->Users->patchEntity($user, $post);
                    $new_user = $this->Users->save($user);
                      
                     // generate refferal code
                        $user_referral_code =  substr($post['email'],0,3).rtrim(strtr(base64_encode($new_user->id), '+/', '-_'), '=');  
                        $this->Users->updateAll(['refer_code' =>  $user_referral_code], ['id' => $new_user->id]);
                    if ($new_user) {
                        $ms = 'A new user has been registered recently with email address <strong>' . $post['email'] . '</strong>';

                        $ms .= '<br>';

                        $ms .= '<table border="0"><tr><th scope="row" align="left">Name</th><td>' . $post['name'] . '</td></tr><tr><th scope="row" align="left">Email</th><td>' . $post['email'] . '</td></tr></table>';

                         $email = new Email('default');
                         $email->from(['rupak@avainfotech.com' => 'Earth Vendors'])  
                         	->emailFormat('html')
                         	->template('default', 'default')
                         	->to($new_user->email)
                         	->subject('New User Registration')
                         	->send($ms);
                        $currentuser = $this->Users->find('all', ['conditions' => ['Users.id' => $new_user->id]]);
                        $currentuser = $currentuser->first();
                        $this->Auth->setUser($currentuser);     
                        $response['isSucess'] = "true";
                        $response['msg'] = "<div class='alert alert-success'><strong>Registered Successfully.</strong></div>";
                    }
                }
            }
        }

        echo json_encode($response);
        exit;
    }  

    public function myaccount(){
      $this->loadModel('Favourites');  
      $uid =  $this->Auth->user('id');
      if($uid){
        $userdata  = $this->Users->find('all',array('conditions'=>array('Users.id'=>$uid)));
        $userdata  = $userdata->first();
        
        $fav_store  = $this->Favourites->find('all',array('contain'=>['Stores'],'conditions'=>array('Favourites.user_id'=>$uid)));
        $fav_store  = $fav_store->all();
        $fav_store = $fav_store->toArray();

      }else {
       return $this->redirect(['controller' => 'stores', 'action' => 'index']);    
      }
         $this->set(compact('userdata','fav_store'));
        $this->set('_serialize', ['userdata','fav_store']);
      
    }
    
     

    /**

     * Edit method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.

     * @throws \Cake\Network\Exception\NotFoundException When record not found.

     */
    public function edit() {
        
        $id = $this->Auth->user('id');
       if($id){
          
              $user = $this->Users->get($id, [

            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
 
            $post = $this->request->data;

                if ($this->request->data['image']['name'] != '') {

                    if ($user->image != '') {
                        unlink(WWW_ROOT . 'images/users/' . $user->image);
                    }

                    $image = $this->request->data['image'];
                    $name = time() . $image['name'];
                    $tmp_name = $image['tmp_name'];
                    $upload_path = WWW_ROOT . 'images/users/' . $name;
                    move_uploaded_file($tmp_name, $upload_path);

                    $post['image'] = $name;
                } else {
                    unset($this->request->data['image']);
                    $post = $this->request->data;
                }

            $user = $this->Users->patchEntity($user, $post);

            if ($this->Users->save($user)) {

                $this->Flash->success(__('Your profile has been updated successfully.'));
            } else {

                $this->Flash->error(__('The user could not be saved. Please, Try Again.'));
            }
        }

           
       }else{
           $this->Flash->error(__('Please login to the website in order to have access to the request.'));  
          return $this->redirect(['controller' => 'stores', 'action' => 'index']);    
       } 

        $this->loadModel('Countries');

        $countries = $this->Countries->find('all');
        $countries = $countries->all();

        $this->set(compact('countries'));

        $this->set(compact('user'));

        $this->set('_serialize', ['user']);
    }

    /**

     * Delete method

     *

     * @param string|null $id User id.

     * @return \Cake\Http\Response|null Redirects to index.

     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.

     */
    public function delete($id = null) {

        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {

            $this->Flash->success(__('The User Has Been Deleted.'));
        } else {

            $this->Flash->error(__('The User Could Not Be Deleted. Please, Try Again.'));
        }



        return $this->redirect(['action' => 'index']);
    }
    
    
    
    /************************My product********************************/ 
    public function myproduct(){    
      if($this->Auth->user('id')){  
        $userdata  = $this->Users->find('all',array('contain'=>['Products'],'conditions'=>array('Users.id'=>$this->Auth->user('id'))));
        $userdata  = $userdata->first();  
          
        }else {
           return $this->redirect(['controller' => 'stores', 'action' => 'index']);    
        }
        $this->set(compact('userdata'));
        $this->set('_serialize', ['userdata']);  
    }   
    
    public function capchaverify(){
        if ($this->request->is('post')) {
         $response = array();
            if(isset($this->request->data['g-recaptcha-response']) && !empty($this->request->data['g-recaptcha-response'])){
                
         //your site secret key
        $secret = '6Lef5j0UAAAAALd1HfD_lJN_vbfY7YWpBnzIwVs5';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->request->data['g-recaptcha-response']);
       
        $responseData = json_decode($verifyResponse);  
        if($responseData->success){           
             $response['status'] = true;
             $response['msg'] = '';   
        }else{
           $response['status'] = false;
           $response['msg'] = 'Robot verification failed, please try again.';  
        }

        }else{
             $response['status'] = false;
             $response['msg'] = 'Please click on the reCAPTCHA box.';
        }
        
        }
        echo json_encode($response) ;
        exit;
       
    }
    
    
    public function login() {

      $this->loadModel('Carts');  
    if(empty($this->Auth->user('id'))){
        
        
        if ($this->request->is('post')) {  

             $oldsession = $this->request->session()->id();    
  
            $this->request->session()->delete('user_id');    

            if ($this->request->data['username'] == '') {
                $this->Flash->error(__('Please enter your Email Address!'));
            
            } else if ($this->request->data['password'] == '') { 
                $this->Flash->error(__('Please enter your Password!'));
             
            } else {

                if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {

                    $this->Auth->config('authenticate', [

                        'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                    ]);

                    $this->Auth->constructAuthenticate();

                    $this->request->data['email'] = $this->request->data['username'];

                    unset($this->request->data['username']);
                }

                $user = $this->Auth->identify();
                if ($user) {         
                    if ($user['status'] == 0) {   
                        $this->Auth->logout();
                       $this->Flash->error(__('You are not active Yet!'));
                      
                    } else {
                        $this->Auth->setUser($user);  
                        $updatenewsession = $this->request->session()->id(); 
                        $this->Carts->updateAll(array('uid' => $user['id'],'sessionid'=>"$updatenewsession"), array('sessionid' => $oldsession)); 
                        if ($this->Auth->user('role') == 'admin') {
                            //$this->Auth->logout();
                            $this->Flash->success(__('Your Role Is Admin'));
                            return $this->redirect(['prefix' => 'admin','controller' => 'dashboard', 'action' => 'index']);  
                          
                        } else {
                             
        
                           
                         
                            $this->Flash->success(__('Logged In Successfully')); 
                            return $this->redirect(['controller' => 'stores', 'action' => 'index']);  
                        }
                    }
                } else {
                    $this->Flash->error(__('Invalid email address & Password'));

                }
            }

        } 
        }else{
           return $this->redirect(['controller' => 'stores', 'action' => 'index']);  
        }
        $this->set(compact('response'));

        $this->set('_serialize', ['response']);
    }

    public function logout() {  
         $this->request->session()->delete('sociallogin');  
        if ($this->Auth->logout()) {

            return $this->redirect('/');
        }
    }

    public function forgot() {
        if ($this->Auth->user('id')) {  
            $this->redirect('/');
        }


        if ($this->request->is('post')) {

            $email = $this->request->data['email'];



            $user = $this->Users->find('all', ['conditions' => ['Users.email' => $email]]);

            $user = $user->first();

            $burl = Router::fullbaseUrl();

            if (empty($user)) {

                $this->Flash->error(__('Enter regsitered email address to reset you password'));
            } else {

                if ($user->email) {

                    $hash = md5(time() . rand(111999999999999999999999999, 99999999999999999999999999999999999999999));

                    $url = Router::url(['controller' => 'users', 'action' => 'reset' . '/' . $hash]);



                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));
                    
                    $refer_link =  $burl . $url ; 
                     $email = new Email('default');

                 $send = $email->from(['rupak@avainfotech.com' => 'Earth Vendors']) 
                        ->emailFormat('html')
                        ->template('forgot')
                        ->to($user->email)
                        ->subject('Reset Your Password')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('user' => $user))  
                        ->send();  



                    $this->Flash->success(__('Check your email to reset your Password'));
                } else {

                    $this->Flash->error(__('Email Is Invalid'));
                }
            }
        }
    }

    public function reset($token) {

        $query = $this->Users->find('all', ['conditions' => ['Users.tokenhash' => $token]]);
        $data = $query->first();
        if ($data) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                if ($this->request->data['password1'] != $this->request->data['password']) {
                    $this->Flash->success(__('New password & confirm password does not match!'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                }
                $this->request->data['tokenhash'] = md5(time() . rand(111999999999999999999999999999, 999999999999999999999999999999999));
                $user = $this->Users->get($data->id, [
                    'contain' => []
                ]);
                $user = $this->Users->patchEntity($user, $this->request->getData());  

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Your password has been changed'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                } else {
                    $this->Flash->success(__('Invalid Password, try again'));
                    return;
                    //$this->redirect(['action' => 'reset/' . $token]);
                }
            }
        } else {
            $this->Flash->success(__('Invalid Token, Try Again'));
            return;
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function changepassword() {
        $id = $this->Auth->user('id');

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['password1'])) {
                if ($this->request->data['password'] != $this->request->data['password1']) {
                    $this->Flash->error(__('New and confirm password does not match'));
                    return;
                }
            }
            if ((new DefaultPasswordHasher)->check($this->request->data['opassword'], $user['password'])) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Password Changed Successfully'));

                    if (isset($_GET['route'])) {
                        return $this->redirect(['action' => 'edit', $id]);
                    } else {
                        return $this->redirect(['action' => 'changepassword']);
                    }
                } else {
                    $this->Flash->error(__('Invalid Password, Try again'));
                    if (isset($_GET['route'])) {
                        return $this->redirect(['action' => 'edit', $id]);
                    } else {
                        return $this->redirect(['action' => 'changepassword']);
                    }
                }
            } else {
                $this->Flash->error(__('Old Password did not match'));
                if (isset($_GET['route'])) {
                    return $this->redirect(['action' => 'edit', $id]);
                } else {
                    return $this->redirect(['action' => 'changepassword']);
                } 
            }
        }
    }

    public function referearn() {
       $id = $this->Auth->user('id');
       
       if($this->request->is('post')){
           $email1 = $this->request->data['email'];
           $refer_link = $this->request->data['refer_link'];

            if(!empty($email1)){ 

                 $email = new Email('default');

                 $send = $email->from(['rupak@avainfotech.com' => 'Earth Vendors']) 
                        ->emailFormat('html')
                        ->template('invite')
                        ->to($email1)
                        ->subject('Registration Invite Code!')
                        ->viewVars(array('link' => $refer_link)) 
                        ->viewVars(array('email' => $email1))  
                        ->send();
                  if($send){
                      $this->Flash->success(__('Successfully Sent!'));
                  }else{
                   $this->Flash->error(__('Try Again!')); 
                  } 
            }
           
        }
       $query = $this->Users->find('all', ['conditions' => ['Users.id' => $id]]);
       $user = $query->first();
       
        $this->set('user',$user); 
        $this->set('_serialize', ['user']);

      
    }
    
    public function invitecode($invitecode = null) {    

       
    }
 
    public function contact() {  


        $this->loadModel('Contacts');

        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {

                $ms = '<table width="200" border="1"><tr><th scope="row">Name</th><td>' . $this->request->data['name'] . '</td></tr><tr><th scope="row">Email</th><td>' . $this->request->data['email'] . '</td></tr><tr><th scope="row">Subject</th><td>' . $this->request->data['subject'] . '</td></tr><th scope="row">Message</th><td>' . $this->request->data['message'] . '</td></tr></table>';


                $email = new Email('default');

                $email->from(['rupak@avainfotech.com' => 'Earth Vendors'])
                        ->emailFormat('html')
                        ->template('default', 'default')
                        ->to('rupak@avainfotech.com')
                        ->subject('Contact Us Enquiry')
                        ->send($ms);


                $this->Flash->success(__('Your Enquiry has been sent successfully.'));
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }
    
     public function paymenthistory() {
         $this->loadModel('Orders');

         $uid = $this->Auth->user('id');
         if (empty($uid)) {      
            $this->redirect('/');
        }
//       $orderitems  = $this->OrderItems->find('all', ['conditions' => ['OrderItems.seller_id' => $uid]]);
//       $orderitems  = $orderitems->all();  
//        $orderid = array();
//       foreach($orderitems as $item){
//           $orderid[] = $item['order_id'];  
//       }
   
      // $orderid = $orderid?$orderid:0; 
       
      $order = $this->Orders->find('all',['contain'=>['OrderItems','Users','Seller'],'conditions'=>['Orders.seller_id'=>$uid]]);           
      $orderhistory = $order->all(); 
   
    
        $this->set(compact('orderhistory'));
        $this->set('_serialize', ['orderhistory']);  
        
     }    
   /***********Newsletter*****************/

    public function newsletter() {
        // include(ROOT.'/Mailchimp/Mailchimp.php'); 
         require ROOT.'/vendor/jhut89/mailchimp3php/src/mailchimpRoot.php';
        //ashu $api_key = "35833bae8881ce0ecced3fc3daa81482-us14";    
        //ashu $list_id = "1a2fe1e7c5";
        $list_id = "15aa663281";  

      $post_params = ['email_address'=>$_POST['email'], 'status'=>'subscribed'];

       $subscriber =  $mailchimp->lists($list_id)->members()->POST($post_params);  

       // $subscriber = $Mailchimp_Lists->subscribe($list_id, array('email' => htmlentities($_POST['email'])));
        if (!empty($subscriber->id)) {  
            echo "success";
        } else {
            echo "fail";
        }
        exit;
    }

}
