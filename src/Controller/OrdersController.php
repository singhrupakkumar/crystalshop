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
        $sellorder = $this->Orders->find('all',['contain'=>['Users','Seller'],'conditions'=>['Orders.seller_id'=>$uid],'order'   => ['Orders.id' => 'desc'] ]);         
        $sellorder = $sellorder->all();  

        $this->paginate = [
            'contain' => ['OrderItems','Users','Seller'],'conditions'=>['Orders.uid'=>$this->Auth->user('id')],
            'order'   => ['Orders.id' => 'desc'] 
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
    
     public function ordercancel($id = null){     
         
         $order = $this->Orders->get($id);
         $post['order_status'] = 4;
         $order = $this->Orders->patchEntity($order, $post);
        if ($this->Orders->save($order)) {  

            $this->Flash->success(__('Order Cancel successfully.'));
            
        $data = $this->Orders->find('all', array('contain'=>array('Users','OrderItems','Seller'),'conditions' => array('Orders.id' => $id)));  
        $data = $data->first()->toArray();     
               
               $email = new Email('default');        
                        /**********admin***********/
                 $send = $email->from(['rupak@avainfotech.com' => 'Earth Vendors'])      
                        ->emailFormat('html')
                        ->template('ordercancel')
                        ->to('rupak@avainfotech.com')   
                        ->subject('Order Cancelled')      
                        ->viewVars(array('order' => $data))           
                        ->send();  
                 
                         /**********seller***********/
                 $send1 = $email->from(['rupak@avainfotech.com' => 'Earth Vendors'])      
                        ->emailFormat('html')
                        ->template('ordercancelseller')
                        ->to($data['seller']['email']) 
                        ->subject('Order Cancelled')      
                        ->viewVars(array('order' => $data))           
                        ->send();   
                        /**********buyer***********/
                 $send2 = $email->from(['rupak@avainfotech.com' => 'Earth Vendors'])      
                        ->emailFormat('html')
                        ->template('ordercanceluser')  
                        ->to($data['email']) 
                        ->subject('Order Cancelled')      
                        ->viewVars(array('order' => $data))              
                        ->send();    
 

        } else {    
            $this->Flash->error(__('Unable to Cancel.'));

        }
        return $this->redirect(['action' => 'orderhistory']);  
        
        
    }

   
}
