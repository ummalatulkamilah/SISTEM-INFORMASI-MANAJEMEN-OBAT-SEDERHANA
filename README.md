#  LANGKAH-LANGKAH SISTEM-INFORMASI-MANAJEMEN-OBAT-SEDERHANA

## Langkah 1 : Persiapan
1.	Persiapkan web server xampp
2.	Persiapkan Text editor, bisa mengunakan sublime text, Visual Studio code atau lainnya
3.	Instal dan persiapkan Codeigniter
4.	Download tamplate boostrap yang akan diterapkan jadi tampilan web, saya menggunakan tamplate bootstrap sb amnin 2.


## Langkah 2 : Konfigurasi Awal  Code igniter
1.	Konfigurasi Base URL, buka config/config.php, isi bagian $config['base_url'] = 'http://localhost/sibat';. Sibat adalah nama folder codeigniter yang digunakan untuk mengembangkan web ini.
2.	Konfigurasi Helper, Pertama buka file config/autoload.php, lalu cari $autoload['helper']. Tambahkan url dan form, sehingga menjadi seperti ini:
$autoload['helper']= 'url, form'.
3.	Konfigurasi Libraries, buka file config/autoload.php, lalu cari $autoload['libraries']. Tambahkan database dan dan session, sehingga menjadi seperti ini:
$autoload['helper']= 'database, session'.
4.	Membuat konstantan, buat konstanta SITE_NAME untuk menyimpan nama web. Konstanta ini nanti kita perlukan untuk mengambil judul web pada template. buka file config/constants.php kode berikut dibagian bawah

  	/*
	|--------------------------------------------------------------------------
	| Constants for Site
	|--------------------------------------------------------------------------
	|
	*/
	
	define('SITE_NAME', 'sibat');


#Langkah 3 : Menambahkan SB admin di code igniter.
1.	Ekstrak SB admin
2.	Copy Folder js, css dan vendor ke folder codeigniter, untuk folder vendor dirubah jadi asset agar tidak bercampur dengan folder vendor dari composer.
3.	Membuat folder admin di view, lalu copy bagian content index.html pada file baru di dalam folder admin, berinama file admin.php.
4.	Membuat folder tamplate di view, lalu copy bagian footer, header dan topbar yang adadi index.html pada file baru di dalam folder tamplate, berinama file untuk footer dengan footer,php, file untuk header dengan header.php dan top bar dengan nama topbar.php.
Buat file admin.php dalam controller/admin, tambahkan code 


``<?php 

class Admin extends CI_Controller{
 // fuctioon construct pada controller digunakan untuk mengaktifkan model dan helper
	function __construct(){
		parent::__construct();
	 $this->load->model('m_data'); // memanggil atau mengaktifkan m_data
		$this->load->model('m_admin'); // memanggil atau mengaktifkan m_admin
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
 }	

}
``


5.	Buat route baru untuk admin, buka config/routes.php 
    Tambahkan : $route['admin'] = 'admin/admin';
6.	Ubah semua link css, js yang mengarah /vendor/ jadi /assets/
7.	Untuk mengahpus index.php agar url lebih simple, buka config/config.php, hapus index.php  pada $config['index_page']. Selanjutnya      membuat htaccess di directory root codeigniter, dengan buat file baru dengan nama “ .htaccess “. Isi file tersebut:


  ``RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f

   RewriteCond %{REQUEST_FILENAME} !-d

    RewriteRule ^(.*)$ index.php/$1 [L]``
