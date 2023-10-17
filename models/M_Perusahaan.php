<?php 

class M_Perusahaan extends Model {
	public function lihat(){
		$query = $this->get_where('tperusahaan',['id_perusahaan'=>$_SESSION['login']['id_perusahaanref']]);
		$query = $this->execute();
		return $query;
	}

    public function lihat2(){
		$query = $this->get_where('tbl_akun',['id_perusahaanref'=>$_SESSION['login']['id_perusahaanref']], ['nama', 'username', 'id']);
		$query = $this->execute();
		return $query;
	}

	public function ubah($data,$id){
		$query = $this->update('tperusahaan', $data, ['id_perusahaan' => $id]);
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