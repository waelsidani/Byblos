<?php 

class Model_Designertasks extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getDesignertasksData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM designertasks where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM designertasks ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
public function getDesignertasksData2($id = null)
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
	public function getActiveDesignertasksData()
	{
		$sql = "SELECT * FROM Designertasks WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
        public function getActiveDesignertasksData2()
	{
		$sql = "SELECT * FROM attribute_value ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
           public function getActiveDesignertasksData3()
	{
		$sql = "SELECT * FROM brands ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
 
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('designertasks', $data);
			return ($insert == true) ? true : false;
		}
	}
       

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('designertasks', $data);
			return ($update == true) ? true : false;
		}
	}
      

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Designertasks');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalDesignertasks()
	{
		$sql = "SELECT * FROM Designertasks";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}