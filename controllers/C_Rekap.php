<?php 

class C_Rekap extends Controller {
	public function __construct(){
		$this->addFunction('url');
		//print_r($this->addFunction('url'));
		if(!isset($_SESSION['login'])) {
			$_SESSION['error'] = 'Anda harus masuk dulu!';
			header('Location: ' . base_url());
		}
		
		$this->addFunction('web');
		$this->addFunction('session');
		$this->req = $this->library('Request');
		$this->perjalanan = $this->model('M_Rekap');
		$this->perusahaan = $this->model('M_Perusahaan');
	}

    public function index(){
        $tglstart=date('d-m-Y');
        $tglend=date('d-m-Y');
		$data = [
			'aktif' => 'rekap',
			'judul' => 'Rekap Transaksi Uang Masuk dan Uang Keluar',
            'data_perjalanan'=>$this->perjalanan->lihattgl($tglstart,$tglend),
			'no' => 1
		];
		$this->view('rekap/index', $data);
	}



	public function indextgl($tglstart,$tglend){
		//$tglstart=$this->req->post('tglstart');
		//$tglend=$this->req->post('tglend');
		$data = [
            'aktif' => 'rekap',
			'judul' => 'Rekap Transaksi Uang Masuk dan Uang Keluar',
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'data_perjalanan' => $this->perjalanan->lihattgl($tglstart,$tglend),
			'no' => 1
		];
		$this->view('rekap/index', $data);
	}

	
	public function tampil(){
	
		$tglstart=$this->req->post('tglstart');
		$tglend=$this->req->post('tglend');
		$data = [
            'aktif' => 'rekap',
			'judul' => 'Rekap Transaksi Uang Masuk dan Uang Keluar',
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'data_perjalanan' => $this->perjalanan->lihattgl($tglstart,$tglend),
			'no' => 1
		];
		$this->view('rekap/index', $data);
	}

	public function xls($tglstart,$tglend){
		$data = [
            'aktif' => 'rekap',
			'judul' => 'Rekap Transaksi Uang Masuk dan Uang Keluar',
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'data_perjalanan' => $this->perjalanan->lihattgl($tglstart,$tglend),
			'perusahaan' => $this->perusahaan->lihat()->fetch_object(),
			'no' => 1
		];
		$this->view('rekap/xls', $data);
	}

	public function ubah($id,$tglstart,$tglend){
		if(!isset($id) || $this->perjalanan->cek($id)->num_rows == 0) redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);

		$data = [
			'aktif' => 'perjalanan',
			'judul' => 'Ubah Perjalanan',
			'data_ttuk'=>$this->perjalanan->gettuk(),
			'duk' => $this->perjalanan->lihat_id($id)->fetch_object(),
			'tglstart' => $tglstart,
			'tglend' => $tglend,
		];
		$this->view('uangkeluar/ubah', $data);
	}

	public function proses_ubah($id,$tglstart,$tglend){
		if(!isset($id) || $this->perjalanan->cek($id)->num_rows == 0 || !isset($_POST['ubah'])) redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		$rpuk=str_replace('.', '', $this->req->post('rpuk'));
        $tgluk=date('Y-m-d',strtotime($this->req->post('tgluk')));
		$data = [
			'typeuk' => $this->req->post('typeuk'),
			'ketuk' => $this->req->post('ketuk'),
			'rpuk' => $rpuk,
            'tgluk' => $tgluk,
            'userupdate'=>$_SESSION['login']['userid'],
            'dateupdate'=>date('Y-m-d H:i:s'),
		];
		if($this->perjalanan->ubah($data, $id)){
			setSession('success', 'Data berhasil diubah!');
			redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		} else {
			setSession('error', 'Data gagal diubah!');
			redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		}
	}

	public function hapus($id = null,$tglstart,$tglend){
		if(!isset($id) || $this->perjalanan->cek($id)->num_rows == 0) redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);

		if($this->perjalanan->hapus($id)){
			setSession('success', 'Data berhasil dihapus!');
			redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		} else {
			setSession('error', 'Data gagal dihapus!');
			redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		}
	}
}