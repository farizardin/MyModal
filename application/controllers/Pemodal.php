<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemodal extends CI_Controller {

    private $pathFile = "upload/proposal_pemodal/";
    private $pathFile2 = "upload/bukti_pemodal/";
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
    public function PengajuanPemodal()
	{
        $currentSession = $this->session->userdata('id_departemen');
        $this->load->view('Proposal/form_usulan');
    }
    //1
    public function ProposalPending(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->get_proposal($currentSessionID);
        $this->load->view('Pemodal/proposal_pemodal',$data);
    }
    //2 Melakukan Insert Pemodal
    public function InsertProposal(){
        if($this->input->post('submit')){
            $currentSessionID = $this->session->userdata('id_user');
            $abstrak = $this->input->post('abstrak');
            $judul = $this->input->post('judul');
            $dana = $this->input->post('dana');
            // proposal
            $config['upload_path'] = $this->pathFile;
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $fileProposal = $this->upload->do_upload('f_proposal');
            $dataA = $this->upload->data();
            $proposalPath = $this->upload->data('full_path');
            $proposalExt = $this->upload->data('file_ext');
            // print_r($dataA);
            //laporan keuangan
            $config['upload_path'] = $this->pathFile;
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $fileLaporan = $this->upload->do_upload('f_lp_keuangan');
            $laporanPath = $this->upload->data('full_path');
            $laporanExt = $this->upload->data('file_ext');
            // $dataB = $this->upload->data();
            // print_r($dataB);
            // foto ktp
            $config['upload_path'] = $this->pathFile;
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $fileKtp = $this->upload->do_upload('f_ktp');
            $ktpPath = $this->upload->data('full_path');
            $ktpExt = $this->upload->data('file_ext');
            // $dataC = $this->upload->data();
            // print_r($dataC);
            if($fileKtp && $fileLaporan && $fileProposal && $abstrak != '' && $judul != ''){
                $upload_one = $this->Proposal_model->insert_proposal($currentSessionID, $dana, $judul, $abstrak);
                $newDir = $this->pathFile.$upload_one;

                mkdir($newDir);

                $newProposalPath = $newDir."/proposal_pemodal-".$upload_one.$proposalExt;
                $newLaporanPath = $newDir."/laporan_pemodal-".$upload_one.$laporanExt;
                $newKtpPath = $newDir."/ktp_pemodal-".$upload_one.$ktpExt;
                $moveProposal = rename($proposalPath,$newProposalPath);
                $moveProposal = rename($laporanPath,$newLaporanPath);
                $moveProposal = rename($ktpPath,$newKtpPath);
                
                $insert_two = $this->Proposal_model->insert_step_two($newProposalPath, $newLaporanPath, $newKtpPath, $upload_one);

                if($upload_one && $moveProposal && $moveProposal && $moveProposal && $insert_two){
                    $this->session->set_flashdata('success', 'Proposal Berhasil Ditambahkan');
                    redirect('Pemodal/ProposalPending');
                }else{
                    $this->session->set_flashdata('error', 'Proposal Gagal Ditambahkan');
                    redirect('Pemodal');
                }
            }else{
                $this->session->set_flashdata('error', 'Proposal Gagal Ditambahkan');
                redirect('Pemodal/PengajuanPemodal');
            }
        }
    }
    //3
    public function ConfirmPemodal($id){
        if($this->input->post('submit')){
            $JudulCatatan = $this->input->post('judulcatatan');
            $Catatan = $this->input->post('catatan');
            $dana = $this->input->post('danadisetujui');
            $currentSessionID = $this->session->userdata('id_user');
            $config['upload_path'] = $this->pathFile2;
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $fileBukti = $this->upload->do_upload('bukti');
            $buktiPath = $this->upload->data('full_path');
            $buktiExt = $this->upload->data('file_ext');

            if($dana != null && $fileBukti){
                $this->Proposal_model->confirmPengajuan($id);
                $transaksi =$this->Proposal_model->Pencairan($id,$dana);
                $dir = $this->pathFile2.$id;
                mkdir($dir);
                $newDir = $dir.'/Bukti-'.$id.$buktiExt;
                $move = rename($buktiPath,$newDir);
                $transaksi =$this->Proposal_model->insertBukti($transaksi,$newDir);
            }
            if($JudulCatatan != null && $Catatan != null){
                $this->Proposal_model->CatatanPeminjam($id,$currentSessionID,$JudulCatatan,$Catatan);
            }
            redirect('Pemodal/PengajuanMasuk');
        }
    }
    //4
    // public function TolakPemodal($id = null){
    //     $this->Proposal_model->tolakPetugas($id);
    //     redirect('Pemodal/PengajuanMasuk');
    // }
    //4
    public function DetailProposal($id){
        $data['proposal_data'] = $this->Proposal_model->get_detail_proposal($id);
        $this->load->view('Proposal/detail_proposal',$data);
    }
    //5
    public function ProposalDitolak(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->ditolak_proposal($currentSessionID);
        $this->load->view('Pemodal/proposal_ditolak',$data);
    }
    //6 Proposal Diterima
    public function ProposalDiterima(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->diterima_proposal($currentSessionID);
        $this->load->view('Pemodal/proposal_diterima',$data);
    }
    // 7 Pengajuan Masuk
    public function PengajuanMasuk(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->get_pengajuan($currentSessionID);
        $this->load->view('Pemodal/pengajuan_masuk',$data);
    }
    //8 PengajuanDitolak
    public function PengajuanDitolak(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->ditolak_pengajuan($currentSessionID);
        $this->load->view('Pemodal/pengajuan_ditolak',$data);
    }
    //9 Pengajuan Diterima
    public function PengajuanDiterima(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->diterima_pengajuan($currentSessionID);
        $this->load->view('Pemodal/pengajuan_diterima',$data);
    }
    //10 Dana Masuk
    public function DanaMasuk(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->get_pengembalian_user($currentSessionID);
        $this->load->view('Pemodal/dana_masuk',$data);
    }
    //11 Dana Keluar
    public function DanaKeluar(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->get_pencairan_user($currentSessionID);
        $this->load->view('Pemodal/dana_masuk',$data);
    }
    // 12 Hapus Penawaran Pemodal
    public function Hapus($id){
        $this->Proposal_model->hapusCatatan($id);
        $this->Proposal_model->hapusPenawaran($id);
        redirect('Pemodal/ProposalDiterima');
    }
    //13
    public function Tolak($id){
        $this->Proposal_model->tolakPeminjam($id);
        redirect('Pemodal/PengajuanMasuk');
    }
}