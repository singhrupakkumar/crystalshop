<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Routing\Router;

use Cake\Mailer\Email;         

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 *
 * @method \App\Model\Entity\Store[] paginate($object = null, array $settings = [])
 */
class StoresController extends AppController
{

      
    public function initialize()
    { 
        parent::initialize();
        $this->loadComponent('Cart');    
    }
    
    	public function beforeFilter(Event $event) {
 
        parent::beforeFilter($event);



        $this->Auth->allow(['index', 'add','storeDetails','shop','all','hotdeals','cart',
            'remove','itemupdate','clear','displaycart','webdisplaycart','webremoveitems','cartincreaseqty','cartdecreaseqty']);

        $this->authcontent();
  
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
    
      
        
        $this->loadModel('Products');
        $this->loadModel('Categories'); 
        $products = $this->Products->find('all',['contain'=>['Categories'], 'conditions' => ['Products.status' => 1]]);
        $features = $products->all(); 
        $features = $features->toArray();
        /*************Categories*************/
        $categories = $this->Categories->find('all', array(
            'recursive' => -1,
            'contain' => array(
                'Products'
            ),
            'limit' => 5,
            'conditions' => array(
                'Categories.status' => 1
            ),
            'order' => array(
                'Categories.id' => 'ASC'
            )
        ));
       
        $categories = $categories->all(); 
        $categories = $categories->toArray(); 
   
        $this->set('features', $features);
        $this->set('_serialize', ['features']);
        $this->set('categories', $categories);
        $this->set('_serialize', ['categories']); 
    }
    
      public function shop() 
    {

        $stores = $this->Stores->find('all',['contain'=>['Products'], 'conditions' => ['Stores.status' => 1]]);
        $stores = $stores->all(); 
        $data = $stores->toArray();
 
        $this->set('stores', $data); 
        $this->set('_serialize', ['stores']);
    }
     public function hotdeals() {  
        /*******Hot offers**********/
        $this->loadModel('Categories');
        $this->loadModel('Products');
        $cat = $this->Categories->find('all', ['conditions' => ['Categories.slug' => 'hot_deals']]);
        $cat = $cat->first();  
        $monday_coupon = $this->Categories->find('all', ['conditions' => ['Categories.slug' => 'monday_coupon']]);

        $monday_coupon = $monday_coupon->first();  
        $products = $this->Products->find('all',['contain'=>['Stores'], 'conditions' => ['Products.cat_id' => $cat['id']]]);
        $hotdeals = $products->all(); 
        $hotdeals = $hotdeals->toArray();
        
        /**********Monday cuupon*********/
        
        $monday = $this->Products->find('all',['contain'=>['Stores'], 'conditions' => ['Products.cat_id' => $monday_coupon['id']]]);
        $monday = $monday->all(); 
        $monday = $monday->toArray(); 
        
        $this->set('hotdeals', $hotdeals); 
        $this->set('_serialize', ['hotdeals']);  
        
        $this->set('monday', $monday); 
        $this->set('_serialize', ['monday']); 
         
     }
    
      public function topviewstore() 
    {  
        $stores = $this->Stores->find('all',['contain'=>['Products'],['order'=>'Stores.view_count ASC'] ,'conditions' => ['Stores.status' => 1,'Stores.view_count !=' => 0]]);
        $stores = $stores->all(); 
        $data = $stores->toArray();
 
        $this->set('stores', $data); 
        $this->set('_serialize', ['stores']);
    }
    
        public function cashbackstore() 
    {

        $stores = $this->Stores->find('all',['contain'=>['Products'], 'conditions' => ['Stores.cashback' => 1,'Stores.status' => 1]]);
        $stores = $stores->all(); 
        $data = $stores->toArray();
 
        $this->set('cashback', $data); 
        $this->set('_serialize', ['stores']);
    }
    
    public function all() {
        if($this->request->is('get')){
            $term = $this->request->query['search'];
            $store = $this->Stores->find('all', array(
                'conditions' => array('Stores.name LIKE' => '%' . $term . '%','Stores.status' => 1),
                'limit' => 200,
            ));
            $store = $store->all(); 
            $store = $store->toArray();
           
            if($store){
                $response['isSuccess'] = 'true';
                $response['data'] = $store;
            }else{
              $response['isSuccess'] = 'false';
              $response['data'] = $store;
              $response['msg'] = 'There Is No Stote Same Like';
            }
        }   
        echo json_encode($store);
       exit;
 
    }
    

