<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Supplier';

		$this->load->model('model_Supplier');
	}

	/* 
	* It only redirects to the manage Supplier page
	*/
	public function index()
	{

		if(!in_array('viewSupplier', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('Supplier/index', $this->data);	
	}	

	/*
	* It checks if it gets the Supplier id and retreives
	* the Supplier information from the Supplier model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchSupplierDataById($id) 
	{
		if($id) {
			$data = $this->model_Supplier->getSupplierData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the Supplier value from the Supplier table 
	* this function is called from the datatable ajax function
	*/
	public function fetchSupplierData()
	{
		$result = array('data' => array());

		$data = $this->model_Supplier->getSupplierData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateSupplier', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteSupplier', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the Supplier form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createSupplier', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('Supplier_name', 'Supplier name', 'trim|required');
                $this->form_validation->set_rules('Supplier_phone1', 'Supplier Phone1', 'trim|required');
                $this->form_validation->set_rules('Supplier_Contact', 'Supplier Contact', 'trim|required');
                $this->form_validation->set_rules('Supplier_phone2', 'Supplier Phone2', 'trim|required');
                $this->form_validation->set_rules('Supplier_Address', 'Supplier Address', 'trim|required');
                $this->form_validation->set_rules('Supplier_email', 'Supplier Email', 'trim|required');
                $this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('Supplier_name'),
                        'Phone1' => $this->input->post('Supplier_phone1'),
                        'Scontact' => $this->input->post('Supplier_Contact'),
                        'Phone2' => $this->input->post('Supplier_phone2'),
                        'Address' => $this->input->post('Supplier_Address'),
                        'Email' => $this->input->post('Supplier_email'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_Supplier->create($data);
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
	* Its checks the Supplier form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateSupplier', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
                    
                $this->form_validation->set_rules('edit_Supplier_name', 'Supplier name', 'trim|required');
                $this->form_validation->set_rules('edit_Supplier_Phone1', 'Supplier Phone1', 'trim|required');
                $this->form_validation->set_rules('edit_Supplier_Contact', 'Supplier Contact', 'trim|required');
                $this->form_validation->set_rules('edit_Supplier_Phone2', 'Supplier Phone2', 'trim|required');
                $this->form_validation->set_rules('edit_Supplier_Address', 'Supplier Address', 'trim|required');
                $this->form_validation->set_rules('edit_Supplier_email', 'Supplier Email', 'trim|required');
                $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	                'name' => $this->input->post('edit_Supplier_name'),
                        'Phone1' => $this->input->post('edit_Supplier_Phone1'),
                        'Scontact' => $this->input->post('edit_Supplier_Contact'),
                        'Phone2' => $this->input->post('edit_Supplier_Phone2'),
                        'Address' => $this->input->post('edit_Supplier_Address'),
                        'Email' => $this->input->post('edit_Supplier_email'),
        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_Supplier->update($data, $id);
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
	* It removes the Supplier information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteSupplier', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$Supplier_id = $this->input->post('Supplier_id');

		$response = array();
		if($Supplier_id) {
			$delete = $this->model_Supplier->remove($Supplier_id);
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