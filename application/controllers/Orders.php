<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Orders';

		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Orders';
		$this->render_template('orders/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('orders/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if(in_array('createOrder', $this->permission)) {
				$total= $value['net_amount']; }
                                else
                                {$total = 0;}

			$result['data'][$key] = array(
				$value['bill_no'],
				$value['customer_name'],
				$value['customer_phone'],
				$date_time,
				$count_total_item,
				$total,
				$value['discount'],
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
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_orders->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('orders/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/create', $this->data);
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
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_orders->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	

        	$result = array();
        	$orders_data = $this->model_orders->getOrdersData($id);

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->remove($order_id);
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
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $order_data['date_time']);
			$paid_status = $order_data['shipping'] ;

			$html = '<!-- Main content -->
			<!DOCTYPE html>
                        
			<html>
                        
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>AdminLTE 2 | Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
                          
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
                             
			</head>
                        
<style ">
@page { size: auto;  margin: 0mm; }
 
table {
  border-collapse: separate;
  border-spacing: 0;
 text-align:center;
 
}
th,
td {
  padding: 10px 15px;
  
}
thead {

  border-bottom: 1px solid #cecfd5;
  border-right: 1px solid #cecfd5;
  border-left: 1px solid #cecfd5;
}
tbody tr:nth-child(even) {
  background: #f0f0f2;
  
  
}
td {
border-top: 1px solid #cecfd5;
  border-bottom: 1px solid #cecfd5;
  border-right: 1px solid #cecfd5;
  
}
td:first-child {
border-top: 1px solid #cecfd5;
  border-left: 1px solid #cecfd5;
}

                        
body {
  height: auto; 
 
  overflow-y: hidden;
  overflow-x: hidden;
}

img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>


			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          <td ><img src='.base_url('assets\images\log-header\header.png').'  width="750" height="100"   ></td>
                                 
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    
			       
			      <div class="col-sm-4">
			       
			        <b>Preforma Num.</b> '.$order_data['bill_no'].'<br>
			        <b>Name:</b> '.$order_data['customer_name'].'<br>
			        <b>Address:</b> '.$order_data['customer_address'].' <br />
			        <b>Phone:</b> '.$order_data['customer_phone'].'
			     
			      <!-- /.col -->
			    </div>
                            
			    <!-- /.row -->
			   
			      <div  class="col-xs-12 table-responsive">
			        <table class="table table-striped">
                                
			          <thead>
                                  
                                  <tr style="text-align:right" > 
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th><th  ><small class="pull-right">Date:'.$order_date.'</small> </th></tr>
			          <tr  >
                                  <th style="text-align:center; vertical-align: middle" >S/N</th>
                                  <th style="text-align:center ; width:15% ; vertical-align: middle" >Image</th>
			            <th style="text-align:center; vertical-align: middle" >Product Code</th>
                                    <th style="text-align:center; vertical-align: middle" >CTN</th>
                                    <th style="text-align:center; vertical-align: middle" >Packing</th>
                                    <th style="text-align:center; vertical-align: middle" >Qty</th>
			            <th style="text-align:center; vertical-align: middle" >Price</th>
                                    <th style="text-align:center; vertical-align: middle" >CBM</th>
                                    <th style="text-align:center; vertical-align: middle" >Total CBM</th>
			            <th style="text-align:center; vertical-align: middle" >Amount</th>
			          </tr>
			          </thead>
			          <tbody  >'; 
$r=1;
			          foreach ($orders_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
                                             <td style="text-align:center ; vertical-align: middle;  font-size:15px">'.$r.'</td>
                                            <td style="text-align:center; width: 20%; vertical-align: middle;" ><img src='.base_url($v['image']).'  width="120" height="120" ></td>
                                            <td style="text-align:center ; vertical-align: middle;  font-size:15px ;">'.$product_data['name'].'</td>
                                            <td style="text-align:center ; vertical-align: middle;  font-size:15px">'.$v['ctn'].'</td>
                                            <td style="text-align:center; vertical-align: middle;  font-size:15px">'.$v['packing'].'</td>
                                            <td style="text-align:center; vertical-align: middle;  font-size:15px">'.$v['qty'].'</td> 
				            <td style="text-align:center; vertical-align: middle;  font-size:15px">'.$v['rate'].'</td>
				            <td style="text-align:center; vertical-align: middle;  font-size:15px">'.$v['cbm'].'</td>
                                            <td style="text-align:center; vertical-align: middle;  font-size:15px">'.$v['tcbm'].'</td>
				            <td style="text-align:center; vertical-align: middle;  font-size:15px">'.$v['amount'].'</td>
			          	</tr>';
                                         $r++;
			          }
			         
			          $html .= '
     <tr>
     <td></td>
<td style="text-align:center ; font-size: large"><b>Total</td> 
<td><b>Total Carton:</td> 
<td style="text-align:center" >'.$order_data['tctn'].'</td> 
<td><b>Total Set/Pc:</td> 
<td style="text-align:center">'.$order_data['tset'].'</td> 
    <td><b>Total CBM:</td> 
<td style="text-align:center">'.$order_data['tcbm'].'</td> 
<td><b>Total Amount:</td> 
<td  style="text-align:center">'.$order_data['gross_amount'].'$</td> 

</tr> 


</tbody>
			        </table>
			      
			    </div>
			  

			   
			      <div class="col-xs-7 pull pull-Left">

			        <table  style= "page-break-inside:avoid" class="table  table-striped">
                                
			              <th style="text-align:center" >Comments or Special Instructions</th>
			             
			            </tr>
			            <tr>
                                  ';
			           
			            	$html .= '<tr>
				              <th style= "font-size:12px">'."- ".$order_data['note1'].'</th></tr>
				              <tr><th style= "font-size:12px">'."- ".$order_data['note2'].'</th></tr>
                                                  
                                                <tr>  <th style= "font-size:12px">'.$order_data['note3'].'</th></tr>
                                                    <tr>  <th style= "font-size:12px">'.$order_data['note4'].'</th></tr>
				            </tr>';
			            			            
			            
			            $html .=' 
			          </table>
			        </div>
			      <div class="col-xs-5 pull pull-right">

			        <table style= "page-break-inside:avoid" class="table  table-striped">
                                <tr>
                                <tr>
			              <th>Total Amount:</th>
			              <td>'.$order_data['gross_amount'].'</td>
			            </tr>
			           
                                  ';
			            if($order_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
				              <td>'.$order_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Paid Amount:</th>
			              <td>'.$order_data['discount'].'</td>
			            </tr>
			            
                                    <tr>
			              <th>Shipping Fees:</th>
			              <td>'.$paid_status.'</td>
			            </tr>
                                    <tr>
			              <th>Net Amount:</th>
			              <td>'.$order_data['net_amount'].'</td>
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
//header('Content-Type:application/xls');
//header('Content-Disposition:attachment;filename=report.xls');
			
                                    echo $html;
		}
	}
