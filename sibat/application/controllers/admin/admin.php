<!-- controller admin.php digunakan untuk tampilan yang akan di tampilkaan setelah login -->

<?php 

class Admin extends CI_Controller{
 // fuctioon construct pada controller digunakan untuk mengaktifkan model dan helper
	function __construct(){
		parent::__construct();
	 $this->load->model('m_data'); // memanggil atau mengaktifkan m_data
	
        $this->load->helper('url'); // mengaktifkan helper url

		// mengecek apakah sesion status, untuk mendeteksi apakah user atau admin sudah login atau belum. 
		if($this->session->userdata('status') != "login"){ 
			redirect(base_url("login")); //jika user tidak berhasil login maka akan diarahkan ke halaamn login
		}
	}

//menampilkan view v_andmin
	function index(){
		 $data['exp'] = $this->m_data->jumlah_exp(); // menjalankna fucntion jumlah_exp  yang hasilnya berupa jumlah obat kadaluarsa
         $data['stok'] = $this->m_data->hampir_habis(); // menjalankan function hampir habis yang menampilkan obat yang stoknya kurang dari 10
         $this->load->view('template/header'); // menampilkan header ke view
         $this->load->view('template/topbar'); // menampilkan topbar ke view
         $this->load->view('admin/overview',$data); // menampilkan view over view 
      		$this->load->view('template/footer');
 }

	

}