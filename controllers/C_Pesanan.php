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

	public function tampil(){
		$tglstart=$this->req->post('tglstart');
		$tglend=$this->req->post('tglend');
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

	public function tambah($tglstart,$tglend){
		if(!isset($_POST['tambah'])) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		$harga=str_replace('.', '', $this->req->post('harga'));
		$tgl_pinjam=date('Y-m-d',strtotime($this->req->post('tgl_pinjam')));
		$tgl_kembali=date('Y-m-d',strtotime($this->req->post('tgl_kembali')));
		$data = [
			'id_pemesan' => $this->req->post('id_pemesan'),
			'id_mobil' => $this->req->post('id_mobil'),
			'id_perjalanan' => $this->req->post('id_perjalanan'),
			'id_jenis_bayar' => $this->req->post('id_jenis_bayar'),
			'harga' => $harga,
			'tgl_pinjam' => $tgl_pinjam,
			'tgl_kembali' => $tgl_kembali,
			'id_perusahaanref'=>$_SESSION['login']['id_perusahaanref']
		];

		if($this->pesanan->tambah($data)){
			setSession('success', 'Data berhasil ditambahkan!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		} else {
			setSession('error', 'Data gagal ditambahkan!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		}
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
			//'pemesan' => $this->pemesan->lihat_id($id_pemesan)->fetch_object(),
			//'mobil' => $this->mobil->lihat_id($id_mobil)->fetch_object(),
			//'perjalanan' => $this->perjalanan->lihat_id($id_perjalanan)->fetch_object(),
			'jenis_bayar' => $this->j_bayar->lihat_id($id_jenis_bayar)->fetch_object(),
			'pesanan' => $pesanan
		];
		$this->view('pesanan/ubah', $data);
	}

	public function proses_ubah($id,$tglstart,$tglend){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0 || !isset($_POST['ubah'])) redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		$harga=str_replace('.', '', $this->req->post('harga'));
		$tgl_kembali=date('Y-m-d',strtotime($this->req->post('tgl_kembali')));
		$data = [
			'harga' => $harga,
			'tgl_kembali' => $tgl_kembali,
		];
		if($this->pesanan->ubah($data, $id)){
			setSession('success', 'Data berhasil diubah!');
			redirect('pesanan/indextgl/'.$tglstart."/".$tglend);
		} else {
			setSession('error', 'Data gagal diubah!');
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
			'pesanan' => $this->pesanan->detail($id)->fetch_object(),
		];

		$this->view('pesanan/detail', $data);
	}

	public function invoice($id){
		if(!isset($id) || $this->pesanan->cek($id)->num_rows == 0) redirect('pesanan');

		$data = [
			'aktif' => 'pesanan',
			'judul' => 'Detail Pesanan',
			'pesanan' => $this->pesanan->detail($id)->fetch_object(),
			'perusahaan' => $this->perusahaan->lihat()->fetch_object(),
		];

		$this->view('pesanan/invoice', $data);
	}
}