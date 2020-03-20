<!-- model m_data ini berisi operasi-operasi database untuk keperluaan crud -->

<?php 

class M_data extends CI_Model{

// function tampil_data pada model m_data digunakan untuk mengambil data dari database.untuk pada function ino saya akan mengambil data dari tabel obat untuk ditampilkan ke v_tampil maka dari itu tabel admin sebagai parameter.
	function tampil_data(){
		return $this->db->get('tb_obat');
	}

// function input_data  pada model m_data berfungsi untuk menyimpan data yang di diterima dari form inputan ke tabel yang dituju.
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}

// function hapus_data berfungsi untuk meghapus tabel yang ada di database, berdasarkan data yang ada pada variabel where
	function hapus_data($where,$table){
		$this->db->where($where); 
		$this->db->delete($table);
	}

// function edit data berfungsi untuk menyeleksi data obat yang akan di edit berdasarkan id yang di simpan divariabel where
	function edit_data($where,$table){		
	return $this->db->get_where($table,$where);
	}

// function update berfungsi melakukan update data obat yang sudah di edit ke database.
	function update_data($where,$data,$table){
		$this->db->where($where); //
		$this->db->update($table,$data); // update data ke tabel yang dituju
	}	

//function jumlah exp berfungsi untuk menghitung jumlah kadaluarsa untuk ditampilkan pada halaman dasboard
	function jumlah_exp(){

		$query = $this->db->query("SELECT COUNT(keterangan) as ket FROM tb_obat WHere keterangan = 'kadaluarsa';")->row();
		return $query;
	}

//function hampir_habis berfungsi untuk menampilkan nama obat yang stoknya kurang dari 10
	function hampir_habis(){
		$query = $this->db->query("SELECT COUNT(nama_obat) as namo FROM tb_obat WHere stok_obat < '10';")->row();
		return $query;
	}
}