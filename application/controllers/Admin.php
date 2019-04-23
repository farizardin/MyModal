<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('Proposal_model');

        if($this->session->id_role != 3){
            redirect('');
        }
    }
    
	public function index()
	{
        $this->load->view('Petugas');
    }

    public function ProposalMasuk(){
        $currentSessionID = $this->session->userdata('id_departemen');
        $data['proposal_data_dos'] = $this->Proposal_model->get_proposal_petugas($currentSessionID);
        $this->load->view('Petugas/proposal_masuk',$data);
    }

    public function ConfirmProposal($id = null){
        if($this->input->post('submit')){
            $JudulCatatan = $this->input->post('judulcatatan');
            $Catatan = $this->input->post('catatan');
            $currentSessionID = $this->session->userdata('id_user');
            $this->Proposal_model->confirmPetugas($id);

            if($JudulCatatan != null && $Catatan != null){
                $this->Proposal_model->Catatan($id,$currentSessionID,$JudulCatatan,$Catatan);
            }
            redirect('Petugas/ProposalMasuk');
        }
    }

    public function TolakProposal($id = null){
        $this->Proposal_model->tolakPetugas($id);
        redirect('Petugas/ProposalMasuk');
    }

    public function ProposalDitolak(){
        $currentSessionID = $this->session->userdata('id_departemen');
        $data['proposal_data_dos'] = $this->Proposal_model->ditolak_proposal_petugas($currentSessionID);
        $this->load->view('Petugas/proposal_ditolak',$data);
    }

    public function ProposalDiterima(){
        $currentSessionID = $this->session->userdata('id_departemen');
        $data['proposal_data_dos'] = $this->Proposal_model->diterima_proposal_petugas($currentSessionID);
        $this->load->view('Petugas/proposal_diterima',$data);
    }
}
