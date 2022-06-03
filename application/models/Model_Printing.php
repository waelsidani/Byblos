<?php 

class Model_Printing extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getPrintingData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Printing where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Printing ORDER BY S_date DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
public function getPrintingData2($id = null)
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
        public function getPaintsData($id = null)
	{
		
		$sql = "SELECT * FROM   categories";
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}
	public function getActivePrintingData()
	{
		$sql = "SELECT * FROM Printing WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
        public function getActivePrintingData2()
	{
		$sql = "SELECT * FROM attribute_value ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
           public function getActivePrintingData3()
	{
		$sql = "SELECT * FROM brands ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
 public function getActivePrintingData4()
	{
		$sql = "SELECT * FROM Printingion_items ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('Printing', $data);
			return ($insert == true) ? true : false;
		}
	}
public function image($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->insert('Printing', $data);
			return ($update == true) ? true : false;
		}
	}
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Printing', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Printing');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalPrinting()
	{
		$sql = "SELECT * FROM Printing";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}