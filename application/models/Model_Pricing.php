
<?php 

class Model_Pricing extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the Pricing data */
	public function getPricingData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Pricing WHERE id = ? ORDER BY id DESC " ;
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Pricing ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getProductionData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Production WHERE id=?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Production ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getProductionData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Production WHERE P_number=$id ORDER BY id DESC";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Production ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
          public function getProductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM products WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM products ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
      
public function getPricingItemData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workshop WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM workshop  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}public function getActiveMaterialData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM     brands  ";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM    brands  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
       
       
        function getPricingItemData6()
	{
		

		$sql = "SELECT * FROM   brands ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
       
public function getPricingItemData5($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM  brands WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = " SELECT * FROM  brands";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the Pricing item data
	public function getPricingItemData($Pricing_id = null)
	{
		if(!$Pricing_id) {
			return false;
		}

		$sql = "SELECT * FROM Pricing_item WHERE Pricing_id = ?";
		$query = $this->db->query($sql, array($Pricing_id));
		return $query->result_array();
	}
        public function getPricingItemData11($Pricing_id = null)
	{
		if(!$Pricing_id) {
			return false;
		}

		$sql = "SELECT Material_ID  FROM Pricing_item WHERE Pricing_id = ?";
		$query = $this->db->query($sql, array($Pricing_id));
		return $query->result_array();
	}
        public function getPricingItemData4($Production_id = null)
	{
		if(!$Production_id) {
			return false;
		}

		$sql = "SELECT * FROM Production_items WHERE Production_id = ?";
		$query = $this->db->query($sql, array($Production_id));
		return $query->result_array();
	}
public function getProductionItemsData($Production_ID = null)
	{
		if(!$Production_ID) {
			return false;
		}

		$sql = "SELECT * FROM Production_items WHERE Production_ID = ?";
		$query = $this->db->query($sql, array($Production_ID));
		return $query->result_array();
	}
public function upload_image()
    {
    	 	// assets/images/product_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
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
	public function create()
	{
		$user_id = $this->session->userdata('username');
		$bill_no = 'Pricing-'. $this->input->post('sn');
                $upload_image = $this->upload_image();
    	        $data = array(
    		'bill_no' => $bill_no,
                'Att_name' => $this->input->post('Pricing_type'),
    		'customer_name' => $this->input->post('customer_name'),
    		'customer_address' => $this->input->post('customer_address'),
    		'Description' => $this->input->post('Description'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_subtotal' => $this->input->post('gross_subtotal_value'),
                'gross_nettotal' => $this->input->post('gross_nettotal_value'),
    		'service_charge_rate' => $this->input->post('service_charge_rate'),
    		'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'image' => $upload_image,
    		'net_subtotal' => $this->input->post('net_subtotal_value'),
    		'discount' => $this->input->post('discount'),
                'profit' => $this->input->post('profit'),
    		'paid_status' => 2,
    		'user_id' => $user_id,
                        'totalindirect'=>$this->input->post('indirect_subtotal_value'),
                            'totaldirect'=>$this->input->post('direct_subtotal_value'),
                        
    	);

		$insert = $this->db->insert('Pricing', $data);
		$Pricing_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'Pricing_id' => $Pricing_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
                        'subtotal' => $this->input->post('subtotal_value')[$x],
    			'rate' => $this->input->post('subtotal_value')[$x],
    			//'amount' => $this->input->post('net_subtotal_value')[$x],
                        'direct' => $this->input->post('direct_value')[$x],
    			'indirect' => $this->input->post('indirect_value')[$x],
                       'Workshop_ID' => $this->input->post('Workshop_ID')[$x],
                    'Material_ID' => $this->input->post('Material_ID')[$x],
    		);

    		$this->db->insert('Pricing_item', $items);

    		// now decrease the stock from the product
    		
    	}

		return ($Pricing_id) ? $Pricing_id : false;
	}

	public function countPricingItem($Pricing_id)
	{
		if($Pricing_id) {
			$sql = "SELECT * FROM Pricing_item WHERE Pricing_id = ?";
			$query = $this->db->query($sql, array($Pricing_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('username');
			// fetch the Pricing data 

			$data = array(
                        'Att_name' => $this->input->post('Pricing_type'),
			'customer_name' => $this->input->post('customer_name'),
	    		'customer_address' => $this->input->post('customer_address'),
	    		'Description' => $this->input->post('Description'),
	    		'gross_subtotal' => $this->input->post('gross_subtotal_value'),
                            'gross_nettotal' => $this->input->post('gross_nettotal_value'),
	    		'service_charge_rate' => $this->input->post('service_charge_rate'),
	    		'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    		'net_subtotal' => $this->input->post('net_subtotal_value'),
	    		'discount' => $this->input->post('discount'),
                        'profit' => $this->input->post('profit'),
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id,
                            'totalindirect'=>$this->input->post('indirect_subtotal_value'),
                            'totaldirect'=>$this->input->post('direct_subtotal_value'),
                               
	    	);
                        if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                $this->db->where('id', $id);
               $this->db->update('Pricing', $upload_image);
            }

			$this->db->where('id', $id);
			$update = $this->db->update('Pricing', $data);

			// now the Pricing item 
			// first we will replace the product qty to original and subtract the qty again
			
				
				
			}

			// now remove the Pricing item data 
			$this->db->where('Pricing_id', $id);
			$this->db->delete('Pricing_item');

		
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'Pricing_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
                            	'qty' => $this->input->post('qty')[$x],
                                'subtotal' => $this->input->post('subtotal_value')[$x],
    			        'rate' => $this->input->post('subtotal_value')[$x],
                                'direct' => $this->input->post('direct_value')[$x],
                                'indirect' => $this->input->post('indirect_value')[$x],
                                'Workshop_ID' => $this->input->post('Workshop_ID')[$x],
                            'Material_ID' => $this->input->post('Material_ID')[$x],
	    			
	    		);
	    		$this->db->insert('Pricing_item', $items);

	    		// now decrease the stock from the product
	    		
	    	}

			return true;
		}
	



	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Pricing');

			$this->db->where('Pricing_id', $id);
			$delete_item = $this->db->delete('Pricing_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidPricing()
	{
		$sql = "SELECT * FROM Pricing WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}