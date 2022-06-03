<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workorder_acc extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Workorder_acc';

		$this->load->model('model_Workorder_acc');
                $this->load->model('model_Production');
	}

	/* 
    * It only redirects to the manage Workorder_acc page
    */
	public function index()
	{
		if(!in_array('viewWorkorder_acc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('Workorder_acc/index', $this->data);	
	}

	/*
	* It retrieve the specific Workorder_acc information via a Workorder_acc id
	* and returns the data in json format.
	*/
	public function fetchWorkorder_accDataById($id) 
	{
		if($id) {
			$data = $this->model_Workorder_acc->getWorkorder_accData($id);
			echo json_encode($data);
		}
	}

	/*
	* It retrieves all the Workorder_acc data from the database 
	* This function is called from the datatable ajax function
	* The data is return based on the json format.
	*/
           public function getProductsNumber($e)
            {
                    $ProductsNumber = $this->model_Workorder_acc->doneWorkorder_acccount1($e);
                    echo json_encode($ProductsNumber);
            }
            public function getProductsid($e)
            {
                    $ProductsNumber = $this->model_Workorder_acc->doneWorkorder_acccount2($e);
                    echo json_encode($ProductsNumber);
            }
	public function fetchWorkorder_accData()
	{
		$result = array('data' => array());

		$data = $this->model_Workorder_acc->getWorkorder_accData();
                $countwnum = '';
		foreach ($data as $key => $value) {
                $wnum = $this->model_Workorder_acc->getWorkorder_acccount($value['name']);
                $Dwnum = $this->model_Workorder_acc->doneWorkorder_acccount($value['name']);
                $countwnum = count($wnum);
                $countdwnum = count($Dwnum);
                $countdwnum1='<span class="label label-success" style = "font-size : 13px">'.$countdwnum.' Finished</span>';
			// button
                                $buttons = '';

			if(in_array('updateWorkorder_acc', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteWorkorder_acc', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
                         if ($value['done']!= '')
                    {      $check_l = json_decode($value['done']);
                    $Product = json_decode($value['products']);
                             foreach ($check_l as $k2 => $v2)
                             { 
                                 if($v2== 1)
                                 {$v2= "Done";}elseif ($v2==0){$v2= "Pending";}
                                 $Check1[$k2]= $v2."-".$Product[$k2]."<p>";
                                 
                             }   
                            
                           }else {$Check1[0]=0;}
                           $z = print_r($Check1,true);
                           $z= str_replace('Array','', $z); 
                           $z= str_replace('(','', $z);
                            $z= str_replace(')','', $z);
                foreach ($wnum as $k =>$v){
                    if($v['availability']=="Done"){$rrr= "Checked";} else {
                    $rrr='';}
                   
                    $rr[$k+1]='<p>'.$v['Number'].'<input type="checkbox" disabled style="width: 20px; height: 20px;"  '.$rrr.' ></p>';}
                           $list = '<span >'.print_r ($rr,true).'<p> </span>';
                           $list2= str_replace('Array','', $list);
                           $list3= str_replace('(','', $list2);
                           $list4=str_replace(')','', $list3);
                           $list5=str_replace('=>','', $list4);
                            if ($countwnum == 0 ){$list5 = 0;}
                        $result['data'][$key] = array(
				$value['name'],
                                $value['customer'],
                                $value['name'],
                                $countwnum.'<p></p>'.$countdwnum1.'<p></p>'.$list5,
				$z,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it inserts the data into the database and 
    returns the appropriate message in the json format.
    */
	public function create()
	{
		if(!in_array('createWorkorder_acc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('Workorder_acc_name', 'Workorder_acc name', 'trim|required|is_unique[workorder.name]');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('Workorder_acc_name'),
                    'customer' => $this->input->post('Customer'),
                    'delivery' => $this->input->post('Delivery'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_Workorder_acc->create($data);
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
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it updates the data into the database and 
    returns a n appropriate message in the json format.
    */
	public function update($id)
	{
		if(!in_array('updateWorkorder_acc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_Workorder_acc_name', 'Workorder_acc name', 'trim|required');
			

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        	    'name' => $this->input->post('edit_Workorder_acc_name'),
                            'customer' => $this->input->post('edit_Customer'),
	        	    'done' =>  json_encode($this->input->post('status2')),
                            'p_id' =>  json_encode($this->input->post('P_ID')),
                            'products' =>  json_encode($this->input->post('Number'), JSON_UNESCAPED_UNICODE),
                            'cost' => json_encode($this->input->post('indirect'), JSON_UNESCAPED_UNICODE),
	        	
                            );

	        	$update = $this->model_Workorder_acc->update($data, $id);
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
	* If checks if the Workorder_acc id is provided on the function, if not then an appropriate message 
	is return on the json format
    * If the validation is valid then it removes the data into the database and returns an appropriate 
    message in the json format.
    */
	public function remove()
	{
		if(!in_array('deleteWorkorder_acc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$Workorder_acc_id = $this->input->post('Workorder_acc_id');

		$response = array();
		if($Workorder_acc_id) {
			$delete = $this->model_Workorder_acc->remove($Workorder_acc_id);
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
         public function printReport($id2)
            {
                    if(!in_array('updateProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }
            $id3 = $this->model_Production->getProductionReportData($id2);
            $id4 = json_decode($id3['Production_ID']);
            
          
             for($rr = 0; $rr < count($id4); $rr++) 
             { 
                         $id=$id4[$rr];
                         $Prod_data = $this->model_Production->getProductionData($id);
                         $Workshop_data_dis = json_decode($Prod_data['Workshop_Dis']);
                         $Workshop_data_dis_1[$rr]=$Workshop_data_dis;
                         $Workshop_ID= json_decode($Prod_data['Workshop']);
                         $Workshop_ID_1[$rr]=$Workshop_ID;
                         $Materials_data_dis = json_decode($Prod_data['Material_Dis']);
                         $Materials_data_dis_1[$rr]=$Materials_data_dis;
                         $Materials_ID = json_decode($Prod_data['Material_ID']);
                         $Materials_ID_1[$rr] =$Materials_ID;
                         $quantity_data = json_decode($Prod_data['qty_Dis']);
                         $quantity_data_1[$rr]=$quantity_data;
                         $quantity_ID = json_decode($Prod_data['Mqty']);
                         $quantity_ID_1[$rr]=$quantity_ID;
                         $Note_1= json_decode($Prod_data['Note_1']);
                         $Note_1_1[$rr]=$Note_1;
                         $Note_2 = json_decode($Prod_data['Note_2']);
                         $Note_2_1[$rr]=$Note_2;
                         $Qnty_1 = json_decode($Prod_data['Qnty_1']);
                         $Qnty_1_1[$rr]=$Qnty_1;
                         $Qnty_2 = json_decode($Prod_data['Qnty_2']);
                         $Qnty_2_1[$rr]=$Qnty_2;
                         $Note_data_dis = json_decode($Prod_data['Note_Dis']);
                         $Note_data_dis_1[$rr]=$Note_data_dis;
                         $id_1[$rr]=$Prod_data['id'];
                         $name_1[$rr] = $Prod_data['name'];
                         $number_1[$rr]= $Prod_data['Number'];
                         $design_1[$rr] =$Prod_data['Design'];
                         $barcod_1[$rr]=$Prod_data['Barcode'];
                         $qnty_1[$rr]=$Prod_data['Added_Q'];
                         
                    }

                             
                            $Pricing_date = date('d/m/Y', $Prod_data['date_time']);

                            $html = '<!-- Main content -->
                            <!DOCTYPE html>
                            <html>

    <!-- media="screen" means these styles will only be used by screen 
      devices (e.g. monitors) -->

    <!-- media types can be combined with commas to affect multiple devices -->
    <style type="text/css" media="screen,print">
        h1{
          font-family: Arial, Helvetica, sans-serif;
          font-size: large;
          font-weight: bold;

        }


    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;

    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 1px;
      text-align:center
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
                            <head>

                              <meta charset="utf-8">
                              <meta http-equiv="X-UA-Compatible" content="IE=edge">

                              <!-- Tell the browser to be responsive to screen width -->
                              <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                              <!-- Bootstrap 3.3.7 -->
                              <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
                              <!-- Font Awesome -->
                              <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
                              <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
                            </head>
                            <body onload="window.print();">






                            <div class="wrapper">

                            <h5 style = "text-align:center" ><b>Production Report/تقرير إنتاج</b></h5>
                              <section class="invoice">
                                <!-- title row -->
                                <div class="row">
                                  <div class="col-xs-12">

                                    <h3 class="page-header">

                                <img src='.base_url('assets\images\designs\byblos.gif').' alt="Trulli" width="100" height="40">



                                      <small class="pull-right">Date: '.$Pricing_date.'</small>
                                    </h3>
                                    ';
                                     for($r1 = 0; $r1 < count($id_1); $r1++){
                                       $html .= '  <h3><small class="pull-left" > | ID: '. $id_1[$r1].'</small></h3><P></P>';
                                    }
                                       $html .= '      

                                </div>
                                  <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <p></p>
                                <div class="row invoice-info">
                                 
                                  <div class="col-sm-4 invoice-col" style="width: 100%">';
                            for($n1 = 0; $n1 < count($name_1); $n1++){
                                   $html .= ' <b>- رقم الطلب /Production Number:</b> '.$name_1[$n1]."|".'
                                    <b>رقم المنتج/Product Number:</b> '.$number_1[$n1]."|".'
                                    
                                    <b>الكمية المنتجة/Produced Qty:</b> '.$qnty_1[$n1].' Sets <br />';
                              }
                                   $html .= ' 

                                  </div>

                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
 <P style="page-break-before: always"></P>
                                <!-- Table row -->
                                <div class="row">
                                  <div class="col-xs-12 table-responsive">
                                    <table  border=1 class="inlineTable" >
                                    <thead><h4 style = " text-align:center">Items Used/ المواد الاولية المستخدمة</h2></thead>
                                      <thead>
                                      <tr >
                                      <th  style = "text-align:center" >Item name/ المواد</th>
                                       <th style = "text-align:center" > Qnt/كمية (Set)</th>
                                      </tr>
                                      </thead>
                                      <tbody>'; 

                                    
                                      for($t1 = 0; $t1 < count($Materials_ID_1); $t1++) {
                                         $html .=' <td style= "font-size: 25px" ><b>'."$number_1[$t1]".'</td>';
                                       for($j = 0; $j < count($Materials_ID_1[$t1]); $j++) {
                                            $Material_ID1 = $this->model_brands->getBrandData($Materials_ID_1[$t1][$j]); 


                                             if ($Materials_ID_1[$t1][$j] == '-'){$MaterialValueID[$t1]="-";}else{$MaterialValueID[$t1]=$Material_ID1['name'];}
                                           
                                          for($i15 = 0; $i15 < count($Materials_data_dis_1[$t1]); $i15++){
                                          $MaterialD_data5 = $this->model_brands->getBrandData($Materials_data_dis_1[$t1][$i15]); 
                                          if ($i15 != 0){$sum = $quantity_data_1[$t1][$i15-1];} else{$sum =0;}
                                          if ($Material_ID1['Code']  == $MaterialD_data5['Code'] )
                                           
                                          {$sum_material = (int) $quantity_data_1[$t1][$i15] + (int) $sum; }
                                           else {$sum_material=0;}
                                       }
                                       $totalqty =  (int)$quantity_ID_1[$t1][$j];
                                             $html .= '<tr>       

                                             <td>'.$MaterialValueID[$t1]."| Code: ".$Material_ID1['Code'].'</td>

                                              <td>'."$totalqty"."+ "."$sum_material"."= ".($totalqty + $sum_material).'</td> 
                                                 </tr>';
                                            }
                                       }
                                      $html .= '</tbody>
                                    </table>
                                    <P style="page-break-before: always"></P>
                                    
                                    <font size="2" face="Courier New" >
                                    <table     border=1 class="inlineTable">

                                    <thead><h4 style = " text-align:center" >Disposal/الهدر</h4></thead>
                                      <thead>
                                      <tr>
                                        <th  style = "text-align:center" >Item name/ المواد</th>
                                       <th  style = "text-align:center" >Workshop Name/ أسم القسم</th>
                                        <th  style = "text-align:center" >Disposal Qnt/كمية الهدر</th>
                                        <th style = "text-align:center" >Reason/سبب الهدر</th>
                                        </tr>
                                      </thead>
                                      <tbody>'; 
                                     
                          for($i = 0; $i < count($Materials_data_dis_1); $i++) {
                               $html .='<td style= "font-size: 25px" ><b>'."$number_1[$i]".'</td>';
                                        for($i1 = 0; $i1 < count($Materials_data_dis_1[$i]); $i1++){
                                            $MaterialD_data = $this->model_brands->getBrandData($Materials_data_dis_1[$i][$i1]); 
                                            $Workshop_data = $this->model_Workshop->getWorkshopData($Workshop_data_dis_1[$i][$i1]);
                                            
                                            if ($Materials_data_dis_1[$i] == '-')
                                            {$MaterialValue="-";}
                                            else{$MaterialValue=$MaterialD_data['name'];}
                                             if ($Workshop_data_dis_1[$i][$i1] == '-')
                                             {$workshopValue="-";}
                                             else{$workshopValue=$Workshop_data['name'];}
                                            $html .= '<tr>       
                                         <td>'.$MaterialValue."| Code:".$MaterialD_data['Code'].'</td>
                                             <td>'.$workshopValue.'</td>

                                              <td>'.$quantity_data_1[$i][$i1].'</td> 
                                                   <td>'.$Note_data_dis_1[$i][$i1].'</td>

                                            </tr>';
                                          
                                        }}

                                      $html .= '</tbody>
                                    </table>
                                    </font>

    <font size="2" face="Courier New" >


 <P style="page-break-before: always"></P>
    <table   border=1 class="inlineTable">
    <thead><h4 style = " text-align:center">Used Maretial/المواد المستخدمة في الإنتاج</h4> </thead>
    <thead>
    <tr>
    <th style = "width: 40% ;  text-align:center" >Workshop Name/ أسم القسم</th>
    <th  style = "text-align:center" >Materials/المواد المستعملة</th>
    <th  style = "text-align:center">Quantity/الكمية</th>
    <th  style = "text-align:center">Materials/المواد المستعملة</th>
    <th  style = "text-align:center">Quantity/الكمية</th>

    </tr>
    </thead>

    <tbody>';


    for($l = 0; $l < count($Workshop_ID_1); $l++)
    {
        $html .='<td style= "font-size: 25px" > <b>'."$number_1[$l]".'</td>';
        for($l1 = 0; $l1 < count($Workshop_ID_1[$l]); $l1++){
           

    $Workshop_ID2 = $this->model_Workshop->getWorkshopData($Workshop_ID_1[$l][$l1]);
    if ($Workshop_ID_1[$l][$l1] != 13 && $Workshop_ID_1[$l][$l1] != 14){
    if ($Workshop_ID_1[$l][$l1] == '' ){$workshopValueID[$l1]="-";}else{$workshopValueID[$l1]=$Workshop_ID2['name'];}


    $html .=' <tr> 
    <td>'.$workshopValueID[$l1].'</td>  
    <td>'.$Note_1_1[$l][$l1].'</td>
    <td>'.$Qnty_1_1[$l][$l1].'</td>
    <td>'.$Note_2_1[$l][$l1].'</td>
    <td>'.$Qnty_2_1[$l][$l1].'</td>
    </tr>';
        }}
    
    
    }

    $html .=' 
    </tbody>
    </table>

    </font>
    <!-- /.col -->




    </div>

    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    </body>

    <style>

    body {
    height: auto; 

      overflow-y: hidden;
      overflow-x: hidden;
    }
    </style>
            </html>';
                                          // header('Content-Type:application/xls');
    //header('Content-Disposition:attachment;filename=report.xls');

                              echo $html;

                    }

}