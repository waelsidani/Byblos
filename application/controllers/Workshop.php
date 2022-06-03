<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Workshop';

		$this->load->model('model_Workshop');
	}

	/* 
	* It only redirects to the manage Workshop page
	*/
	public function index()
	{

		if(!in_array('viewWorkshop', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('Workshop/index', $this->data);	
	}	

	/*
	* It checks if it gets the Workshop id and retreives
	* the Workshop information from the Workshop model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchWorkshopDataById($id) 
	{
		if($id) {
			$data = $this->model_Workshop->getWorkshopData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the Workshop value from the Workshop table 
	* this function is called from the datatable ajax function
	*/
	public function fetchWorkshopData()
	{
		$result = array('data' => array());

		$data = $this->model_Workshop->getWorkshopData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateWorkshop', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteWorkshop', $this->permission)) {
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
	* Its checks the Workshop form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createWorkshop', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('Workshop_name', 'Workshop name', 'trim|required');
                $this->form_validation->set_rules('Workshop_indirect', 'Workshop Indirect', 'trim|required');
                $this->form_validation->set_rules('Workshop_avgworkers', 'Workshop avgworker', 'trim|required');
                $this->form_validation->set_rules('Workshop_Store_ID', 'Workshop Store', 'trim|required');
                $this->form_validation->set_rules('active', 'Active', 'trim|required');
                $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('Workshop_name'),
                        'indirect' => $this->input->post('Workshop_indirect'),
                        'avgworker' => $this->input->post('Workshop_avgworkers'),
                        'store' => $this->input->post('Workshop_Store_ID'),
                        'active' => $this->input->post('active'),
                     
        	);

        	$create = $this->model_Workshop->create($data);
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
	* Its checks the Workshop form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateWorkshop', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
                    
                $this->form_validation->set_rules('edit_Workshop_name', 'Workshop name', 'trim|required');
                $this->form_validation->set_rules('edit_Workshop_indirect', 'Workshop Indirect', 'trim|required');
                $this->form_validation->set_rules('edit_Workshop_avgworkers', 'Workshop avgworkers', 'trim|required');
                $this->form_validation->set_rules('edit_Workshop_Store_ID', 'Workshop Store_ID', 'trim|required');
                $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	                'name' => $this->input->post('edit_Workshop_name'),
                        'indirect' => $this->input->post('edit_Workshop_indirect'),
                        'avgworker' => $this->input->post('edit_Workshop_avgworkers'),
                        'store' => $this->input->post('edit_Workshop_Store_ID'),
                        'active' => $this->input->post('edit_active'),
                        'Qty_production' => json_encode($this->input->post('Qty_production')),
                        'Work_production' => json_encode($this->input->post('Work_production'), JSON_UNESCAPED_UNICODE),
	        	);

	        	$update = $this->model_Workshop->update($data, $id);
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
	* It removes the Workshop information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteWorkshop', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$Workshop_id = $this->input->post('Workshop_id');

		$response = array();
		if($Workshop_id) {
			$delete = $this->model_Workshop->remove($Workshop_id);
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