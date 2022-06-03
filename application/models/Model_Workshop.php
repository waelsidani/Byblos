<?php 

class Model_Workshop extends CI_Model
{
    
    
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveCategroy()
	{
		$sql = "SELECT * FROM workshop WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
public function getActiveWorkshopData()
	{
		$sql = "SELECT * FROM workshop WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	/* get the brand data */
	public function getWorkshopData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workshop WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workshop";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function getWorkshopData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workshop WHERE name = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workshop";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

        public function getWorkshopData1($id = null)
	{
		if($id) {
			$sql = "SELECT Work_production FROM workshop WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('workshop', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('workshop', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('workshop');
			return ($delete == true) ? true : false;
		}
	}

}