<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Products';

		$this->load->model('model_products');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');
                $this->load->model('model_Pricing');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('products/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchProductData()
	{
		$result = array('data' => array());

		$data = $this->model_products->getProductData();

		foreach ($data as $key => $value) {
if ($value['P_Cat']!= "" ){
$Cat= $this->model_products->Productcategorycode($value['P_Cat']);}
			// button
            $buttons = '';
            if(in_array('updateProduct', $this->permission)) {
    			$buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			
if (!$value['image'] == '0' && $value['image'] == 0)
    
{		$img = '<img src="'.base_url($value['image']).'" alt="" class="img-square" width="90" height="90" />';
}
else {$img = "-";}

if(in_array('updateProduct', $this->permission) ) {
    			$buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            
            
      }
      $price = $value['price'];
      if ($value['availability']==2)
            {
                        $availabile = '<span class="label label-danger">Yes</span>';
                        
            }
            else {$availabile = "No";}
            $qty_status = '';
            if($value['qty'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            }  if($value['qty'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }


			$result['data'][$key] = array(
				$img,
                                $value['Number'],
                                $value['Barcode'],
                                $Cat['category'],
				$value['Design'],
                                $value['description'],
				$price,
                                $value['qty'] . ' ' . $qty_status,
                             
				 $availabile,
                            $value['date'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
        
        	public function code()
	{
		if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
$this->form_validation->set_rules('Number', 'Number', 'trim|required|is_unique[products.Number]');
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	

        	$data = array(
        		
                        'code' => $this->input->post('Number'),
                        'ended_code' => $this->input->post('Number2'),
        		
        	);
 
                $Number_id = $this->input->post('P_Cat');
        	
                $create= $this->model_products->update2($data, $Number_id);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('products/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('products/code', 'refresh');
        	}
        }
        else {
            // false case

    
        	    	
			$this->data['stores'] = $this->model_stores->getActiveStore();        	

            $this->render_template('products/code', $this->data);
        }	
	}
        
        
	public function create()
	{
		if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
$this->form_validation->set_rules('Number', 'Number', 'trim|required|is_unique[products.Number]');
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$upload_image = $this->upload_image();

        	$data = array(
        		'date' => $this->input->post('Added_Date'),
        		'P_Cat' => $this->input->post('P_Cat'),
                        'Design' => $this->input->post('Design'),
                        'Number' => $this->input->post('Number'),
                        'Barcode' => $this->input->post('Barcode'),
                        'Barcode2' => $this->input->post('Barcode2'),
        		'price' => $this->input->post('price'),
                        'size' => $this->input->post('size'),
        		'qty' => $this->input->post('qty'),
        		'image' => $upload_image,
        		'description' => $this->input->post('description'),
        		'packing' => $this->input->post('Packing'),
                        'store_id' => $this->input->post('store'),
        		'availability' => $this->input->post('availability'),
        	);
 
                $barcode_id = $this->input->post('Barcodeid');
                $Number_id = $this->input->post('Numberid');
        	$create = $this->model_products->create($data);
                $data2 = array(
                  'code' => $this->input->post('Number'),  
                    'active' => 1, 
                );
                $data3 = array(
                  'code' => $this->input->post('Number'),  
                     
                );
                $this->model_products->update1($data2, $barcode_id);
                $this->model_products->update2($data3, $Number_id);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('products/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('products/create', 'refresh');
        	}
        }
        else {
            // false case

    
        	    	
			$this->data['stores'] = $this->model_stores->getActiveStore();        	

            $this->render_template('products/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
        public function getcatValueById($t)
	{
		$product_id = $t;
		if($product_id) {
			$product_data = $this->model_products->Productcategorycode($product_id);
			echo json_encode($product_data);
		}
	}
         public function getbarcodeValueById()
	{
		
		
			$product_data = $this->model_products->Productbarcode();
			echo json_encode($product_data);
		
	}


	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '15000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($product_id)
	{      
        if(!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
            redirect('dashboard', 'refresh');
        }

   
      
        
         $this->form_validation->set_rules('Number', 'Number', 'trim|required');
     

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                
        	
                'Design' => $this->input->post('Design'),
                'Number' => $this->input->post('Number'),
                'price' => $this->input->post('price'),
                'size' => $this->input->post('size'),
                'qty' => $this->input->post('qty'),
                'Barcode' => $this->input->post('Barcode'),
                'description' => $this->input->post('description'),
                'store_id' => $this->input->post('store'),
                'availability' => $this->input->post('availability'),
                'packing' => $this->input->post('Packing'),
               
            );
  
            
            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_products->update($upload_image, $product_id);
            }

            $update = $this->model_products->update($data, $product_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('products/update/'.$product_id, 'refresh');
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

            $product_data = $this->model_products->getProductData($product_id);
           $Production_data = $this->model_Pricing->getProductionData2($product_id);
           if ($Production_data == null){$Production_data = '0';}
            $this->data['product_data'] = $product_data;
             $this->data['Production_data'] = $Production_data;
            $this->render_template('products/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_products->remove($product_id);
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

}