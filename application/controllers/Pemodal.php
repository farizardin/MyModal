<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemodal extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Proposal_model');

        if($this->session->id_role != 1){
            redirect('');
        }
    }
    
	public function index()
	{
        $this->load->view('Pemodal');
    }
    public function PengajuanJudul()
	{
        $currentSession = $this->session->userdata('id_departemen');
        $this->load->view('Proposal/form_usulan');
    }

    public function ProposalPending(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->get_proposal($currentSessionID);
        $this->load->view('Proposal/proposal_mahasiswa',$data);
    }

    public function InsertProposal(){
        if($this->input->post('submit')){
            $currentSessionID = $this->session->userdata('id_user');
            $abstrakTA = $this->input->post('abstrak');
            $judulTA = $this->input->post('judul');
            $dana = $this->input->post('dana');
            $config['upload_path'] = './proposal/';
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $hehe = $this->upload->do_upload('hehe');
            if($hehe && $abstrakTA != '' && $judulTA != ''){
                $data = $this->upload->data();
                $filename = $data['file_name'];
                $in_id = $this->Proposal_model->insert_proposal($currentSessionID, $dana, $judulTA, $abstrakTA, $filename);
                if($in_id){
                    $this->session->set_flashdata('success', 'Proposal Berhasil Ditambahkan');
                    redirect('Pemodal/ProposalPending');
                }else{
                    $this->session->set_flashdata('error', 'Proposal Gagal Ditambahkan');
                    redirect('Pemodal');
                }
            }
        }
    }

    public function DetailProposal($id){
        // $data['proposal_data'] = $this->Proposal_model->get_detail_proposal($id);
        $this->load->view('Proposal/detail_proposal');
    }

    public function ProposalDitolak(){
        $currentSessionID = $this->session->userdata('id_user');
        // $data['proposal_data'] = $this->Proposal_model->ditolak_proposal($currentSessionID);
        $this->load->view('Proposal/proposal_ditolak');
    }
    
    public function ProposalDiterima(){
        $currentSessionID = $this->session->userdata('id_user');
        // $data['proposal_data'] = $this->Proposal_model->diterima_proposal($currentSessionID);
        $this->load->view('Proposal/proposal_diterima');
    }
}