<?php 

class Model_BrushStore extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getBrushStoreData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM BrushStore where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM BrushStore ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
public function getBrushStoreData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM BrushStore where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM BrushStore ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getActiveBrushStoreData()
	{
		$sql = "SELECT * FROM BrushStore ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
        public function getActiveBrushStoreData2($id)
	{
		
		$sql = "SELECT * FROM BrushStore ORDER BY id DESC";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
           public function getActiveBrushStoreData3()
	{
		$sql = "SELECT * FROM brands ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
 
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('brushstore', $data);
			return ($insert == true) ? true : false;
		}
	}
       

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('brushstore', $data);
			return ($update == true) ? true : false;
		}
	}
      

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('BrushStore');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalBrushStore()
	{
		$sql = "SELECT * FROM BrushStore";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}