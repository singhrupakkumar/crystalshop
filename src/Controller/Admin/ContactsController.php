<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\Mailer\Email;
/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 *
 * @method \App\Model\Entity\Contact[] paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
	
	
	public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin');

        }

        $this->Auth->allow();

        $this->authcontent();

    }
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $contacts = $this->Contacts->find('all', [
			'order' => ['Contacts.id' => 'desc']
		]);
		
		$contacts = $contacts->all()->toArray();

        $this->set(compact('contacts'));
        $this->set('_serialize', ['contacts']);
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);

        $this->set('contact', $contact);
        $this->set('_serialize', ['contact']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
			
				$ms = '<table width="200" border="1"><tr><th scope="row">Name</th><td>'.$this->request->data['name'].'</td></tr><tr><th scope="row">Email</th><td>'.$this->request->data['email'].'</td></tr><tr><th scope="row">Subject</th><td>'.$this->request->data['subject'].'</td></tr><th scope="row">Message</th><td>'.$this->request->data['message'].'</td></tr><tr><th scope="row">Reply</th><td>'.$this->request->data['status'].'</td></tr></table>';

			
				$email = new Email('default');

					$email->from(['gurpreet@avainfotech.com' => 'Trainer'])

							->emailFormat('html')

							->template('default', 'default')

							->to($this->request->data['email'])

							->subject('Contact Us Enquiry - Reply From Admin')

							->send($ms);
			
			
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }else{
            	$this->Flash->error(__('The contact could not be saved. Please, try again.'));
			}	
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     /**
     * 
     * @param type $id
     */
    public function changestatus($id = null) {
         $contact = $this->Contacts->get($id);
         $post['status'] = 1;    
         $user = $this->Contacts->patchEntity($contact, $post);
        if ($this->Contacts->save($contact)) {

            $this->Flash->success(__('Status change successfully.'));  

        } else {  

            $this->Flash->error(__('Unable to change.'));

        }
  


        return $this->redirect(['action' => 'index']);
    }
    
    
}
