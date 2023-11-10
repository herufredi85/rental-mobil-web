<?php 

class C_Captcha extends Controller {
	public function __construct(){
		$this->addFunction('url');
		$this->addFunction('web');
        $this->addFunction('session');
	}
	public function index(){
		//print_r();
		$data = [
			
		];
		$this->view('captcha', $data);
	}
}