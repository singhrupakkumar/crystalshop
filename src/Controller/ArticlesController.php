<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router; 
/**
 * Staticpages Controller
 *
 * @property \App\Model\Table\StaticpagesTable $Staticpages
 *
 * @method \App\Model\Entity\Staticpage[] paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
	
	public function beforeFilter(Event $event) { 
        parent::beforeFilter($event);
        $this->Auth->allow(['view','add','index','all']);
        $this->authcontent();
    } 
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
          $this->paginate = [
            'contain' => ['Categories'],'conditions'=>['Articles.user_id'=>$this->Auth->user('id')]  
        ];  
        $articles = $this->paginate($this->Articles)->toArray();  
 
        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
    }
    
        public function all()
    {
          $this->paginate = [
            'contain' => ['Categories'],'conditions'=>['Articles.status'=>1]  
        ];    
        $articles = $this->paginate($this->Articles)->toArray();  
 
        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
    }

    /**
     * View method
     *
     * @param string|null $id Staticpage id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function view($id = null)
    {
        $staticpage = $this->Staticpages->get($id, [
            'contain' => []
        ]);

        $this->set('staticpage', $staticpage);
        $this->set('_serialize', ['staticpage']);
    }*/
	
	public function view($id = null){
	
		$articles = $this->Articles->find('all', [
			'conditions' => ['Articles.id' => $id]
		]);
		      
		$articles = $articles->first();
		
		$this->set('articles', $articles);
        $this->set('_serialize', ['articles']);
	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       if(!empty($this->Auth->user('id'))) { 
        $articles = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $post = $this->request->data;  
            if(!empty($this->Auth->user('id'))){
             $post['user_id'] =  $this->Auth->user('id');
            }else{  
                  $post['user_id'] = 0;  
            }
            $articles = $this->Articles->patchEntity($articles, $post);
            if ($this->Articles->save($articles)) {  
                $this->Flash->success(__('The articles has been saved.'));
                return $this->redirect(['action' => 'index']);  
            }else{
              $this->Flash->error(__('The articles could not be saved. Please, try again.'));    
            }
          
        }
        
     }else{  
          $this->Flash->error(__('Please login to the website in order to have access to the request.'));
          return $this->redirect(['controller' => 'stores', 'action' => 'index']);      
      }
         $categories = $this->Articles->Categories->find('list');      
        $this->set(compact('articles','categories'));
        $this->set('_serialize', ['articles','categories']);   
    }

    /**
     * Edit method
     *
     * @param string|null $id articles id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $articles = $this->Articles->get($id, [
            'contain' => []
        ]);
        
        if($articles['user_id'] == $this->Auth->user('id')){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articles = $this->Articles->patchEntity($articles, $this->request->getData());
            if ($this->Articles->save($articles)) {
                $this->Flash->success(__('The articles has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The articles could not be saved. Please, try again.'));
        }
        }else{ 
          $this->Flash->error(__('You have a no authorize to access.'));
          return $this->redirect(['action' => 'index']);   
        }
       $categories = $this->Articles->Categories->find('list');    
        $this->set(compact('articles','categories'));
        $this->set('_serialize', ['articles','categories']);     
    }

    /**
     * Delete method
     *
     * @param string|null $id articles id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $articles = $this->Articles->get($id);
        if ($this->Articles->delete($articles)) {
            $this->Flash->success(__('The articles has been deleted.'));
        } else {
            $this->Flash->error(__('The articles could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
