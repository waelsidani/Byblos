<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Raw Material';

		$this->load->model('model_Store');
		$this->load->model('model_stores');
                $this->load->model('model_brands');
                $this->load->model('model_Workshop');
                $this->load->model('model_Production');
                
	}

	/* 
	* It only redirects to the manage product page and
	*/
        public function getTableitemsRow()
	{
		$products = $this->model_brands->getActiveBrands();
		echo json_encode($products);
	}

        
        public function create()
	{
		if(!in_array('updateStore', $this->permission) && !in_array('updateProduction', $this->permission) ) {
            redirect('dashboard', 'refresh');
        }
              $this->form_validation->set_rules('workshop[]', 'Workshop name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {     

        	
        	$create = $this->model_Store->create();
                if($create) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		
        	}
        	
        }
        else {
            // false case
        	

            $this->render_template('Store/create', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
        public function raw()
	{
		if(!in_array('viewStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_Store->getStoreData3();

		$this->data['results'] = $result;

		$this->render_template('Store/raw', $this->data);
	}
	public function index()
	{
		if(!in_array('viewStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_Store->getStoreData();

		$this->data['results'] = $result;

		$this->render_template('Store/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	public function fetchStoreData()
	{
		$result = array('data' => array());

		$data = $this->model_Store->getStoreData();
                
                 foreach ($data as $key => $value) {
                    {
                        
			// button
			$buttons = '';
                        $buttons2 = '';
			if(in_array('viewStore', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editStore('.$value['id'].')" data-toggle="modal" data-target="#editStoreModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeStore('.$value['id'].')" data-toggle="modal" data-target="#removeStoreModal"><i class="fa fa-trash"></i></button>
				';
			}
                        if(in_array('deleteStore', $this->permission)) {
				$buttons2 .= ' <button type="button" class="btn btn-default" onclick="approveStore('.$value['id'].')" data-toggle="modal" data-target="#approveStoreModal"><i class="fa fa-thumbs-o-up"></i></button>
				';
			}
                       $name =  $value['name'];
                        $Code =  $value['Code'];
                         $qnty =  $value['Quantity'];
                         $workshop= $value['Workshop'];
                         $Status =  $value['Status'];
                         $approval= $value['approval'];
                          
			
                        
                        $date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);
                        $date_time = $date . ' ' . $time;
                       if($value['Sent_M_Sec'] !== '')
                       {
                           $date1 = date('d-m-Y', $value['Sent_M_Sec']);
                       $time1 = date('h:i a', $value['Sent_M_Sec']);
                        $date_time1 = $date1 . ' ' . $time1;
                       }
                       else{$date_time1=0;}
                           if($Status == 2) { $Status2 = '<span class="label label-success">Submited</span>';} else{$Status2= '<span class="label label-danger">Pending</span>';}
                            
                          $orderID= $value['Order_id'];
                          if ($orderID == 0)
                          {$orderID = 'عينات/Samples';
                          $orderNumber = "-";}
                                           else 
                                   {$orderNumber1 = $this-> model_Production->getProductionData($value['Order_id']);
                                      $orderNumber = $orderNumber1['name']."-".$orderNumber1['Number'];
                                           $orderID= $value['Order_id'];
                          
                                   }
                                   
                                   if ($approval !=0)
                                   {$approval ='<span class="label label-success">Approved</span>';} else{$approval= '<span class="label label-danger">Need Approval</span>';}
                            
			$result['data'] [$key] = array(
                        '<p style="text-align:center; font-size : 15px"> '.  '<b>'.$value['id'].'</b>'.'<p></p>'.  $buttons,
                            
                        $this->model_Workshop -> getWorkshopData($workshop)['name'],
                            $orderID,
                            $orderNumber,
                            
                             $this->model_brands->getBrandData($Code)['Code'],
				 $this->model_brands->getBrandData($name)['name'],
                            
                                
                             '<p style="text-align:center;">'.  $qnty,
                              $date_time ,
                              $date_time1,
                             '<p style="text-align:center;">'.  $value['Set_Qnty'],
                              $value['Person'],
                           
                             '<p style="text-align:center;">'.  $Status2.'<p></p>' .'<p style="text-align:center;">'.$approval.'<p></p>'.$buttons2,
			
			);
                        
                       
                       
                          
                             
                 } }
// /foreach}
echo json_encode($result);
                
	}

	/*
	* It checks if it gets the brand id and retreives
	* the brand information from the brand model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
        
        
        public function fetchStoreData1()
	{
		$result = array('data' => array());

		$data = $this->model_Store->getStoreData3();
                
                 foreach ($data as $key => $value) {
                      $Status =  $value['Status'];
                  
                    {
                        
                        
			// button
			$buttons = '';

			if(in_array('viewStore', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editStore('.$value['id'].')" data-toggle="modal" data-target="#editStoreModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeStore('.$value['id'].')" data-toggle="modal" data-target="#removeStoreModal"><i class="fa fa-trash"></i></button>
				';
			}				
                       $name =  $value['name'];
                        $Code =  $value['Code'];
                         $qnty =  $value['Quantity'];
                         $workshop= $value['Workshop'];
                        
                          
			
                        
                        $date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);
                        $date_time = $date . ' ' . $time;
                       if($value['Sent_M_Sec'] !== '')
                       {
                           $date1 = date('d-m-Y', $value['Sent_M_Sec']);
                       $time1 = date('h:i a', $value['Sent_M_Sec']);
                        $date_time1 = $date1 . ' ' . $time1;
                       }
                       else{$date_time1=0;}
                           if($Status == 2) { $Status2 = '<span class="label label-success">Submited</span>';} else{$Status2= '<span class="label label-danger">Pending</span>';}
                          $orderID= $value['Order_id'];
                          $orderNumber=$this-> model_Production->getProductionData($value['Order_id']);
                          if ($orderID == 0)
                          {$orderID = 'عينات/Samples';}
                          
                                   
			$result['data'] [$key] = array(
                        '<p style="text-align:center; font-size : 15px"> '.  '<b>'.$value['id'].'</b>'.'<p></p>'.  $buttons,
                            
                        $orderNumber['Number'],
                            $orderID,
                            $orderNumber['name'],
                            $this->model_brands->getBrandData($Code)['Code'],
				 $this->model_brands->getBrandData($name)['name'],
                            
                                 
                             '<p style="text-align:center;">'.  $qnty,
                              $date_time ,
                              $date_time1,
                             '<p style="text-align:center;">'.  $value['Set_Qnty'],
                              $value['Person'],
                             '<p style="text-align:center;">'.  $Status2,
			
			);
                        
                       
                       
                          
                             
                 }} 
// /foreach}
echo json_encode($result);
                
	}

	/*
	* It checks if it gets the brand id and retreives
	* the brand information from the brand model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchStoreDataById($id)
	{
		if($id) {
			$data = $this->model_Store->getStoreData($id);
			
			echo json_encode($data);
		}

		return false;
	}
        
        public function fetchStoreDataById1($id)
	{
		if($id) {
			$data = $this->model_Store->getStoreData3($id);
			
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	
	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
	        $this->form_validation->set_rules('edit_Store_Quantity', 'edit_Store_Quantity', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		
				
				'Set_Qnty' => $this->input->post('edit_Store_Quantity'),
                                'Sent_date'=> $this -> input->post('edit_date_time'),
                                'Sent_M_Sec'=> $this -> input->post('edit_date_time1'),
                                'Person' =>   $this->input->post('Person'),
	 		        'Store_ID' => $this->input->post('edit_Store_ID'),
                                'Status' => $this->input->post('Status1'),
                                'approval' => $this->input->post('approval1'),
                                           );
                         $order= $this->input->post('Order_num');
                         $pro_data = $this->model_Production->getProductionData($order);
                         $m_status1= $pro_data['MID_status'];
                         $m_status3 = json_decode($m_status1);
                        
                        $array= $this->input->post('Array_num');
                        $m_status2 = [];
                        $count=count($m_status3);
                                for($i=0;$i<$count;$i++){ 
                      if ($i!=$array){
                      array_push($m_status2,$m_status3[$i]);
                      }else {array_push($m_status2,"2");}
                  }
                        $sdata = $this->model_Store->getStoreData();
                        $data1 = array(
	        		'MID_status' => json_encode($m_status2),
                            
                                           );
	        	$update = $this->model_Store->update($data, $id);
                        $this->model_Production->update($data1, $order);                        
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the brand information from the database 
	* and returns the json format operation messages
	*/
        
        
        public function update1($id)
	{
		if(!in_array('updateStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
	        $this->form_validation->set_rules('edit_Store_Quantity', 'edit_Store_Quantity', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		
				
				'Set_Qnty' => $this->input->post('edit_Store_Quantity'),
                                'Sent_date'=> $this -> input->post('edit_date_time'),
                                'Sent_M_Sec'=> $this -> input->post('edit_date_time1'),
                                'Person' =>   $this->input->post('Person'),
	 		        'Store_ID' => $this->input->post('edit_Store_ID'),
                                'Status' => $this->input->post('Status'),
                                'approval' => $this->input->post('approval'),
                                           );
                         $order= $this->input->post('Order_num');
                         $pro_data = $this->model_Production->getProductionData($order);
                         $m_status1= $pro_data['MID_status1'];
                         $m_status3 = json_decode($m_status1);
                        
                        $array= $this->input->post('Array_num');
                        $m_status2 = [];
                        $count=count($m_status3);
                                for($i=0;$i<$count;$i++){ 
                      if ($i!=$array){
                      array_push($m_status2,$m_status3[$i]);
                      }else {array_push($m_status2,"2");}
                  }
                        
                        $data1 = array(
	        		'MID_status1' => json_encode($m_status2),
                            
                                           );
	        	$update = $this->model_Store->update1($data, $id);
                        $this->model_Production->update($data1, $order);                        
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the brand information from the database 
	* and returns the json format operation messages
	*/
        
        public function approve()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$brand_id = $this->input->post('Store_id');
		$response = array();
		if($brand_id) {
                   $data = array(
                       'approval'=> "1",
                       );
                    
			$approve = $this->model_Store->approve($data, $brand_id);

			if($approve == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully Approved";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
	public function remove()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$brand_id = $this->input->post('Store_id');
		$response = array();
		if($brand_id) {
			$delete = $this->model_Store->remove($brand_id);

			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
public function remove1()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$brand_id = $this->input->post('Store_id1');
		$response = array();
		if($brand_id) {
			$delete = $this->model_Store->remove1($brand_id);

			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
}