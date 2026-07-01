<?php

declare(strict_types=1);

namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * CMS Controller
 *
 * @method \UserAdmin\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CmsController extends AppController
{
    
    public function listing()
    {
        $this->viewBuilder()->setLayout('content');
        $this->set("page_title", ['0' => 'CMS', '1' => 'Page Listing']);

        $CmsPages = $this->fetchTable('CmsPages');
        $this->paginate = [
            'order' => ['id' => 'DESC'],
            'limit' => 20
        ];

        $cmsPages = $this->paginate($CmsPages);
        $this->set(compact('cmsPages'));
        $this->render("listing");
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('content');
        $this->set("page_title", ['0' => 'CMS', '1' => 'Add Page']);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $CmsPages = $this->fetchTable('CmsPages');
            $cmsPage = $CmsPages->newEmptyEntity();
            $cmsPage = $CmsPages->patchEntity($cmsPage, $data);
            if ($CmsPages->save($cmsPage)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'listing']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }

        $this->render("add_edit");
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('content');
        $this->set("page_title", ['0' => 'CMS', '1' => 'Edit Page']);

        $CmsPages = $this->fetchTable('CmsPages');
        $cmsPage = $CmsPages->get($id);

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $cmsPage = $CmsPages->patchEntity($cmsPage, $data);
            if ($CmsPages->save($cmsPage)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'listing']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }

        $this->set(compact('cmsPage'));
        $this->render("add_edit");
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $CmsPages = $this->fetchTable('CmsPages');
        $cmsPage = $CmsPages->get($id);
        if ($CmsPages->delete($cmsPage)) {
            $this->Flash->success(__('The page has been deleted.'));
        } else {
            $this->Flash->error(__('The page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'listing']);
    }
}
