<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Kantei Controller
 *
 * @method \App\Model\Entity\Kantei[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KanteiController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Qreki');
        $this->loadComponent('Shuku');
        $this->loadComponent('Jukkan');
        $this->loadComponent('Zero');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //$kantei = $this->paginate($this->Kantei);

        //$this->set(compact('kantei'));
    }

    public function personaldestiny()
    {
        $shuku = '';
        $jukkan = '';
        $zero = '';
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $shuku = $this->Shuku->getShuku($data['dob']);
            $jukkan = $this->Jukkan->getJukkan($data['dob']);
            $zero = $this->Zero->getZero($data['dob']);
        }
        $lifeSteps = $this->Zero->getLifeSteps();
        $this->set(compact(['shuku', 'jukkan', 'zero', 'lifeSteps']));
    }

    public function teamdestiny()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $teamdobs = explode("\n", str_replace(["\r\n", "\r", "\n"], "\n", $data['teamdob']));
            $lifeSteps = $this->Zero->getLifeSteps();
            $outputData = [];
            foreach ($teamdobs as $key => $teamdob) {
                $shuku = '';
                $jukkan = '';
                $zero = '';

                if (strpos($teamdob, ',') !== false) {
                    $targetData = explode(',', $teamdob); //0:姓, 1:名, 2:ふりがな, 3:DOB
                } else {
                    $targetData = explode("\t", $teamdob); //0:姓, 1:名, 2:ふりがな, 3:DOB
                }
                if (!is_array($targetData)) {
                    continue;
                } //配列でなければ次へ
                $shuku = $this->Shuku->getShuku($targetData[3]);
                $jukkan = $this->Jukkan->getJukkan($targetData[3]);
                $zero = $this->Zero->getZero($targetData[3]);

                $targetData['syukuName'] = $shuku['name'];
                $targetData['syukuYomi'] = $shuku['yomi'];
                $targetData['syukuDescription'] = $shuku['description'];
                $targetData['jukkanName'] = $jukkan['name'];
                $targetData['jukkanYomi'] = $jukkan['yomi'];
                $targetData['jukkanDescription'] = $jukkan['description'];
                $targetData['zeroName'] = $zero['name'];
                $targetData['zeroDescription'] = $zero['description'];
                $targetData['lifeStepName'] = $lifeSteps[$zero['destinyNum']]['name'];
                $targetData['lifeStepDescription'] = $lifeSteps[$zero['destinyNum']]['description'];

                $outputData[] = $targetData;
            }
        }
        $this->set(compact(['outputData']));
    }

    /**
     * View method
     *
     * @param string|null $id Kantei id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $kantei = $this->Kantei->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('kantei'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $kantei = $this->Kantei->newEmptyEntity();
        if ($this->request->is('post')) {
            $kantei = $this->Kantei->patchEntity($kantei, $this->request->getData());
            if ($this->Kantei->save($kantei)) {
                $this->Flash->success(__('The kantei has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kantei could not be saved. Please, try again.'));
        }
        $this->set(compact('kantei'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Kantei id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $kantei = $this->Kantei->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $kantei = $this->Kantei->patchEntity($kantei, $this->request->getData());
            if ($this->Kantei->save($kantei)) {
                $this->Flash->success(__('The kantei has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The kantei could not be saved. Please, try again.'));
        }
        $this->set(compact('kantei'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Kantei id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $kantei = $this->Kantei->get($id);
        if ($this->Kantei->delete($kantei)) {
            $this->Flash->success(__('The kantei has been deleted.'));
        } else {
            $this->Flash->error(__('The kantei could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
