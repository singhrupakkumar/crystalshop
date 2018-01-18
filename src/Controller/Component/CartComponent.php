<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;  

class CartComponent extends Component {  

//////////////////////////////////////////////////

    public $controller;

//////////////////////////////////////////////////

    public function __construct() {   
        $this->session = new Session();  
    }


    public $maxQuantity = 99;

//////////////////////////////////////////////////

    public function add($id, $quantity = 1, $productmodId = null,$uid = NUll) { 
       $this->Products = TableRegistry::get('Products');
      
        if(!is_numeric($quantity)) {  
            $quantity = 1;
        }

        if($quantity == 0) { 
            $this->remove($id); 
            return;
        }

        $product = $this->Products->find('all', array(
            'recursive' => -1,
            'contain' => array( 
                    'Users',
                    'Categories'
                ),
            'conditions' => array(
                'Products.id' => $id
            )
        ));
        
        
        if(empty($product)) {  
            return false;
        }    
        $product = $product->first(); 
  
        $data['product_id'] = $product['id'];  
        $data['name'] = $product['name'];
        $data['weight'] = $product['weight'];
        $data['uid'] = $uid;
        $data['price'] = $product['price'];    
        $data['quantity'] = $quantity; 
        $data['image'] = $product['image'];
        $data['seller_id'] = $product['user_id'];   
        $data['cat_id'] = $product['category']['id'];
        $data['subtotal'] = sprintf('%01.2f', $product['price'] * $quantity);
        $data['totalweight'] = sprintf('%01.2f', $product['weight'] * $quantity);
        $data['Products'] = $product;
     
        $this->session->write('Shop.OrderItem.' . $id, $data);
        $this->session->write('Shop.Order.shop', 1);    
        $this->Carts = TableRegistry::get('Carts');  
        $cartdata['sessionid'] = $this->session->id(); 
        $cartdata['quantity'] = $quantity;
        $cartdata['uid'] = $uid;  
        $cartdata['product_id'] = $product['id'];
        $cartdata['image'] = $product['image'];
        $cartdata['seller_id'] = $product['user_id'];     
        $cartdata['cat_id'] = $product['category']['id'];   
        $cartdata['name'] = $product['name'];
        $cartdata['weight'] = $product['weight'];
        $cartdata['weight_total'] = sprintf('%01.2f', $product['weight'] * $quantity);
        $cartdata['price'] = $product['price'];
        $cartdata['subtotal'] = sprintf('%01.2f', $product['price'] * $quantity);

        $existing = $this->Carts->find('all', array(  
            'recursive' => -1,
            'conditions' => array(
                'sessionid' => $this->session->id(),
                'product_id' => $product['id'],  
            )
        ));
         $existing =  $existing->first();  
        
        if($existing) {
            $cartdata['id'] = $existing['id'];
         
        } else {     
         $cart = $this->Carts->newEntity(); 
        } 
        $cartdata = $this->Carts->patchEntity($cart, $cartdata); 
        $this->Carts->save($cartdata);   
        $this->cart();  
        return $product; 
    }    

   //////////////////////////////////////////////////
      public function checkcrt($sid, $pid,$uid) { 
        $shop = TableRegistry::get('Carts')->find('all', array(
            'contain'=>['Products'],
            'conditions' => array(
                'AND' => array(
                    'Carts.sessionid' => $sid,
                    'Carts.product_id' => $pid,
		    'Carts.uid'=> $uid
        ))));
        $shop = $shop->all();   
        return $shop;
    }
    
  
    
    /////////////////////////////////////////////

    public function remove($id) {
        $this->Cart = TableRegistry::get('Carts');
        if($this->session->check('Shop.OrderItem.' . $id)) {
            $product = $this->session->read('Shop.OrderItem.' . $id); 
            $this->session->delete('Shop.OrderItem.' . $id); 

            $this->Cart->deleteAll(
                array(
                    'sessionid' => $this->session->id(),
                    'product_id' => $id, 
                ),
                false
            );

            $this->cart();
            return $product;
        }
        return false;
    }

//////////////////////////////////////////////////

    public function cart() { 
   
        $shop = $this->session->read('Shop');  
        $quantities = 0;
        $weight = 0;
        $subtotal = 0;
        $total = 0;
        $order_item_count = 0;

        if (count($shop['OrderItem']) > 0) { 
            foreach ($shop['OrderItem'] as $item) {
                $quantities += $item['quantity'];
                $weight += $item['totalweight'];
                $subtotal += $item['subtotal'];
                $total += $item['subtotal'];
                $order_item_count++;
            }
            $d['order_item_count'] = $order_item_count;   
            $d['quantity'] = $quantities;
            $d['weight'] = sprintf('%01.2f', $weight);
            $d['subtotal'] = sprintf('%01.2f', $subtotal);
            $d['total'] = sprintf('%01.2f', $total);
            $this->session->write('cartcount',$order_item_count);
            $this->session->write('Shop.Order', $d + $shop['Order']);
            return true; 
        }
        else { 
            $d['quantity'] = 0;
            $d['weight'] = 0;
            $d['subtotal'] = 0; 
            $d['total'] = 0; 
            $this->session->write('cartcount',0);
            $this->session->write('Shop.Order', $d + $shop['Order']);
            return false; 
        }
    }

//////////////////////////////////////////////////

    public function clear() {
       
         TableRegistry::get('Carts')->deleteAll(array('sessionid' => $this->session->id()), false);
        $this->session->delete('Shop');  
    }
  
//////////////////////////////////////////////////

}  
   