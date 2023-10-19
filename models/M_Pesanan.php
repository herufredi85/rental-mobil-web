<?php 

class M_Pesanan extends Model{
	public function tambah($data){
		$query = $this->insert('tbl_pesanan2', $data);
		$query = $this->execute();
		return $query;
	}

	public function lihat(){
		$query = $this->setQuery("SELECT tbl_pesanan2.*
		FROM tbl_pesanan2 
		where tbl_pesanan2.id_perusahaanref=".$_SESSION['login']['id_perusahaanref']."  
		order by tbl_pesanan2.id desc");
		$query = $this->execute();
		return $query;
	}

	public function lihattgl($tglstart,$tglend){
		$tglstart=date('Y-m-d',strtotime($tglstart));
		$tglend=date('Y-m-d',strtotime($tglend));
		$sq="SELECT tbl_pesanan2.id, tbl_pesanan2.id_pemesan AS nama_pemesan, tbl_pesanan2.id_mobil AS nama_mobil, tbl_jenis_bayar.jenis_bayar,harga,tgl_pinjam,tgl_kembali,DATEDIFF(tgl_kembali,now()) as ddif  
		FROM tbl_pesanan2 
		INNER JOIN tbl_jenis_bayar ON tbl_pesanan2.id_jenis_bayar = tbl_jenis_bayar.id 
		where tbl_pesanan2.id_perusahaanref=".$_SESSION['login']['id_perusahaanref']." and tbl_pesanan2.tgl_pinjam>='".$tglstart."' and tbl_pesanan2.tgl_pinjam<='".$tglend."'
		order by tbl_pesanan2.id desc";
		//echo $sq;
		$query = $this->setQuery($sq);
		$query = $this->execute();
		return $query;
	}

	public function lihat_id($id){
		$query = $this->get_where('tbl_pesanan2', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function ubah($data, $id){
		$query = $this->update('tbl_pesanan2', $data, ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function cek($id){
		$query = $this->get_where('tbl_pesanan2', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function hapus($id){
		$query = $this->delete('tbl_pesanan2', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function detail($id){
		$q="SELECT tbl_pesanan2.*, tbl_jenis_bayar.jenis_bayar 
		FROM tbl_pesanan2 
		INNER JOIN tbl_jenis_bayar ON tbl_pesanan2.id_jenis_bayar = tbl_jenis_bayar.id  WHERE tbl_pesanan2.id = $id";
		//echo $q;
		$query = $this->setQuery($q);
		$query = $this->execute();
		return $query;
	}
}