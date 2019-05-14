<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Proposal_model');

        if($this->session->id_role != 3){
            redirect('');
        }
    }
	public function index()
	{
        $this->load->view('Petugas');
    }
    //1
    public function ProposalMasuk(){
        $data['proposal_data'] = $this->Proposal_model->get_proposal_petugas();
        $this->load->view('Petugas/proposal_masuk',$data);
    }
    //2
    public function ConfirmProposal($id = null){
        if($this->input->post('submit')){
            $JudulCatatan = $this->input->post('judulcatatan');
            $Catatan = $this->input->post('catatan');
            $currentSessionID = $this->session->userdata('id_user');
            $this->Proposal_model->confirmPetugas($id);

            if($JudulCatatan != null && $Catatan != null){
                $this->Proposal_model->Catatan($id,$currentSessionID,$JudulCatatan,$Catatan);
            }
            redirect('Admin/ProposalMasuk');
        }
    }
    //3
    public function TolakProposal($id = null){
        $this->Proposal_model->tolakPetugas($id);
        redirect('Admin/ProposalMasuk');
    }
//4
    public function ProposalDitolak(){
        $data['proposal_data_dos'] = $this->Proposal_model->ditolak_proposal_petugas();
        $this->load->view('Petugas/proposal_ditolak',$data);
    }
    //5
    public function ProposalDisetujui(){
        $data['proposal_data_dos'] = $this->Proposal_model->diterima_proposal_petugas();
        $this->load->view('Petugas/proposal_diterima',$data);
    }
    //6
    public function DetailProposal($id){
        $data['proposal_data'] = $this->Proposal_model->get_detail_proposal($id);
        $this->load->view('Proposal/detail_proposal',$data);
    }
    //7
    public function PencairanPending(){
        $data['proposal_data'] = $this->Proposal_model->get_pencairan();
        $this->load->view('Petugas/pencairan',$data);
    }
//8
    public function PencairanVerified(){
        $data['proposal_data'] = $this->Proposal_model->get_pencairan_verifikasi();
        $this->load->view('Petugas/pencairan_ver',$data);
    }
//9
    public function PengembalianPending(){
        $data['proposal_data'] = $this->Proposal_model->get_pengembalian();
        $this->load->view('Petugas/pengembalian',$data);
    }
//10
    public function PengembalianVerified(){
        $data['proposal_data'] = $this->Proposal_model->get_pencairan_verifikasi();
        $this->load->view('Petugas/pengembalian_ver',$data);
    }
//11
    public function Verif($id)
    {
        $currentSessionID = $this->session->userdata('id_user');
        $this->Proposal_model->verification($id,$currentSessionID);
        redirect('Admin/PencairanPending');
    }
//12
    public function Ver($id)
    {
        $currentSessionID = $this->session->userdata('id_user');
        $this->Proposal_model->verPeminjam($id,$currentSessionID);
        $d = $this->Proposal_model->danakembali($id);
        $dana = $d->jumlah_dana;
        $danaShare = $dana * 10/100;
        $danaPemodal = $danaShare * 80/100;
        $danaPerusahaan = $danaShare - $danaPemodal;
        $this->Proposal_model->PemasukanPerusahaan($id,$danaPerusahaan);
        $this->Proposal_model->PemasukanPemodal($id,$danaPemodal);
        redirect('Admin/PengembalianPending');
    }
//13
    public function ManajemenUser(){
        $data['proposal_data'] = $this->Proposal_model->get_user_data();
        $this->load->view('Petugas/manajemen_user',$data);
    }
    //14
    public function HapusUser($id){
        $this->Proposal_model->hapusUser($id);
        redirect('Petugas/ManajemenUser');
    }
//15
    public function TambahUser(){
        if($this->input->post('submit')){
			$usrname = $this->input->post('username');
			$name = $this->input->post('name');
			$password = md5($this->input->post('password'));
			$idrole = $this->input->post('role');
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
					redirect('Admin/ManajemenUser');
				}
			}
			redirect('Admin/ManajemenUser');
		}
    }
}
