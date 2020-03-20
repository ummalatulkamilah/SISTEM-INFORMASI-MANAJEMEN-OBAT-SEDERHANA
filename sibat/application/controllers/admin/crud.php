
<!-- crud.php meruapakan controler yang berisi fungsi mengambil data obat dari model yang kemudian ditampilkan ke view-->
<?php 

class Crud extends CI_Controller{


					// ======Menampilkan data=======
// fungsi construct pada crud.php digunakan untuk memanggil m_data yang merupakan model (berisi operasi database) dan helper  url

function __construct(){
	parent::__construct();		
	$this->load->model('m_data'); //memanggil m_data
	$this->load->helper('url');	//mengaktifkan helper url

}

// fungsi index untuk menampilkan data, dengan menggunakan fungsi tampil data  yang ada di model m_data untuk mengambil data dari database kemudian data tersebut di parsing ke view untuk ditampilkan.

function index(){
	$data['obat'] = $this->m_data->tampil_data()->result(); //mengambil daata dari database 
	$this->load->view('template/header'); //menampilkan header ke view
    $this->load->view('template/topbar'); // menampilkan topbar ke view
	$this->load->view('admin/v_tampil',$data); // parsing data ke view
	
}

// Catatan : agar mengakses dan mengelola databes harus melakukan load library database,saya mengaktifkan library database pada pengaturan autoload codeigniter.application/config/autoload.php.


					
					// ======input data======

// fungsi tambah berfungsi untuk menampilkan v_input yang merupakan form input data obat 
	function tambah(){
		$this->load->view('template/header'); // menampilkan header ke view
    	$this->load->view('template/topbar'); // menampilkan topbar ke view
		$this->load->view('admin\v_input'); //menampilkan v_input yang berada di folder admin pada view
		
	}

// fungsi tambah_aksi digunakan untuk mengatur proses penginputan data obat 
	function tambah_aksi(){

		$nama_obat = $this->input->post('nama_obat'); 
		$stok_obat = $this->input->post('stok_obat');
		$harga_obat = $this->input->post('harga_obat');
		$tanggal_masuk = $this->input->post('tanggal_masuk');
		$tanggal_exp = $this->input->post('tanggal_exp');
		$keterangan = $this->input->post('keterangan');

//kemudian data yang diterima atau ditangkap di jadikan sebuah aray
		$data = array(
			'nama_obat' => $nama_obat,
			'stok_obat' => $stok_obat,
			'harga_obat' => $harga_obat,
			'tanggal_masuk' => $tanggal_masuk,
			'tanggal_exp' => $tanggal_exp,
			'keterangan' => $keterangan
			);

//menginput data array ke database  dengan menggunakan fungsi input_data yang terdpat pada model m_data
//parameter petama berisi data yang akan diinpukan (array data : $data)
//parameter kedua berisi tabel tujuan untuk menyimpan data (user)
		$this->m_data->input_data($data,'tb_obat'); //menginputkan data ke tabel user
		redirect('admin/crud/index'); // mengerahkan ke index
	}


					 // ======hapus data=======

// fungsi hapus data  pada controller crud.php berfungsi untuk menghapus data obat yang ada didatabase berdasarkan id yang tertampung di variabel $where mengunakan fungsi hapus_data yang terdapat di model m_data
	function hapus($id){
		$where = array('id' => $id); //data id obat yang akan dihapus dijadikan array
		$this->m_data->hapus_data($where,'tb_obat'); // mengahapus data tabel obat dengan id yang tertampung di variabel where
		redirect('admin/crud/index'); //jika proses hapus data berhasil akan diarahkan ke index
	}

							// ======edit data========

// fungsi edit  pada controller crud.php berfungsi untuk mengambil data dari tabel obat untuk di edit di from v_edit						
	function edit($id){
	$where = array('id' => $id); //menjadikan id yang akan digunakan sebgai array 
	$data['obat'] = $this->m_data->edit_data($where,'tb_obat')->result(); // mengambil data yanga akan di edit berdasaekan data array berupa id 
	$this->load->view('template/header');
    	$this->load->view('template/topbar');
 $this->load->view('admin/v_edit',$data); //memampilkan v_edit yang merupakan form untuk mengedit data

}

// fungsi update digunakan untuk mengatur proses update data  obatterbaru ke database
function update(){
		$id = $this->input->post('id');
		$nama_obat = $this->input->post('nama_obat');
		$stok_obat = $this->input->post('stok_obat');
		$harga_obat = $this->input->post('harga_obat');
		$tanggal_masuk = $this->input->post('tanggal_masuk');
		$tanggal_exp = $this->input->post('tanggal_exp');
		$keterangan = $this->input->post('keterangan');
//data nama, alamat dan pekerjaan yang diterima melalui method post  kemudian dijadikan array dan disimpan pada variabel $data
	$data = array(
			'nama_obat' => $nama_obat,
			'stok_obat' => $stok_obat,
			'harga_obat' => $harga_obat,
			'tanggal_masuk' => $tanggal_masuk,
			'tanggal_exp' => $tanggal_exp,
			'keterangan' => $keterangan
			);

//smentara data id yang menjadi penentu obat mana yang mau diedit, data id tersebut di simpan di dalam variabel where dan juga dijadikan array.
	$where = array(
		'id' => $id
	);

//mengupdate data obat ke tb-obat berdasarkan id yamg terdapat di dalam variabel whwre
	$this->m_data->update_data($where,$data,'tb_obat'); // update data obat ke database
	redirect('admin/crud/index'); //mengarahkan ke index
}


}
