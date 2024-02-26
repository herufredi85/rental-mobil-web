<?php 

class C_Gantipassword extends Controller {
	public function __construct(){
		$this->addFunction('url');
		if(!isset($_SESSION['login'])) {
			$_SESSION['error'] = 'Anda harus masuk dulu!';
			header('Location: ' . base_url());
		}
		
		$this->addFunction('web');
		$this->addFunction('session');
		$this->req = $this->library('Request');
		$this->akun = $this->model('M_Gantipassword');
	}

	public function index(){
		$data = [
			'aktif' => 'gantipassword',
			'judul' => 'Ganti Password',
			'data_akun' => $this->akun->lihat(),
			'no' => 1
		];
		$this->view('gantipassword/index', $data);
	}

	public function ubah(){
		if(!isset($_POST['tambah'])) redirect('gantipassword');
		$password=$_POST['passwordlama'];
		$username=$_SESSION['login']['username'];
		if($_POST['password'] !== $_POST['password2']) {
			setSession('error', 'Password tidak sama!');
			redirect('gantipassword');
		} else {

			$akun = $this->akun->cek_login($username);
			
			if($akun->num_rows > 0){
				$akun = $akun->fetch_object();
				if(password_verify($password, $akun->password)){
					$data = [
						'password' => password_hash($this->req->post('password'), PASSWORD_DEFAULT),
					];
					if($this->akun->ubah($data,$_SESSION['login']['userid'])){
						setSession('success', 'Data berhasil diubah!');
					} else {
						setSession('error', 'Data gagal ditambahkan!');
					}
					redirect('gantipassword');
				} else {
					setSession('error', 'Password salah!');
					redirect();
				}
			} else {
				setSession('error', 'Username tidak ditemukan!');
				redirect();
			}
			// proses upload
			//die('gambar error');
			
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