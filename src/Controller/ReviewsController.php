<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 *
 * @method \App\Model\Entity\Review[] paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{

	public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view', 'addReview']);
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
            'contain' => ['Trainers', 'Users']
        ];
        $reviews = $this->paginate($this->Reviews);

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Trainers', 'Users']
        ]);

        $this->set('review', $review);
        $this->set('_serialize', ['review']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $review = $this->Reviews->newEntity();
        if ($this->request->is('post')) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $trainers = $this->Reviews->Trainers->find('list', ['limit' => 200]);
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $this->set(compact('review', 'trainers', 'users'));
        $this->set('_serialize', ['review']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $trainers = $this->Reviews->Trainers->find('list', ['limit' => 200]);
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $this->set(compact('review', 'trainers', 'users'));
        $this->set('_serialize', ['review']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function addreview(){
		
		$review = $this->Reviews->newEntity();
	
		if($this->request->is(['patch', 'post', 'put'])){
			
			$post = $this->request->getData();
			
			
			$post['user_id'] = $this->Auth->user('id');
			
			$review = $this->Reviews->patchEntity($review, $post);
			
			if($this->Reviews->save($review)){

				$reviews = $this->Reviews->find('all',[
					'conditions' => ['Reviews.trainer_id' => $post['trainer_id']]
				]);
				
				$reviews = $reviews->all();
				
				$review_total = 0;
				
				if(!empty($reviews)){
					foreach($reviews as $review){
						$review_total = $review_total + $review->rating;
					}
				}
				
				$avg_rating = $review_total/ count($reviews);
				
				$this->loadModel('Users');
				
				$this->Users->updateAll(array('avg_rating' => $avg_rating), array('id' => $this->request->data['trainer_id']));
				
				echo 'success';
				exit;			
			}else{
				echo 'error';
				exit;
			}
		}
	}
}