          public function storeDetails($slug = null)  
    { 

        $stores = $this->Stores->find('all',['contain'=>['Products'], 'conditions' => ['Stores.slug' => $slug,'Stores.status' => 1]]);
        $stores = $stores->first(); 
        
    
        $this->set('stores', $stores); 
        $this->set('_serialize', ['stores']);
    }

    /**
     * View method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $store = $this->Stores->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('store', $store);
        $this->set('_serialize', ['store']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $store = $this->Stores->newEntity();
        if ($this->request->is('post')) {
            $store = $this->Stores->patchEntity($store, $this->request->getData());
            if ($this->Stores->save($store)) {
                $this->Flash->success(__('The store has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Store Could Not Be Saved. Please, Try Again.'));
        }
        $this->set(compact('store'));
        $this->set('_serialize', ['store']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $store = $this->Stores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $store = $this->Stores->patchEntity($store, $this->request->getData());
            if ($this->Stores->save($store)) {
                $this->Flash->success(__('The store has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Store Could Not Be Saved. Please, Try Again.'));
        }
        $this->set(compact('store'));
        $this->set('_serialize', ['store']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Stores->get($id);
        if ($this->Stores->delete($store)) {
            $this->Flash->success(__('The Store Has Been Deleted.'));
        } else {
            $this->Flash->error(__('The Store Could Not Be Deleted. Please, Try Again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function cart() {    
        $shop = $this->request->session()->read('Shop');
   
        $this->set(compact('shop')); 
    }
    
    public function remove($id = null) {
        $product = $this->Cart->remove($id);
        if(!empty($product)) {
            $this->Flash->error(__($product['Product']['name'] . ' was removed from your shopping cart'));
         
        } 
        return $this->redirect(array('action' => 'cart'));
    }
    
   
    
     public function clear() { 
        $this->Cart->clear();
        $this->Flash->error(__('All item(s) removed from your shopping cart'));
        return $this->redirect('/');
    }
    
    
      public function displaycart($uid,$sid){
        $this->loadModel('Carts');
        $this->loadModel('Products');
        $shop = $this->Carts->find('all', array(
       'contain' => array(
                     'Products'
                ), 
           'conditions' => array(      
               'AND' => array(
                   'Carts.uid' =>$uid,
                   'Carts.sessionid' => $sid  
       ))   
       )); 

        $shop = $shop->all();  
        $shop = $shop->toArray(); 
        $quantity = 0;
        $weight = 0;
        $subtotal = 0;
        $total = 0;
        $order_item_count = 0;
        $cartparent=array();
        $cartdata = array();
        $cart_using_dates = array(); 
	
        foreach ($shop as $key => $value) {
            
             if($value['product']['image']){   
             $value['product']['image'] = Router::url('/', true)."images/products/". $value['product']['image'];
             }else{
             $value['product']['image'] = Router::url('/', true)."images/products/no-image.jpg";   
             }
	      $cart_using_dates[] =$value;
	   
        }

        if (count($shop) > 0) {
            foreach ($shop as $item) {
                $quantity += $item['quantity'];
                $weight += $item['weight'];
                $subtotal += $item['subtotal'];
                $total += $item['subtotal']; 
                
                $storename = $this->Stores->find('all', array(
                    'conditions' => array(
                            'Stores.id' => $item['store_id']
                )));
                
                $order_item_count++;   
            }
            $storename = $storename->first();

            $this->request->session()->write('cart_count',$quantity);      
            $d['order_item_count'] = $order_item_count;
            $d['quantity'] = $quantity;
            $d['weight'] = sprintf('%01.2f', $weight);
            $d['subtotal'] = sprintf('%01.2f', $subtotal);
            $d['total'] = sprintf('%01.2f', $total); 
         
           
			 
            $cart['cartInfo']=$d; 
	    $cart['cartcount']= $quantity; 
            $cart['store']= $storename; 
            $cart['products']=$cart_using_dates;
 
        } else {
            $this->request->session()->write('cart_count',0);
            $d['quantity'] = 0;
            $d['weight'] = 0;
            $d['subtotal'] = 0;
            $d['total'] = 0;
            $cart['cartInfo']=$d;
            $cart['cartcount']= 0; 
            $cart['products']= $cart_using_dates;
      
        }  
        
        return $cart;    
	  }
 
     public function webdisplaycart() {               
          $sid   = $this->request->session()->id();
          
          $uid = $this->Auth->user('id'); 
          $user_id= $uid?$uid:0;
          $data = $this->displaycart($user_id, $sid); 
	
        if (!empty($data)) { 
            $response['error'] = "0";
            $response['data'] = $data;

        } else { 
            $response['error'] = "1";   
            $response['data'] = "error";
        }     

        echo json_encode($response);
        exit;    
    }
     
     public function webremoveitems() { 
            $sid   = $this->request->session()->id();
            $uid = $this->Auth->user('id'); 
            $id = $this->request->data['id'];
            $this->loadModel('Carts');  
            $cartItems = $this->Carts->find('all',array('conditions'=>array('AND'=>array('Carts.product_id'=>$id,'Carts.sessionid'=>$sid))));
            $cartItems = $cartItems->first();
                $cart = $this->Carts->get($cartItems['id']);
                $delet = $this->Carts->delete($cart);  
                if($delet){
                  $response['msg'] = "deleted";     
                }else{
                    $response['msg'] = "issue";    
                }
               $user_id= $uid?$uid:0;
                $data = $this->displaycart($user_id, $sid); 
        if (!empty($data)) { 
            $response['error'] = "0";
            $response['data'] = $data; 
          
        } else {    
            $response['error'] = "1";   
            $response['data'] = "error";
        }     

        echo json_encode($response);
        exit;  
        }
        
        
         public function cartincreaseqty() {    
            $sesid = $this->request->session()->id();
            $product_id = $this->request->data['id']; 
            if($this->Auth->user('id')){
            $uid = $this->Auth->user('id');
            }else{
                $uid =0;
            }
             $this->loadModel('Products');
             $pro_record = $this->Products->find('all',array('conditions'=>array('Products.id'=>$product_id)));
	     $pro_record = $pro_record->first();
			
            $this->loadModel('Carts');  
            $data = $this->Carts->find('all', array('contain'=>['Products'],'conditions' => array('Carts.product_id' => $product_id))); 	
            $data = $data->all();
            
         
             foreach ($data as $d) { 

		      $cartd = $this->Cart->checkcrt($sesid, $product_id,$uid);
	
		      $product_quantity = 0; 
                    foreach ($cartd as $key => $cart_product) {
                        $product_quantity += $cart_product['quantity'];
                    }
			
			if($product_quantity < $d['product']['quantity']){ 	
			 $qty = $d['quantity'] + 1;
                        $weight_total = $d['weight_total'] + $d['weight'];
                        $subtotal = $d['subtotal'] + $d['price'];
                       
             $updated = $this->Carts->updateAll(array('subtotal' => $subtotal, 'quantity' => $qty, 'weight_total' => $weight_total), array('id' => $d['id']));
           
                    }else{
                    $response['error'] = "1";
                    $response['msg'] = 'Available Item(s) in Stock : '.$d['product']['quantity'];	
                  }		
	
        }
             $user_id= $uid?$uid:0;   
             $data = $this->displaycart($user_id, $sesid);  
             $response['error'] = "0";
             $response['data'] = $data; 
          echo 	json_encode($response);
          exit;     
     
    } 
    
        public function cartdecreaseqty() { 
        $product_id = $this->request->data['id'];
        $sesid = $this->request->session()->id();
        $this->loadModel('Carts');
         $this->loadModel('Products');
         if($this->Auth->user('id')){
            $uid = $this->Auth->user('id');
            }else{
                $uid =0;
            }
         $pro_record = $this->Products->find('all',array('conditions'=>array('Products.id'=>$product_id)));
         $pro_record = $pro_record->first();  
         $data = $this->Carts->find('all', array('conditions' => array('Carts.product_id' => $product_id))); 
         $data = $data->all();    

        foreach ($data as $d) {
	
            if($d['quantity']>1){
                $qty = $d['quantity'] - 1;
                $weight_total = $d['weight_total'] + $d['weight'];
                $subtotal = $d['price'] * $qty;
                $updated = $this->Carts->updateAll(array('subtotal' => $subtotal, 'quantity' => $qty, 'weight_total' => $weight_total), array('id' => $d['id'])
                ); 
            }
		
        }
             $user_id= $uid?$uid:0;   
             $data = $this->displaycart($user_id, $sesid);  
             $response['error'] = "0"; 
             $response['data'] = $data; 
          echo 	json_encode($response);
          exit;  
    }

   
        
        
        
}
