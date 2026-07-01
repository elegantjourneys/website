<?php

declare(strict_types=1);

namespace Admin\Controller;

use Admin\Controller\AppController;

class ManagePagesController extends AppController
{

    public function managePage($id = null)
    {
        $this->viewBuilder()->setLayout('content');
        $this->set("page_title", ['0' => 'CMS', '1' => 'Manage Page']);

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
        $this->render("manage_page");
    }

    public function sectionListing($id = '')
    {
        $this->viewBuilder()->setLayout('content');
        $this->set("page_title", ['0' => 'Manage Pages', '1' => 'List Sections']);

        $pageId = $id ?: $this->request->getQuery('page_id');

        $CmsPages = $this->fetchTable('CmsPages');
        $CmsContents = $this->fetchTable('CmsContents');

        $cmsPage = $CmsPages->get($pageId);

        $query = $CmsContents->find()
            ->select([
                'CmsContents.id',
                'CmsContents.name',
                'CmsContents.code',
                'CmsContents.page_id',
                'category_name' => 'CmsContentCategories.name',
                'category_code' => 'CmsContentCategories.code'
            ])
            ->leftJoin(
                ['CmsContentCategories' => 'cms_content_categories'],
                ['CmsContentCategories.id = CmsContents.content_category_id']
            )
            ->where(['CmsContents.parent_id' => 0]);

        if (!empty($pageId)) {
            $query->where(['CmsContents.page_id' => $pageId]);
        }

        $this->paginate = [
            'limit' => 60,
            'order' => [
                'CmsContentCategories.id' => 'ASC',
                'CmsContents.id' => 'ASC'
            ]
        ];

        $sections = $this->paginate($query);

        $this->set(compact('sections', 'pageId', 'cmsPage'));
        $this->render("section_listing");
    }

