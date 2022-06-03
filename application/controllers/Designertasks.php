<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Designertasks extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Designertasks';

		$this->load->model('model_Designertasks');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
                $this->load->model('model_Pricing');
	}

    /* 
    * It only redirects to the manage Designertasks page
    */
	public function index()
	{
        if(!in_array('viewDesignertasks', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('Designertasks/index', $this->data);	
	}

    /*
    * It Fetches the Designertasks data from the Designertasks table 
    * this function is called from the datatable ajax function
    */
	public function fetchDesignertasksData()
	{
		$result = array('data' => array());

		$data = $this->model_Designertasks->getDesignertasksData();

		foreach ($data as $key => $value) {
 $date5 = date('d-m-Y', $value['add_date']);
                            $time2 = date('h:i a', $value['add_date']);

                            $date_time = $date5 . ' ' . $time2;
            		// button
            $buttons = '';
            if(in_array('updateDesignertasks', $this->permission)) {
    			$buttons .= '<a href="'.base_url('Designertasks/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteDesignertasks', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			
if (json_decode($value['image']) == NULL)
        {$images[0] =  "assets/images/Designs/Byblos.gif";}
        else
        {$images = json_decode($value['image']);}
			$img = '<img src="'.base_url($images[0]).'" alt="'.$value['film'].'" class="img-square" width="90" height="90" />';

            if ( $value['Done'] !== 'null' && $value['Done'] !== null){
               
                $stat2= (substr_count($value['Done'], 'Done') * 100 ) ;
                $stat1= (substr_count($value['Done'], '0') * 100 );
                $stat3 = count(json_decode($value['Done']));
                
                $stat= $stat2 / $stat3;
                $stat_p=$stat1 / $stat3;
               $stat= sprintf("%02d", $stat);
               $stat_p = sprintf("%02d", $stat_p);
                $procc= '';
                
                $procc = '<div class="progress" style = "background-color : red"> <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: ' .$stat.'%">
     '.$stat.' % Complete (success)</div> <div class="progress-bar progress-bar-warning" role="progressbar" style="width:'.$stat_p.'%">'.$stat_p.'%</div></div>';
    
                } else{$procc = 0;}
            


        
			$result['data'][$key] = array(
				$img,
                            $date_time,
                                $value['Tittle'],
				$value['Deadline'],
                                $procc,
                                $buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage Designertasks page
    */
	
        public function create()
	{
		if(!in_array('createDesignertasks', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('Tittle', 'Tittle', 'trim|required');

        if ($this->form_validation->run() == true) {
            // true case
          
            
        	 if(!empty($_FILES['Designertasks_image']['name'][0])){
            $upload_image = $this->upload_image2();
            }
                else{$upload_image = 0;}
              
                $data = array(
                'update_Tasks'=> "2",
                'Tittle' => $this->input->post('Tittle'),
                'person' => $this->input->post('person'),
                'Deadline' => $this->input->post('Deadline'),
                'Subtitle' => json_encode($this->input->post('Subtitle')),
                'details' => json_encode($this->input->post('details')),
                'film' => json_encode($this->input->post('film')),
                'done_date' =>json_encode( $this->input->post('done_date')),
                'Done' => json_encode($this->input->post('Done')),
                'note' => $this->input->post('note'),
                'add_date' => strtotime(date('Y-m-d h:i:s a')),
                'image' =>$upload_image,
              );
        	$create = $this->model_Designertasks->create($data);
                
            
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Designertasks/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Designertasks/create', 'refresh');
        	}
        }
        else {
            // false case

    
        	    	
			    	

            $this->render_template('Designertasks/create', $this->data);
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
      $count = count($_FILES['Designertasks_image']['name']);

      for($i=0;$i<$count;$i++){

        if(!empty($_FILES['Designertasks_image']['name'][$i])){
          $_FILES['file']['name'] = $_FILES['Designertasks_image']['name'][$i];
          $_FILES['file']['type'] = $_FILES['Designertasks_image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['Designertasks_image']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['Designertasks_image']['error'][$i];
          $_FILES['file']['size'] = $_FILES['Designertasks_image']['size'][$i];
         $config['upload_path'] = 'assets/images/Designertasks'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '15000';
          
          
          $config['file_name'] = uniqid();
          $this->load->library('upload',$config); 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $data['totalFiles'][] = $filename;
        
            
             $type = explode('.', $_FILES['Designertasks_image']['name'][$i]);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$filename;
         array_push($path2,$path);
       
            
          }

        }

      }

   return ($data == true) ? json_encode($path2)  : false;   
   }

  

	
	public function update($Designertasks_id)
	{      
        if(!in_array('updateDesignertasks', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$Designertasks_id) {
            redirect('dashboard', 'refresh');
        }

        
        
   if ( $this->input->post('update') == 1) {
            // true case
          
              
                $data = array(
                'update_Tasks'=> "2",
                'Tittle' => $this->input->post('Tittle'),
                'person' => $this->input->post('person'),
                'Deadline' => $this->input->post('Deadline'),
                'Subtitle' => json_encode($this->input->post('Subtitle')),
                'details' => json_encode($this->input->post('details')),
                'film' => json_encode($this->input->post('film')),
                'done_date' =>json_encode( $this->input->post('done_date')),
                'Done' => json_encode($this->input->post('Done')),
                'note' => $this->input->post('note'),
                'add_date' => strtotime(date('Y-m-d h:i:s a')),
                
              );

           
          
            $update = $this->model_Designertasks->update($data, $Designertasks_id); 
             if( $this->input->post('image') == 0) {
                $upload_image = $this->upload_image2();
                $upload_image = array('image' => $upload_image);
                
             $this->model_Designertasks->update($upload_image, $Designertasks_id);}
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('Designertasks/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Designertasks/update/'.$Designertasks_id, 'refresh');
            }
        }
        else {
            // attributes 
            
         
            
            
            // false case
                     

            $Designertasks_data = $this->model_Designertasks->getDesignertasksData($Designertasks_id);
           
         
            $this->data['Designertasks_data'] = $Designertasks_data;
            
            $this->render_template('Designertasks/edit', $this->data); 
        }   
	
        }
    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
    
	public function remove()
	{
        if(!in_array('deleteDesignertasks', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $Designertasks_id = $this->input->post('Designertasks_id');

        $response = array();
        if($Designertasks_id) {
            $delete = $this->model_Designertasks->remove($Designertasks_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the Designertasks information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}