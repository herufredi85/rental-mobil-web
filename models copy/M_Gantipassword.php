<?php 

class M_Gantipassword extends Model {
	public function lihat(){
		$query = $this->get_where('tbl_akun',['id_perusahaanref'=>$_SESSION['login']['id_perusahaanref']], ['nama', 'username', 'id']);
		$query = $this->execute();
		return $query;
	}

	public function tambah($data){
		$query = $this->insert('tbl_akun', $data);
		$query = $this->execute();
		return $query;
	}
	public function ubah($data,$id){
		$query = $this->update('tbl_akun', $data, ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function lihat_id($id){
		$query = $this->get_where('tbl_akun', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function cek($id){
		$query = $this->get_where('tbl_akun', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function cek_login($username){
		$query = $this->get_where('tbl_akun', ['username' => $username]);
		$query = $this->execute();
		return $query;
	}

	public function detail($id){
		$query = $this->get_where('tbl_akun', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function hapus($id){
		$query = $this->delete('tbl_akun', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}
}