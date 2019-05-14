<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller {
    private $pathFile = "upload/proposal_peminjam/";
    private $pathFile2 = "upload/bukti_peminjam/";
	public function __construct()
	{
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('Peminjam_model');
        $this->load->model('Proposal_model');
        if($this->session->id_role != 2){
            redirect('');
        }
    }
    
	public function index()
	{
        $this->load->view('Peminjam');
    }

    public function ProposalPengajuan($id){
        $currentProposalID = $id;
        $data['proposal_data'] = $this->Proposal_model->get_detail_proposal($currentProposalID);
        $this->load->view('Peminjam/form_pengajuan',$data);
    }

    public function InsertProposal(){
        if($this->input->post('submit')){
            $currentSessionID = $this->session->userdata('id_user');
            $proposalPemodal = $this->input->post('proposal_pemodal');
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
            print_r($dataA);
            // laporan keuangan
            $config['upload_path'] = $this->pathFile;
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $fileLaporan = $this->upload->do_upload('f_lp_keuangan');
            $laporanPath = $this->upload->data('full_path');
            $laporanExt = $this->upload->data('file_ext');
            $dataB = $this->upload->data();
            print_r($dataB);
            // foto ktp
            $config['upload_path'] = $this->pathFile;
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $fileKtp = $this->upload->do_upload('f_ktp');
            $ktpPath = $this->upload->data('full_path');
            $ktpExt = $this->upload->data('file_ext');
            $dataC = $this->upload->data();
            print_r($dataC);
            //jaminan
            $config['upload_path'] = $this->pathFile;
            $config['allowed_types'] = 'png|jpg|pdf|doc|docx';
            $config['max_size'] = 5120;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $fileJaminan = $this->upload->do_upload('jaminan');
            $jaminanPath = $this->upload->data('full_path');
            $jaminanExt = $this->upload->data('file_ext');
            $dataD = $this->upload->data();
            print_r($dataD);
            if($fileKtp && $fileLaporan && $fileProposal && $abstrak != '' && $judul != ''){
                $upload_one = $this->Peminjam_model->insert_proposal($currentSessionID, $dana, $judul, $abstrak, $proposalPemodal);
                $newDir = $this->pathFile.$upload_one;
                mkdir($newDir);
                $newProposalPath = $newDir."/proposal_peminjam-".$upload_one.$proposalExt;
                $newLaporanPath = $newDir."/laporan_peminjam-".$upload_one.$laporanExt;
                $newKtpPath = $newDir."/ktp_peminjam-".$upload_one.$ktpExt;
                $newJaminanPath = $newDir."/jaminan_peminjam-".$upload_one.$jaminanExt;
                $moveProposal = rename($proposalPath,$newProposalPath);
                $moveProposal = rename($laporanPath,$newLaporanPath);
                $moveProposal = rename($ktpPath,$newKtpPath);
                $moveProposal = rename($jaminanPath,$newJaminanPath);

                $insert_two = $this->Peminjam_model->insert_step_two($newProposalPath, $newLaporanPath, $newKtpPath, $newJaminanPath, $upload_one);

                if($upload_one && $moveProposal && $moveProposal && $moveProposal && $insert_two){
                    $this->session->set_flashdata('success', 'Proposal Berhasil Ditambahkan');
                    redirect('Peminjam/ProposalPending');
                }else{
                    $this->session->set_flashdata('error', 'Proposal Gagal Ditambahkan');
                    redirect('Peminjam');
                }
            }else{
                $this->session->set_flashdata('error', 'Proposal Gagal Ditambahkan');
                redirect('Peminjam/ProposalPengajuan');
            }
        }
    }

    public function ConfirmPeminjam($id){
        if($this->input->post('submit')){
            $Keuntungan = $this->input->post('keuntungan');
            $dana = $this->input->post('kembali');
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
                $transaksi =$this->Peminjam_model->Pengembalian($id,$dana);
                $dir = $this->pathFile2.$id;
                mkdir($dir);
                $newDir = $dir.'/Bukti-'.$id.$buktiExt;
                $move = rename($buktiPath,$newDir);
                $transaksi =$this->Peminjam_model->insertBukti($transaksi,$newDir);
            }
            redirect('Peminjam/ProposalDiterima');
        }
    }

    public function ProposalPending(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Peminjam_model->get_proposal($currentSessionID);
        $this->load->view('Peminjam/proposal_pending',$data);
    }

    public function ProposalDitolak(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Peminjam_model->ditolak_proposal($currentSessionID);
        $this->load->view('Peminjam/proposal_ditolak',$data);
    }

    public function ProposalDiterima(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Peminjam_model->diterima_proposal($currentSessionID);
        $this->load->view('Peminjam/proposal_diterima',$data);
    }
    public function DetailProposal($id){
        $data['proposal_data'] = $this->Proposal_model->get_detail_proposal($id);
        $this->load->view('Proposal/detail_proposal',$data);
    }
    // public function PengajuanMasuk(){
    //     $currentSessionID = $this->session->userdata('id_user');
    //     $data['proposal_data'] = $this->Peminjam_model->diterima_proposal($currentSessionID);
    //     $this->load->view('Peminjam/proposal_diterima',$data);
    // }
    public function PengajuanDitolak($id){
        $data['proposal_data'] = $this->Peminjam_model->get_detail_proposal($id);
        $this->load->view('Proposal/detail_proposal',$data);
    }
    public function PengajuanDiterima(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Peminjam_model->diterima_proposal($currentSessionID);
        $this->load->view('Peminjam/proposal_diterima',$data);
    }

    public function CariPemodal(){
        $data['proposal_data_dos'] = $this->Proposal_model->diterima_proposal_petugas();
        $this->load->view('Peminjam/cari_pemodal',$data);
    }

    public function DanaMasuk(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->get_pencairan_peminjam($currentSessionID);
        $this->load->view('Peminjam/dana_masuk',$data);
    }
    public function DanaKeluar(){
        $currentSessionID = $this->session->userdata('id_user');
        $data['proposal_data'] = $this->Proposal_model->get_pengembalian_peminjam($currentSessionID);
        $this->load->view('Peminjam/dana_keluar',$data);
    }
}
