<?php 

class C_Pesanan extends Controller {
	public function __construct(){
		$this->addFunction('url');
		if(!isset($_SESSION['login'])) {
			$_SESSION['error'] = 'Anda harus masuk dulu!';
			header('Location: ' . base_url());
		}
		
		$this->addFunction('web');
		$this->addFunction('session');
		$this->req = $this->library('Request');
		$this->pesanan = $this->model('M_Pesanan');
		$this->j_bayar = $this->model('M_Jenis_Bayar');
		$this->mobil = $this->model('M_Mobil');
		$this->pemesan = $this->model('M_Pemesan');
		$this->perjalanan = $this->model('M_Perjalanan');
		$this->perusahaan = $this->model('M_Perusahaan');
		
	}

	public function index(){
		$data = [
			
			'aktif' => 'pesanan',
			'judul' => 'Data Pesanan',
			'data_pesanan' => $this->pesanan->lihat(),
			'data_pemesan' => $this->pemesan->lihat(),
			'data_mobil' => $this->mobil->lihat(),
			'data_perjalanan' => $this->perjalanan->lihat(),
			'data_jenis_bayar' => $this->j_bayar->lihat(),
			'no' => 1
		];
		$this->view('pesanan/index', $data);
	}

	public function indextgl($tglstart,$tglend){
		$data = [
			
			
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'aktif' => 'pesanan',
			'judul' => 'Data Pesanan',
			'data_pesanan' => $this->pesanan->lihattgl($tglstart,$tglend),
			'data_pemesan' => $this->pemesan->lihat(),
			'data_mobil' => $this->mobil->lihat(),
			'data_perjalanan' => $this->perjalanan->lihat(),
			'data_jenis_bayar' => $this->j_bayar->lihat(),
			'no' => 1
		];
		$this->view('pesanan/index', $data);
	}

	public function add($tglstart,$tglend){
		$data = [
			'cb'=> $this->pesanan->generate_cb(),
			'cbcb'=> $this->pesanan->generate_cbcb(),
			'aktif' => 'pesanan',
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'judul' => 'Data Pesanan',
			'data_pemesan' => $this->pemesan->lihat(),
			'data_mobil' => $this->mobil->lihat(),
			'data_perjalanan' => $this->perjalanan->lihat(),
			'data_jenis_bayar' => $this->j_bayar->lihat(),
			'no' => 1
		];
		$this->view('pesanan/add', $data);
	}


	public function tampil(){
		$tglstart=$this->req->post('tglstart');
		$tglend=$this->req->post('tglend');
		$data = [
			'cb'=> $this->pesanan->generate_cb(),
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'aktif' => 'pesanan',
			'judul' => 'Data Pesanan',
			'data_pesanan' => $this->pesanan->lihattgl($tglstart,$tglend),
			'data_pemesan' => $this->pemesan->lihat(),
			'data_mobil' => $this->mobil->lihat(),
			'data_perjalanan' => $this->perjalanan->lihat(),
			'data_jenis_bayar' => $this->j_bayar->lihat(),
			'no' => 1
		];
		$this->view('pesanan/index', $data);

	}

	public function xls($tglstart,$tglend){


		$data = [
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'aktif' => 'pesanan',
			'judul' => 'Data Pesanan',
			'data_pesanan' => $this->pesanan->lihattgl($tglstart,$tglend),
			'perusahaan' => $this->perusahaan->lihat()->fetch_object(),
			'no' => 1
		];
		//$this->view('pesanan/excel', $data);
		$this->view('pesanan/excelcomposer', $data);
	
	}

