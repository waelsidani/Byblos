<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BrushStore extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'BrushStore';

		$this->load->model('model_BrushStore');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
                $this->load->model('model_Pricing');
	}

    /* 
    * It only redirects to the manage BrushStore page
    */
	public function index()
	{
        if(!in_array('viewBrushStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('BrushStore/index', $this->data);	
	}

    /*
    * It Fetches the BrushStore data from the BrushStore table 
    * this function is called from the datatable ajax function
    */
	public function fetchBrushStoreData()
	{
		$result = array('data' => array());

		$data = $this->model_BrushStore->getBrushStoreData();

		foreach ($data as $key => $value) {

            		// button
            $buttons = '';
            if(in_array('updateBrushStore', $this->permission)) {
    			$buttons .= '<a href="'.base_url('BrushStore/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteBrushStore', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			
if (json_decode($value['image']) == 0)
        {$images[0] =  "assets/images/BrushStores/Byblos.gif";}
        else
        {$images = json_decode($value['image']);}
			$img = '<img src="'.base_url($images[0]).'" alt="'.$value['film'].'" class="img-square" width="120" height="120" />';

           
            


        
			$result['data'][$key] = array(
				$img,
                                json_decode($value['product']),
				 json_decode($value['qty']),
				$value['film'],
				
                         
                              
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage BrushStore page
    */
	
        public function create()
	{
		if(!in_array('createBrushStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('film', 'film', 'trim|required');

        if ($this->form_validation->run() == true) {
            // true case
          
            
        	 if(!empty($_FILES['BrushStore_image']['name'][0])){
            $upload_image = $this->upload_image2();
            }
                else{$upload_image = 0;}
                
                $data = array(
               'update_Sticker'=> "2",
                'film' => $this->input->post('film'),
                'note' => $this->input->post('note'),
                'qty' => json_encode($this->input->post('qty')),
                'Rec_date' => json_encode($this->input->post('Rec_date')),
                'add_date' => json_encode($this->input->post('add_date')),
                'Tray' => $this->input->post('Tray'),
                'note2' => $this->input->post('note2'),
                'product' => json_encode($this->input->post('product')),
                'details' => json_encode($this->input->post('details')),
                'image' => $upload_image,
                           );
        	$create = $this->model_BrushStore->create($data);
                
            
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('BrushStore/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('BrushStore/create', 'refresh');
        	}
        }
        else {
            // false case

    
        	    	
			    	

            $this->render_template('BrushStore/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
        public function getActiveProductData($id)
	{
		$products = $this->model_BrushStore->getActiveBrushStoreData2($id);
		echo json_encode($products);
	}
	public function upload_image2()
        {
       $data = [];
$path2= [];
      $count = count($_FILES['BrushStore_image']['name']);

      for($i=0;$i<$count;$i++){

        if(!empty($_FILES['BrushStore_image']['name'][$i])){
          $_FILES['file']['name'] = $_FILES['BrushStore_image']['name'][$i];
          $_FILES['file']['type'] = $_FILES['BrushStore_image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['BrushStore_image']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['BrushStore_image']['error'][$i];
          $_FILES['file']['size'] = $_FILES['BrushStore_image']['size'][$i];
         $config['upload_path'] = 'assets/images/BrushStores'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '15000';
          
          
          $config['file_name'] = uniqid();
          $this->load->library('upload',$config); 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $data['totalFiles'][] = $filename;
        
            
             $type = explode('.', $_FILES['BrushStore_image']['name'][$i]);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$filename;
         array_push($path2,$path);
       
            
          }

        }

      }

   return ($data == true) ? json_encode($path2)  : false;   
   }

  

	public function update1($BrushStore_id)
	{      
        if(!in_array('updateBrushStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$BrushStore_id) {
            redirect('dashboard', 'refresh');
        }

     
        
        if ($this->form_validation->run() == true) {
            // true case
            
                
            $data1 = array(
                'update_Sticker'=> "2",
               'film' => $this->input->post('film'),
                'note' => $this->input->post('note'),
                'Rec_date' => json_encode($this->input->post('Rec_date')),
                'add_date' => json_encode($this->input->post('add_date')),
                'Tray' => $this->input->post('Tray'),
                'orders' => json_encode($this->input->post('orders')),
                'product' => json_encode($this->input->post('product')),
                'details' => json_encode($this->input->post('details')),
                'items' => json_encode($this->input->post('items')),
                'items1' => json_encode($this->input->post('items1')),
                'items2' => json_encode($this->input->post('items2')),
                'qty' => json_encode($this->input->post('qty')),
                'qty2' =>json_encode( $this->input->post('qty2')),
                'qty3' =>json_encode( $this->input->post('qty3')),
                'qty4' => json_encode($this->input->post('qty4'))
                  );
$update1 = $this->model_BrushStore->update($data1, $BrushStore_id); 
            
           
            if( $this->input->post('image') ==1 ) {
                $upload_image = $this->upload_image2();
                $upload_image = array('image' => $upload_image);
                
                $this->model_BrushStore->update($upload_image, $BrushStore_id);
                }

            
            if($update1 == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('BrushStore/', 'refresh');
                     
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('BrushStore/update/'.$BrushStore_id, 'refresh');
                
            }
        }
        else {
            // attributes 
                    

            $BrushStore_data = $this->model_BrushStore->getBrushStoreData($BrushStore_id);
           
            $this->data['BrushStore_data'] = $BrushStore_data;
             
            $this->render_template('BrushStore/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
        
        public function update($BrushStore_id)
	{  if ($this->form_validation->run() == false){
            $BrushStore_data = $this->model_BrushStore->getBrushStoreData($BrushStore_id);
           
            $this->data['BrushStore_data'] = $BrushStore_data;
            
        $this->render_template('BrushStore/edit', $this->data);  }
       if ( $this->input->post('update') == 1){
           //switch it will save after load 
        $data1 = array(
                'update_Sticker'=> "2",
                'film' => $this->input->post('film'),
                'note' => $this->input->post('note'),
                'note3' => json_encode($this->input->post('note3')),
                'Rec_date' => json_encode($this->input->post('Rec_date')),
                'add_date' => json_encode($this->input->post('add_date')),
                'Tray' => $this->input->post('Tray'),
                'orders' => json_encode($this->input->post('orders')),
                'product' => json_encode($this->input->post('product')),
                'details' => json_encode($this->input->post('details')),
                'items' => json_encode($this->input->post('items')),
                'items1' => json_encode($this->input->post('items1')),
                'items2' => json_encode($this->input->post('items2')),
                'qty' => json_encode($this->input->post('qty')),
                'qty2' =>json_encode( $this->input->post('qty2')),
                'qty3' =>json_encode( $this->input->post('qty3')),
                'qty4' => json_encode($this->input->post('qty4')),
                'istext' => json_encode($this->input->post('istext')),
                'rownum' => json_encode($this->input->post('rownum'))
            
            
                  );
        
$update1 = $this->model_BrushStore->update($data1, $BrushStore_id); 
            
           
            if($update1 == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
               redirect('BrushStore/update/'.$BrushStore_id, 'refresh');
                     
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('BrushStore/update/'.$BrushStore_id, 'refresh');
                
            }
        
        }}
	public function remove()
	{
        if(!in_array('deleteBrushStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $BrushStore_id = $this->input->post('BrushStore_id');

        $response = array();
        if($BrushStore_id) {
            $delete = $this->model_BrushStore->remove($BrushStore_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the BrushStore information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}