<?php 

class Model_Workorder extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active Workorder data */
	public function getActiveWorkorder()
	{
		$sql = "SELECT * FROM Workorder WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getWorkorderData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Workorder where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Workorder";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getWorkordercount($wnum)
	{
		if($wnum) {
			$sql = "SELECT * FROM production where name = ?";
			$query = $this->db->query($sql, array($wnum));
			return $query->result_array();
		}

		$sql = "SELECT * FROM Workorder";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
         public function doneWorkordercount($wnum)
	{
		if($wnum) {
			$sql = "SELECT * FROM production where name = ? and availability = 'Done'";
			$query = $this->db->query($sql, array($wnum));
			return $query->result_array();
		}

		$sql = "SELECT * FROM Workorder";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getWorkorderData1($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Workorder where id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Workorder ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function getWorkorderData22($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Workorder where id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workshop ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
 public function getWorkorderData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Workorder where name = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Workorder ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('Workorder', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Workorder', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Workorder');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalWorkorder()
	{
		$sql = "SELECT * FROM Workorder WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}