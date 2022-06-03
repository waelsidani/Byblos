    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Production extends Admin_Controller 
    {
            public function __construct()
            {
                    parent::__construct();

                    $this->not_logged_in();

                    $this->data['page_title'] = 'Production';
                    $this->load->model('Model_Pricing');
                    $this->load->model('model_Production');
                    $this->load->model('model_brands');
                    $this->load->model('model_category');
                    $this->load->model('model_stores');
                    $this->load->model('model_attributes');
                    $this->load->model('model_products');
                    $this->load->model('model_company');
                    $this->load->model('model_Workshop');
                    $this->load->model('model_Store');
                    $this->load->model('model_Workorder');
                    $this->load->model('Model_Workers');
                    $this->load->model('model_Workorder_acc');

            }

        /* 
        * It only redirects to the manage Production page
        */
            public function index()
            {
            if(!in_array('viewProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }
         
            
                    
                $this->render_template('Production/index', $this->data);	
            }
             public function log()
            {
            if(!in_array('viewProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }
         
            
                    
                $this->render_template('Production/log', $this->data);	
            }

        /*
        * It Fetches the Production data from the Production table 
        * this function is called from the datatable ajax function
        */
            public function fetchProductionData()
            {
                    $result = array('data' => array());
 if(!in_array('deleteProduction', $this->permission)){
                    $data = $this->model_Production->getProductionData1();
 }
 else {$data = $this->model_Production->getProductionData();}
                    foreach ($data as $key => $value) {

            
                            // button
                $buttons = '';
                if(in_array('updateProduction', $this->permission) || in_array('viewProduction', $this->permission) ) {
                            $buttons .= '<a href="'.base_url('Production/update/'.$value['id']).'" class="btn btn-default" target="_blank"><i class="fa fa-pencil"></i></a>';
                }


                if(in_array('deleteProduction', $this->permission)) { 
                            $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
                }
                    if(in_array('createProduction', $this->permission)) {
                            $buttons .= '<a href="'.base_url('Production/doublicate/'.$value['id']).'" class="btn btn-default"><i class="fa fa-refresh"></i></a>';
                }	
    //            if(in_array('deleteProduction', $this->permission)) {
    //                        $buttons .= '<input type= "checkbox" name="checkboxvar[]" >1<br>';
    //            }	

                            $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'"  width="100" height="100" />';

                $availability = ($value['availability'] !== "Done") ? '<span class="label label-warning">In Progress</span>' : '<span class="label label-success">Finished</span>';
    $date5 = date('Y-m-d', $value['date_time']);
                            $time2 = date('H:i ', $value['date_time']);

                            $date_time2 = $date5 . ' ' . "[".$time2."]";
                $pro_approval = '';
                if($value['approval'] ==1 ) {
                    $pro_approval = '<span class="label label-success">Approved</span>';
                }  if($value['approval'] == 2) {
                    $pro_approval = '<span class="label label-info">Need Approval</span>';
                }elseif ($value['approval'] ==3) {
                    
                    $pro_approval ='<span class="label label-danger">Canceled</span>'; 
                }
                if($value['approval_Pause']== 1 )
                {$pause ='<span class="label label-danger">Paused</span>' ; }
                else {$pause = "";}

                $pro_Stop = '';
                if($value['not_rec'] ==0 ) {
                    $pro_Stop = '<span class="label label-danger">Stopped</span>';
                }
                if ($value['Added_Q'] != null)
                {$d_qty = $value['Added_Q'];}
                else 
                {$d_qty = 0;}
                if ($value['Status'] !== ''&& $value['Status'] !== null){
               
                $stat2= (substr_count($value['Status'], '2') * 100 ) ;
                $stat1= (substr_count($value['Status'], '1') * 100 );
                $stat3 = count(json_decode($value['Status']));
                
                $stat= $stat2 / $stat3;
                $stat_p=$stat1 / $stat3;
                $stat= sprintf("%02d", $stat);
                $stat_p = sprintf("%02d", $stat_p);
                $procc= '';
                $rawMaterial_s=0;
                $rawMaterial_t=0;
                if (json_decode($value['MID_status1']) != ''){
                        foreach (json_decode($value['MID_status1']) as $Key1 => $Value1)
                {if ($Value1 == "2" )
                {$rawMaterial_s = $rawMaterial_s+1;}
                else{$rawMaterial_t = $rawMaterial_t+1;}
                }
                }
                $disposal=0;
                foreach (json_decode($value['Material_Dis']) as $Key2 => $Value2)
                if ($Value2 != "-")
                {
                    $disposal = $disposal+1 ;
                }
              
               
                
                $procc = '<div class="progress" style = "background-color : red"> <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: ' .$stat.'%">
     '.$stat.' % Complete (success)</div> <div class="progress-bar progress-bar-warning" role="progressbar" style="width:'.$stat_p.'%">'.$stat_p.'%</div></div>';
    
                } else {$procc = 0;}
                
                                  $result['data'][$key] = array(
                                      $key+1,
                                    $buttons.'<p></p>'."<b>Sent to Store: ".$rawMaterial_s.'<p></p>'."<b style = 'background-color : red; color : white;'>Not Sent: ".$rawMaterial_t,
                                    $pause.$pro_approval.'<p></p>'. $value['id'].'<p></p>'. $procc,
                                    $img,
                                    $value['Design'],
                                    $value['name'],
                                    $value['Number'],
                                    "<b>Requested= ".$value['qty'] ."<p>"."<b>Delivered= ".$d_qty."<p>"."<b style = 'background-color : #997bea; '>Disposal count= ".$disposal ,
                                    $date_time2,
                                    $value['date_time_finished'] ,
                                    $availability.'<p></p>'.$pro_Stop,

                );
                
                
                    // /foreach
                    }
                    echo json_encode($result);
            }	

        /*
        * If the validation is not valid, then it redirects to the create page.
        * If the validation for each input field is valid then it inserts the data into the database 
        * and it stores the operation message into the session flashdata and display on the manage Production page
        */
            
            public function fetchProductionlog()
            {
                    $result = array('data' => array());
 
  {$data = $this->model_Production->getProductionlog();}
                    foreach ($data as $key => $value) {

            
                            // button
                $buttons = '';
                if(in_array('updateProduction', $this->permission) || in_array('viewProduction', $this->permission) ) {
                            $buttons .= '<a href="'.base_url('Production/item_histry/'.$value['id']).'" class="btn btn-default" target="_blank"><i class="fa fa-pencil"></i></a>';
                }


      
                           
                $availability = ($value['availability'] !== "Done") ? '<span class="label label-warning">In Progress</span>' : '<span class="label label-success">Finished</span>';
    $date5 = date('d-m-Y', $value['date_time']);
                            $time2 = date('h:i a', $value['date_time']);

                            $date_time2 = $date5 . ' ' . $time2;
                $pro_approval = '';
                if($value['approval'] ==1 ) {
                    $pro_approval = '<span class="label label-success">Approved</span>';
                }  if($value['approval'] == 2) {
                    $pro_approval = '<span class="label label-info">Need Approval</span>';
                }elseif ($value['approval'] ==3) {
                    
                    $pro_approval ='<span class="label label-danger">Canceled</span>'; 
                }
                if($value['approval_Pause']== 1 )
                {$pause ='<span class="label label-danger">Paused</span>' ; }
                else {$pause = "";}
 
                $pro_Stop = '';
                if($value['not_rec'] ==0 ) {
                    $pro_Stop = '<span class="label label-danger">Stopped</span>';
                }
                
                if ($value['Status'] !== ''&& $value['Status'] !== null){
               
                $stat2= (substr_count($value['Status'], '2') * 100 ) ;
                $stat1= (substr_count($value['Status'], '1') * 100 );
                $stat3 = count(json_decode($value['Status']));
                
                $stat= $stat2 / $stat3;
                $stat_p=$stat1 / $stat3;
                $stat= sprintf("%02d", $stat);
                $stat_p = sprintf("%02d", $stat_p);
                $procc= '';
                
                $procc = '<div class="progress" style = "background-color : red"> <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: ' .$stat.'%">
     '.$stat.' % Complete (success)</div> <div class="progress-bar progress-bar-warning" role="progressbar" style="width:'.$stat_p.'%">'.$stat_p.'%</div></div>';
    
               
                } else {$procc = 0;}
                
                                  $result['data'][$key] = array(
                                    $buttons,
                                    $pause.$pro_approval.'<p></p>'. $value['p_id'].'<p></p>'. $procc,
                                     
                                    $value['Design'],
                                    $value['name'],
                                    $value['Number'],
                                    $value['qty'],
                                    $date_time2,
                                    $value['user'] ,
                                    $availability.'<p></p>'.$pro_Stop,

                );
                
                
                    // /foreach
                    }
                    echo json_encode($result);
            }	

        /*
        * If the validation is not valid, then it redirects to the create page.
        * If the validation for each input field is valid then it inserts the data into the database 
        * and it stores the operation message into the session flashdata and display on the manage Production page
        */
            public function create()
            {
                    if(!in_array('createProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }

            $this->form_validation->set_rules('workshop[]', 'Workshop name', 'trim|required');
            $this->form_validation->set_rules('Production_name', 'Production name', 'trim|required');
            $this->form_validation->set_rules('P_number', 'Procuct Number', 'trim|required');
            $this->form_validation->set_rules('Added_Q', 'Added_Q', 'trim|required');
            $this->form_validation->set_rules('qty', 'Qty', 'trim|required');
            $this->form_validation->set_rules('store', 'Store', 'trim|required');
            $this->form_validation->set_rules('availability', 'Availability', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            $this->form_validation->set_rules('Status', 'description', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                // true case
                    $upload_image2 = $this->upload_image();

                    $pricingid=$this->input->post('Pricing');
                $productiondata = $this->Model_Pricing-> getPricingItemData11($pricingid);
            if ($productiondata)
            {
                foreach ($productiondata as $k => $v) 
                {
                    $result[$k] = $v['Material_ID'];
                }
            }
            //print_r($result);die;
  $m_status=[];
$m_status[0]=0;
                    $data = array(
                    'name' => $this->input->post('Production_name'),
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'P_number' => $this->input->post('P_number'),
                    'Added_Q' => 0,
                    'qty' => $this->input->post('qty'),
                    'qty_Dis' => "[0]",
                    'Note_Dis' => "[0]",
                    'Added_Q' => $this->input->post('Added_Q'),
                    'description' => $this->input->post('description'),
                    'pricing' => $this->input->post('Pricing'),
                    'Workshop' => json_encode($this->input->post('workshop')),
                    'Workshop_Dis' => "[1]",
                    'Material_Dis' => "[0]",
                    'store_id' => $this->input->post('store'),
                    'availability' => $this->input->post('availability'),
                    'Status' => json_encode(["0"]),
                    'Material_ID'=> json_encode($result),
                    'approval' => 2,
                    'date_time_finished'=>0,
                    'not_rec' => 0,  
                    'MID_status' => json_encode($m_status),
                       'Report_Pro_Workshop' => 'null', 
                    );


                    $create = $this->model_Production->create($data);
       $date2 = strtotime(date('Y-m-d h:i:s a'));
                    $Number = $this->input->post('Production_name');

                        $to = 'wael@byblosglass.com , muhammed@byblosglass.com';
    $subject = 'تم إنشاء طلب إنتاج جديد';
    $message = $Number.' : '.' تم إنشاء طلب إنتاج الرجاء الإتطلاع عليه والموافق أو الرفض  شرح الطلب <----> Http://192.168.1.251/byblos';
    $headers = "From: Byblos Software\r\n";
    if (mail($to, $subject, $message, $headers)) {
       echo "SUCCESS";
    } else {
       echo "ERROR";
    }

                    if($create == false) {
                            $this->session->set_flashdata('success', 'Successfully created');
                            redirect('Production/', 'refresh');

                    }
                    else {
                            $this->session->set_flashdata('errors', 'Error occurred!!');
                            redirect('Production/create', 'refresh');

                    }
            }
            else {
                // false case

                    // attributes 
                    $attribute_data = $this->model_attributes->getActiveAttributeData();

                    $attributes_final_data = array();
                    foreach ($attribute_data as $k => $v) {
                            $attributes_final_data[$k]['attribute_data'] = $v;

                            $value = $this->model_attributes->getAttributeValueData($v['id']);

                            $attributes_final_data[$k]['attribute_value'] = $value;
                    }

                    $this->data['attributes'] = $attributes_final_data;
                            $this->data['Pricing'] = $this->Model_Pricing->getPricingData();        	
                            $this->data['category'] = $this->model_category->getActiveCategroy();        	
                            $this->data['stores'] = $this->model_stores->getActiveStore();        	
                            $this->data['workshop'] = $this->Model_Pricing->getPricingItemData2();
                            $this->data['Materialid'] = $this->Model_Pricing->getActiveMaterialData();
                            $this->data['products2'] = $this->model_products->getProductData();   
                            $this->render_template('Production/create', $this->data);

            }	
            }

        /*
        * This function is invoked from another function to upload the image into the assets folder
        * and returns the image path
        */

            public function upload_image()
        {
            // assets/images/Production_image
            $config2['upload_path'] = 'assets/images/product_image';
            $config2['file_name'] =  uniqid();
            $config2['allowed_types'] = 'gif|jpg|png';
            $config2['max_size'] = '1000';

            // $config['max_width']  = '1024';s
            // $config['max_height']  = '768';

            $this->load->library('upload', $config2);
            if ( ! $this->upload->do_upload('Production_image'))
            {
                $error = $this->upload->display_errors();
                return $error;
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $type = explode('.', $_FILES['Production_image']['name']);
                $type = $type[count($type) - 1];

                $path = $config2['upload_path'].'/'.$config2['file_name'].'.'.$type;
                return ($data == true) ? $path : false;            
            }
        }

        /*
        * If the validation is not valid, then it redirects to the edit Production page 
        * If the validation is successfully then it updates the data into the database 
        * and it stores the operation message into the session flashdata and display on the manage Production page
        */
            public function update($Production_id)
            {      
            if(!in_array('updateProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }

            if(!$Production_id) {
                redirect('dashboard', 'refresh');
            }
            $this->form_validation->set_rules('Material[]', 'Material ID', 'trim|required');
            $this->form_validation->set_rules('Status[]', 'Status ID', 'trim|required');   
            $this->form_validation->set_rules('workshop[]', 'Workshop name', 'trim|required');
            $this->form_validation->set_rules('Production_name', 'Production name', 'trim|required');
            $this->form_validation->set_rules('Design', 'SKU', 'trim|required');
            $this->form_validation->set_rules('Number', 'Number', 'trim|required');
            $this->form_validation->set_rules('P_number', 'Product Numner', 'trim|required');
            $this->form_validation->set_rules('Barcode', 'Barcode', 'trim|required');
          
            $this->form_validation->set_rules('store', 'Store', 'trim|required');
            $this->form_validation->set_rules('availability', 'Availability', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                // true case   
                $data = array(
                    'p_id' => $this->input->post('p_id'),
                    'reason_cancellation'=> $this->input->post('reason_cancellation'),
                    'name' => $this->input->post('Production_name'),
                    'Design' => $this->input->post('Design'),
                    'P_number' => $this->input->post('P_number'),
                    'image' => $this->input->post('imagurl'),
                    'Number' => $this->input->post('Number'),
                    'Barcode' => $this->input->post('Barcode'),
                    'qty' => $this->input->post('qty'),
                    'description' => $this->input->post('description'),
                    'Added_Q' => $this->input->post('Added_Q'),
                    'pricing' => $this->input->post('Pricing'),
                    'Workshop' => json_encode($this->input->post('workshop')),
                    'Workshop_Dis' => json_encode($this->input->post('workshop_Dis')),
                    'Note_1' => json_encode($this->input->post('Note_1')),
                    'Note_2' => json_encode($this->input->post('Note_2')),
                    'Qnty_1' => json_encode($this->input->post('Qnty_1')),
                    'Qnty_2' => json_encode($this->input->post('Qnty_2')),
                    'Material_ID' => json_encode($this->input->post('Material')),
                    'Material_Dis' => json_encode($this->input->post('Material_Dis')),
                    'Status' => json_encode($this->input->post('Status')),
                    'Note_Dis' => json_encode($this->input->post('Note_Dis')),
                    'qty_Dis' => json_encode($this->input->post('qty_Dis')),
                    'MID_status' => json_encode($this->input->post('MID_status')),
                    'MID_status1' => json_encode($this->input->post('MID_status1')),
                    'Mqty' => json_encode($this->input->post('Mqty')),
                    'Rec_time' => json_encode($this->input->post('Rec_time')),
                    'Rec_min' => json_encode($this->input->post('Rec_min')),
                    'Finish_min' => json_encode($this->input->post('Finish_min')),
                    'Finish_time' => json_encode($this->input->post('Finish_time')),
                    'Total_time' => json_encode($this->input->post('Total_time')),
                    'Prod_num' => json_encode($this->input->post('Prod_num')),
                    'Disp_num' => json_encode($this->input->post('Disp_num')),
                    'store_id' => $this->input->post('store'),
                    'approval' =>$this->input->post('approval2'),
                    'approval_Pause' =>$this->input->post('approval3'),
                    'Approval_Person' => $this->input->post('Approval_Person'),
                    'Approval_date' => $this->input->post('Approval_date'),
                    'availability' => $this->input->post('availability'),
                    'date_time_finished' => $this->input->post('ending_time'),
                    'not_rec' => $this->input->post('not_rec'), 
                    'finishtime' => $this->input->post('finishtime'), 
                    'Report_Pro_Workshop' => json_encode($this->input->post('Report_Pro_Workshop')),
                    'Report_Pro_Start' => json_encode($this->input->post('Report_Pro_Start')),
                    'Report_Pro_Finish' => json_encode($this->input->post('Report_Pro_Finish')),
                    'Time_production_Start' => json_encode($this->input->post('Time_production_Start')),
                    'Report_Pro_Qty' => json_encode($this->input->post('Report_Pro_Qty')),
                    'Report_Pro_note' => json_encode($this->input->post('Report_Pro_note')),
                    'Report_Pro_note2' => json_encode($this->input->post('Report_Pro_note2')),
                    'Report_temp_Start' => json_encode($this->input->post('Report_temp_Start')),
                    'Work_production' => json_encode($this->input->post('Work_production')),
                    'Name_production' => json_encode($this->input->post('Name_production')),
                    'Type_production' => json_encode($this->input->post('Type_production')),
                    'Qty_production' => json_encode($this->input->post('Qty_production')),
                    'Time_production' => json_encode($this->input->post('Time_production')),
                    'Pause_Play' => json_encode($this->input->post('Pause_Play')),
                    );
                $store = $this->model_Store->getStoreData2($Production_id);
                $store_raw = $this->model_Store->getStoreData4($Production_id);
                $M_dis_status=$this->input->post('MID_status');
                $M_dis_status1=$this->input->post('MID_status1');

                $count_product = count($M_dis_status);
                $count_product1 = count($M_dis_status1);
            $coutstore_items = count($store);
            $coutstore_items1 = count($store_raw);
            if (($count_product1) > 0){
            {
            foreach ($store_raw as $key => $value){if ($value['Status'] !== '2'){$this->model_Store->remove1($value['id']);}}
                
                for($y = 0; $y < $count_product1; $y++) {
                    
                    if($M_dis_status1[$y] !== '0' && $M_dis_status1[$y] !== '2' && $M_dis_status1[$y] !== ''  ){
                    $items1 = array(
                                    'Status' => $M_dis_status1[$y],
                                    'name' =>$this->input->post('Material')[$y],
                                    'code'=> $this->input->post('Material')[$y],
                                    'Quantity'=> $this->input->post('Mqty')[$y],
                                    'Workshop' =>  10,
                                    'Order_ID'=> $Production_id,
                                    'date_time' => strtotime(date('Y-m-d h:i:s a'))+7200,
                                    'array_num' => $y,
                         

                    );

                    $this->db->insert('raw_store', $items1);


            }}}}

            else {foreach ($store_raw as $key => $value){$this->model_Store->remove1($value['id']);}}
                
            if (($count_product) > 0){
            {
            foreach ($store as $key => $value){if ($value['Status'] !== '2'){$this->model_Store->remove($value['id']);}}
                
                for($x = 0; $x < $count_product; $x++) {
                    
                    if($M_dis_status[$x] !== '0' && $M_dis_status[$x] !== '2' ){
                    $items = array(
                                    'Status' => $M_dis_status[$x],
                                    'name' =>$this->input->post('Material_Dis')[$x],
                                    'code'=> $this->input->post('Material_Dis')[$x],
                                    'Quantity'=> $this->input->post('qty_Dis')[$x],
                                    'Workshop' =>  $this->input->post('workshop_Dis')[$x],
                                    'Order_ID'=> $Production_id,
                                    'date_time' => strtotime(date('Y-m-d h:i:s a'))+7200,
                                    'array_num' => $x,

                    );

                    $this->db->insert('Store', $items);


            }}}}

            else {foreach ($store as $key => $value){$this->model_Store->remove($value['id']);}}
                
                 
                             $product_data2 = $this->model_products->getProductData($this->input->post('P_number'));
                    $qty =  (float)$product_data2['qty'] +   (float)$this->input->post('Added_Q');
                    $update_product2 = array('qty' => $qty);
                    $this->model_products->update($update_product2, $this->input->post('P_number'));
                if($_FILES['Production_image']['size'] > 0) {
                    $upload_image2 = $this->upload_image();
                    $upload_image2 = array('image' => $upload_image2);

                    $this->model_Production->update($upload_image2, $Production_id);
                }

                $update = $this->model_Production->update($data, $Production_id);
                
                $log = array(
                      'p_id' => $this->input->post('p_id'),
                    'date_time' => strtotime(date('Y-m-d h:i:s a'))+7200,
                    'reason_cancellation'=> $this->input->post('reason_cancellation'),
                    'name' => $this->input->post('Production_name'),
                    'Design' => $this->input->post('Design'),
                    'P_number' => $this->input->post('P_number'),
                    'image' => $this->input->post('imagurl'),
                    'Number' => $this->input->post('Number'),
                    'Barcode' => $this->input->post('Barcode'),
                    'qty' => $this->input->post('qty'),
                    'description' => $this->input->post('description'),
                    'Added_Q' => $this->input->post('Added_Q'),
                    'pricing' => $this->input->post('Pricing'),
                    'Workshop' => json_encode($this->input->post('workshop')),
                    'Workshop_Dis' => json_encode($this->input->post('workshop_Dis')),
                    'Note_1' => json_encode($this->input->post('Note_1')),
                    'Note_2' => json_encode($this->input->post('Note_2')),
                    'Qnty_1' => json_encode($this->input->post('Qnty_1')),
                    'Qnty_2' => json_encode($this->input->post('Qnty_2')),
                    'Material_ID' => json_encode($this->input->post('Material')),
                    'Material_Dis' => json_encode($this->input->post('Material_Dis')),
                    'Status' => json_encode($this->input->post('Status')),
                    'Note_Dis' => json_encode($this->input->post('Note_Dis')),
                    'qty_Dis' => json_encode($this->input->post('qty_Dis')),
                    'MID_status' => json_encode($this->input->post('MID_status')),
                    'Mqty' => json_encode($this->input->post('Mqty')),
                    'Rec_time' => json_encode($this->input->post('Rec_time')),
                    'Rec_min' => json_encode($this->input->post('Rec_min')),
                    'Finish_min' => json_encode($this->input->post('Finish_min')),
                    'Finish_time' => json_encode($this->input->post('Finish_time')),
                    'Total_time' => json_encode($this->input->post('Total_time')),
                    'Prod_num' => json_encode($this->input->post('Prod_num')),
                    'Disp_num' => json_encode($this->input->post('Disp_num')),
                    'store_id' => $this->input->post('store'),
                    'approval' =>$this->input->post('approval2'),
                    'approval_Pause' =>$this->input->post('approval3'),
                    'Approval_Person' => $this->input->post('Approval_Person'),
                    'Approval_date' => $this->input->post('Approval_date'),
                    'availability' => $this->input->post('availability'),
                    'date_time_finished' => $this->input->post('ending_time'),
                    'not_rec' => $this->input->post('not_rec'), 
                    'finishtime' => $this->input->post('finishtime'), 
                   
                    'user' => $_SESSION['username'],
                    );
                 
                $this->model_Production->updatelog($log);
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect('Production/update/'.$Production_id, 'refresh');
 
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('Production/update/'.$Production_id, 'refresh');
                      
                }
            }
            else {
                // attributes 


                // false case
              $this->load->model('model_Pricing');
              $P_ID = $this->input->post('P_number');
                $this->data['Pricing'] = $this->Model_Pricing->getPricingData();           
                $this->data['category'] = $this->model_category->getActiveCategroy();           
                $this->data['stores'] = $this->model_stores->getActiveStore();    
                $this->data['workshop'] = $this->Model_Pricing->getPricingItemData2();
                $this->data['Materialid'] = $this->Model_Pricing->getActiveMaterialData();
                $this->data['Employees'] = $this->Model_Workers->getActiveCategroy();
                $this->data['products2'] = $this->model_products->getProductData();
                $this->data['Product_data'] = $this->model_Pricing->getProductData();
                $this->data['Store_data']  = $this->model_Store->getStoreData();
                


                $result = array();
                    $Production_data = $this->model_Pricing->getProductionData($Production_id);

                    $result['Production'] = $Production_data;
                    

                    

                $this->data['Production_data'] = $result;

                $this->data['Production_data'] = $Production_data;

                $this->render_template('Production/edit', $this->data); 
            }   
            }

        /*
        * It removes the data from the database
        * and it returns the response into the json format
         * 
         * 
        */
            
            
               public function item_histry($Production_id)
                
            
               {
                $this->load->model('model_Pricing');
                $P_ID = $this->input->post('P_number');
                $this->data['Pricing'] = $this->Model_Pricing->getPricingData();           
                $this->data['category'] = $this->model_category->getActiveCategroy();           
                $this->data['stores'] = $this->model_stores->getActiveStore();    
                $this->data['workshop'] = $this->Model_Pricing->getPricingItemData2();
                $this->data['Materialid'] = $this->Model_Pricing->getActiveMaterialData();
                $this->data['products2'] = $this->model_products->getProductData();
                $this->data['Product_data'] = $this->model_Pricing->getProductData();
                $this->data['Store_data']  = $this->model_Store->getStoreData();


                $result = array();
                    $Production_data = $this->model_Production->getProductionlog($Production_id);

                    $result['Production'] = $Production_data;
                    

                    

                    $this->data['Production_data'] = $result;

                $this->data['Production_data'] = $Production_data;

                $this->render_template('Production/item_log', $this->data); 
            }   
            
            public function getworkshopValueById()
            {
                    $workshop_id = $this->input->post('workshop_id');
                    if($workshop_id) {
                            $product_data = $this->model_Production->getworkshopData2($workshop_id);
                            echo json_encode($product_data);
                    }
            }
             public function getworkshopValueById2()
            {
                    $workshop_id2 = $this->input->post('workshop_id2');

                            $product_data = $this->model_Production->getworkshopData3($workshop_id2);
                            echo json_encode($product_data);


            }
    public function getTableproduction()
            {
                    $materialsdata = $this->model_Production->getProductionData();
                    echo json_encode($materialsdata);
            }
             public function getTableworkshopRow2()
            {
                    $materialsdata = $this->Model_Pricing->getPricingItemData6();
                    echo json_encode($materialsdata);
            }
            public function getTableworkshopRow()
            {
                    $workshop = $this->Model_Pricing->getPricingItemData2();
                    echo json_encode($workshop);
            }

            public function doublicate($id)
                    {
$stat = [];
            
            $Productions_data = $this->model_Production->getProductionData($id);
            foreach (json_decode($Productions_data['Status']) as $key => $value) {
               $stat[$key]=0; 
            }
           $inser  = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'name' => $Productions_data['name'],
                    'Design' => $Productions_data['Design'],
                    'P_number' => $Productions_data['P_number'],
                    'image' => $Productions_data['image'],
                    'Number' => $Productions_data['Number'],
                    'Barcode' => $Productions_data['Barcode'],
                    'qty' => $Productions_data['qty'],
                    'description' => $Productions_data['description'],
                    'Added_Q' => $Productions_data['Added_Q'],
                    'Pricing' => $Productions_data['Pricing'],
                    'Workshop' => $Productions_data['Workshop'],
                    'Workshop_Dis' => json_encode(["-"]),
                    'Material_Dis' => json_encode(["-"]),
                    'qty_Dis' => json_encode(["0"]),
                    'Note_Dis' => json_encode(["0"]),      
                    'Material_ID' => $Productions_data['Material_ID'],
                    'store_id' =>  $Productions_data['store_id'],
                    'approval' =>  "2",
                    'final_approval' =>  "2",
                    'availability' => "Pending",
                    'MID_status' =>json_encode(["0"]),
                    'not_rec' => $Productions_data['not_rec'],
                    'Status' => json_encode($stat),
                    'Added_Q'=>json_encode(["0"]),
               'Report_Pro_Workshop' => 'null',
               
               
                   );
            $this->model_Production->create($inser);

             redirect('Production/', 'refresh');
            }
            public function remove()
            {
            if(!in_array('deleteProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }

            $Production_id = $this->input->post('Production_id');

            $response = array();
            if($Production_id) {
                $delete = $this->model_Production->remove($Production_id);
                if($delete == true) {
                    $response['success'] = true;
                    $response['messages'] = "Successfully removed"; 
                }
                else {
                    $response['success'] = false;
                    $response['messages'] = "Error in the database while removing the Production information";
                }
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Refersh the page again!!";
            }

            echo json_encode($response);
            }


            public function P_Report()
            {
                    if(!in_array('updateProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }

            $this->form_validation->set_rules('workshop[]', 'Workshop name', 'trim|required');


                              if ($this->input->post('workorder')!= "-"){
                             $workorder= $this->model_Production->workorderdata($this->input->post('workorder'));
                             if ($workorder == ''){$workorder[0]=1;}
                             $workorderarray=[];             
                             foreach ($workorder as $k4 => $v4):
                             $workorderarray[$k4]= $v4['id'];
                              endforeach;}
        if ($this->form_validation->run() == TRUE) {
                
if ($this->input->post('workorder')== "-")
{
    $data = array(
                    
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
               
                    'Production_ID' => json_encode($this->input->post('workshop')),
                    
                    
                    );


                    $create = $this->model_Production->createR($data);
}
else {
    $data = array(
                    
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
               
                    'Production_ID' => json_encode($workorderarray),
                    
                    
                    );


$create = $this->model_Production->createR($data);

}

                    

                    if($create == false) {
                            $this->session->set_flashdata('success', 'Successfully created');
                            redirect('Production/printReport/'.$create, 'refresh');

                    }
                    else {
                            $this->session->set_flashdata('errors', 'Error occurred!!');
                            redirect('Production/printReport/'.$create, 'refresh');

                    }
            }
            else {	
                            $this->data['workshop'] = $this->model_Production->getProductionData();


                            $this->render_template('Production/P_Report', $this->data);

            }	
            }

        /*
        * This function is invoked from another function to upload the image into the assets folder
        * and returns the image path
        */
            
             public function P_Report_1()
            {
                    if(!in_array('updateProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }

        

$this->form_validation->set_rules('start_date', 'start_date', 'trim|required');
$this->form_validation->set_rules('end_date', 'end_date', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                


                    $data = array(
                    
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                         'start_date' => $this->input->post('start_date'),
                         'end_date' => $this->input->post('end_date'),
               
                   
                    
                    
                    );


                    $create = $this->model_Production->createR_1($data);
       



                    if($create == false) {
                            $this->session->set_flashdata('success', 'Successfully created');
                            redirect('Production/printReport/'.$create, 'refresh');

                    }
                    else {
                            $this->session->set_flashdata('errors', 'Error occurred!!');
                            redirect('Production/printReport1/'.$create, 'refresh');

                    }
            }
            else {	
                            


                            $this->render_template('Production/P_Report_1', $this->data);

            }	
            }

        /*
        * This function is invoked from another function to upload the image into the assets folder
        * and returns the image path
        */
            
                public function printReport1($id2)
            {
                    if(!in_array('updateProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }
        $report = $this->model_Production->getProductionReportData1($id2);
            $start1 = strtotime ($report['Start_date'])- 7200;
             $start= ($start1/60);
            $end1 = strtotime ($report['End_date'])- 7200;
             $end= ($end1/60)  ;
            $date = $report['date_time'];
      $workers= $this->Model_Workers->getActiveCategroy();
             $ProID=[];
            $count_workshop=[];
            $time11 = [];
            $count_Note=[];
            $count_Note2=[];
            $Employeename1=[];
            $workshop_Present=[];
            $workshop_Present2=[];
            $workshop_Present3=[];
            $daily_Present=[];
            $daily_Present2=[];
           $i=0;
          
            $Prod_data =  $this->model_Production->getProductionData_report();
             
            $workshop_main = $this->model_Workorder->getWorkorderData22();
           $worker = $this->Model_Workers->getWorkersData();
           
           for($c = 0; $c< count($workshop_main); $c++) {
               $count_workshop[$c]=0;
               $count_workers_in_workshop[$c]=0;
                $workshop_Present[$c]= "";
                $workshop_Present2[$c]= "";
                $workshop_Present3[$c]= "";
               $ProID[$c]="";
               $time11[$c] = "";
               $count_Note[$c]=">";
               $count_Note2[$c]=">";
               $count_Note5[$c]="";
               
               
           }
           for($c1 = 0; $c1< count($worker); $c1++) {
           $count_workers[$c1]=0;
           $count_type[$c1]="";
           $daily_Present[$c1]="";
           $daily_Present2[$c1]="";
           $count_workshop1[$c1]= "";
           $workshop_line[$c1]="";
           
           }
         
     foreach ($Prod_data as $k => $v):
       
     $start_w= json_decode($v['Report_Pro_Start']);
     $end_w = json_decode($v['Report_Pro_Finish']) ;
     $end_workers_time = json_decode($v['Time_production']) ;
    $start_workers_time = json_decode($v['Time_production_Start']) ; 
     $workshop_por = json_decode($v['Report_Pro_Workshop']);
     $workshop_por1 = json_decode($v['Name_production']);
     $pro_num_value= json_decode($v['Report_Pro_Qty']);
     $worker_num_value= json_decode($v['Qty_production']);
     $worker_wshop_value= json_decode($v['Work_production']);
     $productname = $v['id'];
     $productionname = json_decode($v['Report_Pro_note']);
      if (json_decode($v['Report_Pro_note2'])!==''){
          $Employeename = json_decode($v['Report_Pro_note2']);
          
          $type = json_decode($v['Type_production']);
      }else {$Employeename[$k] = "0";}
    if ($workshop_por1=="")
    {
        $workshop_por1[0]=0;
        $type[0] =0;
        $count_type[0]= 0;
        $count_workers_in_workshop[0]=0;
        $workshop_Present[0]= 0;
        $workshop_Present2[0]= 0;
        $workshop_Present3[0]= 0;
        $daily_Present[0]= 0;
        $daily_Present2[0]= 0;
        $count_workshop1[0]=0;
        $workshop_line[0]=0;
    }
     
     if ($workshop_por == '')
     {$workshop_por[0] =0;
     $start_w[0] = 0;
     $end_w[0]=  0;
     $pro_num_value[0]= 0 ;
     }
     if ($end_w[0] !=='0')
    
    {
         
         
         
             for($w1 = 0; $w1< count($workshop_por1);$w1++)
          { foreach ($worker as $k2 => $v2): 
     {
              if ($v2['name'] == $workshop_por1[$w1] )
                  
          {
                  
                  if ($end_workers_time[$w1]  > $start && $end_workers_time[$w1] < $end )
          {if(is_numeric($worker_num_value[$w1])){
             
              
          $count_workers[$k2] =  ($count_workers[$k2] + $worker_num_value[$w1]);}
             if ($type[$w1]!=0 || $type[$w1] != "-")
             { if ($start_workers_time[$w1]!= null && $start_workers_time[$w1] != 0){
             $time11[$w1]= ($end_workers_time[$w1]- $start_workers_time[$w1] ) ;}
             $worker1 = $this->model_Workshop->getWorkshopData($worker_wshop_value[$w1]);
             
             
             }
             else {$worker1=0; }
           
          $count_workshop1[$k2] .=$worker1["name"]."-ID:".$productname."<p>";
          
             $central = $this->model_Workshop->getWorkshopData2($worker1["name"]);
            if ($central!=null){
             $Qty_prod = json_decode($central["Qty_production"]);
              $Work_prod = json_decode($central["Work_production"]);
            
              foreach ($Qty_prod as $key13 => $value13) {
         
                 if ($Work_prod[$key13] ==$type[$w1] )
                 {
                 $workshop_line[$w1]= $value13;
                 
                 foreach ($workshop_main as $k1 => $v1){
                    
                 if ($v1["id"] == $worker_wshop_value[$w1] )
                 {
                    if ($workshop_line[$w1]!=0){
                        
                  $workshop_Present[$k1]=(( ((float)$worker_num_value[$w1])/(float)$workshop_line[$w1])*100);
                  $workshop_Present2[$k1]=((int) $workshop_Present[$k1]+ (int) $workshop_Present2[$k1] ) ;
                  $workshop_Present3[$k1] =1;
                  $count_workers_in_workshop[$k1]++;
                    }
                 }}}
                 
            }}
     if ($workshop_line[$w1] == 0 || empty($workshop_line[$w1]) ) {$workshop_line[$w1]= 1;}
   
          $daily_Present[$k2]=( (float)$worker_num_value[$w1]/(float)$workshop_line[$w1])*100;
          $daily_Present2[$k2]=((int)$daily_Present[$k2]+ (int) $daily_Present2[$k2])  ;
        
    
   if (empty($time11[$w1])){$time11[$w1]=0;}
      $count_type[$k2] .= $type[$w1].":".$worker_num_value[$w1]."/".$workshop_line[$w1]."<p>";
          }}}endforeach;
     
    }
         
         
         
          for($w = 0; $w< count($workshop_por);$w++)
          { foreach ($workshop_main as $k1 => $v1): 
     {
              if ($v1['id'] === $workshop_por[$w] )
                  
          {if ($end_w[$w]  > $start && $end_w[$w] < $end ){
              if (!empty($pro_num_value[$w])){
              $count_workshop[$k1] =  ($count_workshop[$k1] + (int)$pro_num_value[$w]);
              
            
              
          }
              }
             
              
             if (!empty($Employeename[$w]))
             {
         $count_Note[$k1] .=  "("."-".$Employeename[$w]."-".$productionname[$w].":".$pro_num_value[$w].")";
             $count_Note5[$k1] .= $Employeename[$w];}
             if (!empty($pro_num_value[$w])){
                 
          if  ($pro_num_value[$w] != 0 && $pro_num_value[$w]!= "")
          {
          $count_Note2[$k1] .=  "(ID:".$productname."=".$pro_num_value[$w].")";
          
             }}
         
            
          $i++;
          
          
               
    }}endforeach;
     
  }}endforeach ;
     $html = '<!-- Main content -->
                            <!DOCTYPE html>
                            <html>

    <!-- media="screen" means these styles will only be used by screen 
      devices (e.g. monitors) -->

    <!-- media types can be combined with commas to affect multiple devices -->
    <style type="text/css" media="screen,print">
    body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  padding: 10px 20px;
}



        h1{
          font-family: Arial, Helvetica, sans-serif;
          font-size: large;
          font-weight: bold;

        }


    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      page-break-before:always;

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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>                            
</head>
                            <body onload="window.print();">

                            <div class="wrapper">
                            <h5 style = "text-align:center" ><b>Production Reports For Each WorkShop/ تقرير إنتاج لكل قسم</b></h5>
                              <section class="invoice">
                                <!-- title row -->
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h3 class="page-header">
                                <img src='.base_url('assets\images\designs\byblos.png').' alt="Trulli" width="100" height="40">
                                      <small class="pull-right">Date: '.date('d-m-Y',$date).'</small>
                                    </h3>
                                    
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">

                                  <div class="col-sm-4 invoice-col" style="width: 450px">

                                    <b>من تاريخ/From Date:</b> '.$report['Start_date'].'<br>
                                    <b>إلى تاريخ/To Date:</b> '.$report['End_date'].'<br>' ;
             $datetime1 = new DateTime($report['Start_date']);
$datetime2 = new DateTime( $report['End_date']);
$datetime3 = new DateInterval("PT1M");
$datetime3->invert = 1;
$datetime2->add($datetime3);
$interval = $datetime1->diff($datetime2);
$woweekends = 0;
for($i=0; $i<=$interval->d; $i++){
    $datetime1->modify('+ 1 day');
    $weekday = $datetime1->format('w');

    if($weekday != "0" && $weekday != "6"){ // 0 for Sunday and 6 for Saturday
        $woweekends++;  
    }
    if ($weekday == "6")
    {$woweekends= $woweekends+(0.5);}
     if ($weekday == "0")
    {$woweekends= $woweekends+(1);}
    
}
             
     
                                       //$num_days= (strtotime($report['End_date'])-strtotime($report['Start_date']))/(60*60*24);
            $html .='<b>عدد الأيام/Number of days:</b> '.$woweekends.'<br>
                                       </div>

                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                  <div class="col-xs-12 table-responsive">
                                    
                                    <font size="2" face="Courier New" >
                                    
                                    </font>

    <font size="2" face="Courier New" >
<!-- /.col -->
                                <!-- /.row -->
                                <div
id="myChart" style="width:100%; max-width:680px; height:800px;">
</div>        
 <table   border=1 class="inlineTable">
                                      
                                      <thead>
                                      
                                      <tr>
                                     
                                       <th style = "text-align:center" >Workshop Name/ أسم القسم</th>
                                      <th  style = "text-align:center" >Production Number in set/كمية الإنتاج بالطقم</th>
                                    
                                      
                                        </tr>
                                      </thead>
<tbody>
<tr>'
       ;
            
             if ($woweekends==0.5){ $woweekends=2;}
    foreach ($workshop_main as $k2 => $v2){ if($count_workshop[$k2] !== 0){
          if ($count_workers_in_workshop[$k2] == 0){$count_workers_in_workshop[$k2] = 1;}
        if ($workshop_Present3[$k2] != 0 ) 
        {
            $count_worker_in_workshop=(int)$workshop_Present3[$k2];
        }
        else{
                      

            $count_worker_in_workshop=1;}
     $html .=' <tr> 
    <td>'.$v2['name'].'</td>  
    <td>'.$count_workshop[$k2]."---".round((((int)$workshop_Present2[$k2]/$count_worker_in_workshop)/( $count_workers_in_workshop[$k2]))/$woweekends,2)."%".'</td> ';
 $count_Note5[$k2] = str_replace("][",' , ',$count_Note5[$k2]);
 $count_Note5[$k2] = str_replace("[",'',$count_Note5[$k2]);
 $count_Note5[$k2] = str_replace("]",'',$count_Note5[$k2]);

$count_Note5[$k2] = explode (  " , " , $count_Note5[$k2]);
asort($count_Note5[$k2]);
$eee="";
$count_worker_in_workshop=1;
$tr = 0 ;
foreach ($count_Note5[$k2] as $k3 => $v3)
    
{$eee .= "*".$v3;}

    $html .='
    </tr>
    
    <tr> <td colspan="3"  dir="rtl"><b></b></td></tr>
        <td colspan="3"  dir="rtl"><b></b></td>
    <tr> <td colspan="3"  dir="rtl"><b>---------</b></td></tr>';}}
   $html .='<table   border=1 class="inlineTable">
                                     <div
id="myChart2" style="width:100%; max-width:680px; height:800px;">
</div>        
                                      <thead>
                                      <tr>
                                       <th style = "text-align:center" >Workshop Name/ أسم القسم</th>
                                      <th  style = "text-align:center" >Production Number in set/كمية الإنتاج بالطقم</th>
                                    
                                      
                                        </tr>
                                      </thead><tbody> '
    
    ;foreach ($worker as $k3 => $v3):
        if ($count_type[$k3]==""){$count_type[$k3]="-";}
        if ($count_workers[$k3]!=0){
     $html .=' <tr > 
    <td style= "font-size : 25px;">'.$v3['name'].'</td>  
    <td style= "font-size : 25px;">'.$count_workers[$k3]."**".(round(((float)$daily_Present2[$k3]/$woweekends), 1))."%".'</td></tr> ';
     
      $html .='
    <tr><td >'.$count_workshop1[$k3].'</td> '
             . '<td>'.$count_type[$k3].'</td></tr>';
    
        }
    endforeach;
           
           $html .=' 
                                
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
    <script>
    google.charts.load("current", {"packages":["corechart"]});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
var data = google.visualization.arrayToDataTable([
  ["Employees", "%"],'
 ;
    foreach ($worker as $k9 => $v9){ if($count_workers[$k9] !== 0){ 
     $html .='  
    ["'.$v9['name'].'", '.((float)$daily_Present2[$k9]/$woweekends).'], 
    ';}}
    $html .='
]);

var options = {
  title:"Employees Production",
  is3D:true
};

var chart = new google.visualization.BarChart(document.getElementById("myChart2"));
  chart.draw(data, options);
}
function drawChart() {
var data = google.visualization.arrayToDataTable([
  ["Wshop", "P_Qty"],'
 ;
    foreach ($workshop_main as $k2 => $v2){ if($count_workshop[$k2] !== 0){ 
     $html .='  
    ["'.$v2['name'].'", '.(((int)$workshop_Present2[$k2]/$count_worker_in_workshop)/( $count_workers_in_workshop[$k2]))/$woweekends.'], 
    ';}}
    $html .='
]);

var options = {
  title:"Work Shop Production",
  is3D:true
};

var chart = new google.visualization.BarChart(document.getElementById("myChart"));
  chart.draw(data, options);
}
    </script>
            </html>';
                                         

                              echo $html;
                    }
             public function printReport($id2)
            {
                    if(!in_array('updateProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }
            
            $id3 = $this->model_Production->getProductionReportData($id2);
            if ($id3 !== null)
            {
            $id4 = json_decode($id3['Production_ID']);
            
            
            $id8=$id4[1];
             $Prod_data2 = $this->model_Production->getProductionData($id8);
               
             $Worder_number = $Prod_data2['name']  ;      
            $costProduct1 = $this->model_Workorder_acc->getWorkorder_accNumber($Worder_number);
            if ($costProduct1 !== ''){              
            $costProduct = json_decode($costProduct1['products']);
                          $costProduct_acc = json_decode($costProduct1['cost']);
                          $Done_acc = json_decode($costProduct1['done']);
            }
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
                         $availability[$rr]=$Prod_data['availability'];
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
                                            if ($availability[$t1] == "Done")
                                           {$availability[$t1] = "جاهز";}
                                           else {$availability[$t1] = "غير جاهز";}
                                         $html .=' <td style= "font-size: 25px" ><b>'.$availability[$t1]."  -  "."$number_1[$t1]".'</td>';
                                         
                                         if ($costProduct1 !== '' && $costProduct !== null){
                                         foreach ($costProduct as $k => $v) {
                                             
                                          if ($number_1[$k] ==  $v){
                                         
                                        $costs[$k] = $costProduct_acc[$k] ;
                                        $Done_acc1[$k] = $Done_acc[$k];
                                          }else{
                                            $costs[$k]= 0 ;  
                                          }
                                          
                                          
                                          
                                          }
                                          if ($Done_acc1[$t1] ==0)
                                          {$Done_acc1[$t1] ="غير مرحل";}
                                          elseif ($Done_acc1[$t1] ==1)
                                           {$Done_acc1[$t1] =" مرحل";}
                                           
                                         
                                           
                                          $html .=' <td style= "font-size: 25px" ><b>'."Cost:".$costs[$t1] ."/".$Done_acc1[$t1].'</td>';
                                         }
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


                                   




    <!-- /.col -->

    <!-- /.row -->

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

    }}
            public function printDiv($id)
            {
                    if(!in_array('deleteProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }

                    if($id) {
                            $Prod_data = $this->model_Production->getProductionData($id);
                        
                         $Workshop_data_dis = json_decode($Prod_data['Workshop_Dis']);
                         $Workshop_ID = json_decode($Prod_data['Workshop']);
                         $Materials_data_dis = json_decode($Prod_data['Material_Dis']);
                         $Materials_ID = json_decode($Prod_data['Material_ID']);
                         $quantity_data = json_decode($Prod_data['qty_Dis']);
                         $quantity_ID = json_decode($Prod_data['Mqty']);
                         $startmin = json_decode($Prod_data['Rec_min']);
                         $starttime = json_decode($Prod_data['Rec_time']);
                         $endmin = json_decode($Prod_data['Finish_min']);
                         $endtime = json_decode($Prod_data['Finish_time']);
                         $duration = json_decode($Prod_data['Total_time']);
                         $Note_1 = json_decode($Prod_data['Note_1']);
                         $Note_2 = json_decode($Prod_data['Note_2']);
                         $Qnty_1 = json_decode($Prod_data['Qnty_1']);
                         $Qnty_2 = json_decode($Prod_data['Qnty_2']);
                    }

                              $Note_data_dis = json_decode($Prod_data['Note_Dis']);
                              
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
                                    <h3><small class="pull-right" >ID: '.$Prod_data['id'].'</small></h3>
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                 <div class="col-xs-4 pull pull-right">
                                <img src='.base_url($Prod_data['image']).' alt="Trulli" width="160" height="160">
                                 </div>
                                  <div class="col-sm-4 invoice-col" style="width: 450px">

                                    <b>وصف طلب الانتاج/Production Discription:</b> '.$Prod_data['name'].'<br>
                                    <b>رقم المنتج/Product Number:</b> '.$Prod_data['Number'].'<br>			        
                                    <b>رقم الديزاين/Design Number:</b> '.$Prod_data['Design'].'<br>
                                    <b>Barcode Number:</b> '.$Prod_data['Barcode'].' <br />
                                    <b>الكمية/Quantity:</b> '.$Prod_data['qty'].'Sets<br />
                                        <b>الوقت المستهلك للإنتاج/Duration to Finish:</b> '.$Prod_data['finishtime'].'<br />
                                    <b>تاريخ الانتهاء/Finished Date: </b> '.$Prod_data['date_time_finished'].'<br />
                                    <b>وصف المنتج/Product Description:</b> '.$Prod_data['description'].'

                                  </div>

                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                  <div class="col-xs-12 table-responsive">
                                    <table  border=1 class="inlineTable" >
                                    <thead><h4>Items Used/ المواد الاولية المستخدمة</h2></thead>
                                      <thead>
                                      <tr >
                                      <th  style = "text-align:center" >Item name/ المواد</th>
                                       <th style = "text-align:center" > Qnt/كمية (Set)</th>
                                      </tr>
                                      </thead>
                                      <tbody>'; 

                                      $j=0;
                                        foreach ($Materials_ID as $k => $v) {
                                            $Material_ID1 = $this->model_brands->getBrandData($Materials_ID[$j]); 


                                             if ($Materials_ID[$j] == '-'){$MaterialValueID="-";}else{$MaterialValueID=$Material_ID1['name'];}
                                           $html .= '<tr>       

                                             <td>'.$MaterialValueID.'</td>

                                              <td>'.$quantity_ID[$j].'</td> 


                                            </tr>';
                                            $j++;
                                      }

                                      $html .= '</tbody>
                                    </table>
                                    <font size="2" face="Courier New" >
                                    <table     border=1 class="inlineTable">

                                    <thead><h4>Disposal/الهدر</h4></thead>
                                      <thead>
                                      <tr>
                                        <th  style = "text-align:center" >Item name/ المواد</th>
                                       <th  style = "text-align:center" >Workshop Name/ أسم القسم</th>
                                        <th  style = "text-align:center" >Disposal Qnt/كمية الهدر</th>
                                        <th style = "text-align:center" >Reason/سبب الهدر</th>
                                        </tr>
                                      </thead>
                                      <tbody>'; 
                            $i=0;
                                        foreach ($Materials_data_dis as $k => $v) {
                                            $MaterialD_data = $this->model_brands->getBrandData($Materials_data_dis[$i]); 
                                            $Workshop_data = $this->model_Workshop->getWorkshopData($Workshop_data_dis[$i]); 
                                            if ($Materials_data_dis[$i] == '-'){$MaterialValue="-";}else{$MaterialValue=$MaterialD_data['name'];}
                                             if ($Workshop_data_dis[$i] == '-'){$workshopValue="-";}else{$workshopValue=$Workshop_data['name'];}
                                            $html .= '<tr>       
                                         <td>'.$MaterialValue.'</td>
                                             <td>'.$workshopValue.'</td>

                                              <td>'.$quantity_data[$i].'</td> 
                                                   <td>'.$Note_data_dis[$i].'</td>

                                            </tr>';
                                            $i++;
                                      }

                                      $html .= '</tbody>
                                    </table>
                                    </font>



    <font size="2" face="Courier New" >


                                    <table        class="table table-striped table-dark">
                                     <thead><h4>Productions Steps/مراحل الانتاج</h4> </thead>

                                     <thead>
                                      <tr>
                                      <th style = "text-align:center" >Workshop Name/ أسم القسم</th>
                                      <th  style = "text-align:center">Start Time/ وقت الاستلام</th>
                                      <th  style = "text-align:center">Disposal Qnt/وقت الانتهاء</th>
                                      <th  style = "text-align:center">Duration/المدة المستغرقة لإنجاز العمل</th>
                                      <th  style = "text-align:center">Waiting Duration/المدة الإنتظار قبل البدأ</th>
                                      </tr>
                                      </thead><tr>   

                                      <tbody>'; 

                                      $z=0;
                                        foreach ($Workshop_ID as $k => $v) {

                                            $Workshop_ID1 = $this->model_Workshop->getWorkshopData($Workshop_ID[$z]); 
                                              if ($Workshop_ID[$z] == ''){$workshopValueID="-";}else{$workshopValueID=$Workshop_ID1['name'];}
                                              if ($z == 0 )
                                              {$waiting = 0; }
                                              else
                                              {$waiting =($startmin[$z] - $endmin[$z-1])/60;}
                                              $html .= '
                                             <td>'.$workshopValueID.'</td>
                                               <td>'.$starttime[$z].'</td>
                                                   <td>'.$endtime[$z].'</td>
                                                       <td>'.$duration[$z].'</td>
                                                           <td>'.(round($waiting, 2)*60).'min</td>
                                           </tr> ';

                                            $z++;
                                      }

                                      $html .= '</tbody>
                                    </table>




                                  <!-- /.col -->

                                <!-- /.row -->


                                      <table   border=1 class="inlineTable">
                                      <thead><h4>Used Maretial/المواد المستخدمة في الإنتاج</h4> </thead>
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

                                        $l=0;
                                        foreach ($Workshop_ID as $k => $v) {

                                            $Workshop_ID2 = $this->model_Workshop->getWorkshopData($Workshop_ID[$l]); 
                                              if ($Workshop_ID[$l] == ''){$workshopValueID="-";}else{$workshopValueID=$Workshop_ID2['name'];}


                                         $html .=' <tr> 
                                            <td>'.$workshopValueID.'</td>  
                                            <td>'.$Note_1[$l].'</td>
                                            <td>'.$Qnty_1[$l].'</td>
                                            <td>'.$Note_2[$l].'</td>
                                            <td>'.$Qnty_2[$l].'</td>
                                            </tr>';
                                        $l++;}

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
    public function toexcel($id)
            {
                    if(!in_array('deleteProduction', $this->permission)) {
                redirect('dashboard', 'refresh');
            }

                    if($id) {
                            $Prod_data = $this->model_Production->getProductionData($id);

                            $company_info = $this->model_company->getCompanyData(1);
                         $Workshop_data_dis = json_decode($Prod_data['Workshop_Dis']);
                         $Workshop_ID = json_decode($Prod_data['Workshop']);
                              $Materials_data_dis = json_decode($Prod_data['Material_Dis']);
                               $Materials_ID = json_decode($Prod_data['Material_ID']);
                              $quantity_data = json_decode($Prod_data['qty_Dis']);
                              $quantity_ID = json_decode($Prod_data['Mqty']);
                               $starttime = json_decode($Prod_data['Rec_time']);
                                $endtime = json_decode($Prod_data['Finish_time']);
                                 $duration = json_decode($Prod_data['Total_time']);
                                 $Note_1 = json_decode($Prod_data['Note_1']);
                                 $Note_2 = json_decode($Prod_data['Note_2']);
                                 $Qnty_1 = json_decode($Prod_data['Qnty_1']);
                                 $Qnty_2 = json_decode($Prod_data['Qnty_2']);
                    }

                              $Note_data_dis = json_decode($Prod_data['Note_Dis']);
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
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                 <div class="col-xs-4 pull pull-right">
                                <img src='.base_url($Prod_data['image']).' alt="Trulli" width="160" height="160">
                                 </div>
                                  <div class="col-sm-4 invoice-col" style="width: 450px">

                                    <b>وصف طلب الانتاج/Production Discription:</b> '.$Prod_data['name'].'<br>
                                    <b>رقم الديزاين/Design Number:</b> '.$Prod_data['Design'].'<br>
                                    <b>Barcode Number:</b> '.$Prod_data['Barcode'].' <br />
                                    <b>الكمية/Quantity:</b> '.$Prod_data['qty'].'<br />
                                        <b>الوقت المستهلك/Duration to Finish:</b> '.$Prod_data['finishtime'].'<br />
                                    <b>تاريخ الانتهاء/Finished Date: </b> '.$Prod_data['date_time_finished'].'<br />
                                    <b>وصف المنتج/Product Description:</b> '.$Prod_data['description'].'

                                  </div>

                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                  <div class="col-xs-12 table-responsive">
                                    <table  border=1 class="inlineTable" >
                                    <thead><h4>Items Used/ المواد الاولية المستخدمة</h2></thead>
                                      <thead>
                                      <tr >
                                      <th  style = "text-align:center" >Item name/ المواد</th>
                                       <th style = "text-align:center" > Qnt/كمية </th>
                                      </tr>
                                      </thead>
                                      <tbody>'; 

                                      $j=0;
                                        foreach ($Materials_ID as $k => $v) {
                                            $Material_ID1 = $this->model_brands->getBrandData($Materials_ID[$j]); 


                                             if ($Materials_ID[$j] == '-'){$MaterialValueID="-";}else{$MaterialValueID=$Material_ID1['name'];}
                                           $html .= '<tr>       

                                             <td>'.$MaterialValueID.'</td>

                                              <td>'.$quantity_ID[$j].'</td> 


                                            </tr>';
                                            $j++;
                                      }

                                      $html .= '</tbody>
                                    </table>
                                    <font size="2" face="Courier New" >
                                    <table     border=1 class="inlineTable">

                                    <thead><h4>Disposal/الهدر</h4></thead>
                                      <thead>
                                      <tr>
                                        <th  style = "text-align:center" >Item name/ المواد</th>
                                       <th  style = "text-align:center" >Workshop Name/ أسم القسم</th>
                                        <th  style = "text-align:center" >Disposal Qnt/كمية الهدر</th>
                                        <th style = "text-align:center" >Reason/سبب الهدر</th>
                                        </tr>
                                      </thead>
                                      <tbody>'; 
                            $i=0;
                                        foreach ($Materials_data_dis as $k => $v) {
                                            $MaterialD_data = $this->model_brands->getBrandData($Materials_data_dis[$i]); 
                                            $Workshop_data = $this->model_Workshop->getWorkshopData($Workshop_data_dis[$i]); 
                                            if ($Materials_data_dis[$i] == '-'){$MaterialValue="-";}else{$MaterialValue=$MaterialD_data['name'];}
                                             if ($Workshop_data_dis[$i] == '-'){$workshopValue="-";}else{$workshopValue=$Workshop_data['name'];}
                                            $html .= '<tr>       
                                         <td>'.$MaterialValue.'</td>
                                             <td>'.$workshopValue.'</td>

                                              <td>'.$quantity_data[$i].'</td> 
                                                   <td>'.$Note_data_dis[$i].'</td>

                                            </tr>';
                                            $i++;
                                      }

                                      $html .= '</tbody>
                                    </table>
                                    </font>



    <font size="2" face="Courier New" >


                                    <table        class="table table-striped table-dark">
                                     <thead><h4>Productions Steps/مراحل الانتاج</h4> </thead>

                                     <thead>
                                      <tr>
                                      <th style = "text-align:center" >Workshop Name/ أسم القسم</th>
                                      <th  style = "text-align:center">Start Time/ وقت الاستلام</th>
                                      <th  style = "text-align:center">Disposal Qnt/وقت الانتهاء</th>
                                      <th  style = "text-align:center">Duration/المدة المستغرقة لإنجاز العمل</th>
                                      </tr>
                                      </thead><tr>   

                                      <tbody>'; 

                                      $z=0;
                                        foreach ($Workshop_ID as $k => $v) {

                                            $Workshop_ID1 = $this->model_Workshop->getWorkshopData($Workshop_ID[$z]); 
                                              if ($Workshop_ID[$z] == ''){$workshopValueID="-";}else{$workshopValueID=$Workshop_ID1['name'];}

                                              $html .= '
                                             <td>'.$workshopValueID.'</td>
                                               <td>'.$starttime[$z].'</td>
                                                   <td>'.$endtime[$z].'</td>
                                                       <td>'.$duration[$z].'</td>
                                           </tr> ';

                                            $z++;
                                      }

                                      $html .= '</tbody>
                                    </table>




                                  <!-- /.col -->

                                <!-- /.row -->


                                      <table   border=1 class="inlineTable">
                                      <thead><h4>Used Maretial/المواد المستخدمة في الإنتاج</h4> </thead>
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

                                        $l=0;
                                        foreach ($Workshop_ID as $k => $v) {

                                            $Workshop_ID2 = $this->model_Workshop->getWorkshopData($Workshop_ID[$l]); 
                                              if ($Workshop_ID[$l] == ''){$workshopValueID="-";}else{$workshopValueID=$Workshop_ID2['name'];}


                                         $html .=' <tr> 
                                            <td>'.$workshopValueID.'</td>  
                                            <td>'.$Note_1[$l].'</td>
                                            <td>'.$Qnty_1[$l].'</td>
                                            <td>'.$Note_2[$l].'</td>
                                            <td>'.$Qnty_2[$l].'</td>
                                            </tr>';
                                        $l++;}

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
                                         header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=report.xls');

                              echo $html;

                    }
            }
