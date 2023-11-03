<?php 

class M_Pesanan extends Model{
	public function tambah($data){
		$query = $this->insert('tbl_pesanan2', $data);
		$query = $this->execute();
		return $query;
	}
	public function tambahdetail($data){
		$query = $this->insert('tpesanan_detail', $data);
		$query = $this->execute();
		return $query;
	}

	public function tambahfile($data){
		$query = $this->insert('tpemesanan_file', $data);
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
		$sq="SELECT no_invoice,booking_code,tbl_perjalanan.asal as sts,tbl_pesanan2.id, tbl_pesanan2.id_pemesan AS nama_pemesan, tbl_pesanan2.id_mobil AS nama_mobil, tbl_jenis_bayar.jenis_bayar,harga,tgl_pinjam,tgl_kembali,DATEDIFF(tgl_kembali,now()) as ddif  
		FROM tbl_pesanan2 
		left JOIN tbl_jenis_bayar ON tbl_pesanan2.id_jenis_bayar = tbl_jenis_bayar.id
		left JOIN tbl_perjalanan ON tbl_pesanan2.id_perjalanan = tbl_perjalanan.id  
		where tbl_pesanan2.id_perusahaanref=".$_SESSION['login']['id_perusahaanref']." and tbl_pesanan2.tgl_pinjam>='".$tglstart."' and tbl_pesanan2.tgl_pinjam<='".$tglend."'
		order by tbl_pesanan2.id desc";
		//echo $sq;
		$query = $this->setQuery($sq);
		$query = $this->execute();
		return $query;
	}
	public function generate_cb(){
		$datenow = date("Y-m-d");
		$sq="SELECT COUNT(*) as kon  FROM tbl_pesanan2 WHERE tgl_pinjam = '$datenow' and id_perusahaanref=".$_SESSION['login']['id_perusahaanref'];
		//echo $sq;
		$query = $this->setQuery($sq);
		$query = $this->execute();
		$kon=0;
		while($data = $query->fetch_object()) :
			$kon=$data->kon;
		endwhile;
		$len=strlen($kon);
		$code = 'BOK';
		$ymd = date('d/m/Y');
		$squence = $kon+1;
		$squence = str_pad($squence,$len+1,0,STR_PAD_LEFT);
		$sq2="SELECT prefix  FROM tperusahaan WHERE id_perusahaan=".$_SESSION['login']['id_perusahaanref'];
		$query = $this->setQuery($sq2);
		$query = $this->execute();
		while($data2 = $query->fetch_object()) :
			$prefix=$data2->prefix;
		endwhile;
		//return
		return $prefix."/".$squence."/".$ymd;
	}

	public function generate_cbcb(){
		$datenow = date("Y-m-d");
		$sq="SELECT COUNT(*) as kon  FROM tbl_pesanan2 WHERE tgl_pinjam = '$datenow' and id_perusahaanref=".$_SESSION['login']['id_perusahaanref'];
		//echo $sq;
		$query = $this->setQuery($sq);
		$query = $this->execute();
		$kon=0;
		while($data = $query->fetch_object()) :
			$kon=$data->kon;
		endwhile;
		$len=strlen($kon);
		$code = 'BOK';
		$ymd = date('d/m/Y');
		$squence = $kon+1;
		$squence = str_pad($squence,$len+1,0,STR_PAD_LEFT);
		$sq2="SELECT prefix  FROM tperusahaan WHERE id_perusahaan=".$_SESSION['login']['id_perusahaanref'];
		$query = $this->setQuery($sq2);
		$query = $this->execute();
		while($data2 = $query->fetch_object()) :
			$prefix=$data2->prefix;
		endwhile;
		//return
		return $code.$squence.$this->generateRandomString(6);
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function lihat_id($id){
		$query = $this->get_where('tbl_pesanan2', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function listfile($id){
		$query = $this->get_where('tpemesanan_file', ['pemesanan_id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function listfileid($id){
		$query = $this->get_where('tpemesanan_file', ['id' => $id]);
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

	public function detailid($id){
		$query = $this->get_where('tpesanan_detail', ['pesanan_id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function hapus($id){
		$query = $this->delete('tbl_pesanan2', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}

	public function hapusdetail($id){
		$query = $this->delete('tpesanan_detail', ['pesanan_id' => $id]);
		$query = $this->execute();
		return $query;
	}
	public function hapusfile($id){
		$query = $this->delete('tpemesanan_file', ['id' => $id]);
		$query = $this->execute();
		return $query;
	}
	//SELECT LAST_INSERT_ID();
	public function lid(){
		$q="SELECT LAST_INSERT_ID() as lid";
		//echo $q;
		$query = $this->setQuery($q);
		$query = $this->execute();
		while($data2 = $query->fetch_object()) :
			$lid=$data2->lid;
		endwhile;
		return $lid;
	}
	public function detail($id){
		$q="SELECT tbl_pesanan2.*, tbl_jenis_bayar.jenis_bayar,tbl_perjalanan.asal 
		FROM tbl_pesanan2 
		left JOIN tbl_jenis_bayar ON tbl_pesanan2.id_jenis_bayar = tbl_jenis_bayar.id 
		left JOIN tbl_perjalanan ON tbl_pesanan2.id_perjalanan = tbl_perjalanan.id  
		WHERE tbl_pesanan2.id = $id";
		//echo $q;
		$query = $this->setQuery($q);
		$query = $this->execute();
		return $query;
	}
}