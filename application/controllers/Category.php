<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Category';

		$this->load->model('model_category');
                	

		$this->load->model('model_orders');
		$this->load->model('model_Workshop');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage category page
	*/
	public function index()
	{

		if(!in_array('viewCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('category/index', $this->data);	
	}	

	/*
	* It checks if it gets the category id and retreives
	* the category information from the category model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchCategoryDataById($id) 
	{
		if($id) {
			$data = $this->model_category->getCategoryData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the category value from the category table 
	* this function is called from the datatable ajax function
	*/
public function getcategoryData($category_id = null)
	{
		if(!$category_id) {
			return false;
		}

		$sql = "SELECT * FROM orders_item WHERE order_id = ?";
		$query = $this->db->query($sql, array($category_id));
		return $query->result_array();
	}
	public function fetchCategoryData()
	{
		$result = array('data' => array());

		$data = $this->model_category->getCategoryData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateCategory', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteCategory', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				
                         $qty_status1 = '';
                                 if($value['qty'] <= $value['mqty']) {
                                  $qty_status1 = '<span class="label label-warning">Low !</span>';
                              } if($value['qty'] <= 0) {
                                  $qty_status1 = '<span class="label label-danger">Out of stock !</span>';
                                         }
                                         
                                         //$status = '';
                                        // if($value['active'] == 1) { $status = '<span class="label label-success">600</span>';}
                                        // if($value['active'] == 2) {  $status ='<span class="label label-warning">200</span>';}
                                       //  ;

			$result['data'][$key] = array(
				$value['name'],
                            $value['number'],
                            $value['qty']. ' ' . $qty_status1,
				
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the category form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
        
        
        
	public function create()
	{
		if(!in_array('createCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();


        	

        		
		$this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
		$this->form_validation->set_rules('category_number', 'Category number', 'trim|required');
                $this->form_validation->set_rules('category_qty', 'Category qty', 'trim|required');
                $this->form_validation->set_rules('category_mqty', 'Category mqty', 'trim|required');
                $this->form_validation->set_rules('category_des', 'Category description', 'trim|required');
                $this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('category_name'),
                        'number' => $this->input->post('category_number'),
                        'qty' => $this->input->post('category_qty'),
                        'mqty' => $this->input->post('category_mqty'),
                        'description' => $this->input->post('category_des'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_category->create($data);
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
                        
                        $this->data['Workshop'] = $this->model_Workshop->getActiveWorkshopData();      	

            $this->render_template('Category/create', $this->data);
        	}
        }

        echo json_encode($response);
	}
        
	/*
	* Its checks the category form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
				
		$this->form_validation->set_rules('edit_category_name', 'Category name', 'trim|required');
		$this->form_validation->set_rules('edit_category_number', 'Category number', 'trim|required');
                $this->form_validation->set_rules('edit_category_qty', 'Category qty', 'trim|required');
                $this->form_validation->set_rules('edit_category_mqty', 'Category mqty', 'trim|required');
                $this->form_validation->set_rules('edit_category_des', 'Category description', 'trim|required');
                $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        	'name' => $this->input->post('edit_category_name'),
                        'number' => $this->input->post('edit_category_number'),
                        'qty' => $this->input->post('edit_category_qty'),
                        'mqty' => $this->input->post('edit_category_mqty'),
                        'description' => $this->input->post('edit_category_des'),
        		'active' => $this->input->post('edit_active'),
	        	);
                        
                       $categories_id  = $id ;
		       
                       $items = array(
    			'categories_id' => $categories_id,
    			'date_time' => strtotime(date('Y-m-d h:i:s a')),
    			'qty' => $this->input->post('edit_category_nqty'),
                        'trans_name' => $this->input->post('edit_category_Trans'),
    			
    		 
    		);

    	              

	        	$update = $this->model_category->update($data, $id);
                        $Trans = $this->model_category->create2($items);
                       
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
	* It removes the category information from the database 
	* and returns the json format operation messages
	*/
        
        public function getTableProductRow()
	{
		$Workshop = $this->model_Workshop->getActiveProductData();
		echo json_encode($Workshop);
	}

	public function remove()
	{
		if(!in_array('deleteCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$category_id = $this->input->post('category_id');

		$response = array();
		if($category_id) {
			$delete = $this->model_category->remove($category_id);
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