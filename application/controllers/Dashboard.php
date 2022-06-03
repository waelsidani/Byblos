<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		$this->load->model('Model_production');
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_users');
		$this->load->model('model_Customer');


	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_work_orders'] = $this->Model_production->getinproccessProductionData();
                $this->data['total_Done_work_orders'] = $this->Model_production->getinproccessProductionData2();
                $this->data['total_Notapproved_work_orders'] = $this->Model_production->getinproccessProductionData3();
		$this->data['total_stopped_work_orders'] = $this->Model_production->getinproccessProductionData4();
		
                $this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_Customer'] = $this->model_Customer->countTotalCustomer();
$this->data['Lead_Customer'] = $this->model_Customer->countLeadCustomer();
$this->data['Contact_Customer'] = $this->model_Customer->countContactCustomer();
$this->data['Cus_Customer'] = $this->model_Customer->countCustomer();

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}