    public function sectionAddEdit($pageId = null, $id = null)
    {
        $this->viewBuilder()->setLayout('content');
        $this->set("page_title", ['0' => 'Manage Pages', '1' => 'Manage Sections', '2' => $id ? 'Edit Section' : 'Add Section']);

        //print_r($this->request->getData());exit;
        $CmsPages = $this->fetchTable('CmsPages');
        $cmsPage = $CmsPages->get($pageId);

        $CmsContents = $this->fetchTable('CmsContents');
        $CmsContentCategories = $this->fetchTable('CmsContentCategories');
        $contentCategories = $CmsContentCategories->find('list')->toArray();

        $CmsContentDescriptions = $this->fetchTable('CmsContentDescriptions');

        $generalData = [];
        if ($id) {
            $section = $CmsContents->get($id);
            $generalData = $CmsContentDescriptions->find()
                ->where(['cms_content_id' => $id])
                ->order(['order_sequence' => 'ASC'])
                ->toArray();
        } else {
            $section = $CmsContents->newEmptyEntity();
        }

        $CmsContentVideos = $this->fetchTable('CmsContentVideos');

        $videoData = [];
        if ($id) {
            $videoData = $CmsContentVideos->find()
                ->where(['cms_content_id' => $id])
                ->order(['order_sequence' => 'ASC'])
                ->toArray();
        }

        $CmsContentImages = $this->fetchTable('CmsContentImages');

        $imageData = [];
        if ($id) {
            $imageData = $CmsContentImages->find()
                ->where(['cms_content_id' => $id])
                ->order(['order_sequence' => 'ASC'])
                ->toArray();
        }

        $CmsContentItineraries = $this->fetchTable('CmsContentItineraries');
        $CmsContentItineraryDays = $this->fetchTable('CmsContentItineraryDays');
        $CmsContentItineraryDescriptions = $this->fetchTable('CmsContentItineraryDescriptions');

        $itineraryData = null;

        if ($id) {
            $itineraryData = $CmsContentItineraries->find()
                ->where(['cms_content_id' => $id])
                ->contain([
                    'CmsContentItineraryDays' => [
                        'CmsContentItineraryDescriptions'
                    ]
                ])
                ->first();
        }



        // Always set page_id from URL parameter
        if ($pageId) {
            $section->page_id = $pageId;
        }

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // Keep only selected section data
            $type = $data['content_category_id'] ?? null;





            if ($type != 1) {
                unset($data['general']);
            }
            if ($type != 2) {
                unset($data['price']);
            }
            if ($type != 3) {
                unset($data['videos']);
            }

            if ($type != 4) {
                unset($data['images']);
            }
            if ($type != 5) {
                unset($data['itinerary']);
            }

            // Force page_id into data before save
            if ($pageId) {
                $data['page_id'] = $pageId;
            }

            $section = $CmsContents->patchEntity($section, $data);

            if ($CmsContents->save($section)) {

                // DELETE OLD RECORDS (for edit case)
                if ($id && ($type == 1) && !empty($data['general'])) {
                    $CmsContentDescriptions->deleteAll([
                        'cms_content_id' => $section->id
                    ]);
                }
                // Delete old videos
                if ($id && ($type == 3) && !empty($data['videos'])) {
                    $CmsContentVideos->deleteAll([
                        'cms_content_id' => $section->id
                    ]);
                }
                // Delete old images
                if ($id && $type == 4) {
                    $CmsContentImages->deleteAll([
                        'cms_content_id' => $section->id
                    ]);
                }
                // SAVE NEW GENERAL SECTION DATA

                if ($type == 1 && !empty($data['general'])) {
                    foreach ($data['general'] as $key => $row) {
                        if (!empty($row['title']) || !empty($row['description'])) {
                            $desc = $CmsContentDescriptions->newEmptyEntity();
                            $desc->cms_content_id = $section->id;
                            $desc->title = $row['title'];
                            $desc->description = $row['description'];
                            $desc->order_sequence = $key;

                            $CmsContentDescriptions->save($desc);
                        }
                    }
                }

                if ($type == 3 && !empty($data['videos'])) {
                    foreach ($data['videos'] as $key => $row) {

                        if (!empty($row['video_url'])) {

                            $video = $CmsContentVideos->newEmptyEntity();
                            $video->cms_content_id = $section->id;
                            $video->title = $row['title'] ?? null;
                            $video->video_url = $row['video_url'];
                            $video->video_type = $row['video_type'] ?? 'internal';
                            $video->order_sequence = $key;

                            $CmsContentVideos->save($video);
                        }
                    }
                }

                if ($type == 4 && !empty($data['images'])) {

                    foreach ($data['images'] as $key => $row) {

                        $filename = $row['old_image'] ?? null; // default = old image

                        // ✅ If new file uploaded
                        if (!empty($row['image']['name'])) {

                            $file = $row['image'];

                            $filename = time() . '_' . $file['name'];
                            $uploadPath = WWW_ROOT . 'trains/assets/images/' . $filename;

                            move_uploaded_file($file['tmp_name'], $uploadPath);
                        }

                        // ✅ Save record (even if only title changed)
                        if (!empty($filename)) {

                            $img = $CmsContentImages->newEmptyEntity();
                            $img->cms_content_id = $section->id;
                            $img->title = $row['title'] ?? null;
                            $img->image = $filename;
                            $img->order_sequence = $key;

                            $CmsContentImages->save($img);
                        }
                    }
                }

                if ($type == 5 && !empty($data['itinerary'])) {

                    $itData = $data['itinerary'];

                    // ======================
                    // LOAD EXISTING OR NEW
                    // ======================
                    $itinerary = $CmsContentItineraries->find()
                        ->where(['cms_content_id' => $section->id])
                        ->first();

                    if (!$itinerary) {
                        $itinerary = $CmsContentItineraries->newEmptyEntity();
                    }

                    // ======================
                    // IMAGE
                    // ======================
                    $filename = $itData['old_image'] ?? null;

                    if (!empty($itData['image']['name'])) {
                        $file = $itData['image'];

                        $filename = time() . '_' . rand(1000, 9999) . '_' . $file['name'];
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'trains/assets/images/' . $filename);
                    }

                    // ======================
                    // SAVE MAIN
                    // ======================
                    $itinerary->cms_content_id = $section->id;
                    $itinerary->title = $itData['title'] ?? null;
                    $itinerary->page_url = $itData['page_url'] ?? null;
                    $itinerary->total_days = $itData['total_days'] ?? 0;
                    $itinerary->image = $filename;

                    $CmsContentItineraries->save($itinerary);

                    // ======================
                    // HANDLE DELETE DAYS
                    // ======================
                   
                    $conditions = [
                        'cms_content_itinerary_id' => $itinerary->id
                    ];

                    if (!empty($submittedDayIds)) {
                        $conditions['id NOT IN'] = $submittedDayIds;
                    }

                    // 🔥 Get days to delete
                    $daysToDelete = $CmsContentItineraryDays->find()
                        ->where($conditions)
                        ->all();

                    foreach ($daysToDelete as $day) {

                        // 🔥 Delete descriptions first
                        $CmsContentItineraryDescriptions->deleteAll([
                            'cms_content_itinerary_day_id' => $day->id
                        ]);

                        // 🔥 Then delete day
                        $CmsContentItineraryDays->delete($day);
                    }

                    // ======================
                    // SAVE DAYS
                    // ======================
                    foreach ($itData['days'] as $dKey => $dayRow) {

                        if (!empty($dayRow['id'])) {
                            $day = $CmsContentItineraryDays->find()
                                ->where(['id' => $dayRow['id']])
                                ->first();

                            if (!$day) {
                                $day = $CmsContentItineraryDays->newEmptyEntity();
                            }
                        } else {
                            $day = $CmsContentItineraryDays->newEmptyEntity();
                        }

                        $day->cms_content_itinerary_id = $itinerary->id;
                        $day->day_count = $dKey + 1;
                        $day->week_day = $dayRow['week_day'] ?? null;
                        $day->city = $dayRow['city'] ?? null;
                        $day->title = $dayRow['title'] ?? null;

                        $CmsContentItineraryDays->save($day);

                        // ======================
                        // DESCRIPTIONS
                        // ======================
                        $CmsContentItineraryDescriptions->deleteAll([
                            'cms_content_itinerary_day_id' => $day->id
                        ]);

                        if (!empty($dayRow['descriptions'])) {
                            foreach ($dayRow['descriptions'] as $desc) {

                                if (!empty($desc)) {
                                    $descEntity = $CmsContentItineraryDescriptions->newEmptyEntity();
                                    $descEntity->cms_content_id = $section->id;
                                    $descEntity->cms_content_itinerary_day_id = $day->id;
                                    $descEntity->description = $desc;

                                    $CmsContentItineraryDescriptions->save($descEntity);
                                }
                            }
                        }
                    }
                }

                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect([
                    'action' => 'sectionListing',
                    $pageId
                ]);
            }

