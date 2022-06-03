<?php 

class Model_Design extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getDesignData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM design where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM design ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
public function getDesignData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM attribute_value where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM attribute_value ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getActiveDesignData()
	{
		$sql = "SELECT * FROM design WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
        public function getActiveDesignData2()
	{
		$sql = "SELECT * FROM attribute_value ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
           public function getActiveDesignData3()
	{
		$sql = "SELECT * FROM brands ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
 public function getActiveDesignData4()
	{
		$sql = "SELECT * FROM designion_items ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('design', $data);
			return ($insert == true) ? true : false;
		}
	}
        public function create1($data1)
	{
		if($data1) {
			$insert = $this->db->insert('Printing', $data1);
                     
		         $id = $this->db->insert_id();  
                        return ($id) ? $id : false;
			
		}
	}
public function image($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->insert('design', $data);
			return ($update == true) ? true : false;
		}
	}
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('design', $data);
			return ($update == true) ? true : false;
		}
	}
       public function update1($data1, $id)
	{
		if($data1 && $id) {
			$this->db->where('id', $id);
			$update1 = $this->db->update('Printing', $data1);
			
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('design');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalDesign()
	{
		$sql = "SELECT * FROM design";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}