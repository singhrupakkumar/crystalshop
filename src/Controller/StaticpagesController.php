<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Event\Event;
/**
 * Staticpages Controller
 *
 * @property \App\Model\Table\StaticpagesTable $Staticpages
 *
 * @method \App\Model\Entity\Staticpage[] paginate($object = null, array $settings = [])
 */
class StaticpagesController extends AppController
{
	
	public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['view','faq','contact','term','promoteproduct','writeanarticle','becomeaseller']);      
        $this->authcontent();    
    }
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $staticpages = $this->paginate($this->Staticpages);

        $this->set(compact('staticpages'));
        $this->set('_serialize', ['staticpages']);
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
	
	public function view($slug = null){
	
		$this->loadModel('Staticpages');
	
		$page = $this->Staticpages->find('all', [
			'conditions' => ['Staticpages.slug' => $slug]
		]);
		
		$page = $page->first();
		
		$this->set('page', $page);
        $this->set('_serialize', ['page']);
	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $staticpage = $this->Staticpages->newEntity();
        if ($this->request->is('post')) {
            $staticpage = $this->Staticpages->patchEntity($staticpage, $this->request->getData());
            if ($this->Staticpages->save($staticpage)) {
                $this->Flash->success(__('The staticpage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The staticpage could not be saved. Please, try again.'));
        }
        $this->set(compact('staticpage'));
        $this->set('_serialize', ['staticpage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Staticpage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $staticpage = $this->Staticpages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $staticpage = $this->Staticpages->patchEntity($staticpage, $this->request->getData());
            if ($this->Staticpages->save($staticpage)) {
                $this->Flash->success(__('The staticpage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The staticpage could not be saved. Please, try again.'));
        }
        $this->set(compact('staticpage'));
        $this->set('_serialize', ['staticpage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Staticpage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $staticpage = $this->Staticpages->get($id);
        if ($this->Staticpages->delete($staticpage)) {
            $this->Flash->success(__('The staticpage has been deleted.'));
        } else {
            $this->Flash->error(__('The staticpage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function aboutus(){
       $aboutus = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'about-us','Staticpages.status'=>1]]);
       $aboutus = $aboutus->first(); 
       
       $this->set(compact('aboutus'));   
       $this->set('_serialize', ['aboutus']);   
    }
    
    public function contact(){
        
           
     $this->loadModel('Contacts');
     $contact = $this->Contacts->newEntity();
    if($this->request->is('post')){    
       if(!empty($this->request->data['email'])){        
        
          $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {

                $ms = '<table width="200" border="1"><tr><th scope="row">Name</th><td>' . $this->request->data['name'] . '</td></tr><tr><th scope="row">Email</th><td>' . $this->request->data['email'] . '</td></tr><tr><th scope="row">Subject</th><td>' . $this->request->data['subject'] . '</td></tr><th scope="row">Message</th><td>' . $this->request->data['message'] . '</td></tr></table>';


                $email = new Email('default');

                $email->from(['rupak@avainfotech.com' => 'Earth Vendors'])
                        ->emailFormat('html')
                        ->template('default', 'default')
                        ->to('rupak@avainfotech.com')
                        ->subject('Contact Us Enquiry')
                        ->send($ms);


                $this->Flash->success(__('Thank you for contacting us! We will get back to you shortly.'));      
            } else {  
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            } 
           
       }else{
        $this->Flash->error(__('Email is requred'));    
       } 
  
    }   
       $contact = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'contact','Staticpages.status'=>1]]);
       $contact = $contact->first(); 
       
       $this->set(compact('contact'));   
       $this->set('_serialize', ['contact']);          
    
    }
    public function term(){
       $term = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'terms-and-conditions','Staticpages.status'=>1]]);
       $term = $term->first();
       $this->set(compact('term'));
       $this->set('_serialize', ['term']);     
    }
    
    public function privacy(){
       $privacy = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'privacy-policy','Staticpages.status'=>1]]);
       $privacy = $privacy->first();
       $this->set(compact('privacy'));
       $this->set('_serialize', ['privacy']); 
    }
    public function faq(){
       $faq = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'faq','Staticpages.status'=>1]]);
       $faq = $faq->first();  
    
       $this->set(compact('faq'));
       $this->set('_serialize', ['faq']);  
    }
    
    public function promoteproduct(){
       $promoteproduct = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'promoteproduct','Staticpages.status'=>1]]);
       $promoteproduct = $promoteproduct->first();  
    
       $this->set(compact('promoteproduct'));
       $this->set('_serialize', ['promoteproduct']);    
    }
    
     public function writeanarticle(){
       $promoteproduct = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'write-article','Staticpages.status'=>1]]);
       $promoteproduct = $promoteproduct->first();  
    
       $this->set(compact('promoteproduct'));
       $this->set('_serialize', ['promoteproduct']);    
    }
    
     public function becomeaseller(){
       $promoteproduct = $this->Staticpages->find('all',['conditions'=>['Staticpages.position'=>'become-a-seller','Staticpages.status'=>1]]);
       $promoteproduct = $promoteproduct->first();  
    
       $this->set(compact('promoteproduct'));
       $this->set('_serialize', ['promoteproduct']);    
    }
}
