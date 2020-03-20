<?php 

class Crudadm extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_admin');
                $this->load->helper('url');
	}

	function index(){
		$data['adm'] = $this->m_admin->tampil_data()->result();
		$this->load->view('v_tampiladm',$data);
	}
}