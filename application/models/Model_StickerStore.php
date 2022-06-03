<?php 

class Model_StickerStore extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getStickerStoreData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM StickerStore where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM StickerStore ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
public function getStickerStoreData2($id = null)
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
	public function getActiveStickerStoreData()
	{
		$sql = "SELECT * FROM StickerStore WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
        public function getActiveStickerStoreData2()
	{
		$sql = "SELECT * FROM attribute_value ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
           public function getActiveStickerStoreData3()
	{
		$sql = "SELECT * FROM brands ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
 
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('stickerstore', $data);
			return ($insert == true) ? true : false;
		}
	}
       

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('stickerstore', $data);
			return ($update == true) ? true : false;
		}
	}
      

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('StickerStore');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalStickerStore()
	{
		$sql = "SELECT * FROM StickerStore";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}