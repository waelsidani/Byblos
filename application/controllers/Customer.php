
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Customer';

		$this->load->model('model_Customer');
	}

	/* 
	* It only redirects to the manage Customer page
	*/
	public function index()
	{

		if(!in_array('viewCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('Customer/index', $this->data);	
	}	

	/*
	* It checks if it gets the Customer id and retreives
	* the Customer information from the Customer model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
        
      public function fetchAttributeValueData($attribute_parent_id)
	{
		$result = array('data' => array());

		$data = $this->model_Customer->getAttributeValueData($attribute_parent_id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '
			<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
			';

			$result['data'][$key] = array(
				$value['value'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/* 
	* fetch the attribute value by the attritute value id  
	*/
	public function fetchAttributeValueById($id) 
	{
		if($id) {
			$data = $this->model_Customer->getAttributeValueById($id);
			echo json_encode($data);
		}
	}
        public function addfile($attribute_id = null)
	{
		if(!$attribute_id) {
			redirect('dashboard', 'refersh');
		}

		$this->data['customer_data_file'] = $this->model_Customer->getAttributeData($attribute_id);

		$this->render_template('Customer/addfile', $this->data);	
	}


	public function fetchCustomerDataById($id) 
	{
		if($id) {
			$data = $this->model_Customer->getCustomerData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the Customer value from the Customer table 
	* this function is called from the datatable ajax function
	*/
        
        
	public function fetchCustomerData()
	{
		$result = array('data' => array());
                $user= $_SESSION['username'];
if(!in_array('deleteCustomer', $this->permission)&&$user !== "Reem Ridani"){
                    $data = $this->model_Customer->getCustomerData1($user);
 }
 else {$data = $this->model_Customer->getCustomerData();}
		

		foreach ($data as $key => $value) {
                   

			// button
			$buttons = '';
 
                       
			if(in_array('updateCustomer', $this->permission)) {
				$buttons .= '<button type="button"  class="btn btn-default" onclick="editFunc('.$value['id'].') " data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" ></i></button>';
			         
                        }

                        
			if(in_array('deleteCustomer', $this->permission)) {
				$buttons .= 
                                        ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				
                               
                                 if($value['Status'] == "0") {
                                  $qty_status1 = '<span class="label label-danger">Potential Customer</span>';
                              } elseif ($value['Status'] == "2")
                              {$qty_status1 = '<span class="label label-success">Final Customer</span>';} 
                              elseif ($value['Status'] == "1")
                              {$qty_status1 = '<span class="label label-warning">Under Communication Customer</span>';}
                              else {$qty_status1 = '<span class="label label-danger">Potential Customer</span>';}
                                  
			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
                       $Date_action = $value['Note_action'];
			
                       $Date_action2= explode(',', $Date_action);
                      
                        $Date_action3 = end($Date_action2);
                        $Date_action4 = str_replace(array('[',']','"','\\'), '',$Date_action3);

			$result['data'][$key] = array(
				$value['company'],
                                $value['contactname'],
                                $value['date'],
                                $value['user'],
                            $value['phone2'],
                            $value['phone3'],
                                $qty_status1,
                               $Date_action4,
                          
				$buttons,
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the Customer form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
        
	public function create()
	{
		if(!in_array('createCustomer', $this->permission)) {
	
                    redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('Customer_Company', 'Customer company', 'trim|required');
                $this->form_validation->set_rules('Customer_phone1', 'Customer phone1', 'trim|required');
                $this->form_validation->set_rules('Customer_Contact', 'Customer contactname', 'trim|required');
                $this->form_validation->set_rules('Customer_phone2', 'Customer phone2', 'trim|required');
                $this->form_validation->set_rules('Customer_phone3', 'Customer phone3', 'trim|required');
                $this->form_validation->set_rules('Customer_Address', 'Customer address', 'trim|required');
                $this->form_validation->set_rules('Customer_email', 'Customer email', 'trim|required');
                $this->form_validation->set_rules('Customer_web', 'Customer website', 'trim|required');
                $this->form_validation->set_rules('Customer_user', 'Customer user', 'trim|required');
                $this->form_validation->set_rules('Customer_addeddate', 'Customer date', 'trim|required');
                $this->form_validation->set_rules('Customer_Sales', 'Customer sales', 'trim|required');
                $this->form_validation->set_rules('Customer_Salesperson', 'Customer salesperson', 'trim|required');
                $this->form_validation->set_rules('Customer_Website', 'Customer web', 'trim|required');
                $this->form_validation->set_rules('Customer_Alibaba', 'Customer alibaba', 'trim|required');
                $this->form_validation->set_rules('Customer_istoc', 'Customer istoc', 'trim|required');
                $this->form_validation->set_rules('Customer_Social_Media', 'Customer socialmedia', 'trim|required');
                $this->form_validation->set_rules('Customer_Social_Media_Type', 'Customer socialmediatype', 'trim|required');
               // $this->form_validation->set_rules('Customer_note', 'Customer note', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'company' => $this->input->post('Customer_Company'),
                        'phone1' => $this->input->post('Customer_phone1'),
                        'contactname' => $this->input->post('Customer_Contact'),
                        'phone2' => $this->input->post('Customer_phone2'),
                        'phone3' => $this->input->post('Customer_phone3'),
                        'address' => $this->input->post('Customer_Address'),
                        'email' => $this->input->post('Customer_email'),
                        'website' => $this->input->post('Customer_web'),
                        'user' => $this->input->post('Customer_user'),
                        'date' => $this->input->post('Customer_addeddate'),
                        'sales' => $this->input->post('Customer_Sales'),
                        'salesperson' => $this->input->post('Customer_Salesperson'),
                        'web' => $this->input->post('Customer_Website'),
        		'alibaba' => $this->input->post('Customer_Alibaba'),
                        'istoc' => $this->input->post('Customer_istoc'),
                        'socialmedia' => $this->input->post('Customer_Social_Media'),
                        'socialmediatype' => $this->input->post('Customer_Social_Media_Type'),
                        //'note' => $this->input->post('Customer_note'),
                    
                            'Status' => $this->input->post('Status'),
                            
                            'Note_action' => json_encode($this->input->post('Note-1'), JSON_UNESCAPED_UNICODE),
                            
                            
        	);

        	$create = $this->model_Customer->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	/*
	* Its checks the Customer form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
                
               
              
		$response = array();

		if($id) {
                    
                $this->form_validation->set_rules('edit_Customer_Company', 'Customer company', 'trim|required');
                $this->form_validation->set_rules('edit_Customer_phone1', 'Customer phone1', 'trim|required');
                $this->form_validation->set_rules('edit_Customer_Contact', 'Customer contactname', 'trim|required');
               
	        if ($this->form_validation->run() == TRUE) {
                    
	        	$data = array(
	                'company' => $this->input->post('edit_Customer_Company'),
                        'phone1' => $this->input->post('edit_Customer_phone1'),
                        'contactname' => $this->input->post('edit_Customer_Contact'),
                        'phone2' => $this->input->post('edit_Customer_phone2'),
                        'phone3' => $this->input->post('edit_Customer_phone3'),
                        'address' => $this->input->post('edit_Customer_Address'),
                        'email' => $this->input->post('edit_Customer_email'),
                        'website' => $this->input->post('edit_Customer_web'),
                        'user' => $this->input->post('edit_Customer_user'),
                        'date' => $this->input->post('edit_Customer_addeddate'),
                        'sales' => $this->input->post('edit_Customer_Sales'),
                        'salesperson' => $this->input->post('edit_Customer_Salesperson'),
                        'web' => $this->input->post('edit_Customer_Website'),
        		'alibaba' => $this->input->post('edit_Customer_Alibaba'),
                        'istoc' => $this->input->post('edit_Customer_istoc'),
                        'socialmedia' => $this->input->post('edit_Customer_Social_Media'),
                        'socialmediatype' => $this->input->post('edit_Customer_Social_Media_Type'),
                        'Status' => $this->input->post('Status_1'),
                        
                        'Note_action' => json_encode($this->input->post('Note'), JSON_UNESCAPED_UNICODE),
                        'filenote' => json_encode($this->input->post('filenote'), JSON_UNESCAPED_UNICODE),
                        
                            
                            
                            );
                          
                
               
           
            
            $update = $this->model_Customer->update($data, $id);
	        	
            
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
	* It removes the Customer information from the database 
	* and returns the json format operation messages
	*/
        public function upload_image2()
        {
       $data = [];
$path2= [];
      $count = count($_FILES['product_image']['name']);

      for($i=0;$i<$count;$i++){

        if(!empty($_FILES['product_image']['name'][$i])){
          $_FILES['file']['name'] = $_FILES['product_image']['name'][$i];
          $_FILES['file']['type'] = $_FILES['product_image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['product_image']['error'][$i];
          $_FILES['file']['size'] = $_FILES['product_image']['size'][$i];
         $config['upload_path'] = 'assets/images/Customer'; 
          $config['allowed_types'] = '*';
          $config['max_size'] = '15000';
          
          
          $config['file_name'] = uniqid();
          $this->load->library('upload',$config); 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $data['totalFiles'][] = $filename;
        
            
             $type = explode('.', $_FILES['product_image']['name'][$i]);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$filename;
         array_push($path2,$path);
       
            
          }

        }

      }

   return ($data == true) ? json_encode($path2)  : false;   
   }

        public function upload_image()
  {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/customer';
        $config['file_name'] = 'Customer'.uniqid();
        $config['allowed_types'] = 'gif|jpg|png|xlsx|pdf|jpeg';
        $config['max_size'] = '5000';
         
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false; 
           
  }}
	

  


        public function upload_file()
	{

	 $Ex_file1=[];
              
             $id = $this->input->post('id');
               
	       $Ex_file=$this->model_Customer->getAttributeData($id);
	          $Ex_file2= json_decode($Ex_file['files']) ;
                 
                $upload_image3 = $this->upload_image2();
                if  (!empty($Ex_file2)){
                $count=  count($Ex_file2);
                
                  for($i=0;$i<$count;$i++){ 
                      
                      array_push($Ex_file1,$Ex_file2[$i]);
                      
                  }
                array_push($Ex_file1,$upload_image3);}
                else{$Ex_file1 =json_decode($upload_image3) ;}
                if(!empty($upload_image3 )){
                    
                   // array_push($Ex_file1,$upload_image3);
                    $Ex_file1 = json_encode($Ex_file1);
                $upload_image2 = array('files' => $Ex_file1);
           $update2 = $this->model_Customer->update($upload_image2, $id);
            
                
	        	
            
            if($update2 == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
                        echo json_encode($response);
	        }
	        
        }
                

	/*
	* It removes the Customer information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$Customer_id = $this->input->post('Customer_id');

		$response = array();
		if($Customer_id) {
			$delete = $this->model_Customer->remove($Customer_id);
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