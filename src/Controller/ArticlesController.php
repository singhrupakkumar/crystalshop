<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
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
        $this->Auth->allow(['view']);
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
        $this->set('_serialize', ['page']);
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
        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
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
        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);    
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
