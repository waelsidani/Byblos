<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Raw Material';

		$this->load->model('model_brands');
		$this->load->model('model_stores');
	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewBrand', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_brands->getBrandData();

		$this->data['results'] = $result;

		$this->render_template('brands/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	public function fetchBrandData()
	{
		$result = array('data' => array());

		$data = $this->model_brands->getBrandData();
                

		foreach ($data as $key => $value) {
                    
                        
			// button
			$buttons = '';

			if(in_array('viewBrand', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editBrand('.$value['id'].')" data-toggle="modal" data-target="#editBrandModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteBrand', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeBrand('.$value['id'].')" data-toggle="modal" data-target="#removeBrandModal"><i class="fa fa-trash"></i></button>
				';
			}				

			
                             $qty_status = '';
                                 if($value['Quantity'] <= $value['MQnty']) {
                                  $qty_status = '<span class="label label-warning">Low !</span>';
                              } if($value['Quantity'] <= 0) {
                                  $qty_status = '<span class="label label-danger">Out of stock !</span>';
                                         }
			$result['data'][$key] = array(
				$value['name'],
                                $value['Code'],
                                $value['Quantity']. ' ' . $qty_status,
                                
				
				$buttons
                                
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the brand id and retreives
	* the brand information from the brand model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchBrandDataById($id)
	{
		if($id) {
			$data = $this->model_brands->getBrandData($id);
			
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createBrand', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
               
		$response = array();

		$this->form_validation->set_rules('brand_name', 'Brand name','trim|required');
		$this->form_validation->set_rules('brand_Size','Brand Size','trim|required');
		$this->form_validation->set_rules('brand_Code','Brand Code','trim|required');
		$this->form_validation->set_rules('brand_Quantity','Brand Quantity','trim|required');
	     	$this->form_validation->set_rules('brand_Price','Brand Price','trim|required');
                $this->form_validation->set_rules('brand_MQnty','Brand MQnty','trim|required');
                $this->form_validation->set_rules('brand_Material','Brand Material','trim|required');
		$this->form_validation->set_rules('brand_Packing','Brand Packing','trim|required');
                $this->form_validation->set_rules('brand_BarCode','Brand BarCode','trim|required');
                $this->form_validation->set_rules('brand_Des','Brand Des','trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');
                $this->form_validation->set_rules('Supplier_ID', 'Supplier_ID', 'trim|required');
                $this->form_validation->set_rules('Store_ID', 'Store_ID', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == true) {
        	
            $data = array(
                    
        		        'name' => $this->input->post('brand_name'),
			        'Size' => $this->input->post('brand_Size'),
				'Code' => $this->input->post('brand_Code'),
				'Quantity' => $this->input->post('brand_Quantity'),
                                'Price' => $this->input->post('brand_Price'),
                                'MQnty' => $this->input->post('brand_MQnty'),
                                'Material' => $this->input->post('brand_Material'),
                                'Packing' => $this->input->post('brand_Packing'),
				'BarCode' => $this->input->post('brand_BarCode'),
                                'Des' => $this->input->post('brand_Des'),
	 		        'active' => $this->input->post('active'),
                                'Supplier_ID' => $this->input->post('Supplier_ID'),
                                'Store_ID' => $this->input->post('Store_ID'),
                              
        	);
                          
        	$create = $this->model_brands->create($data);
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
	* Its checks the brand form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateBrand', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
	        $this->form_validation->set_rules('edit_brand_name', 'Brand name','trim|required');
		$this->form_validation->set_rules('edit_brand_Size','Brand Size','trim|required');
		$this->form_validation->set_rules('edit_brand_Code','Brand Code','trim|required');
		$this->form_validation->set_rules('edit_brand_Quantity','Brand Quantity','trim|required');
	     	$this->form_validation->set_rules('edit_brand_Price','Brand Price','trim|required');
                $this->form_validation->set_rules('edit_brand_MQnty','Brand MQnty','trim|required');
                $this->form_validation->set_rules('edit_brand_Material','Brand Material','trim|required');
		$this->form_validation->set_rules('edit_brand_Packing','Brand Packing','trim|required');
                $this->form_validation->set_rules('edit_brand_BarCode','Brand BarCode','trim|required');
                $this->form_validation->set_rules('edit_brand_Des','Brand Des','trim|required');
		$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
                $this->form_validation->set_rules('edit_Supplier_ID', 'Supplier_ID', 'trim|required');
                $this->form_validation->set_rules('edit_Store_ID', 'Store_ID', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		
				'name' => $this->input->post('edit_brand_name'),
			        'Size' => $this->input->post('edit_brand_Size'),
				'Code' => $this->input->post('edit_brand_Code'),
				'Quantity' => $this->input->post('edit_brand_Quantity'),
                                'Price' => $this->input->post('edit_brand_Price'),
                                'MQnty' => $this->input->post('edit_brand_MQnty'),
                                'Material' => $this->input->post('edit_brand_Material'),
                                'Packing' => $this->input->post('edit_brand_Packing'),
				'BarCode' => $this->input->post('edit_brand_BarCode'),
                                'Des' => $this->input->post('edit_brand_Des'),
	 		        'active' => $this->input->post('edit_active'),
                                'Supplier_ID' => $this->input->post('edit_Supplier_ID'),
                                'Store_ID' => $this->input->post('edit_Store_ID'),
                                           );
	        	$update = $this->model_brands->update($data, $id);
                      
                        
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
	public function remove()
	{
		if(!in_array('deleteBrand', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$brand_id = $this->input->post('brand_id');
		$response = array();
		if($brand_id) {
			$delete = $this->model_brands->remove($brand_id);

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