<?php 

class Model_Store extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active Store information*/
	
	/* get the brand data */
	public function getStoreData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Store WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM Store ORDER BY id DESC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function getStoreData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Store WHERE Order_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM Store";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
         public function getStoreData3($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM raw_store WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM raw_store ORDER BY id DESC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
         public function getStoreData4($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM raw_store WHERE Order_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM raw_store";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
         public function getStorePending($id = null)
	{
		
		$sql = "SELECT * FROM raw_store WHERE Status = 1 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function create()
	{       
            $material = count($this->input->post('attribute'));
            for($x = 0; $x < $material; $x++) {
            $data = array(
                     'date_time' => strtotime(date('Y-m-d h:i:s a'))+7200,
                     'Status' => 1,
                     'Order_ID' => 0,
                     'Workshop' => $this->input->post('workshop'),
                     'Requester' => $this->input->post('person_name'),
                     'note' => $this->input->post('note'),
                     'name' => $this->input->post('attribute')[$x],
                     'Code' => $this->input->post('attribute')[$x],
                     'Quantity' => $this->input->post('qty')[$x],
                
                  );
                              
             $this->db->insert('store', $data);}
             redirect('Store/', 'refresh');
             
        }
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Store', $data);
		
			return ($update == true) ? true : false;
		}
	}
        public function update1($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('raw_store', $data);
		
			return ($update == true) ? true : false;
		}
	}
public function approve($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Store', $data);
		
			return ($update == true) ? true : false;
		}	
                
                }
	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Store');
			return ($delete == true) ? true : false;
		}
	}
public function remove1($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('raw_store');
			return ($delete == true) ? true : false;
		}
	}

}