<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;

//use Cake\Mailer\Mailer;

class ToursController extends AppController
{
	
	public function initialize(): void
    {
        parent::initialize();
		$this->loadComponent('Email'); // Load the EmailComponent
    }


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
		//Configure::write('debug',true);
    }

	public function index($categoryUrl="")
    {
		
        $this->viewBuilder()->setLayout('version1/default');
		$categoryInfo = $this->getCategoryByUrl($categoryUrl);

		
		$categoryTourInfo = array();

		if(!empty($categoryInfo["id"]))
		{
			$categoryTourInfo = array();
		    //$categoryTourInfo = $this->getCategoryTours($categoryInfo["id"]);

		    $this->set("categoryId",$categoryInfo["id"]);

		}

		$this->set("categoryInfo",$categoryInfo);
		$this->set("tourInfo",$categoryTourInfo);
		
	}



	



	private function getCategoryByUrl($categoryUrl=""){



		



		$categoryTbl = $this->fetchTable('TblCategory');



		$options['conditions'] =array("TblCategory.category_url"=>$categoryUrl);	



		return $categoryInfo = $categoryTbl->find("all",$options)->enableHydration(false)->first();	



	}



	



	private function getCategoryTours($categoryId="")
	{

		$tblsTourPages = $this->fetchTable('TblsTourPages');

		$options['fields'] = array(



							/*"id"=>"CmsManagetour.id",*/



							"tour_duration"=>"CmsManagetour.tour_duration",



							"tour_page_id"=>"TblsTourPages.id",



							"tour_name"=>"TblsTourPages.title",



							"tour_url"=>"TblsTourPages.page_url",



							"tour_code"=>"TblsTourPages.tour_code",



							"lowest_price_id"=>"TblsTourPages.lowest_price_id",



							"price_display"=>"TblsTourPages.price_display",



							"tour_image"=>"TblsTourPageDescription.image"



							);



		$options['contain'] = array("TblTourCategory","TblsTourPageDescription","CmsManagetour");



		$options['conditions'] = array("TblTourCategory.category_id"=>$categoryId);



		$options['order'] = array("TblTourCategory.order_sequence"=> "ASC");



		$options['limit'] = 3;



		//$this->paginate = $options;



		//$tourPageInfo = $this->paginate($tblsTourPages->find("all",$options)->enableHydration(false));



		//$tourPageInfo->enableHydration(false); // Results as arrays instead of entities



		



		$tourPageInfo = $tblsTourPages->find("all",$options)->enableHydration(false);



		return $result = $tourPageInfo->all()->toList(); // Execute the query and return the array



		



	}



	



	public function getLoadMoreTours(){



	    



	    $this->viewBuilder()->disableAutoLayout();



		



		$receivedData = array();



		$receivedData['page'] = $this->request->getData("page");



		$receivedData['category_id'] = $this->request->getData("category_id");



		



		$tblsTourPages = $this->fetchTable('TblsTourPages');



		



		$options['fields'] = array(



							"id"=>"CmsManagetour.id",



							"tour_duration"=>"CmsManagetour.tour_duration",



							"tour_page_id"=>"TblsTourPages.id",



							"tour_name"=>"TblsTourPages.title",



							"tour_url"=>"TblsTourPages.page_url",



							"tour_code"=>"TblsTourPages.tour_code",



							"lowest_price_id"=>"TblsTourPages.lowest_price_id",



							"price_display"=>"TblsTourPages.price_display",



							"tour_image"=>"TblsTourPageDescription.image"



							);



		$options['contain'] = array("TblTourCategory","TblsTourPageDescription","CmsManagetour");



		$options['conditions'] = array("TblTourCategory.category_id"=>$receivedData['category_id']);



		$options['order'] = array("TblTourCategory.order_sequence"=> "ASC");



		$options['limit'] = 3;



		$options['page'] = (int) $receivedData['page'];



		



		$tourPageInfo = $tblsTourPages->find("all",$options)->enableHydration(false);



		$result = $tourPageInfo->all()->toList();



		//print_r($result);exit;



		$hasMore = ($tblsTourPages->find("all",$options)->count() > 3 * (int) $receivedData['page']);



		



		 $tourData = array(



            "tour_info"     =>     $result,



            "hasMore"      =>      $hasMore



        );







        $json = array(



            "result"    =>      "success",



            "message"   =>      "Tour successfully compiled.",



            "data"      =>      $tourData



        );



        echo json_encode($json);  



        exit;



		



	}



	



	



	



	public function details($categoryPageUrl="",$tourPageUrl="")
    {

    	$this->viewBuilder()->setLayout('version1/default');

		$tabTblsTourPages = $this->fetchTable('TblsTourPages');
		$tabCmsManagetour = $this->fetchTable('CmsManagetour');
		$tabTblTourCategory = $this->fetchTable('TblTourCategory');
		$tabTblCategory = $this->fetchTable('TblCategory');
	


		$requestData = array();
		$requestData['page_url'] = $tourPageUrl;
		$requestData['category_page_url'] = $categoryPageUrl;

		$tourPageInfo = $tabTblsTourPages->findByPageUrl($requestData['page_url'])->toArray();
		$tourPageInfo = $tourPageInfo[0];

		$tourCategoryInfo = $tabTblTourCategory->findByTourPageIdAndTourId($tourPageInfo['id'],$tourPageInfo['tour_id'])->toArray();
		$tourCategoryInfo = $tourCategoryInfo[0];

		$categoryInfo = $tabTblCategory->findById($tourCategoryInfo['category_id'])->toArray();
		$categoryInfo = $categoryInfo[0];

		$cmsManagetourInfo = $tabCmsManagetour->findById($tourPageInfo['tour_id'])->toArray();
		$cmsManagetourInfo = $cmsManagetourInfo[0];

		$tourPrimaryInfo = array();
		$tourPrimaryInfo['tour_id'] = $tourPageInfo['tour_id'];
		$tourPrimaryInfo['category_id'] = $categoryInfo['id'];
		$tourPrimaryInfo['category_name'] = $categoryInfo['name'];
		$tourPrimaryInfo['tour_category_id'] = $tourCategoryInfo['id'];
		$tourPrimaryInfo['category_page_url'] = $tourCategoryInfo['page_url'];
		$tourPrimaryInfo['tour_view_type'] = $cmsManagetourInfo['tour_type'];
		
		if($cmsManagetourInfo['tour_start_date']!=""&&$cmsManagetourInfo['tour_start_date']!='0000-00-00')
		{
			$tourPrimaryInfo['tour_start_date'] = date("d M Y",strtotime($cmsManagetourInfo['tour_start_date']));
		}
		else
		{
			$tourPrimaryInfo['tour_start_date']="";
		}

		$tourPrimaryInfo['page_url'] = $tourPageInfo['page_url'];
		$tourPrimaryInfo['title'] = $tourPageInfo['title'];
		$tourPrimaryInfo['duration'] = $cmsManagetourInfo['tour_duration'];
		$tourPrimaryInfo['total_nights'] = ($cmsManagetourInfo['tour_duration']-1);
		$tourPrimaryInfo['tour_page_id'] = $tourPageInfo['id'];

		$breadCrumb = array();

		$breadCrumb[] = array(
									"title"			=>		"Home",
									"link"			=>		WEBROOT_URL,
									"link_display"	=>		true
						);

		$breadCrumb[] = array(
								"title"			=>		$tourPrimaryInfo['category_name'],
								"link"			=>		WEBROOT."holidays-india-".$tourPrimaryInfo['category_page_url'],
								"link_display"	=>		true
					);

		$breadCrumb[] = array(
								"title"			=>		$tourPrimaryInfo['title'],
								"link"			=>		WEBROOT."holidays-india-".$tourPrimaryInfo['category_page_url']."/".$tourPrimaryInfo['page_url'],
								"link_display"	=>		false
					);

		$tourPrimaryInfo['breadcrumb'] = $breadCrumb;

		$tourPrimaryData = $this->getTourPrimaryInformation($tourPrimaryInfo);

		$tourItinerarySummary = $this->getDayViewItinerarySummary($tourPrimaryData['events']);

		$this->set("tourPrimaryData",$tourPrimaryData);

		
		
	}

	private function getDayViewItinerarySummary($eventList)
	{
		
		$tabTblsTourEventDescriptions = $this->fetchTable('TblsTourEventDescriptions');

		$cityViewList = array();
		foreach($eventList as $events)
		{
			foreach($events as $event)
			{
				
				$eventDescInfo = $tabTblsTourEventDescriptions->findByTourEventId($event['event_id'])->toArray();
				$eventDescInfo = $eventDescInfo[0];


				$cityViewList[] = array(
											"subregion_id"		=>		$event['subregion_id'],
											"event_start_day"	=>		$event['day'],
											"event_end_day"		=>		(($event['day']+$event['event_duration'])-1),
											"event_duration"	=>		$event['event_duration'],
											"description"		=>		$eventDescInfo['description']
								);
				
			}
		}

		return $cityViewList;
	}





	private function getTourPrimaryInformation($requestData=array())
	{

		$tabCmsTourDayPlan = $this->fetchTable('CmsTourDayPlan');
		$tabTblsTourEvents = $this->fetchTable('TblsTourEvents');
		$tabTblsSubregion = $this->fetchTable('TblsSubregion');
		
		$tourStartDate = $requestData['tour_start_date'];
	
		$noOfDays = $requestData['duration'];

		$eventList=array();
		$cityList = array();

		for($i=1;$i<=$noOfDays;$i++)
		{
			
			$filterTourDayPlan = array();
			$filterTourDayPlan['conditions'] = array(
															"tour_id"	=>		$requestData['tour_id'],
															"day_count"	=>		$i
											);
			$filterTourDayPlan['order'] = array(
														"day_orderno"	=>		"asc"
										);

			$cmsTourDayPlans = $tabCmsTourDayPlan->find('all',$filterTourDayPlan)->toArray();
			
			$events = array();
			foreach($cmsTourDayPlans as $cmsTourDayPlan)
			{
				
				$tourEventInfo = $tabTblsTourEvents->findById($cmsTourDayPlan['event_id'])->toArray();
				$tourEventInfo = $tourEventInfo[0];

				$subregionInfo = $tabTblsSubregion->findById($tourEventInfo['subregion_id'])->toArray();
				$subregionInfo = $subregionInfo[0];

				if(!in_array($subregionInfo['region_location'],$cityList))
				{
					$cityList[] = $subregionInfo['region_location'];
				}
				$events[] = array(
										"tour_day_plan_id"		=>	$cmsTourDayPlan['id'],
										"event_id"				=>	$tourEventInfo['id'],
										"city"					=>	$subregionInfo['region_location'],
										"subregion_id"			=>	$subregionInfo['id'],
										"day"					=>	$i,
										"day_order"				=>	$cmsTourDayPlan['day_orderno'],
										"event_duration"		=>	$cmsTourDayPlan['event_duration']
					);
			}

			$eventList[$i] = $events;

		}

		$requestData['events'] = $eventList;
		$requestData['cities'] = $cityList;

		$cityString = implode("->",$cityList);

		$requestData['city_string'] = $cityString;

		return $requestData;

	}

	

	private function getAllCountryList()

	{

		$tabTblsCountry= $this->fetchTable('TblsCountry');

		

		$options['order'] = array("TblsCountry.name"=> "ASC");



		$countryInfo = $tabTblsCountry->find('list', [

    'keyField' => 'id',      // The field to use for the key (usually primary key)

    'valueField' => 'name'   // The field to use for the value (name or other field)

],$options)->toArray();

		

		return $countryInfo;

	}



	public function tailorMakeTour()



    {

		// Set the layout.

		$this->viewBuilder()->setLayout('version1/default');

	   

		$tblEnquiry  = $this->fetchTable('TblsEnquiry');

		$tblEnquiryDetail  = $this->fetchTable('TblsEnquiryDetail');



		$countryList = $this->getAllCountryList();

		$this->set("countryList",$countryList);



		if ($this->request->is('post')) {

				

			$hotelPreference = implode(",",$this->request->getData('hotel_preferences'));

			$arrChildrenAge = array();

			for($i=1;$i<=$this->request->getData('no_of_children');$i++)

			{

				$arrChildrenAge[] = $this->request->getData('age_of_child'.$i);

			}

			$childrentAges = implode(",",$arrChildrenAge);

			//print_r($hotelPreference);

				

			$data = $tblEnquiry->newEntity($this->request->getData());

			$data->name = $this->request->getData("name");

			$data->email = $this->request->getData("email");

			$data->phone = $this->request->getData("phone");

			$data->country = $this->request->getData("country");

			$data->enquiry_source = 'tailor_make_a_tour';		

				if ($tblEnquiry->save($data)) {

					

					$other_information=array("nationality" =>'',

					'no_of_adults' => $this->request->getData('no_of_adults'),

					'no_of_children'=> $this->request->getData('no_of_children'),

					'no_of_days' => $this->request->getData('no_of_days'),

					'currency' => '',

					'travel_budget'=>$this->request->getData('travel_budget'),

					'no_of_rooms'=>$this->request->getData('no_of_rooms'),

					'star_hotel'=>$hotelPreference);



					$other_information=serialize($other_information);

					

					

					$edata = $tblEnquiryDetail->newEntity($this->request->getData());

					$edata->enquiry_id = $data->id;

					$edata->message = $this->request->getData("message");

					$edata->page_url = '';

					$edata->tour_id = 0;

					$edata->tour_name = '';

					$edata->user_ip = $_SERVER['REMOTE_ADDR'];

					$edata->other_information = $other_information;

					$tblEnquiryDetail->save($edata);

					

					//send mail

					$emailData = array();

					$emailData["name"] = $this->request->getData("name"); 

					$emailData["email"] = $this->request->getData("email"); 

					$emailData["phone"] = $this->request->getData("phone"); 

					$emailData["country"] = $this->request->getData("country"); 

					$emailData["city"] = $this->request->getData("city"); 

					$emailData["no_of_adults"] = $this->request->getData("no_of_adults"); 

					$emailData["no_of_children"] = $this->request->getData("no_of_children"); 

					$emailData["no_of_days"] = $this->request->getData("no_of_days"); 

					$emailData["travel_budget"] = $this->request->getData("travel_budget"); 

					$emailData["travel_date"] = $this->request->getData("travel_date"); 

					$emailData["hotelPreference"] = $hotelPreference; 

					$emailData["childrentAges"] = $childrentAges; 

					$emailData["message"] = $this->request->getData("message"); 

					

					if($this->sendEmail($emailData)){

					

						$this->redirect(array("controller" => "Tours", "action" => "confirmation"));

					}else{

						$this->Flash->error('Failed to send email.');

					}

				}	

				

		}

	}

	

	public function confirmation(){

		

		$this->viewBuilder()->setLayout('version1/default');

		$confirmationPageParameter = array(

												"title" =>  "Thank You",

												"description"	=>	"<h3>Your query has been received.</h3><div>Thank you for contacting us. Your query has been received to us.</div><div> We will contact you shortly.</div>"

									);

		$this->set("confirmationPageParameter",$confirmationPageParameter);							

		

	}

	

	public function sendEmail($data)

    {

        // Example data

        //$to = 'sales2@elegantjourneys.co';

        $subject = 'Tailor Make a Tour Enquiry';

		// HTML content

    $htmlContent = '

    <html>

									<head>

									  <title>Tailor Maka a Tour Enquiry From Website</title>

									</head>

									<body>

									  <p>Here are the details of enquiry submitted by visitors!</p>

									  <table padding="2" border="1">

										<tr>

										  <th style="text-align:left;">Name</th>

										  <td>'.$data['name'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Email</th>

										  <td>'.$data['email'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Phone</th>

										  <td>'.$data['phone'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Country</th>

										  <td>'.$data['city'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Nationality</th>

										  <td>'.$data['country'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Number of Adults</th>

										  <td>'.$data['no_of_adults'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Number of Children</th>

										  <td>'.$data['no_of_children'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Children Ages</th>

										  <td>'.$data['childrentAges'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Number of Days</th>

										  <td>'.$data['no_of_days'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Travel Budget</th>

										  <td>'.$data['travel_budget'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Travel Date</th>

										  <td>'.$data['travel_date'].'</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Hotels Preference</th>

										  <td>'.$data['hotelPreference'].' Star</th>

										</tr>

										<tr>

										  <th style="text-align:left;">Message</th>

										  <td>'.$data['message'].'</th>

										</tr>

									  </table>

									</body>

									</html>

    ';



    // Send the email

    $result = $this->Email->sendHTMLEmail($to="sales2@elegantjourneys.co", $subject, $htmlContent);



        if ($result === true) {

            //$this->Flash->success('Email sent successfully.');

			return true;

        } else {

            //$this->Flash->error('Failed to send email. ' . $result);

			return false;

        }

    }





}



