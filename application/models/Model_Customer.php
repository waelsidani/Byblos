<?php 

class Model_Customer extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveCategroy()
	{
		$sql = "SELECT * FROM Customer WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

        
	/* get the brand data */
	public function getCustomerData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Customer WHERE id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		
 
               //$s = $_SESSION['username'];
              //  if ($s != 'Abdullah' && ($s != 'Admin')){
                }
 else {
     $sql = "SELECT * FROM Customer";
		$query = $this->db->query($sql);
               return $query->result_array();}
    
        }
        
        public function getCustomerData1($user = null)
	{
		if($user) {
			$sql = "SELECT * FROM Customer WHERE user = ? ";
			$query = $this->db->query($sql, array($user));
			return $query->result_array();
                }
 
    
        }
        
        public function getCustomeruser($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Customer WHERE id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		
 
               //$s = $_SESSION['username'];
              //  if ($s != 'Abdullah' && ($s != 'Admin')){
                }
 else {
     $sql ="SELECT MIN(id) AS id, user FROM `customer` GROUP by user";
		$query = $this->db->query($sql);
               return $query->result_array();}
    
        }
	public function getCustomerData2($id = null)
	{
            
		if($id) {
			$sql = "SELECT * FROM Customer WHERE id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		
 
                }
 else {
     $sql = "SELECT * FROM Customer";
		$query = $this->db->query($sql);
               return $query->result_array();}
    
        }
	
public function getAttributeValueData($id = null)
	{
		$sql = "SELECT * FROM customer WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
public function getAttributeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM customer where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM customer";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function countAttributeValue($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM attribute_value WHERE attribute_parent_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->num_rows();
		}
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('Customer', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Customer', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Customer');
			return ($delete == true) ? true : false;
		}
	}
public function countTotalCustomer()
	{
		$sql = "SELECT * FROM customer ";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
        public function countLeadCustomer()
	{
		$sql = "SELECT * FROM customer WHERE Status = '0' ";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
        public function countContactCustomer()
	{
		$sql = "SELECT * FROM customer WHERE Status = '2' ";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
            public function countCustomer()
	{
		$sql = "SELECT * FROM customer WHERE Status = '1' ";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
               
}