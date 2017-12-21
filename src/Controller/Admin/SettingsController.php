<?php
namespace App\Controller\Admin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Staticpages Controller
 *
 * @property \App\Model\Table\StaticpagesTable $Staticpages
 *
 * @method \App\Model\Entity\Staticpage[] paginate($object = null, array $settings = [])
 */
class SettingsController extends AppController
{

	public function beforeFilter(Event $event) {

        parent::beforeFilter($event);

        if ($this->request->params['prefix'] == 'admin') {

            $this->viewBuilder()->setLayout('admin');
             $this->Auth->logout();

        }

        $this->Auth->allow(['index']);

        $this->authcontent();

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
         if ($this->request->is(array('post', 'put'))) {

            foreach ($this->request->data as $setting_key=>$setting_value){
                 
               $this->Settings->updateAll(['value'=>"$setting_value"],['key'=>$setting_key]);          
            }
            
             $this->Flash->success(__('Settings updated!'));
        
             
         }
        
        $settings = $this->Settings->find('all',[
			'order'		=>  ['Settings.id' => 'ASC']
		]);
		
	$settings = $settings->all()->toArray();

        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }


}
