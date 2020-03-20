<!-- untuk membuat sistem login pertama membuat controler yang berisi fungsi untuk menampilkan form login dan melakukan verifikasi/authentikasi username dan password admin yang di masukkan. serta fungsi logout. controller yang saya buat untuk sistem login buat bernama login.php -->

<!-- catatan: untuk membuat sistem login harus mengaktifkan library database (untuk mengakses dan mengolah databse) dan seasion (sesion untuk mengecek apakah si admin sudah login apa belum).dan juga mengaktifkan helper url agar dapat menggunakan fungsi-fungsi url. -->

<?php 



class Login extends CI_Controller{

//fungsi construct yang digunakan untuk memanggil m_login yang merupakanmodel (berisi operasi database)
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');

	}

//fungsi index untuk menampilkan view bernama v_login yang merupakan from untuk mengiputkan data saat login 
	function index(){
		$this->load->view('admin/v_login');
	}

//fungsi aksi_login berfungsi untuk mengatur proses login
	function aksi_login(){
		$username = $this->input->post('username'); // menangkap data username yang diinputkan di from login
		$password = $this->input->post('password'); // menangkap data password yang diinputkan di from login

		//kemudian data yang diterima dan ditangkap di jadikan array agar dapat dikembalikan lagi ke model m_login
		$where = array(
			'username' => $username,
			'password' => md5($password) //md5 digunakan untuk enskripsi password
			);

		//cek ketersediaan username dan pasword admin dengan fungsi cek login yang da di m_login
		$cek = $this->m_login->cek_login("admin",$where)->num_rows();

		//jika hasil cek ternyata menyatakan username dan pasword tersedia maka dibuat sesion berisi username dan status login, kemudian akan di arahkan ke controller admin.
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("admin/admin"));

// jika ternyata username dan passowrd yang diinputkan tidak tersedia maka akan tampil pemberiatahuan password dan username salah
		}else{
			echo "Username dan password salah !";
		}
	}


//fungsi logout berfungsi untuk mengapus semua sesion sehingga proses login berhenti/selesai
	function logout(){
		$this->session->sess_destroy(); //menghentikan semua sesion
		redirect(base_url('admin/login')); // diarahkan ke form login
	}
}
