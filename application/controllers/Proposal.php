<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Proposal_model');
    }
    
    public function deleteProposal(){
        $currentSession = $this->session->userdata('id_departemen');
        $data['proposal_rmk'] = $this->Proposal_model->getRmk($currentSession);
        $this->load->view('Proposal/form_usulan',$data);
    }

    public function Pembatalan($id){
        
    }
}