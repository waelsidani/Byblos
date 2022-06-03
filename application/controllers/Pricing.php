<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Pricing';
                $this->load->model('model_attributes');
		$this->load->model('model_Pricing');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage Pricing page
	*/
	public function index()
	{
		if(!in_array('viewPricing', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Pricing';
		$this->render_template('Pricing/index', $this->data);		
	}

	/*
	* Fetches the Pricing data from the Pricing table 
	* this function is called from the datatable ajax function
	*/
	public function fetchPricingData()
	{
		$result = array('data' => array());

		$data = $this->model_Pricing->getPricingData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_Pricing->countPricingItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('updatePricing', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('Pricing/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updatePricing', $this->permission)) {
				$buttons .= ' <a href="'.base_url('Pricing/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deletePricing', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-warning">Pending</span>';	
			}
			else {
				$paid_status = '<span class="label label-success">Approved</span>';
			}
                        
$img = '<img src="'.base_url($value['image']).'" alt=""  width="150" height="150" />';
			$result['data'][$key] = array(
                          $img,
				$value['bill_no'],
				$value['customer_name'],
				$value['Description'],
				$date_time,
				$value['user_id'],
				$value['net_subtotal'],
				$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createPricing', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Pricing';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$Pricing_id = $this->model_Pricing->create();
        	
        	if($Pricing_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Pricing/update/'.$Pricing_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Pricing/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData2();      	

            $this->render_template('Pricing/create', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
        
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData2($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the Pricing page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData2();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit Pricing page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updatePricing', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Pricing';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_Pricing->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('Pricing/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Pricing/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$Pricing_data = $this->model_Pricing->getPricingData($id);

    		$result['Pricing'] = $Pricing_data;
    		$Pricing_item = $this->model_Pricing->getPricingItemData($Pricing_data['id']);

    		foreach($Pricing_item as $k => $v) {
    			$result['Pricing_item'][] = $v;
    		}

    		$this->data['Pricing_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData2();      	

            $this->render_template('Pricing/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deletePricing', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$Pricing_id = $this->input->post('Pricing_id');

        $response = array();
        if($Pricing_id) {
            $delete = $this->model_Pricing->remove($Pricing_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

	/*
	* It gets the product id and fetch the Pricing data. 
	* The Pricing print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewPricing', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$Pricing_data = $this->model_Pricing->getPricingData($id);
			$Pricing_items = $this->model_Pricing->getPricingItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$Pricing_date = date('d/m/Y', $Pricing_data['date_time']);
			$paid_status = ($Pricing_data['paid_status'] == 2) ? "Approved" : "Pending";

			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>Pricing List</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			</head>
                        <style>

body {
  height: auto; 
 

}</style>
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			          <small class="pull-right">Date: '.$Pricing_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Pricing ID:</b> '.$Pricing_data['bill_no'].'<br>
			        <b>Name:</b> '.$Pricing_data['customer_name'].'<br>
			        <b>Address:</b> '.$Pricing_data['customer_address'].' <br />
			        <b>Title:</b> '.$Pricing_data['Description'].'<br />
                                <b>Type:</b> '.$Pricing_data['Att_name'].'
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Product name/ المواد</th>
			            
                                    
			            <th>Qty/الكمية</th>
			            <th>Direct Cost/ سعر المواد</th>
                                    <th>Indirect Cost/العمالة</th>
                                    <th>Subtotal/المجموع</th>
                                    
			          </tr>
			          </thead>
			          <tbody>'; 

			          foreach ($Pricing_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData2($v['product_id']); 
			          	
			          	$html .= '<tr>
                                            
				     <td>'.$product_data['value'].'</td>
				           
				            <td>'.$v['qty'].'</td>
                                                <td>'.$v['direct'].'</td>
				           <td>'.$v['indirect'].'</td>
                                            <td>'.$v['subtotal'].'</td>
			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      <div class="col-xs-6 pull pull-left">
               <img src='.base_url($Pricing_data['image']).' alt="Trulli" width="500" height="333">
		             </div>
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
                                  <tr>
			              <th style="width:50%">Direct Cost/ المواد:</th>
			              <td>'.$Pricing_data['totaldirect'].'</td>
			            </tr>
                                          <tr>
			              <th style="width:50%">In-Direct Cost/ العمالة:</th>
			              <td>'.$Pricing_data['totalindirect'].'</td>
			            </tr>
			            <tr>
			              <th style="width:50%">Subtotal Ammount:</th>
			              <td>'.$Pricing_data['gross_subtotal'].'</td>
			            </tr>';

			            if($Pricing_data['service_charge'] > -1) {
			            	$html .= '<tr>
				              <th>Disposal/الهدر %'.$Pricing_data['service_charge_rate'].'</th>
				              <td>'.$Pricing_data['service_charge'].'</td>
				            </tr>';
			            }

			           
			            
			             $html .='
                                          <th>Net Total/مجموع التكلفة:</th>
			              <td>'.$Pricing_data['gross_nettotal'].'</td>
			            </tr>
                                    <tr>
			              <th>Profit/ الربح:</th>
			              <td>'.$Pricing_data['profit'].'</td>
			            </tr>
			            <tr>
			            <th>Discount/خصم:</th>
			              <td>'.$Pricing_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$Pricing_data['net_subtotal'].'</td>
			            </tr>
			            <tr>
			              <th>Status/حالة الطلب:</th>
			              <td>'.$paid_status.'</td>
			            </tr>
			          </table>
                                  
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			  echo $html;
		}
	}

}