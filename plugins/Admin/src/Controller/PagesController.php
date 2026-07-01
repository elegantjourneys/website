<?php

declare(strict_types=1);

namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;

class PagesController extends AppController
{

    private $breadcrumbTitles = [
        'meta' => ['0'=>'Head Section','1'=>'Meta'],
        'script' => ['0'=>'Head Section','1'=>'Script'],
        'logo' => ['0'=>'Header','1'=>'Logo'],
        'topheader' => ['0'=>'Header','1'=>'Top Section'],
        'headermenu' => ['0'=>'Header','1'=>'Menu Section'],
        'headerphone' => ['0'=>'Header','1'=>'Phone Section'],
        'bannerimage' => ['0'=>'Hero Section','1'=>'Banner Image'],
        'bannertext' => ['0'=>'Hero Section','1'=>'Hero Text'],
        'footermenu' => ['0'=>'Footer','1'=>'Footer Menu'],
        'phonesection' => ['0'=>'Footer','1'=>'Phone Section'],
        'footerimagesection' => ['0'=>'Footer','1'=>'Footer Image Section'],
        'footertext' => ['0'=>'Footer','1'=>'Footer Text'],
        'aboutus' => ['0'=>'About Us','1'=>'About Us'],
        'day1' => ['0'=>'Itinerary','1'=>'Day 1'],
        'day2' => ['0'=>'Itinerary','1'=>'Day 2'],
        'day3' => ['0'=>'Itinerary','1'=>'Day 3'],
        'day4' => ['0'=>'Itinerary','1'=>'Day 4'],
        'day5' => ['0'=>'Itinerary','1'=>'Day 5'],
        'day6' => ['0'=>'Itinerary','1'=>'Day 6'],
        'day7' => ['0'=>'Itinerary','1'=>'Day 7'],
        'day8' => ['0'=>'Itinerary','1'=>'Day 8'],
        'day9' => ['0'=>'Itinerary','1'=>'Day 9'],
        'day10' => ['0'=>'Itinerary','1'=>'Day 10'],
        'day11' => ['0'=>'Itinerary','1'=>'Day 11'],
        'day12' => ['0'=>'Itinerary','1'=>'Day 12'],
        'day13' => ['0'=>'Itinerary','1'=>'Day 13'],
        'day14' => ['0'=>'Itinerary','1'=>'Day 14'],
        'cabin1' => ['0'=>'Cabins','1'=>'Cabin 1'],
        'cabin2' => ['0'=>'Cabins','1'=>'Cabin 2'],
        'cabin3' => ['0'=>'Cabins','1'=>'Cabin 3'],
        'cabin4' => ['0'=>'Cabins','1'=>'Cabin 4'],
        'cabin5' => ['0'=>'Cabins','1'=>'Cabin 5'],
        'cabin6' => ['0'=>'Cabins','1'=>'Cabin 6'],
        'facility1' => ['0'=>'Facilities','1'=>'Facility 1'],
        'facility2' => ['0'=>'Facilities','1'=>'Facility 2'],
        'facility3' => ['0'=>'Facilities','1'=>'Facility 3'],
        'facility4' => ['0'=>'Facilities','1'=>'Facility 4'],
        'facility5' => ['0'=>'Facilities','1'=>'Facility 5'],
        'facility6' => ['0'=>'Facilities','1'=>'Facility 6'],
        'experience1' => ['0'=>'Experiences','1'=>'Experience 1'],
        'experience2' => ['0'=>'Experiences','1'=>'Experience 2'],
        'experience3' => ['0'=>'Experiences','1'=>'Experience 3'],
        'experience4' => ['0'=>'Experiences','1'=>'Experience 4'],
        'experience5' => ['0'=>'Experiences','1'=>'Experience 5'],
        'experience6' => ['0'=>'Experiences','1'=>'Experience 6'],
        'experience7' => ['0'=>'Experiences','1'=>'Experience 7'],
        'experience8' => ['0'=>'Experiences','1'=>'Experience 8'],
        'experience9' => ['0'=>'Experiences','1'=>'Experience 9'],
        'experience10' => ['0'=>'Experiences','1'=>'Experience 10'],
        'experience11' => ['0'=>'Experiences','1'=>'Experience 11'],
        'experience12' => ['0'=>'Experiences','1'=>'Experience 12'],
        'experience13' => ['0'=>'Experiences','1'=>'Experience 13'],
        'experience14' => ['0'=>'Experiences','1'=>'Experience 14'],
        'inclusions' => ['0'=>'Inclusions','1'=>'Inclusions'],
        'exclusions' => ['0'=>'Inclusions','1'=>'Exclusions'],
        'testimonialsvideos' => ['0'=>'Testimonials','1'=>'Film/Video'],
        'powfilm' => ['0'=>'Testimonials','1'=>'Film'],
        'powpdf' => ['0'=>'Testimonials','1'=>'Brochure'],
        'tarrif1' => ['0'=>'Tarrif','1'=>'Tarrif 1'],
        'tarrif2' => ['0'=>'Tarrif','1'=>'Tarrif 2'],
        'tarrif3' => ['0'=>'Tarrif','1'=>'Tarrif 3'],
        'tarrif4' => ['0'=>'Tarrif','1'=>'Tarrif 4'],
        'tnc' => ['0'=>'Terms & Conditions','1'=>'Terms & Conditions'],
        'tncp' => ['0'=>'Terms & Conditions','1'=>'Terms & Conditions Popup'],
        'tripextension' => ['0'=>'Trip Extension','1'=>'Trip Extension'],
        'tripextensionpop' => ['0'=>'Trip Extension','1'=>'Trip Extension Popup'],
        'contactus' => ['0'=>'Contact Us','1'=>'Contact Us Image'],
        'contactusheading' => ['0'=>'Contact Us','1'=>'Contact Us Heading'],
        'luxuarytrains' => ['0'=>'Luxuary Trains','1'=>'Luxuary Trains'],
    ];

    

