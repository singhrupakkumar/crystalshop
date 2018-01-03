<?php
namespace App\Controller\Admin;      

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
            'contain' => ['OrderItems','Users']
        ];
        $orders = $this->paginate($this->Orders);
    
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']); 
    }


   
}
