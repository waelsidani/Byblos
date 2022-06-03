<?php 

class Model_Production extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
        public function workorderdata($idw = null)
        {        
        if($idw) {
			$sql = "SELECT id FROM Production where name = ?";
			$query = $this->db->query($sql, array($idw));
			return $query->result_array();
		}
        }
	public function getProductionData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Production where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Production ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function getProductionData_report($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Production where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Production WHERE not_rec = 1 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getProductionlog($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM production_log where id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM production_log ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function getProductionData1($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Production where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Production where availability != 'Done' and approval != '2' and approval != '3' ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getProductionReportData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Production_Report where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Production_Report ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function getProductionReportData1($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Production_Report_1 where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Production_Report_1 ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function doublicate($data)
        {if($data) {
			$this->db->insert('Production', $data);
		            
        }
      
        }
           
        public function getProductData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workshop where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workshop ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
            public function getworkshopData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workshop where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workshop ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getworkshopData3($id = null)
	{
		if($id) {
			$sql = $sql = "SELECT * FROM    production_items AS PI INNER JOIN brands AS RM ON  (PI.M_ID = RM.ID)";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM    production_items AS PI INNER JOIN brands AS RM ON  (PI.M_ID = RM.ID)";
		$query = $this->db->query($sql);
		return $query->result_array();
        }
        public function getPricingItemData3()
	{
		
		$sql = "SELECT * FROM    production_items AS PI INNER JOIN brands AS RM ON  (PI.M_ID = RM.ID)";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getActiveProductionData()
	{
		$sql = "SELECT * FROM Production WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
        public function getinproccessProductionData()
	{
		$sql = "SELECT * FROM Production WHERE availability = 'pending' ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
           public function getinproccessProductionData2()
	{
		$sql = "SELECT * FROM Production WHERE availability = 'Done' ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
        public function getinproccessProductionData3()
	{
		$sql = "SELECT * FROM Production WHERE approval = '2' ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
         public function getinproccessProductionData4()
	{
		$sql = "SELECT * FROM Production WHERE not_rec = '0' ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
        public function getActiveProductionData2()
	{
		$sql = "SELECT * FROM attribute_value ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
    public function createR($data)
	{
	if($data) {
			$this->db->insert('Production_Report', $data);
		         $Report_id = $this->db->insert_id();  
                        return ($Report_id) ? $Report_id : false;
        }}
  public function createR_1($data)
	{
	if($data) {
			$this->db->insert('Production_Report_1', $data);
		         $Report_id = $this->db->insert_id();  
                        return ($Report_id) ? $Report_id : false;
        }}

	
	public function create($data)
	{$this->load->model('model_Pricing');
	if($data) {
			$this->db->insert('Production', $data);
		          
        }}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Production', $data);
			return ($update == true) ? true : false;
                        	// now decrease the stock from the product
    		
		}
	}
        
        public function updatelog($data)
	{
		if($data) {
			$this->db->where('id');
			$update = $this->db->insert('Production_log', $data);
			return ($update == true) ? true : false;
                        	
    		
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Production');
			
                        
                        
			$this->db->where('Production_ID', $id);
			$delete_item = $this->db->delete('production_items');
			return ($delete == true && $delete_item) ? true : false;
		
		}
	}

	public function countTotalProduction()
	{
		$sql = "SELECT * FROM Production";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}