    public function manageContent($code = "")
    {
        $this->viewBuilder()->setLayout('default');

        $defaultValue =[$code => ["0"=>"Menu","1"=>ucfirst($code)]];

        //print_r($defaultValue);exit;

        // Determine breadcrumb title from code
        $breadcrumbTitle = $this->breadcrumbTitles[$code] ?? $defaultValue[$code];

        $CmsContents = $this->fetchTable('CmsContents');
        $CmsContentDescriptions = $this->fetchTable('CmsContentDescriptions');



        // Get cms_content by code (or create new)
        $cmsContent = $CmsContents
            ->find()
            ->where(['code' => $code])
            ->first();

        if (!$cmsContent) {
            $cmsContent = $CmsContents->newEmptyEntity();
        }

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // Save or update cms_contents table
            $cmsContent->name = $code;
            $cmsContent->code = $code;

            if ($CmsContents->save($cmsContent)) {
                $cmsContentId = $cmsContent->id;

                // Save or update description table
                $descData = [
                    'cms_content_id' => $cmsContentId,
                    'title' => $data['cms_content_descriptions'][0]['title'] ?? '',
                    'description' => $data['cms_content_descriptions'][0]['description'] ?? '',
                ];

                // Check if description exists
                $description = $CmsContentDescriptions
                    ->find()
                    ->where(['cms_content_id' => $cmsContentId])
                    ->first();

                if ($description) {
                    // Update existing
                    $description = $CmsContentDescriptions->patchEntity($description, $descData);
                } else {
                    // New insert
                    $description = $CmsContentDescriptions->newEntity($descData);
                }

                if ($CmsContentDescriptions->save($description)) {
                    $this->Flash->success('Content saved successfully.');
                    return $this->redirect(['action' => 'manageContent', $code]);
                } else {
                    $this->Flash->error('Description not saved.');
                    debug($description->getErrors());
                }
            } else {
                $this->Flash->error('Content not saved.');
                debug($cmsContent->getErrors());
            }
        }

        // Fetch content + description again for edit
        if ($cmsContent && $cmsContent->id) {
            $description = $CmsContentDescriptions
                ->find()
                ->where(['cms_content_id' => $cmsContent->id])
                ->first();
            $cmsContent->cms_content_descriptions = [$description];
        }

        $this->set("page_title", $breadcrumbTitle);
        $this->set(compact('cmsContent'));
    }

    
}
