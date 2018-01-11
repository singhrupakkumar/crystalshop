<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
//use \CROSCON\CommissionJunction\Client;      



/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[] paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{

    
    public function initialize()
    { 
        parent::initialize();
        $this->loadComponent('Cart');    
    }
    
    
        public function beforeFilter(Event $event) {

        parent::beforeFilter($event);



        $this->Auth->allow(['add','slugify' ,'gallerydelete','searchjson', 'search','view','index','addtocart','productbycat','promoteproduct','addsellproduct','currencyconverter']);          

        $this->authcontent();    
    }
    
     private function slugify($str) {   
                // trim the string
                $str = strtolower(trim($str));
                // replace all non valid characters and spaces with an underscore
                $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                $str = preg_replace('/-+/', "_", $str);
        return $str;
     } 
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {  
        $this->loadModel('Users');
        $this->loadModel('Categories');
        if($this->request->is('post')){
        $uname =  $this->request->data['sellername'];     
        $seller = $this->Users->find('all',['conditions'=>['Users.name LIKE' => '%' . $uname . '%']]); 
        $seller = $seller->first();
        $seller_id = $seller['id'];    
        $this->paginate = [
            'contain' => ['Categories', 'Users'],
            'conditions'=>['Products.user_id'=>$seller_id]
        ];  
        
        }else{

        $this->paginate = [
            'contain' => ['Categories', 'Users']
        ];
            
        }
        $products = $this->paginate($this->Products); 
        
        $categories = $this->Categories->find('all',[ 'contain' => ['Products']]); 
        $categories = $categories->all();
        $this->set(compact('products','categories')); 
        $this->set('_serialize', ['products','categories']);  
    }

    
      public function productbycat($slug = NULL)
    {    
        $this->loadModel('Categories');
        $this->loadModel('Users');
        $cat  = $this->Categories->find('all',array('conditions'=>array('Categories.slug'=>$slug)));
        $cat = $cat->first(); 
        if($this->request->is('post')){
        $uname =  $this->request->data['sellername'];     
        $seller = $this->Users->find('all',['conditions'=>['Users.name LIKE' => '%' . $uname . '%']]); 
        $seller = $seller->first();
        $seller_id = $seller['id'];    
        $this->paginate = [
            'contain' => ['Categories', 'Users'],
            'conditions'=>['AND'=>['Products.user_id'=>$seller_id,'Products.cat_id'=>$cat['id']]]
        ];  
        
        }else{
             $this->paginate = [
            'contain' => ['Categories', 'Users'],
            'conditions'=>['Products.cat_id'=>$cat['id']]    
        ];
            
        }
  
        $products = $this->paginate($this->Products);   
        
        $categories = $this->Categories->find('all',[ 'contain' => ['Products']]); 
        $categories = $categories->all();

        $this->set(compact('products','cat','categories')); 
        $this->set('_serialize', ['products','categories']); 
    }
    
    
     public function promoteproduct()
    {    
        
    }
    
    
    
    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
    
        $product = $this->Products->find('all', array('contain'=>array('Users'),
                'conditions' => ['Products.slug'=>$slug] 
            ));
        $product = $product->first(); 
        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

     public function searchjson() {
        $term = null;
        if(!empty($this->request->query['term'])) {
            $term = $this->request->query['term'];
            $terms = explode(' ', trim($term));
            $terms = array_diff($terms, array(''));
            $conditions = array(
                // 'Brand.active' => 1,
                'Products.status' => 1
            );
            foreach($terms as $term) {
                $conditions[] = array('Products.name LIKE' => '%' . $term . '%');
            }
            $products = $this->Products->find('all', array(
                'recursive' => -1,
                'contain' => array(
                     'Users'
                ),
                'fields' => array(
                    'Products.id',
                    'Products.name',
                    'Products.image'
                ),
                'conditions' => $conditions,
                'limit' => 20,
            ));
        }
        
         $products = $products->all(); 
          $products = $products->toArray();
        
        echo json_encode($products);
        exit;

    }
    
    
    public function search() { 
        $search = null;
        if(!empty($this->request->query['search']) || !empty($this->request->data['name'])) {
            $search = empty($this->request->query['search']) ? $this->request->data['name'] : $this->request->query['search'];
            $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
            $terms = explode(' ', trim($search));
            $terms = array_diff($terms, array(''));
            $conditions = array(
                'Products.status' => 1
            );
            foreach($terms as $term) {
                $terms1[] = preg_replace('/[^a-zA-Z0-9]/', '', $term);
                $conditions[] = array('Products.name LIKE' => '%' . $term . '%');
            }
            
            
            $products = $this->Products->find('all', array(
                'contain' => array(
                    'Users'
                ),
                'conditions' => $conditions,
                'limit' => 200,
            ));
            
            
             $products = $products->all(); 
             $products = $products->toArray();  

            if(count($products) == 1) {
                return $this->redirect(array('controller' => 'products', 'action' => 'view/'.$products[0]['slug']));
            }
            
         
            $terms1 = array_diff($terms1, array(''));
            $this->set(compact('products', 'terms1'));
        }
        $this->set(compact('search'));  

        if ($this->request->is('ajax')) {
            $this->layout = false;
            $this->set('ajax', 1);
        } else {
            $this->set('ajax', 0);
        }

        $this->set('title_for_layout', 'Search');

        $description = 'Search';
        $this->set(compact('description'));

        $keywords = 'search';
        $this->set(compact('keywords'));
    }
    
    
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $cats = $this->Products->Cats->find('list', ['limit' => 200]);
        $stores = $this->Products->Stores->find('list', ['limit' => 200]);
        $this->set(compact('product', 'cats', 'stores'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Galleries');
        if(!empty($this->Auth->user('id'))){
        $product = $this->Products->get($id, [
            'contain' => ['Galleries']
        ]);
      if($this->Auth->user('id') == $product['user_id']){  
        if ($this->request->is(['patch', 'post', 'put'])) {
      

            if ($this->request->data['image'] != 1) {   
                 

                $image = $this->request->data['image'];
	        $name = time().$image['name'];
		$tmp_name = $image['tmp_name'];
		$upload_path = WWW_ROOT.'images/products/'.$name;
		move_uploaded_file($tmp_name, $upload_path);
                $this->request->data['image'] = $name;
               }else {
                    unset($this->request->data['image']);
                }
            $this->request->data['user_id'] = $this->Auth->user('id');    
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $saveproduct = $this->Products->save($product);
            if ($saveproduct) {
                
                
                
                if(isset($this->request->data['images'])){
                  if ($this->request->data['images'][0]['name'] != '') {   
                    for($i=0; $i<count($this->request->data['images']);$i++){
                        $fileName = $this->request->data['images'][$i]['name'];
                        $fileName = date('His') . $fileName;
                        $uploadPath = WWW_ROOT.'images/gallery/'.$fileName; 
                        $actual_file[] = $fileName;
                        move_uploaded_file($this->request->data['images'][$i]['tmp_name'], $uploadPath);
                        $post['product_id'] = $saveproduct['id'];
                        $post['image']    = $fileName;
                        $gallery = $this->Galleries->newEntity();                    
                        $gallery = $this->Galleries->patchEntity($gallery,$post);            
                        $this->Galleries->save($gallery);
                    } 
                  }else {
                    unset($this->request->data['images']);
                }    
                }   

                $response['status'] = true;
                $response['msg'] = 'The product has been saved.';
            }else{
                $response['status'] = false; 
                $response['msg'] = 'The product could not be saved. Please, try again.';
            }
            echo json_encode($response);
            exit; 
            

        }
    
     }else{  
          $this->Flash->error(__('You have no access'));  
          return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
      }    
        
        
     }else{  
          $this->Flash->error(__('You must login first'));
          return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
      }   
        $cats = $this->Products->Categories->find('treeList', ['limit' => 200]); 
        $stores = $this->Products->Stores->find('list', ['limit' => 200]);
        $this->set(compact('product', 'cats', 'stores'));
        $this->set('_serialize', ['product']);  
    }  

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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

        return $this->redirect(['controller'=>'users','action' => 'myproduct']);
    }
 
    
      public function freesaleproduct(){  
      if($this->Auth->user('id')){ 
          if($this->request->is('post')){
              if(!empty($saleproduct)){
             $this->Products->updateAll(array('free_sale' =>0), array('user_id' =>$this->Auth->user('id')));    
             $saleproduct = $this->request->data['saleproduct'];  
             $product = $this->Products->get($saleproduct);  
             $product['free_sale'] = 1;
             if($this->Products->save($product)){
                 $this->Flash->success(__('The product has been Added on free sale.'));
             }else{
                $this->Flash->error(__('The product could not be saved. Please, try again.'));   
             }
             
              }else{
                $this->Flash->error(__('Please select product.'));      
              }  
          }  
        $userproduct  = $this->Products->find('all',array('contain'=>['Users'],'conditions'=>array('Products.user_id'=>$this->Auth->user('id'))));
        $userproduct  = $userproduct->all();   

        }else {
           return $this->redirect(['controller' => 'stores', 'action' => 'index']);    
        }
        
       $bonus = $this->Products->find('all',['contain' => ['Categories','Users'],'conditions'=>['Products.user_id'=>$this->Auth->user('id'),'Products.free_sale'=>1]]) ;
       $bonus = $bonus->first();   

        $this->set(compact('userproduct','bonus'));      
        $this->set('_serialize', ['userproduct','bonus']);    
    } 
    
    
    /************************Add to Cart module********************************/
    
      public function addtocart() {
        $this->loadModel('Carts');
        if ($this->request->is('post')) {
             $uid = $this->Auth->user('id');
             if(!empty($uid)){ 
               $uid = $uid;  
             }else{
                 $uid = 0 ;
             }
            $id = $this->request->data['id'];  

            $quantity = isset($this->request->data['quantity']) ? $this->request->data['quantity'] : null;

            $productmodId = isset($this->request->data['mods']) ? $this->request->data['mods'] : null;
            $exits = $this->Carts->find('all',array('conditions'=>array('AND'=>array('Carts.product_id'=>$id,'Carts.sessionid'=>$this->request->session()->id()))));
            $exits = $exits->first(); 
            if(!empty($exits)){
              $this->Flash->success(__('Product is already added in your cart.'));   
             // $product = true; 
            }else{
            $product = $this->Cart->add($id, $quantity, $productmodId,$uid); 
                if(!empty($product)) { 
                    $this->Flash->success(__($product['name'] . ' is added to your cart successfully.'));
                } else {  
                     $this->Flash->error(__('Unable to add this product to your shopping cart.'));

                } 
            
            }
        }  
        
        $this->redirect($this->referer());
    }
    
    public function addsellproduct(){
      if(!empty($this->Auth->user('id'))) { 
        
       $this->loadModel('Galleries');   
       $product = $this->Products->newEntity();
      // $this->autoRender = false;        

     if ($this->request->is('post')) {
            
                $image = $this->request->data['images'][0];
                if(!empty($image['name'])){
	        $name = time().$image['name'];
		$tmp_name = $image['tmp_name'];
		$upload_path = WWW_ROOT.'images/products/'.$name;
		move_uploaded_file($tmp_name, $upload_path);
            $this->request->data['image'] = $name;
                }else{  
                    $this->request->data['image'] = '';
                }
            $this->request->data['user_id'] = $this->Auth->user('id');  
            $this->request->data['slug'] =$this->slugify($this->request->data['name']);
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $saveproduct = $this->Products->save($product);
            if ($saveproduct) {
                
                
                
                if(isset($this->request->data['images'])){
                    for($i=0; $i<count($this->request->data['images']);$i++){
                        $fileName = $this->request->data['images'][$i]['name'];
                        $fileName = date('His') . $fileName;
                        $uploadPath = WWW_ROOT.'images/gallery/'.$fileName; 
                        $actual_file[] = $fileName;
                        move_uploaded_file($this->request->data['images'][$i]['tmp_name'], $uploadPath);
                        $post['product_id'] = $saveproduct['id'];
                        $post['image']    = $fileName;
                        $gallery = $this->Galleries->newEntity();                    
                        $gallery = $this->Galleries->patchEntity($gallery,$post);            
                        $this->Galleries->save($gallery);
                    } 
                }   

                $response['status'] = true;
                $response['msg'] = 'The product has been saved.';
            }else{
                $response['status'] = false; 
                $response['msg'] = 'The product could not be saved. Please, try again.';
            }
            echo json_encode($response);
            exit;   
        }else{
     $cats = $this->Products->Categories->find('treeList', ['limit' => 300]); 
     $this->set(compact('cats','product'));    
     $this->set('_serialize', ['product','cats']);     
    }  
      }else{
          $this->Flash->error(__('You must login first'));
          return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
      }    
    }
    
    public function currencyconverter() { 
     
     if ($this->request->is(array('post','put'))) {       
        $amount = $this->request->data['amount'];
        $from_Currency = $this->request->data['from_currency'];
        $to_Currency = $this->request->data['to_currency'];
     
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);
        $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);

      
     }  
      echo json_encode($converted_currency);   
        exit;    
    }
    
    
    public function gallerydelete(){
        $this->loadModel('Galleries');
        $this->request->allowMethod(['post', 'delete']);
        if($this->request->is('post')){
            
             $id = $this->request->data['id']; 
             $product = $this->Galleries->get($id);
        if ($this->Galleries->delete($product)) {
            $response['status'] = true;
            $response['msg'] = 'The gallery image has been deleted';
        
        } else {
            $response['status'] = false;
            $response['msg'] = 'The product could not be deleted. Please, try again.';
        
        }    
            
        } 
    echo json_encode($response);
    exit;
        
    }
    
    public function savereview(){
            $this->loadModel('Reviews');
           if ($this->request->is('post')) {
//            $product_id = $this->request->data['product_id'];
//            $name  = $this->request->data['name'];
//            $email = $this->request->data['email'];
//            $punctuality =  $this->request->data['punctuality'];
//            $text =  $this->request->data['text'];
//            $uid = $this->request->data['Review']['uid'];
//            
//            $this->request->data['Review']['product_id'] = $product_id;
//            $this->request->data['Review']['name'] = $name;
//            $this->request->data['Review']['email'] = $email;
//           // $this->request->data['Review']['food_quality'] = $food_quality;
//            //$this->request->data['Review']['price'] = $price;
//            $this->request->data['Review']['punctuality'] = $punctuality;
//           // $this->request->data['Review']['courtesy'] = $courtesy;
//            $this->request->data['Review']['text'] = $text;
//            $this->request->data['Review']['uid'] = $uid;
//	if(isset($_POST['prod_avg_rate'])){
//		$reve	= $_POST['prod_avg_rate'];
//		$av_reiew = $reve?$reve:1;
//   $this->Product->updateAll(array('Product.avg_rating' =>$av_reiew),
//    array('Product.id' => $product_id));
//	}
//            $cnt = $this->Review->find('count', array('conditions' => array('AND' => array('Review.uid' => $uid, 'Review.product_id' => $product_id))));
//            if ($cnt == 0) {
//                $this->Review->save($this->request->data);
//               $this->Session->setFlash('Thanks for review', 'flash_success');
//               return $this->redirect('http://' .$_POST['server']);
//            } else {
//                
//               $this->Session->setFlash('You have been already submitted the review', 'flash_success');
//               return $this->redirect('http://' .$_POST['server']);
//            }
//         
      }  
  
    }
     
     
    
} 
