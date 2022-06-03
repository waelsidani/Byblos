<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workers extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Workers';

		$this->load->model('model_Workers');
	}

	/* 
	* It only redirects to the manage Workers page
	*/
	public function index()
	{

		if(!in_array('viewWorkers', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('Workers/index', $this->data);	
	}	

	/*
	* It checks if it gets the Workers id and retreives
	* the Workers information from the Workers model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchWorkersDataById($id) 
	{
		if($id) {
			$data = $this->model_Workers->getWorkersData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the Workers value from the Workers table 
	* this function is called from the datatable ajax function
	*/
	public function fetchWorkersData()
	{
		$result = array('data' => array());

		$data = $this->model_Workers->getWorkersData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateWorkers', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteWorkers', $this->permission)) {
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
	* Its checks the Workers form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createWorkers', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('Workers_name', 'Workers name', 'trim|required');
                $this->form_validation->set_rules('Workers_phone1', 'Workers Phone1', 'trim|required');
                $this->form_validation->set_rules('Workers_dob', 'Workers DOB', 'trim|required');
                $this->form_validation->set_rules('Workers_id', 'Workers ID', 'trim|required');
                $this->form_validation->set_rules('Workers_startingdate', 'Workers Starting Date', 'trim|required');
                $this->form_validation->set_rules('Workers_endingdate', 'Workers Ending', 'trim|required');
                $this->form_validation->set_rules('Workers_nationality', 'Worker Nationality', 'trim|required');
                $this->form_validation->set_rules('Workers_Salary', 'Workers Salary', 'trim|required');
                $this->form_validation->set_rules('Workers_workinghours', 'Workers Working Hours', 'trim|required');
                $this->form_validation->set_rules('Workers_workonsaturday', 'Workers Work On Saturday', 'trim|required');
                $this->form_validation->set_rules('Worker_gender', 'Gender', 'trim|required');
                $this->form_validation->set_rules('active', 'Active', 'trim|required');
                
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('Workers_name'),
                        'Phone1' => $this->input->post('Workers_phone1'),
                        'dob' => $this->input->post('Workers_dob'),
                        'nid' => $this->input->post('Workers_id'),
                        'startingdate' => $this->input->post('Workers_startingdate'),
                        'endingdate' => $this->input->post('Workers_endingdate'),
                        'nationality' => $this->input->post('Workers_nationality'),
                        'salary' => $this->input->post('Workers_Salary'),
                        'workinghours' => $this->input->post('Workers_workinghours'),
                        'workonsaturday' => $this->input->post('Workers_workonsaturday'), 
                        'gender' => $this->input->post('Worker_gender'),      
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_Workers->create($data);
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
	* Its checks the Workers form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateWorkers', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
                    
                $this->form_validation->set_rules('edit_Workers_name', 'Workers name', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_phone1', 'Workers Phone1', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_dob', 'Workers DOB', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_id', 'Workers ID', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_startingdate', 'Workers Starting Date', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_endingdate', 'Workers Ending', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_nationality', 'Worker Nationality', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_Salary', 'Workers Salary', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_workinghours', 'Workers Working Hours', 'trim|required');
                $this->form_validation->set_rules('edit_Workers_workonsaturday', 'Workers Work On Saturday', 'trim|required');
                $this->form_validation->set_rules('edit_Worker_gender', 'Gender', 'trim|required');
                $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	                if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	                'name' => $this->input->post('edit_Workers_name'),
                        'Phone1' => $this->input->post('edit_Workers_phone1'),
                        'dob' => $this->input->post('edit_Workers_dob'),
                        'nid' => $this->input->post('edit_Workers_id'),
                        'startingdate' => $this->input->post('edit_Workers_startingdate'),
                        'endingdate' => $this->input->post('edit_Workers_endingdate'),
                        'nationality' => $this->input->post('edit_Workers_nationality'),
                        'salary' => $this->input->post('edit_Workers_Salary'),
                        'workinghours' => $this->input->post('edit_Workers_workinghours'),
                        'workonsaturday' => $this->input->post('edit_Workers_workonsaturday'), 
                        'gender' => $this->input->post('edit_Worker_gender'),      
        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_Workers->update($data, $id);
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
	* It removes the Workers information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteWorkers', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$Workers_id = $this->input->post('Workers_id');

		$response = array();
		if($Workers_id) {
			$delete = $this->model_Workers->remove($Workers_id);
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