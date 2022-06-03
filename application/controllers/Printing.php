<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Printing extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Printing';

		$this->load->model('model_Printing');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
                $this->load->model('model_Pricing');
	}

    /* 
    * It only redirects to the manage Printing page
    */
	public function index()
	{
        if(!in_array('viewPrinting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('Printing/index', $this->data);	
	}

    /*
    * It Fetches the Printing data from the Printing table 
    * this function is called from the datatable ajax function
    */
	   public function getTablePaintsRow()
            {
                    $materialsdata = $this->model_Printing->getPaintsData();
                    echo json_encode($materialsdata);
            }
        public function fetchPrintingData()
	{
		$result = array('data' => array());

		$data = $this->model_Printing->getPrintingData();

		foreach ($data as $key => $value) {

            		// button
            $buttons = '';
            if(in_array('updatePrinting', $this->permission)) {
    			$buttons .= '<a href="'.base_url('Printing/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deletePrinting', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			if (json_decode($value['image']) == 0)
        {$images[0] =  "assets/images/designs/Byblos.gif";}
        else
        {$images = json_decode($value['image']);}
			$img = '<img src="'.base_url($images[0]).'" alt="'.$value['id'].'" class="img-square" width="60" height="60" />';

           

//if ($_SESSION['username'] == $value['user'] || $_SESSION['username'] == "Admin"){
        
		{	$result['data'][$key] = array(
                        $img,
                        $value['id'],
			$value['S_date'],
                        $value['Designer'],
                        $value['Design'],
                        $value['Quantity'],
                        $value['Sets_Number'],
			$value['Responsible_P'],
			$value['Finished_D'],
				
				$buttons
);}
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage Printing page
    */
	
        public function create()
	{
		if(!in_array('createPrinting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('S_date', 'S_date', 'trim|required');
        

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'S_date' => $this->input->post('S_date'),
                'Preparation_time' => $this->input->post('Preparation_time'),
                'Designer' => $this->input->post('Designer'),
                'Design' => $this->input->post('Design'),
                'Frame_Number' => $this->input->post('Frame_Number'),
                'preparation_p' => $this->input->post('preparation_p'),
                'Humidity' => $this->input->post('Humidity'),
                'Printing_Person' => $this->input->post('Printing_Person'),
                'color_1' => json_encode($this->input->post('color_1')),
                'color_2' => json_encode($this->input->post('color_2')),
                'color_3' => json_encode($this->input->post('color_3')),
                'color_4' => json_encode($this->input->post('color_4')),
                'color_5' => json_encode($this->input->post('color_5')),
                'color_6' => json_encode($this->input->post('color_6')),
                'color_7' => json_encode($this->input->post('color_7')),
                'color_8' => json_encode($this->input->post('color_8')),
                'color_9' => json_encode($this->input->post('color_9')),
                'color_10' => json_encode($this->input->post('color_10')),
                'color_11' => json_encode($this->input->post('color_11')),
                'color_12' => json_encode($this->input->post('color_12')),
                'color_13' => json_encode($this->input->post('color_13')),
                 'count' => json_encode($this->input->post('count')),
                'C_date' => json_encode($this->input->post('C_date')),
                'C_T' => json_encode($this->input->post('C_T')),
                'Quantity' => $this->input->post('Quantity'),
                'Assistant' => $this->input->post('Assistant'),
                'Disposal' => $this->input->post('Disposal'),
                'Note' => $this->input->post('Note'),
                'Packing' => $this->input->post('Packing'),
                'Responsible_P' => $this->input->post('Responsible_P'),
                'Finished_D' => $this->input->post('Finished_D'),
                'Finished_T' => $this->input->post('Finished_T'),
                'Receiver' => $this->input->post('Receiver'),
                'Received_D' => $this->input->post('Received_D'),
                'Received_T' => $this->input->post('Received_T'),
                'user' => $_SESSION['username'],
                
                
                );
        	$create = $this->model_Printing->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Printing/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Printing/create', 'refresh');
        	}
        }
        else {
            // false case

    
        	    	
			    	

            $this->render_template('Printing/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */public function upload_image()
    {
    	// assets/images/Printing_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('Printing_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['Printing_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit Printing page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage Printing page
    */
	public function upload_image2()
        {
       $data = [];
$path2= [];
      $count = count($_FILES['Printing_image']['name']);

      for($i=0;$i<$count;$i++){

        if(!empty($_FILES['Printing_image']['name'][$i])){
          $_FILES['file']['name'] = $_FILES['Printing_image']['name'][$i];
          $_FILES['file']['type'] = $_FILES['Printing_image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['Printing_image']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['Printing_image']['error'][$i];
          $_FILES['file']['size'] = $_FILES['Printing_image']['size'][$i];
         $config['upload_path'] = 'assets/images/Printings'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '15000';
          
          
          $config['file_name'] = uniqid();
          $this->load->library('upload',$config); 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $data['totalFiles'][] = $filename;
        
            
             $type = explode('.', $_FILES['Printing_image']['name'][$i]);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$filename;
         array_push($path2,$path);
       
            
          }

        }

      }

   return ($data == true) ? json_encode($path2)  : false;   
   }

  

	public function update($Printing_id)
	{      
        if(!in_array('updatePrinting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$Printing_id) {
            redirect('dashboard', 'refresh');
        }

        
       
       
        $this->form_validation->set_rules('S_date', 'S_date', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                 'S_date' => $this->input->post('S_date'),
                'Preparation_time' => $this->input->post('Preparation_time'),
                'Designer' => $this->input->post('Designer'),
                'Design' => $this->input->post('Design'),
                'Frame_Number' => $this->input->post('Frame_Number'),
                'preparation_p' => $this->input->post('preparation_p'),
                'Humidity' => $this->input->post('Humidity'),
                'Printing_Person' => $this->input->post('Printing_Person'),
                'color_1' => json_encode($this->input->post('color_1')),
                'color_2' => json_encode($this->input->post('color_2')),
                'color_3' => json_encode($this->input->post('color_3')),
                'color_4' => json_encode($this->input->post('color_4')),
                'color_5' => json_encode($this->input->post('color_5')),
                'color_6' => json_encode($this->input->post('color_6')),
                'color_7' => json_encode($this->input->post('color_7')),
                'color_8' => json_encode($this->input->post('color_8')),
                'color_9' => json_encode($this->input->post('color_9')),
                'color_10' => json_encode($this->input->post('color_10')),
                'color_11' => json_encode($this->input->post('color_11')),
                'color_12' => json_encode($this->input->post('color_12')),
                'color_13' => json_encode($this->input->post('color_13')),
                 'count' => json_encode($this->input->post('count')),
                'C_date' => json_encode($this->input->post('C_date')),
                'C_T' => json_encode($this->input->post('C_T')),
                'Quantity' => $this->input->post('Quantity'),
                'Assistant' => $this->input->post('Assistant'),
                'Disposal' => $this->input->post('Disposal'),
                'Note' => $this->input->post('Note'),
                'Packing' => $this->input->post('Packing'),
                'Responsible_P' => $this->input->post('Responsible_P'),
                'Finished_D' => $this->input->post('Finished_D'),
                'Finished_T' => $this->input->post('Finished_T'),
                'Receiver' => $this->input->post('Receiver'),
                'Received_D' => $this->input->post('Received_D'),
                'Sets_Number' => $this->input->post('Sets_Number'),
                'Received_T' => $this->input->post('Received_T'), );
                

            
            

            $update = $this->model_Printing->update($data, $Printing_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('Printing/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Printing/update/'.$Printing_id, 'refresh');
            }
        }
        else {
            // attributes 
            $attribute_data = $this->model_attributes->getActiveAttributeData();

            $attributes_final_data = array();
            foreach ($attribute_data as $k => $v) {
                $attributes_final_data[$k]['attribute_data'] = $v;

                $value = $this->model_attributes->getAttributeValueData($v['id']);

                $attributes_final_data[$k]['attribute_value'] = $value;
            }
            
            // false case
            $this->data['attributes'] = $attributes_final_data;
            $this->data['brands'] = $this->model_brands->getActiveBrands();         
            $this->data['category'] = $this->model_category->getActiveCategroy();           
            $this->data['stores'] = $this->model_stores->getActiveStore();          

            $Printing_data = $this->model_Printing->getPrintingData($Printing_id);
           $production_data = $this->model_Pricing->getproductionData2($Printing_id);
           if ($production_data == null){$production_data = '0';}
            $this->data['Printing_data'] = $Printing_data;
             $this->data['production_data'] = $production_data;
            $this->render_template('Printing/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deletePrinting', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $Printing_id = $this->input->post('Printing_id');

        $response = array();
        if($Printing_id) {
            $delete = $this->model_Printing->remove($Printing_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the Printing information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}