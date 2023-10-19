<?php 

class M_Perjalanan extends Model{
	public function tambah($data){
		$query = $this->insert('tbl_perjalanan', $data);
		$query = $this->execute();
		return $query;
	}

	public function lihat(){
		$query = $this->get_where('tbl_perjalanan',['id_perusahaanref'=>$_SESSION['login']['id_perusahaanref']]);
		$query = $this->execute();
		return $query;
	}

	public function lihat_id($id){
		$query = $this->get_where('tbl_perjalanan', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function ubah($data, $id){
		$query = $this->update('tbl_perjalanan', $data, ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function cek($id){
		$query = $this->get_where('tbl_perjalanan', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function hapus($id){
		$query = $this->delete('tbl_perjalanan', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}
}