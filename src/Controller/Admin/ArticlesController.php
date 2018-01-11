<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Error\Debugger;  
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

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin');
            if($this->Auth->user() && $this->Auth->user('role') !='admin'){
              $this->Auth->logout();
              //  $this->viewBuilder()->setLayout('admin');
            }

        }

        $this->Auth->allow(['add','index','edit','delete']); 
  
        $this->authcontent();  

    } 
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $articles = $this->paginate($this->Articles);

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
	
		$page = $this->Articles->find('all', [
			'conditions' => ['Articles.id' => $id]
		]);
		
		$page = $page->first();
		
		$this->set('articles', $page); 
        $this->set('_serialize', ['articles']);
	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $articles = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $articles = $this->Articles->patchEntity($articles, $this->request->getData());
            if ($this->Articles->save($articles)) {
                $this->Flash->success(__('The articles has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The articles could not be saved. Please, try again.'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articles = $this->Articles->patchEntity($articles, $this->request->getData());
            if ($this->Articles->save($articles)) {
                $this->Flash->success(__('The articles has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The articles could not be saved. Please, try again.'));
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
