<?php 

class M_Rekap extends Model{
	public function tambah($data){
		$query = $this->insert('tuangkeluar', $data);
		$query = $this->execute();
		return $query;
	}

    public function lihat(){
		
		$q="SELECT tuangkeluar.*,ttuk.nametuk FROM tuangkeluar INNER JOIN ttuk ON tuangkeluar.typeuk = ttuk.idtuk where tuangkeluar.id_perusahaanref=".$_SESSION['login']['id_perusahaanref']." order by tuangkeluar.id desc";
		//echo $q;
		$query = $this->setQuery($q);
		$query = $this->execute();
		return $query;
	}

	public function lihattgl($tglstart,$tglend){
		$tglstart=date('Y-m-d',strtotime($tglstart));
		$tglend=date('Y-m-d',strtotime($tglend));
		$q="SELECT * from vrekap
			where vrekap.id_perusahaanref=".$_SESSION['login']['id_perusahaanref']." and vrekap.tgltrans>='".$tglstart."' and vrekap.tgltrans<='".$tglend."'
		";
		//echo $q;
		$query = $this->setQuery($q);
		$query = $this->execute();
		return $query;
	}

	public function lihattgldetail($tglstart,$tglend){
		$tglstart=date('Y-m-d',strtotime($tglstart));
		$tglend=date('Y-m-d',strtotime($tglend));
		$q="select tbl_pesanan2.booking_code,harga,tgl_pinjam,tbl_pesanan2.id,
		(select sum(rpuk)  from tuangkeluar where tuangkeluar.booking_code=tbl_pesanan2.booking_code
		) uangkeluar
		from tbl_pesanan2
			where tbl_pesanan2.id_perusahaanref=".$_SESSION['login']['id_perusahaanref']." and tbl_pesanan2.tgl_pinjam>='".$tglstart."' and tbl_pesanan2.tgl_pinjam<='".$tglend."'
			order by tbl_pesanan2.id desc
		";
		//echo $q;
		$query = $this->setQuery($q);
		$query = $this->execute();
		return $query;
	}


    public function gettuk(){
		$query = $this->get('ttuk');
		$query = $this->execute();
		return $query;
	}

	public function lihat_id($id){
		$query = $this->get_where('tuangkeluar', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function ubah($data, $id){
		$query = $this->update('tuangkeluar', $data, ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function cek($id){
		$query = $this->get_where('tuangkeluar', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function hapus($id){
		$query = $this->delete('tuangkeluar', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}
}