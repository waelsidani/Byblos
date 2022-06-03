<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Design';

		$this->load->model('model_Design');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
                $this->load->model('model_Pricing');
	}

    /* 
    * It only redirects to the manage Design page
    */
	public function index()
	{
        if(!in_array('viewDesign', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('Design/index', $this->data);	
	}

    /*
    * It Fetches the Design data from the Design table 
    * this function is called from the datatable ajax function
    */
	public function fetchDesignData()
	{
		$result = array('data' => array());

		$data = $this->model_Design->getDesignData();

		foreach ($data as $key => $value) {

            		// button
            $buttons = '';
            if(in_array('updateDesign', $this->permission)) {
    			$buttons .= '<a href="'.base_url('Design/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteDesign', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			
if (json_decode($value['image']) == 0)
        {$images[0] =  "assets/images/designs/Byblos.gif";}
        else
        {$images = json_decode($value['image']);}
			$img = '<img src="'.base_url($images[0]).'" alt="'.$value['name'].'" class="img-square" width="60" height="60" />';

           
            $qty_status = '';
            if($value['qty'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            }  if($value['qty'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }


        
			$result['data'][$key] = array(
				$img,
                                $value['Number'],
				$value['name'],
				$value['description'],
				$value['C_date'],
                         
                              
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage Design page
    */
	
        public function create()
	{
		if(!in_array('createDesign', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('Number', 'Number', 'trim|required');
        

        if ($this->form_validation->run() == TRUE) {
            // true case
            if( $this->input->post('image') == 0) {
                $upload_image = $this->upload_image2();
              
                
                
            }
            $data1 = array(
                'Designer' => $this->input->post('Designer_name'),
                'Design' => $this->input->post('Number'),
                'Frame_Number' =>  $this->input->post('qty'),
                'color_1' =>json_encode($this->input->post('color')),
                'image' => $upload_image,
                );
        	if ($this->input->post('C_date') == '')
                {
                
                $data = array(
                'name' => $this->input->post('Designer_name'),
                'Design_approval' => $this->input->post('Design_approval'),
                'Number' => $this->input->post('Number'),
                'qty' => $this->input->post('qty'),
                'Rec_date' => $this->input->post('Rec_date'),
                'C_date' => $this->input->post('C_date'),
                //'Sticker_approval' => $this->input->post('Sticker_approval'),
                'Tray' => $this->input->post('Tray'),
                'description' => $this->input->post('description'),
                'printed' => $this->input->post('printed'),
                'image1' => $this->input->post('image1'),
                'image2' => $this->input->post('image2'),
                'image3' => $this->input->post('image3'),
                'image' => $upload_image,
                'color1' => json_encode($this->input->post('color')),
              );
        	$create = $this->model_Design->create($data);
                }
                else{
                    $create1 = $this->model_Design->create1($data1);
                
                $data = array(
                'name' => $this->input->post('Designer_name'),
                'Design_approval' => $this->input->post('Design_approval'),
                'Number' => $this->input->post('Number'),
                'qty' => $this->input->post('qty'),
                'Rec_date' => $this->input->post('Rec_date'),
                'C_date' => $this->input->post('C_date'),
                //'Sticker_approval' => $this->input->post('Sticker_approval'),
                'Tray' => $this->input->post('Tray'),
                'description' => $this->input->post('description'),
                'printed' => $this->input->post('printed'),
                'image1' => $this->input->post('image1'),
                'image2' => $this->input->post('image2'),
                'image3' => $this->input->post('image3'),
                'image' => $upload_image,
                'color1' => json_encode($this->input->post('color')),
                'paint_id' => $create1,
                
);
        	$create = $this->model_Design->create($data);
                }
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Design/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Design/create', 'refresh');
        	}
        }
        else {
            // false case

    
        	    	
			    	

            $this->render_template('Design/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */public function upload_image()
    {
    	// assets/images/Design_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('Design_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['Design_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit Design page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage Design page
    */
	public function upload_image2()
        {
       $data = [];
$path2= [];
      $count = count($_FILES['Design_image']['name']);

      for($i=0;$i<$count;$i++){

        if(!empty($_FILES['Design_image']['name'][$i])){
          $_FILES['file']['name'] = $_FILES['Design_image']['name'][$i];
          $_FILES['file']['type'] = $_FILES['Design_image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['Design_image']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['Design_image']['error'][$i];
          $_FILES['file']['size'] = $_FILES['Design_image']['size'][$i];
         $config['upload_path'] = 'assets/images/designs'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '15000';
          
          
          $config['file_name'] = uniqid();
          $this->load->library('upload',$config); 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $data['totalFiles'][] = $filename;
        
            
             $type = explode('.', $_FILES['Design_image']['name'][$i]);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$filename;
         array_push($path2,$path);
       
            
          }

        }

      }

   return ($data == true) ? json_encode($path2)  : false;   
   }

  

	public function update($Design_id)
	{      
        if(!in_array('updateDesign', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$Design_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('Number', 'Number', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            // true case
            $data1 = array(
                'Designer' => $this->input->post('Designer_name'),
                'Design' => $this->input->post('Number'),
                'image' => $this->input->post('Image_M')
                );  
             $data2 = array('Designer' => $this->input->post('Designer_name'),
                'Design' => $this->input->post('Number'),
                'Frame_Number' =>  $this->input->post('qty'),
                'color_1' =>json_encode($this->input->post('color')),
                'image' => $this->input->post('Image_M'));
             
                $ID_Paint = $this->input->post('Design_printing');
        	 if($this->input->post('C_date') !== ''&& $ID_Paint !=='')
                {$this->model_Design->update1($data1, $ID_Paint );
                }elseif ($ID_Paint ==''&&$this->input->post('C_date') !== '')
                {$ID_Paint = $this->model_Design->create1($data2);}
            $data = array(
                
                'name' => $this->input->post('Designer_name'),
                'Design_approval' => $this->input->post('Design_approval'),
                'Number' => $this->input->post('Number'),
                'qty' => $this->input->post('qty'),
                'Rec_date' => $this->input->post('Rec_date'),
                'C_date' => $this->input->post('C_date'),
                'Sticker_approval' => $this->input->post('Sticker_approval'),
                'Tray' => $this->input->post('Tray'),
                'description' => $this->input->post('description'),
                'printed' => $this->input->post('printed'),
                'image1' => $this->input->post('image1'),
                'image2' => $this->input->post('image2'),
                'image3' => $this->input->post('image3'),
                'color1' => $this->input->post('color1'),
                'color2' => $this->input->post('color2'),
                'color3' => $this->input->post('color3'),
                'color4' => $this->input->post('color4'),
                'color5' => $this->input->post('color5'),
                'color6' => $this->input->post('color6'),
                'color7' => $this->input->post('color7'),
                'color8' => $this->input->post('color8'),
                'paint_id' => $ID_Paint,
                 );

           
            if( $this->input->post('image') == 0) {
                $upload_image = $this->upload_image2();
                $upload_image = array('image' => $upload_image);
                
                $this->model_Design->update($upload_image, $Design_id);
                if ($ID_Paint !== '')
                {
                $this->model_Design->update1($upload_image, $ID_Paint);
            }}

            $update = $this->model_Design->update($data, $Design_id); 
            
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('Design/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Design/update/'.$Design_id, 'refresh');
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

            $Design_data = $this->model_Design->getDesignData($Design_id);
           $production_data = $this->model_Pricing->getproductionData2($Design_id);
           if ($production_data == null){$production_data = '0';}
            $this->data['Design_data'] = $Design_data;
             $this->data['production_data'] = $production_data;
            $this->render_template('Design/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteDesign', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $Design_id = $this->input->post('Design_id');

        $response = array();
        if($Design_id) {
            $delete = $this->model_Design->remove($Design_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the Design information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}