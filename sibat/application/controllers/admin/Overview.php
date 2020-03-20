<?php

//controller admin.php digunakan untuk tampilan yang akan di tampilkaan setelah login
class Overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
        $this->load->model('m_data');
        $this->load->helper('url');
	}

	public function index()
	{
        
        $data['exp'] = $this->m_data->jumlah_exp();
        $data['stok'] = $this->m_data->hampir_habis();
        $this->load->view('template/header');
        $this->load->view('template/topbar');
        $this->load->view('admin/overview',$data);
      
	}
}