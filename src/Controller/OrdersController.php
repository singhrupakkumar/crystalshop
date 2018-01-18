<?php
namespace App\Controller;      

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Routing\Router;

use Cake\Mailer\Email;         

use Cake\Auth\DefaultPasswordHasher;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\FavouritesTable $Stores
 *
 * @method \App\Model\Entity\Store[] paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{

    
    
     
        public function beforeFilter(Event $event) {

        parent::beforeFilter($event);



        $this->Auth->allow(['add','orderhistory','changestatus']);          

        $this->authcontent();    
    }
    
    
        public function orderhistory()
    {  
         $this->loadModel('OrderItems');  
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
//       $orderid = $orderid?$orderid:0;  
        $sellorder = $this->Orders->find('all',['contain'=>['Users'],'conditions'=>['Orders.seller_id'=>$uid]]);         
        $sellorder = $sellorder->all();  

        $this->paginate = [
            'contain' => ['OrderItems','Users'],'conditions'=>['Orders.uid'=>$this->Auth->user('id')]  
        ];
        $yourorders = $this->paginate($this->Orders);      

        $this->set(compact('yourorders','sellorder'));
        $this->set('_serialize', ['yourorders','sellorder']); 
   
    }
    
        public function view($id = null)    
    {
        $order = $this->Orders->get($id, [
            'contain' => ['OrderItems'=>['Users','Products'],'Users']            
        ]);
 
        $this->set('order', $order); 
        $this->set('_serialize', ['order']);    
    }

    
      public function changestatus() {
        $a = $_POST['id'];
        if ($a == 0) {
            exit;
        }
        $d = explode('-', $a); 
        $user_id = $d[0];
        $order_id = $d[1];
        $order_status = $d[2];
        $data = $this->Orders->find('all', array('conditions' => array('Orders.id' => $order_id)));
        $data = $data->first();
        if($data){
            $this->Orders->updateAll(array('order_status' => $order_status), array('Orders.id' => $order_id));  
            
            $new_data = $this->Orders->find('all', array('conditions' => array('Orders.id' => $order_id)));
            
            $new_data = $new_data->first();      
//
//                $Email = new CakeEmail();
//                $Email->from('no-reply@rajdeep.crystalbiltech.com')
//                        ->to($new_data['Order']['email'])
//                        ->subject('Status Changed')
//                        ->template('orderstatus')
//                        ->emailFormat('html')
//                        ->viewVars(array('shop' => $new_data))
//                        ->send();
//      
         
        }


        exit;  
    }

   
}
