<?php 

class C_Uangkeluar extends Controller {
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
		$this->perjalanan = $this->model('M_Uangkeluar');
		$this->pesanan = $this->model('M_Pesanan');
		$this->perusahaan = $this->model('M_Perusahaan');
	}

	public function indextgl($tglstart,$tglend){
		$data = [
			'aktif' => 'uangkeluar',
			'judul' => 'Data Pengeluaran',
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'data_perjalanan' => $this->perjalanan->lihattgl($tglstart,$tglend),
            'data_ttuk'=>$this->perjalanan->gettuk(),
			'data_pesanan'=>$this->pesanan->lihat(),
			'no' => 1
		];
		$this->view('uangkeluar/index', $data);
	}

	public function tampil(){
		$tglstart=$this->req->post('tglstart');
		$tglend=$this->req->post('tglend');		
			$data = [
				'aktif' => 'uangkeluar',
				'judul' => 'Data Pengeluaran',
				'tglstart' => $tglstart,
				'tglend' => $tglend,
				'data_perjalanan' => $this->perjalanan->lihattgl($tglstart,$tglend),
				'data_ttuk'=>$this->perjalanan->gettuk(),
				'data_pesanan'=>$this->pesanan->lihat(),
				'no' => 1
			];
			$this->view('uangkeluar/index', $data);

	}

	public function xls($tglstart,$tglend){
		//$tglstart=$this->req->post('tglstart');
		//$tglend=$this->req->post('tglend');

			$data=[
				'tglstart' => $tglstart,
				'tglend' => $tglend,
				'perusahaan' => $this->perusahaan->lihat()->fetch_object(),
				'data_perjalanan' => $this->perjalanan->lihattgl($tglstart,$tglend),
			];
			//$this->view('uangkeluar/excel', $data);
			$this->view('uangkeluar/excelcomposer', $data);
		
	}


	public function tambah($tglstart,$tglend){
	

			if(!isset($_POST['tambah'])) redirect('uangkeluar');
		$rpuk=str_replace('.', '', $this->req->post('rpuk'));
        $tgluk=date('Y-m-d',strtotime($this->req->post('tgluk')));
		$cb=explode("|",$this->req->post('kode_booking'));
		$data = [
			'booking_code' => $cb['1'],
			'pesanan_id' => $cb['0'],
			'typeuk' => $this->req->post('typeuk'),
			'ketuk' => $this->req->post('ketuk'),
			'rpuk' => $rpuk,
            'tgluk' => $tgluk,
            'userinput'=>$_SESSION['login']['userid'],
            'datecreated'=>date('Y-m-d H:i:s'),
			'id_perusahaanref'=>$_SESSION['login']['id_perusahaanref']
		];

		if($this->perjalanan->tambah($data)){
			setSession('success', 'Data berhasil ditambahkan!');
			redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		} else {
			setSession('error', 'Data gagal ditambahkan!');
			redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		}

		
	}

	public function ubah($id,$tglstart,$tglend){
		if(!isset($id) || $this->perjalanan->cek($id)->num_rows == 0) redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);

		$data = [
			'aktif' => 'perjalanan',
			'judul' => 'Ubah Pengeluaran',
			'data_ttuk'=>$this->perjalanan->gettuk(),
			'duk' => $this->perjalanan->lihat_id($id)->fetch_object(),
			'tglstart' => $tglstart,
			'tglend' => $tglend,
			'data_pesanan'=>$this->pesanan->lihat(),
		];
		$this->view('uangkeluar/ubah', $data);
	}

	public function proses_ubah($id,$tglstart,$tglend){
		if(!isset($id) || $this->perjalanan->cek($id)->num_rows == 0 || !isset($_POST['ubah'])) redirect('uangkeluar/indextgl/'.$tglstart.'/'.$tglend);
		$rpuk=str_replace('.', '', $this->req->post('rpuk'));
        $tgluk=date('Y-m-d',strtotime($this->req->post('tgluk')));
		$cb=explode("|",$this->req->post('kode_booking'));
		$data = [
			'booking_code' => $cb['1'],
			'pesanan_id' => $cb['0'],
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