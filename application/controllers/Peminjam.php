<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('Proposal_model');

        if($this->session->id_role != 2){
            redirect('');
        }
    }
    
	public function index()
	{
        $this->load->view('Dosen');
    }

    public function ProposalMasuk(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data_dos'] = $this->Proposal_model->get_proposal_dosen($currentSessionID);
        $this->load->view('Proposal/proposal_masuk',$data);
    }

    public function ConfirmProposal($id = null){
        $currentSessionID = $this->session->userdata('id_user');
        $this->Proposal_model->confirmDosen($currentSessionID,$id);

        redirect('Dosen/ProposalMasuk');
    }

    public function TolakProposal($id = null){
        $currentSessionID = $this->session->userdata('id_user');
        $this->Proposal_model->tolakDosen($currentSessionID,$id);

        redirect('Dosen/ProposalMasuk');
    }

    public function ProposalDitolak(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->ditolak_proposal_dosen($currentSessionID);
        $this->load->view('Dosen/proposal_ditolak',$data);
    }

    public function ProposalTerkonfirmasi(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->diterima_proposal_dosen($currentSessionID);
        $this->load->view('Dosen/proposal_diterima',$data);
    }
}
