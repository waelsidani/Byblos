<?php 

class Model_Workorder_acc extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active Workorder_acc data */
	public function getActiveWorkorder_acc()
	{
		$sql = "SELECT * FROM workorder_acc WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getWorkorder_accData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workorder_acc where id =?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workorder_acc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getWorkorder_accNumber($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workorder_acc where name = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		
	}
        
        public function getWorkorder_acccount($wnum)
	{
		if($wnum) {
			$sql = "SELECT * FROM production where name = ?";
			$query = $this->db->query($sql, array($wnum));
			return $query->result_array();
		}

		$sql = "SELECT * FROM workorder_acc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
         public function doneWorkorder_acccount($wnum)
	{
		if($wnum) {
			$sql = "SELECT * FROM production where name = ? and availability = 'Done'";
			$query = $this->db->query($sql, array($wnum));
			return $query->result_array();
		}

		$sql = "SELECT * FROM workorder_acc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function doneWorkorder_acccount1($wnum)
	{
		if($wnum) {
			$sql = "SELECT Number FROM production where name = ? and availability = 'Done'";
			$query = $this->db->query($sql, array($wnum));
			return $query->result_array();
		}

		$sql = "SELECT * FROM workorder_acc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function doneWorkorder_acccount2($wnum)
	{
		if($wnum) {
			$sql = "SELECT id FROM production where name = ? and availability = 'Done'";
			$query = $this->db->query($sql, array($wnum));
			return $query->result_array();
		}

		$sql = "SELECT * FROM workorder_acc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        public function getWorkorder_accData1($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workorder_acc where id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workorder_acc ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function getWorkorder_accData22($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workorder_acc where id = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workshop ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
 public function getWorkorder_accData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM workorder_acc where name = ? ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM workorder_acc ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('workorder_acc', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('workorder_acc', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('workorder_acc');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalWorkorder_acc()
	{
		$sql = "SELECT * FROM workorder_acc WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}