public function toexcel($id)
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $order_data['date_time']);
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
                        
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>AdminLTE 2 | Invoice</title>
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
 
  overflow-y: hidden;
  overflow-x: hidden;
}
</style>
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			          <small class="pull-right">Date: '.$order_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Bill ID:</b> '.$order_data['bill_no'].'<br>
			        <b>Name:</b> '.$order_data['customer_name'].'<br>
			        <b>Address:</b> '.$order_data['customer_address'].' <br />
			        <b>Phone:</b> '.$order_data['customer_phone'].'
			      </div>
			      <!-- /.col -->
			    </div>
                            
			    <!-- /.row -->
			    <div  class="row">
			      <div  class="col-xs-12 table-responsive">
			        <table border=1 class="inlineTable">
			          <thead>
                                  <td><img src='.base_url('assets\images\log-header\header.png').'  width="500" height="100" ></td>
                                           
			          <tr>
                                  <th>Image</th>
			            <th>Product name</th>
                                    <th>CTN</th>
                                    <th>Packing</th>
                                    <th>Qty</th>
			            <th>Price</th>
                                    <th>CBM</th>
                                    <th>Total CBM</th>
			            <th>Amount</th>
			          </tr>
			          </thead>
			          <tbody >'; 

			          foreach ($orders_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
                                            <td><img src='.base_url($v['image']).'  width="100" height="100" ></td>
                                            <td width="110" height="110" style="text-align:center ; vertical-align: middle"  >'.$product_data['name'].'</td>
                                            <td style="text-align:center ; vertical-align: middle" >'.$v['ctn'].'</td>
                                            <td style="text-align:center ; vertical-align: middle" >'.$v['packing'].'</td>
                                            <td style="text-align:center ; vertical-align: middle" >'.$v['qty'].'</td> 
				            <td style="text-align:center ; vertical-align: middle" >'.$v['rate'].'</td>
				            <td style="text-align:center ; vertical-align: middle" >'.$v['cbm'].'</td>
                                            <td style="text-align:center ; vertical-align: middle" >'.$v['tcbm'].'</td>
				            <td style="text-align:center ; vertical-align: middle" >'.$v['amount'].'</td>
			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
                                   <tr>
			              <th>Total Set/Pc:</th>
			              <td>'.$order_data['tset'].'</td>
			            </tr>
			           
                                    <tr>
			              <th>Totoal Carton:</th>
			              <td>'.$order_data['tctn'].'</td>
			            </tr>
			           
                                    <tr>
			              <th>Total CBM:</th>
			              <td>'.$order_data['tcbm'].'</td>
			            </tr>
			            <tr>
			              <th style="width:50%">Gross Amount:</th>
			              <td>'.$order_data['gross_amount'].'</td>
			            </tr>';

			          
			            if($order_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
				              <td>'.$order_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$order_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$order_data['net_amount'].'</td>
			            </tr>
			            <tr>
			              <th>Paid Status:</th>
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
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=report.xls');
			  echo $html;
		}
	}

}