	public function tambah($tglstart,$tglend){
		//print_r($_POST['deskripsi']);
		//exit();
	
		if(!isset($_POST['tambah'])) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		$harga=str_replace('.', '', $this->req->post('totalharga'));
		$tgl_pinjam=date('Y-m-d',strtotime($this->req->post('tgl_pinjam')));
		$tgl_kembali=date('Y-m-d',strtotime($this->req->post('tgl_kembali')));
		$pemesan=explode("|",$this->req->post('id_pemesan'));
		$uang_muka=str_replace('.', '', $this->req->post('uang_muka'));
		

		$data = [
			'booking_code'=> $this->req->post('kode_booking'),
			'id_pemesan' => $pemesan[1],
			'no_invoice' => $this->req->post('no_invoice'),
			'id_perjalanan' => $this->req->post('id_perjalanan'),
			'id_jenis_bayar' => $this->req->post('id_jenis_bayar'),
			'harga' => $harga,
			'uang_muka' => $uang_muka,
			'tgl_pinjam' => $tgl_pinjam,
			'tgl_kembali' => $tgl_kembali,
			'id_perusahaanref'=>$_SESSION['login']['id_perusahaanref']
		];
		$id=$this->pesanan->tambah($data);
		$lid=$this->pesanan->lid();
		//print_r($lid);
		$count=count($_POST['deskripsi']);
		for($i=0;$i<$count;$i++){
			$price=str_replace('.', '', $_POST['price'][$i]);
			$datadetail=[
				'pesanan_id'=>$lid,
				'deskripsi'=>$_POST['deskripsi'][$i],
				'qty'=>$_POST['qty'][$i],
				'price'=>$price
			];
			$this->pesanan->tambahdetail($datadetail);
		}
	

		if($id){
			setSession('success', 'Data berhasil ditambahkan!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		} else {
			setSession('error', 'Data gagal ditambahkan!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		}
	
	}

	public function upload($id){
		$data = [
			'id'=>$id,
			'listfile' => $this->pesanan->listfile($id),
		];

		$this->view('pesanan/upload', $data);
	}
	public function copytext($id){
		$data = [
			'detailid' => $this->pesanan->cek($id),
			'det' => $this->pesanan->detailid($id),
		];

		$this->view('pesanan/copytext', $data);
	}

	public function ubah($id,$tglstart,$tglend){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		$pesanan = $this->pesanan->lihat_id($id)->fetch_object();
		//print_r($pesanan);
		$id_pemesan = $pesanan->id_pemesan;
		$id_mobil = $pesanan->id_mobil;
		$id_perjalanan = $pesanan->id_perjalanan;
		$id_jenis_bayar = $pesanan->id_jenis_bayar;

		$data = [
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'aktif' => 'pesanan',
			'judul' => 'Ubah Pesanan',
			'data_pemesan' => $this->pemesan->lihat(),
			//'pemesan' => $this->pemesan->lihat_id($id_pemesan)->fetch_object(),
			'detailid' => $this->pesanan->detailid($id),
			'id_perjalanan' => $id_perjalanan,
			'data_perjalanan' => $this->perjalanan->lihat(),
			'data_jenis_bayar' => $this->j_bayar->lihat(),
			'jenis_bayar' => $this->j_bayar->lihat_id($id_jenis_bayar)->fetch_object(),
			'pesanan' => $pesanan
		];
		$this->view('pesanan/ubah', $data);
	}

	public function proses_ubah($id,$tglstart,$tglend){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0 || !isset($_POST['ubah'])) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		$harga=str_replace('.', '', $this->req->post('totalharga'));
		$tgl_kembali=date('Y-m-d',strtotime($this->req->post('tgl_kembali')));
		$pemesan=explode("|",$this->req->post('id_pemesan'));
		$uang_muka=str_replace('.', '', $this->req->post('uang_muka'));
		$data = [
			'id_pemesan' => $pemesan[1],
			'id_jenis_bayar'=> $this->req->post('id_jenis_bayar'),
			'id_perjalanan' => $this->req->post('id_perjalanan'),
			'harga' => $harga,
			'uang_muka' => $uang_muka,
			'no_invoice' => $this->req->post('no_invoice'),
			'booking_code' => $this->req->post('booking_code'),
			'tgl_kembali' => $tgl_kembali,
			
		];
		$this->pesanan->hapusdetail($id);
		$count=count($_POST['deskripsi']);
		for($i=0;$i<$count;$i++){
			$price=str_replace('.', '', $_POST['price'][$i]);
			$datadetail=[
				'pesanan_id'=>$id,
				'deskripsi'=>$_POST['deskripsi'][$i],
				'qty'=>$_POST['qty'][$i],
				'price'=>$price
			];
			$this->pesanan->tambahdetail($datadetail);
		}
	
		if($this->pesanan->ubah($data, $id)){
			setSession('success', 'Data berhasil diubah!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		} else {
			setSession('error', 'Data gagal diubah!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		}
	}

	public function hapusfile($id = null,$tglstart,$tglend){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);

		$gambar	= $this->pesanan->listfileid($id)->fetch_object()->namafile;

		if($gambar!=""){
			unlink(BASEPATH . DS . 'files' . DS . $gambar) or die('gagal hapus gambar!');
		}
		
		if($this->pesanan->hapusfile($id)){
			setSession('success', 'Data berhasil dihapus!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		} else {
			setSession('error', 'Data gagal dihapus!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		}
	}

	public function hapus($id = null,$tglstart,$tglend){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);

		if($this->pesanan->hapus($id)){
			setSession('success', 'Data berhasil dihapus!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		} else {
			setSession('error', 'Data gagal dihapus!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		}
	}

	public function detail($id,$tglstart,$tglend){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);

		$data = [
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'aktif' => 'pesanan',
			'judul' => 'Detail Pesanan',
			'detailid' => $this->pesanan->detailid($id),
			'pesanan' => $this->pesanan->detail($id)->fetch_object(),
		];

		$this->view('pesanan/detail', $data);
	}

	public function detailid($id){
		$data = [
			'detailid' => $this->pesanan->detailid($id),
		];

		$this->view('pesanan/detailid', $data);
	}



	public function invoice($id){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0) redirect('pesanan');

		$data = [
			'aktif' => 'pesanan',
			'judul' => 'Detail Pesanan',
			'pesanan' => $this->pesanan->detail($id)->fetch_object(),
			'pesananid' => $this->pesanan->detailid($id),
			'perusahaan' => $this->perusahaan->lihat()->fetch_object(),
			'listfile' => $this->pesanan->listfile($id),
		];

		$this->view('pesanan/invoice', $data);
	}

	public function invoicekosong(){
	

		$data = [
			'perusahaan' => $this->perusahaan->lihat()->fetch_object(),
			'cb'=> $this->pesanan->generate_cb(),
		];

		$this->view('pesanan/invoicekosong', $data);
	}

	public function uploadfile($id,$tglstart,$tglend){
		//print_r($_POST);
		//exit();

		// proses upload
		$upload_dir = BASEPATH . DS . 'files' . DS;
		$asal = $_FILES['filelampiran'.$id]['tmp_name'];
		$ekstensi = pathinfo($_FILES['filelampiran'.$id]['name'], PATHINFO_EXTENSION);
		$error = $_FILES['filelampiran'.$id]['error'];
		// echo $ekstensi;
		// exit();

		if($ekstensi =='jpg' or $ekstensi =='png' or $ekstensi =='jpeg' or $ekstensi =='gif'){

		$img_name = $id;
		$img_name = strtolower($img_name);
		$img_name = str_replace(' ', '-', $img_name);
		$img_name = $img_name . '-' . time();


			if(file_exists($upload_dir . $img_name . '.' . $ekstensi)) unlink($upload_dir . $img_name . '.' . $ekstensi);
			
			if(move_uploaded_file($asal, $upload_dir . $img_name . '.' . $ekstensi)){
				$data = [
					'pemesanan_id' => $id,
					'namafile' => $img_name . '.' . $ekstensi,
					'datecreated'=>date('Y-m-d H:i:s'),
				];

			
			} else die('gagal upload gambar');


		if($this->pesanan->tambahfile($data)){
			setSession('success', 'Data berhasil ditambahkan!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		} else {
			setSession('error', 'Data gagal ditambahkan!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		}
	}else{
		setSession('error', 'File harus gambar');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
	}
	}
}