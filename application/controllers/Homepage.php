<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// $this->load->model('Berita_model');	
		// $data["getBerita"] = $this->Berita_model->getBerita();
		$this->load->view('Homepage/index.php');		
	}

	public function Profile()
	{	
		$this->load->view('Homepage/profile.php');		
	}

	public function News()
	{	
		$this->load->model('Berita_model');	
		$data["getBerita"] = $this->Berita_model->getBerita();
		$this->load->view('Homepage/berita.php',$data);	
	}

	public function DetilNews(){
		$this->load->view('Homepage/detail_berita');
	}
	
	public function Download()
	{	
		$this->load->view('Homepage/download.php');		
	}

	public function Gallery()
	{	
		$this->load->view('Homepage/galeri.php');		
	}

}
