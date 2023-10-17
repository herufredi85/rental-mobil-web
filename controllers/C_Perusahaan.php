<?php 

class C_Perusahaan extends Controller {
	public function __construct(){
		$this->addFunction('url');
		if(!isset($_SESSION['login'])) {
			$_SESSION['error'] = 'Anda harus masuk dulu!';
			header('Location: ' . base_url());
		}
		
		$this->addFunction('web');
		$this->addFunction('session');
		$this->req = $this->library('Request');
		$this->akun = $this->model('M_Perusahaan');
	}

	public function index(){
		$data = [
			'aktif' => 'perusahaan',
			'judul' => 'Manajemen Perusahaan',
			'data_akun' => $this->akun->lihat(),
            //'data_akun2' => $this->akun->lihat2(),
			'no' => 1
		];
		$this->view('perusahaan/index', $data);
	}

	public function tambah(){
		if(!isset($_POST['tambah'])) redirect('perusahaan');

		if($_SESSION['login']['id_perusahaanref']=='') {
			setSession('error', 'Password tidak sama!');
			redirect('perusahaan');
		} else {
			// proses upload
			$upload_dir = BASEPATH . DS . 'uploads' . DS.'perusahaan'.DS;
			$asal = $_FILES['foto']['tmp_name'];
			$ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
			$error = $_FILES['foto']['error'];

			//$img_name = $this->req->post('nama_perusahaan');
			$img_name = $_SESSION['login']['id_perusahaanref'];
			$img_name = strtolower($img_name);
			$img_name = str_replace(' ', '-', $img_name);
			$img_name = $img_name . '-' . time();

			if($error == 0){
				if(file_exists($upload_dir . $img_name . '.' . $ekstensi)) unlink($upload_dir . $img_name . '.' . $ekstensi);
				
				if(move_uploaded_file($asal, $upload_dir . $img_name . '.' . $ekstensi)){
					$data = [
						'nama_perusahaan' => $this->req->post('nama_perusahaan'),
						'alamat' => $this->req->post('alamat'),
                        'email' => $this->req->post('email'),
                        'telp' => $this->req->post('telp'),
                        'dateupdate'=>date('Y-m-d H:i:s'),
						'logo' => $img_name . '.' . $ekstensi,
						//'id_perusahaanref'=>$_SESSION['login']['id_perusahaanref'],
                        'userupdate'=>$_SESSION['login']['userid']
					];

					
				} else die('gagal upload gambar');
			} else{
				$data = [
					'nama_perusahaan' => $this->req->post('nama_perusahaan'),
						'alamat' => $this->req->post('alamat'),
                        'email' => $this->req->post('email'),
                        'telp' => $this->req->post('telp'),
                        'dateupdate'=>date('Y-m-d H:i:s'),
						//'logo' => $img_name . '.' . $ekstensi,
						//'id_perusahaanref'=>$_SESSION['login']['id_perusahaanref'],
                        'userupdate'=>$_SESSION['login']['userid']
				];
			} //die('gambar error');
			if($this->akun->ubah($data,$_SESSION['login']['id_perusahaanref'])){
				setSession('success', 'Data berhasil diubah!');
				redirect('perusahaan');
			} else {
				setSession('error', 'Data gagal diubah!');
				redirect('perusahaan');
			}
		}
	}

	public function hapus($id = null){
		if(!isset($id) || $this->akun->cek($id)->num_rows == 0) redirect('akun');

		$gambar	= $this->akun->detail($id)->fetch_object()->foto;
		if($gambar!=''){
			unlink(BASEPATH . DS . 'uploads' . DS . $gambar) or die('gagal hapus gambar!');
		}
		
		if($this->akun->hapus($id)){
			setSession('success', 'Data berhasil dihapus!');
			redirect('akun');
		} else {
			setSession('error', 'Data gagal dihapus!');
			redirect('akun');
		}
	}

	public function detail($id){
		if(!isset($id) || $this->akun->cek($id)->num_rows == 0) redirect('akun');

		$data = [
			'aktif' => 'akun',
			'judul' => 'Detail Akun',
			'akun' => $this->akun->detail($id)->fetch_object(),
		];

		$this->view('akun/detail', $data);
	}
}