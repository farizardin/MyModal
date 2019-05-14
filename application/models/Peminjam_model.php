<?php
class Peminjam_model extends CI_Model {

    public function insert_proposal($currentSessionID, $dana, $judul, $abstrak, $proposalPemodal){
        $this->db->set('id_user', $currentSessionID);
        $this->db->set('id_status', 3);
        $this->db->set('jml_dana', $dana);
        $this->db->set('perihal', $judul);
        $this->db->set('abstrak', $abstrak);
        $this->db->set('id_prop_pemodal', $proposalPemodal);
        $this->db->set('tgl_upload', 'NOW()', false);
        $this->db->insert('proposal_peminjam');
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function insert_step_two($proposal,$laporan,$ktp, $jaminan, $id){
        $this->db->set('nama_file', $proposal);
        $this->db->set('laporan_keuangan', $laporan);
        $this->db->set('foto_ktp', $ktp);
        $this->db->set('jaminan', $jaminan);
        $this->db->where('id_prop_peminjam',$id);
        $up = $this->db->update('proposal_peminjam');
        return $up;
    }

    public function get_proposal($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_peminjam` as id, pd.id_user as user,pd.tgl_upload as pengajuan, pd.nama_file as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.perihal as judul, pd.`abstrak` as abstrak, pd.jml_dana as dana from status_judul st, proposal_peminjam pd where pd.id_user = %s and st.id_status = pd.id_status and pd.id_status = 3 order by id desc", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function diterima_proposal($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_peminjam` as id, pd.id_user as user,pd.tgl_upload as pengajuan, pd.nama_file as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.perihal as judul, pd.`abstrak` as abstrak, pd.jml_dana as dana, (SELECT cp.judul_catatan from proposal_pemodal pm, catatan_pemodal cp where cp.id_proposal = pm.id_prop_pemodal) as catatan, (SELECT cp.catatan_isi from proposal_peminjam pm, catatan_peminjam cp where cp.id_prop_peminjam = pm.id_prop_peminjam) as isi from status_judul st, proposal_peminjam pd where pd.id_user = %s and st.id_status = pd.id_status and pd.id_status = 2 order by id desc", $currentSessionID);        
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function in_confirm($dosen,$in_id){
        $this->db->set('id_user', $dosen);
        $this->db->set('id_ta',$in_id);
        $this->db->set('id_konfirm', 1);

        $confirm = $this->db->insert('konfirmasi');
        return $confirm;
    }

    public function get_proposal_dosen($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE ((judul_ta.id_status = 3 AND judul_ta.id_plotting = 1) OR (judul_ta.id_status = 2 AND judul_ta.id_plotting = 1)) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 and (judul_ta.pembimbing1 = %s OR judul_ta.pembimbing2 = %s) AND (conf1.idstatdos1 = 1 OR conf2.idstatdos2 = 1);", $currentSessionID, $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function ditolak_proposal_dosen($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE ((judul_ta.id_status = 3 AND judul_ta.id_plotting = 1) OR (judul_ta.id_status = 2 AND judul_ta.id_plotting = 1)) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 and (judul_ta.pembimbing1 = %s OR judul_ta.pembimbing2 = %s) AND (conf1.idstatdos1 = 3 OR conf2.idstatdos2 = 3);", $currentSessionID, $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function diterima_proposal_dosen($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE ((judul_ta.id_status = 3 AND judul_ta.id_plotting = 1) OR (judul_ta.id_status = 2 AND judul_ta.id_plotting = 1)) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 and (judul_ta.pembimbing1 = %s OR judul_ta.pembimbing2 = %s) AND (conf1.idstatdos1 = 2 OR conf2.idstatdos2 = 2);", $currentSessionID, $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function confirmDosen($dosen,$id){
        $this->db->where('id_user', $dosen);
        $this->db->where('id_ta',$id);
        $this->db->set('id_konfirm', 2);

        $confirm = $this->db->update('konfirmasi');
        return $confirm;
    }

    public function tolakDosen($dosen,$id){
        $this->db->where('id_user', $dosen);
        $this->db->where('id_ta',$id);
        $this->db->set('id_konfirm', 3);

        $confirm = $this->db->update('konfirmasi');
        return $confirm;
    }

    public function get_proposal_petugas(){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where st.id_status = pd.id_status and st.id_status = 3 order by id desc");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function confirmPetugas($id){
        $this->db->where('id_prop_pemodal',$id);
        $this->db->set('id_status', 2);
        $this->db->set('tgl_validasi', 'NOW()', false);
        $confirm = $this->db->update('proposal_pemodal');
        return $confirm;
    }

    public function tolakPetugas($id){
        $this->db->where('id_prop_pemodal',$id);
        $this->db->set('id_status', 1);

        $confirm = $this->db->update('proposal_pemodal');
        return $confirm;
    }

    public function setujuKaprodi($id){
        $this->db->where('id_ta',$id);
        $this->db->set('id_plotting', 2);

        $confirm = $this->db->update('judul_ta');
        return $confirm;
    }

    public function ditolak_proposal_petugas(){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where st.id_status = pd.id_status and st.id_status = 1 order by id desc");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function ditolak_proposal($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_peminjam` as id, pd.id_user as user,pd.tgl_upload as pengajuan, pd.nama_file as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.perihal as judul, pd.`abstrak` as abstrak, pd.jml_dana as dana from status_judul st, proposal_peminjam pd where pd.id_user = %s and st.id_status = pd.id_status and pd.id_status = 1 order by id desc", $currentSessionID);        
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function diterima_proposal_petugas(){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where st.id_status = pd.id_status and st.id_status = 2 order by id desc");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function get_proposal_kaprodi($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE (judul_ta.id_status = 2 AND judul_ta.id_plotting = 1) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 AND (conf1.idstatdos1 = 2 AND conf2.idstatdos2 = 2) AND user_tabel.id_departemen = %s;", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function Catatan($id,$currentSessionID,$JudulCatatan,$Catatan){
        $this->db->set('id_user', $currentSessionID);
        $this->db->set('id_prop_peminjam', $id);
        $this->db->set('judul_catatan', $JudulCatatan);
        $this->db->set('catatan_isi', $Catatan);
    
        $this->db->insert('catatan');
    }

    public function setuju_proposal_kaprodi($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE (judul_ta.id_status = 2 AND judul_ta.id_plotting = 2) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 AND (conf1.idstatdos1 = 2 AND conf2.idstatdos2 = 2) AND user_tabel.id_departemen = %s;", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function get_detail_proposal($currentProposalID){
        $proposal_query = sprintf("select pm.id_prop_peminjam as id, us.nama_user as nama, st.nama_status as stats, pm.perihal as judul, pm.abstrak as ket, pm.jml_dana as dana, pm.tgl_upload as pengajuan, pm.nama_file as fileProp, pm.tgl_diterima as validasi, pm.foto_ktp as fileKtp, pm.laporan_keuangan as fileLap FROM proposal_peminjam pm, user_tabel us, status_judul st WHERE pm.id_user = us.id_user and pm.id_status = st.id_status and pm.id_prop_peminjam = %s ;",$currentProposalID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->row();
    }
    public function get_catatan_proposal($currentProposalID){
        $this->db->select('*');
        $this->db->from('*');
        $this->db->where('id_ta',$currentProposalID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->row();
    }

    public function Pengembalian($id,$dana){
        $this->db->set('id_prop_peminjam', $id);
        $this->db->set('jumlah_dana', $dana);
        $this->db->set('id_verifikasi',3);
        $this->db->insert('pengembalian');
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    //insert bukti peminjam
    public function insertBukti($id,$buktiTransfer){
        $this->db->set('bukti_transfer', $buktiTransfer);
        $this->db->where('id_pengembalian', $id);
        $up = $this->db->update('pengembalian');
        return $up;
    }
}