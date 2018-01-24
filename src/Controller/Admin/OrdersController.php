<?php
namespace App\Controller\Admin;      

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Routing\Router;

use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;

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

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin'); 
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
             $this->Auth->logout();
              //  $this->viewBuilder()->setLayout('admin');
            }

        }

        $this->Auth->allow(['index']);  

        $this->authcontent();
 

    }
    
    
    
        public function index()
    {
        $this->paginate = [
            'contain' => ['OrderItems','Users','Seller'],
            'order'   => ['Orders.id' => 'desc'] 
        ];
        $orders = $this->paginate($this->Orders);
    
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']); 
    }
    
        public function view($id = null)    
    {
        $order = $this->Orders->get($id, [
            'contain' => ['OrderItems'=>['Users','Products'],'Users']            
        ]);
 
        $this->set('order', $order); 
        $this->set('_serialize', ['order']);    
    }
      
    public function payments(){ 
        $connection = ConnectionManager::get('default');
        if($this->request->is('post')){
           $start_date = $this->request->data['from']; 
           $end_date = $this->request->data['to']; 
           if(empty($start_date)){
            $this->Flash->error(__('Please select from date'));    
           }elseif(empty($end_date)){
            $this->Flash->error(__('Please select to date'));    
           }  
           
           $start_date = date("Y-m-d",strtotime($start_date));
           $end_date = date("Y-m-d",strtotime($end_date));
           
//        $order =  $this->Orders->find('all',[ 
//            'contain' => ['OrderItems','Users','Seller']
//        ]); 
//               $orders = $order->all()->toArray();   
          $orders = $connection
    ->execute("SELECT `Orders`.`id` AS `Orders__id`, `Orders`.`uid` AS `Orders__uid`, `Orders`.`seller_id` AS `Orders__seller_id`, `Orders`.`name` AS `Orders__name`, `Orders`.`email` AS `Orders__email`, `Orders`.`phone` AS `Orders__phone`, `Orders`.`address` AS `Orders__address`, `Orders`.`country` AS `Orders__country`, `Orders`.`city` AS `Orders__city`, `Orders`.`state` AS `Orders__state`, `Orders`.`zip` AS `Orders__zip`, `Orders`.`weight` AS `Orders__weight`, `Orders`.`order_item_count` AS `Orders__order_item_count`, `Orders`.`subtotal` AS `Orders__subtotal`, `Orders`.`total` AS `Orders__total`, `Orders`.`commission_amount` AS `Orders__commission_amount`, `Orders`.`paid_by_admin` AS `Orders__paid_by_admin`, `Orders`.`created` AS `Orders__created`, `Orders`.`modified` AS `Orders__modified`, `Orders`.`payment_status` AS `Orders__payment_status`, `Orders`.`transaction_id` AS `Orders__transaction_id`, `Orders`.`payment_gateway_price` AS `Orders__payment_gateway_price`, `Orders`.`order_status` AS `Orders__order_status`, `Users`.`id` AS `Users__id`, `Users`.`role` AS `Users__role`, `Users`.`name` AS `Users__name`, `Users`.`email` AS `Users__email`, `Users`.`paypal_email` AS `Users__paypal_email`, `Users`.`username` AS `Users__username`, `Users`.`phone` AS `Users__phone`, `Users`.`password` AS `Users__password`, `Users`.`gender` AS `Users__gender`, `Users`.`image` AS `Users__image`, `Users`.`dob` AS `Users__dob`, `Users`.`address` AS `Users__address`, `Users`.`country` AS `Users__country`, `Users`.`state` AS `Users__state`, `Users`.`zip` AS `Users__zip`, `Users`.`google_id` AS `Users__google_id`, `Users`.`refer_code` AS `Users__refer_code`, `Users`.`fb_id` AS `Users__fb_id`, `Users`.`tokenhash` AS `Users__tokenhash`, `Users`.`status` AS `Users__status`, `Users`.`created` AS `Users__created`, `Users`.`modified` AS `Users__modified`, `Seller`.`id` AS `Seller__id`, `Seller`.`role` AS `Seller__role`, `Seller`.`name` AS `Seller__name`, `Seller`.`email` AS `Seller__email`, `Seller`.`paypal_email` AS `Seller__paypal_email`, `Seller`.`username` AS `Seller__username`, `Seller`.`phone` AS `Seller__phone`, `Seller`.`password` AS `Seller__password`, `Seller`.`gender` AS `Seller__gender`, `Seller`.`image` AS `Seller__image`, `Seller`.`dob` AS `Seller__dob`, `Seller`.`address` AS `Seller__address`, `Seller`.`country` AS `Seller__country`, `Seller`.`state` AS `Seller__state`, `Seller`.`zip` AS `Seller__zip`, `Seller`.`google_id` AS `Seller__google_id`, `Seller`.`refer_code` AS `Seller__refer_code`, `Seller`.`fb_id` AS `Seller__fb_id`, `Seller`.`tokenhash` AS `Seller__tokenhash`, `Seller`.`status` AS `Seller__status`, `Seller`.`created` AS `Seller__created`, `Seller`.`modified` AS `Seller__modified` FROM `orders` `Orders` INNER JOIN `users` `Users` ON `Users`.`id` = (`Orders`.`uid`) LEFT JOIN `users` `Seller` ON `Seller`.`id` = (`Orders`.`seller_id`) WHERE Orders.created BETWEEN  '$start_date 00:00:00.000000' AND '$end_date 00:00:00.000000'") 
    ->fetchAll('assoc');       
                
          
        }else{
            
//       $order =  $this->Orders->find('all',[ 
//            'contain' => ['OrderItems','Users','Seller'] ,
//           'conditions'=>['Orders.created'=>'2018-01-15']
//          
//        ]); 
         $orders = $connection
    ->execute("SELECT `Orders`.`id` AS `Orders__id`, `Orders`.`uid` AS `Orders__uid`, `Orders`.`seller_id` AS `Orders__seller_id`, `Orders`.`name` AS `Orders__name`, `Orders`.`email` AS `Orders__email`, `Orders`.`phone` AS `Orders__phone`, `Orders`.`address` AS `Orders__address`, `Orders`.`country` AS `Orders__country`, `Orders`.`city` AS `Orders__city`, `Orders`.`state` AS `Orders__state`, `Orders`.`zip` AS `Orders__zip`, `Orders`.`weight` AS `Orders__weight`, `Orders`.`order_item_count` AS `Orders__order_item_count`, `Orders`.`subtotal` AS `Orders__subtotal`, `Orders`.`total` AS `Orders__total`, `Orders`.`commission_amount` AS `Orders__commission_amount`, `Orders`.`paid_by_admin` AS `Orders__paid_by_admin`, `Orders`.`created` AS `Orders__created`, `Orders`.`modified` AS `Orders__modified`, `Orders`.`payment_status` AS `Orders__payment_status`, `Orders`.`transaction_id` AS `Orders__transaction_id`, `Orders`.`payment_gateway_price` AS `Orders__payment_gateway_price`, `Orders`.`order_status` AS `Orders__order_status`, `Users`.`id` AS `Users__id`, `Users`.`role` AS `Users__role`, `Users`.`name` AS `Users__name`, `Users`.`email` AS `Users__email`, `Users`.`paypal_email` AS `Users__paypal_email`, `Users`.`username` AS `Users__username`, `Users`.`phone` AS `Users__phone`, `Users`.`password` AS `Users__password`, `Users`.`gender` AS `Users__gender`, `Users`.`image` AS `Users__image`, `Users`.`dob` AS `Users__dob`, `Users`.`address` AS `Users__address`, `Users`.`country` AS `Users__country`, `Users`.`state` AS `Users__state`, `Users`.`zip` AS `Users__zip`, `Users`.`google_id` AS `Users__google_id`, `Users`.`refer_code` AS `Users__refer_code`, `Users`.`fb_id` AS `Users__fb_id`, `Users`.`tokenhash` AS `Users__tokenhash`, `Users`.`status` AS `Users__status`, `Users`.`created` AS `Users__created`, `Users`.`modified` AS `Users__modified`, `Seller`.`id` AS `Seller__id`, `Seller`.`role` AS `Seller__role`, `Seller`.`name` AS `Seller__name`, `Seller`.`email` AS `Seller__email`, `Seller`.`paypal_email` AS `Seller__paypal_email`, `Seller`.`username` AS `Seller__username`, `Seller`.`phone` AS `Seller__phone`, `Seller`.`password` AS `Seller__password`, `Seller`.`gender` AS `Seller__gender`, `Seller`.`image` AS `Seller__image`, `Seller`.`dob` AS `Seller__dob`, `Seller`.`address` AS `Seller__address`, `Seller`.`country` AS `Seller__country`, `Seller`.`state` AS `Seller__state`, `Seller`.`zip` AS `Seller__zip`, `Seller`.`google_id` AS `Seller__google_id`, `Seller`.`refer_code` AS `Seller__refer_code`, `Seller`.`fb_id` AS `Seller__fb_id`, `Seller`.`tokenhash` AS `Seller__tokenhash`, `Seller`.`status` AS `Seller__status`, `Seller`.`created` AS `Seller__created`, `Seller`.`modified` AS `Seller__modified` FROM `orders` `Orders` INNER JOIN `users` `Users` ON `Users`.`id` = (`Orders`.`uid`) LEFT JOIN `users` `Seller` ON `Seller`.`id` = (`Orders`.`seller_id`) ")
    ->fetchAll('assoc'); 
        }

        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);   
        
        
    }
    
    public function markpay($id = null){   

         $order = $this->Orders->get($id);
         $post['paid_by_admin'] = 1;
         $order = $this->Orders->patchEntity($order, $post);
        if ($this->Orders->save($order)) {  

            $this->Flash->success(__('Mark successfully.'));

        } else {  
            $this->Flash->error(__('Unable to Mark.'));

        }
        return $this->redirect(['action' => 'payments']);  
        
        
    }
    
  

}
