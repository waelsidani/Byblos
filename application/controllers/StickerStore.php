<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StickerStore extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'StickerStore';

		$this->load->model('model_StickerStore');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
                $this->load->model('model_Pricing');
	}

    /* 
    * It only redirects to the manage StickerStore page
    */
	public function index()
	{
        if(!in_array('viewStickerStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('StickerStore/index', $this->data);	
	}

    /*
    * It Fetches the StickerStore data from the StickerStore table 
    * this function is called from the datatable ajax function
    */
	public function fetchStickerStoreData()
	{
		$result = array('data' => array());

		$data = $this->model_StickerStore->getStickerStoreData();

		foreach ($data as $key => $value) {

            		// button
            $buttons = '';
            if(in_array('updateStickerStore', $this->permission)) {
    			$buttons .= '<a href="'.base_url('StickerStore/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteStickerStore', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			
if (json_decode($value['image']) == 0)
        {$images[0] =  "assets/images/StickerStores/Byblos.gif";}
        else
        {$images = json_decode($value['image']);}
			$img = '<img src="'.base_url($images[0]).'" alt="'.$value['film'].'" class="img-square" width="120" height="120" />';

           
            


        
			$result['data'][$key] = array(
				$img,
                                $value['film'],
				$value['qty2'],
				$value['Tray'],
				
                         
                              
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage StickerStore page
    */
	
        public function create()
	{
		if(!in_array('createStickerStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('film', 'film', 'trim|required');

        if ($this->form_validation->run() == true) {
            // true case
          
            
        	 if(!empty($_FILES['StickerStore_image']['name'][0])){
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
                'orders' => json_encode($this->input->post('orders')),
                'product' => json_encode($this->input->post('product')),
                'details' => json_encode($this->input->post('details')),
                'items1' => json_encode($this->input->post('items1')),
                'qty2' =>json_encode( $this->input->post('qty2')),
                'items2' => json_encode($this->input->post('items2')),
                'qty4' => json_encode($this->input->post('qty4')),
                'qty3' =>json_encode( $this->input->post('qty3')),
                'image' => $upload_image,
                'items' => json_encode($this->input->post('items')),
              );
        	$create = $this->model_StickerStore->create($data);
                
            
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('StickerStore/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('StickerStore/create', 'refresh');
        	}
        }
        else {
            // false case

    
        	    	
			    	

            $this->render_template('StickerStore/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
        
	public function upload_image2()
        {
       $data = [];
$path2= [];
      $count = count($_FILES['StickerStore_image']['name']);

      for($i=0;$i<$count;$i++){

        if(!empty($_FILES['StickerStore_image']['name'][$i])){
          $_FILES['file']['name'] = $_FILES['StickerStore_image']['name'][$i];
          $_FILES['file']['type'] = $_FILES['StickerStore_image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['StickerStore_image']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['StickerStore_image']['error'][$i];
          $_FILES['file']['size'] = $_FILES['StickerStore_image']['size'][$i];
         $config['upload_path'] = 'assets/images/StickerStores'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '15000';
          
          
          $config['file_name'] = uniqid();
          $this->load->library('upload',$config); 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $data['totalFiles'][] = $filename;
        
            
             $type = explode('.', $_FILES['StickerStore_image']['name'][$i]);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$filename;
         array_push($path2,$path);
       
            
          }

        }

      }

   return ($data == true) ? json_encode($path2)  : false;   
   }

  

	public function update1($StickerStore_id)
	{      
        if(!in_array('updateStickerStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$StickerStore_id) {
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
$update1 = $this->model_StickerStore->update($data1, $StickerStore_id); 
            
           
            if( $this->input->post('image') ==1 ) {
                $upload_image = $this->upload_image2();
                $upload_image = array('image' => $upload_image);
                
                $this->model_StickerStore->update($upload_image, $StickerStore_id);
                }

            
            if($update1 == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('StickerStore/', 'refresh');
                     
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('StickerStore/update/'.$StickerStore_id, 'refresh');
                
            }
        }
        else {
            // attributes 
                    

            $StickerStore_data = $this->model_StickerStore->getStickerStoreData($StickerStore_id);
           
            $this->data['StickerStore_data'] = $StickerStore_data;
             
            $this->render_template('StickerStore/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
        
        public function update($StickerStore_id)
	{  if ($this->form_validation->run() == false){
            $StickerStore_data = $this->model_StickerStore->getStickerStoreData($StickerStore_id);
           
            $this->data['StickerStore_data'] = $StickerStore_data;
            
        $this->render_template('StickerStore/edit', $this->data);  }
       if ( $this->input->post('update') == 1){
           //switch it will save after load 
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
        
$update1 = $this->model_StickerStore->update($data1, $StickerStore_id); 
            
           
            

            
            if($update1 == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('StickerStore/', 'refresh');
                     
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('StickerStore/update/'.$StickerStore_id, 'refresh');
                
            }
        
        }}
	public function remove()
	{
        if(!in_array('deleteStickerStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $StickerStore_id = $this->input->post('StickerStore_id');

        $response = array();
        if($StickerStore_id) {
            $delete = $this->model_StickerStore->remove($StickerStore_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the StickerStore information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}