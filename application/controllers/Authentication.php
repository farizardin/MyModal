<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

	public function index()
	{	
		$this->load->view('login.php');		
	}
	public function SignUp(){
		$this->load->view('daftar.php');
	}

	public function login_auth(){	
		$user = $this->input->post('username');
		$pass = md5($this->input->post('password'));

		$authentication = $this->Auth_model->auth($user,$pass);

		if($authentication){
			foreach($authentication as $row);
			$this->session->set_userdata('username', $row->username);
			$this->session->set_userdata('id_role', $row->id_role);
			$this->session->set_userdata('nama_user', $row->nama_user);
			$this->session->set_userdata('id_user', $row->id_user);
			

			if($this->session->userdata('id_role') == 1){
				redirect('Pemodal/index');
			}
			elseif($this->session->userdata('id_role') == 2){
				redirect('Peminjam/index');
			}
			elseif($this->session->userdata('id_role') == 3){
				redirect('Admin/index');
			}
		}else{
			$data['error_message'] = "Username atau Password tidak sesuai";
			$this->load->view('login', $data);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Homepage');
	}

	public function sign_up(){
		if($this->input->post('submit')){
			$usrname = $this->input->post('username');
			$name = $this->input->post('name');
			$password = md5($this->input->post('password'));
			$idrole = 1;
			$userComparation = $this->Auth_model->compair($usrname);
			if($userComparation){
				$data['error_signup'] = "Username sudah ada";
				$this->load->view('daftar', $data);
			}
			else{
				$data = array(
					'id_role' => $idrole,
					'username' => $usrname,
					'nama_user' => $name,
					'pass_user' => $password);
				$query = $this->Auth_model->simpan($data);
				if($query){
					$data['success_signup'] = "Telah berhasil mendaftar";
					$this->load->view('login', $data);
				}
			}
			$this->load->view('daftar', $data);
		}
	}
}