            $this->Flash->error(__('The section could not be saved. Please, try again.'));
        }

        $this->set(compact('section', 'contentCategories', 'pageId', 'cmsPage', 'generalData', 'videoData', 'imageData', 'itineraryData'));
        $this->render("section_add_edit");
    }
    public function sectionDelete($pageId = null, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $CmsContents = $this->fetchTable('CmsContents');
        $section = $CmsContents->get($id);
        $pageId = $section->page_id;

        if ($CmsContents->delete($section)) {
            $this->Flash->success(__('The section has been deleted.'));
        } else {
            $this->Flash->error(__('The section could not be deleted. Please, try again.'));
        }

        return $this->redirect([
            'action' => 'sectionListing',
            '?' => ['page_id' => $pageId]
        ]);
    }

    public function seoAddEdit($pageId = null)
    {
        $this->viewBuilder()->setLayout('content');
        $this->set("page_title", ['0' => 'Manage Pages', '1' => 'Manage SEO']);

        $CmsPages = $this->fetchTable('CmsPages');


        $cmsPage = $CmsPages->get($pageId, [
            'contain' => ['CmsPageSeoTags']
        ]);

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // ensure cms_page_id set
            if (!empty($data['cms_page_seo_tag'])) {
                $data['cms_page_seo_tag']['cms_page_id'] = $pageId;
            }

            $cmsPage = $CmsPages->patchEntity($cmsPage, $data, [
                'associated' => ['CmsPageSeoTags']
            ]);

            if ($CmsPages->save($cmsPage)) {
                $this->Flash->success(__('The SEO settings have been saved.'));
                return $this->redirect(['action' => 'managePage', $pageId]);
            }

            $this->Flash->error(__('The SEO settings could not be saved.'));
        }

        $this->set(compact('cmsPage'));
        $this->render("seo_add_edit");
    }
}
