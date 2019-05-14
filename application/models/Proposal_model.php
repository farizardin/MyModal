<?php
class Proposal_model extends CI_Model {
    public function getDosen($currentSession)
    {
        $this->db->distinct();
        $this->db->select('user_tabel.id_user, user_tabel.nama_user');
        $this->db->from('departemen, user_tabel');
        $this->db->where('user_tabel.id_departemen = departemen.id_departemen');
        $this->db->where('user_tabel.id_role', 2);
        $this->db->where('departemen.id_departemen',$currentSession);
        $this->db->order_by('user_tabel.nama_user','asc');
        
        $query1 = $this->db->get();
        return $query1->result();
    }

    public function insert_proposal($currentSessionID, $dana, $judul, $abstrak){
        $this->db->set('id_user', $currentSessionID);
        $this->db->set('id_status', 3);
        $this->db->set('jml_dana', $dana);
        $this->db->set('judul_nama', $judul);
        $this->db->set('keterangan', $abstrak);
        $this->db->set('tgl_pengajuan', 'NOW()', false);
        $this->db->insert('proposal_pemodal');
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function insert_step_two($proposal,$laporan,$ktp, $id){
        $this->db->set('file_proposal', $proposal);
        $this->db->set('laporan_keuangan', $laporan);
        $this->db->set('foto_ktp', $ktp);
        $this->db->where('id_prop_pemodal',$id);
        $up = $this->db->update('proposal_pemodal');
        return $up;
    }

    //proposal pending
    public function get_proposal($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where pd.id_user = %s and st.id_status = pd.id_status and pd.id_status = 3 order by id desc", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //proposal diterima
    public function diterima_proposal($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana, (SELECT cp.judul_catatan from proposal_pemodal pm, catatan_pemodal cp where cp.id_proposal = pm.id_prop_pemodal) as catatan, (SELECT cp.keterangan from proposal_pemodal pm, catatan_pemodal cp where cp.id_proposal = pm.id_prop_pemodal) as isi from status_judul st, proposal_pemodal pd where pd.id_user = %s and st.id_status = pd.id_status and pd.id_status = 2 order by id desc", $currentSessionID);        
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //proposal ditolak
    public function ditolak_proposal($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where pd.id_user = %s and st.id_status = pd.id_status and st.id_status = 1 order by id desc", $currentSessionID);        
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //pengajuan
    public function get_pengajuan($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_peminjam` as id, pd.id_prop_pemodal , pd.id_user as user,pd.tgl_upload as pengajuan, pd.nama_file as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.perihal as judul, pd.`abstrak` as abstrak, pd.jml_dana as dana from status_judul st, proposal_peminjam pd, proposal_pemodal pm where pd.id_prop_pemodal = pm.id_prop_pemodal and pm.id_user = %s and st.id_status = pd.id_status and pd.id_status = 3 order by id desc", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //pengajuan diterima
    public function diterima_pengajuan($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_peminjam` as id, pd.id_prop_pemodal , pd.id_user as user,pd.tgl_upload as pengajuan, pd.nama_file as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.perihal as judul, pd.`abstrak` as abstrak, pd.jml_dana as dana from status_judul st, proposal_peminjam pd, proposal_pemodal pm where pd.id_prop_pemodal = pm.id_prop_pemodal and pm.id_user = %s and st.id_status = pd.id_status and pd.id_status = 2 order by id desc", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //pengajuan ditolak
    public function ditolak_pengajuan($currentSessionID){
        $proposal_query = sprintf("select pd.`id_prop_peminjam` as id, pd.id_prop_pemodal , pd.id_user as user,pd.tgl_upload as pengajuan, pd.nama_file as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.perihal as judul, pd.`abstrak` as abstrak, pd.jml_dana as dana from status_judul st, proposal_peminjam pd, proposal_pemodal pm where pd.id_prop_pemodal = pm.id_prop_pemodal and pm.id_user = %s and st.id_status = pd.id_status and pd.id_status = 1 order by id desc", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //pending proposal pemodal
    public function get_proposal_petugas(){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where st.id_status = pd.id_status and st.id_status = 3 order by id desc");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //konfirmasi proposal petugas
    public function confirmPetugas($id){
        $this->db->where('id_prop_pemodal',$id);
        $this->db->set('id_status', 2);
        $this->db->set('tgl_validasi', 'NOW()', false);
        $confirm = $this->db->update('proposal_pemodal');
        return $confirm;
    }
    //tolak proposal
    public function tolakPetugas($id){
        $this->db->where('id_prop_pemodal',$id);
        $this->db->set('id_status', 1);
        $confirm = $this->db->update('proposal_pemodal');
        return $confirm;
    }
    //pemodal mengkonfirmasi peminjam
    public function confirmPemodal($id){
        $this->db->where('id_prop_peminjam',$id);
        $this->db->set('id_status', 2);
        $this->db->set('tgl_validasi', 'NOW()', false);
        $confirm = $this->db->update('proposal_peminjam');
        return $confirm;
    }
    //pemodal tolak peminjam
    public function tolakPemodal($id){
        $this->db->where('id_prop_pemodal',$id);
        $this->db->set('id_status', 1);
        $confirm = $this->db->update('proposal_peminjam');
        return $confirm;
    }
    //get proposal ditolak petugas
    public function ditolak_proposal_petugas(){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where st.id_status = pd.id_status and st.id_status = 1 order by id desc");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //get proposal diterima petugas
    public function diterima_proposal_petugas(){
        $proposal_query = sprintf("select pd.`id_prop_pemodal` as id, pd.id_user as user,pd.tgl_pengajuan as pengajuan, pd.file_proposal as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pemodal pd where st.id_status = pd.id_status and st.id_status = 2 order by id desc");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //insert catatan pemodal
    public function Catatan($id,$currentSessionID,$JudulCatatan,$Catatan){
        $this->db->set('id_user', $currentSessionID);
        $this->db->set('id_proposal', $id);
        $this->db->set('judul_catatan', $JudulCatatan);
        $this->db->set('keterangan', $Catatan);
        $this->db->insert('catatan_pemodal');
    }
    //insert catatan peminjam
    public function CatatanPeminjam($id,$currentSessionID,$JudulCatatan,$Catatan){
        $this->db->set('id_user', $currentSessionID);
        $this->db->set('id_prop_peminjam', $id);
        $this->db->set('judul_catatan', $JudulCatatan);
        $this->db->set('catatan_isi', $Catatan);
        $this->db->insert('catatan_peminjam');
    }
    //verifikasi transfer pemodal
    public function Pencairan($id,$dana){
        $this->db->set('id_prop_peminjam', $id);
        $this->db->set('jml_dana', $dana);
        $this->db->set('id_verifikasi',3);
        $this->db->insert('pencairan');
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    //insert bukti pemodal
    public function insertBukti($id,$buktiTransfer){
        $this->db->set('bukti_transfer', $buktiTransfer);
        $this->db->where('id_pencairan', $id);
        $up = $this->db->update('pencairan');
        return $up;
    }
    //konfirm pengajuan peminjam
    public function confirmPengajuan($id){
        $this->db->set('id_status', 2);
        $this->db->set('tgl_diterima', 'NOW()', false);
        $this->db->where('id_prop_peminjam',$id);
        $confirm = $this->db->update('proposal_peminjam');
    }
    //tolak peminjam
    public function tolakPeminjam($id){
        $this->db->where('id_prop_peminjam',$id);
        $this->db->set('id_status', 1);
        $confirm = $this->db->update('proposal_peminjam');
        return $confirm;
    }
    //detail proposal
    public function get_detail_proposal($currentProposalID){
        $proposal_query = sprintf("select pm.id_prop_pemodal as id, us.nama_user as nama, st.nama_status as stats, pm.judul_nama as judul, pm.keterangan as ket, pm.jml_dana as dana, pm.tgl_pengajuan as pengajuan, pm.file_proposal as fileProp, pm.tgl_validasi as validasi, pm.foto_ktp as fileKtp, pm.laporan_keuangan as fileLap FROM proposal_pemodal pm, user_tabel us, status_judul st WHERE pm.id_user = us.id_user and pm.id_status = st.id_status and pm.id_prop_pemodal = %s ;",$currentProposalID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->row();
    }
    //proposal pemodal masuk
    public function get_proposal_masuk($currentProposalID){
        $proposal_query = sprintf("select pd.`id_prop_peminjam` as id, pd.id_prop_pemodal , pd.id_user as user,pd.tgl_upload as pengajuan, pd.nama_file as fileProp, pd.foto_ktp as fileKtp, pd.laporan_keuangan as fileLap, st.nama_status as statname, pd.id_status as status, pd.perihal as judul, pd.`abstrak` as abstrak, pd.jml_dana as dana from status_judul st, proposal_peminjam pd, proposal_pemodal pm where pd.id_prop_pemodal = pm.id_prop_pemodal and pm.id_user = %s and st.id_status = pd.id_status and pd.id_status = 3 order by id desc;",$currentProposalID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->row();
    }
    //hapus catatan
    public function hapusCatatan($currentProposalID){
        $this->db->where('id_proposal',$currentProposalID);
        return $this->db->delete('catatan_pemodal');
    }
    //hapus penawaran
    public function hapusPenawaran($currentProposalID){
        $this->db->where('id_prop_pemodal',$currentProposalID);
        return $this->db->delete('proposal_pemodal');
    }
    //get pencairan admin pending
    public function get_pencairan(){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pencairan as id,pn.jml_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as pengirim, t.usr as tertuju FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pencairan pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and ver.id_verifikasi = 3;");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    //get pencairan admin verified
    public function get_pencairan_verifikasi(){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pencairan as id,pn.jml_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as pengirim, t.usr as tertuju FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pencairan pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and ver.id_verifikasi = 2;");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //dana keluar pemodal
    public function get_pencairan_user($currentSessionID){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pencairan as id,pn.jml_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as pengirim, t.usr as tertuju FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pencairan pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and pm.id_user = %s",$currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    //dana masuk peminjam
    public function get_pencairan_peminjam($currentSessionID){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pencairan as id,pn.jml_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as pengirim, t.usr as tertuju FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pencairan pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and pj.id_user = %s",$currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    //get pengembalian admin pending
    public function get_pengembalian(){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pengembalian as id,pn.jumlah_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as tertuju, t.usr as pengirim FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pengembalian pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and ver.id_verifikasi = 3;;");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    //get pengembalian admin verified
    public function get_pengembalian_verifikasi(){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pengembalian as id,pn.jumlah_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as tertuju, t.usr as pengirim FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pengembalian pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and ver.id_verifikasi = 2;");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function get_pengembalian_user($currentSessionID){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pengembalian as id,pn.jumlah_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as tertuju, t.usr as pengirim FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pengembalian pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and ver.id_verifikasi = 2 and pm.id_user = %s",$currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function get_pengembalian_peminjam($currentSessionID){
        $proposal_query = sprintf("select DISTINCT pn.bukti_transfer as bukti, pn.id_pengembalian as id,pn.jumlah_dana as dana, pn.bukti_transfer as bukti, ver.status_verifikasi as stats, p.pengirim as tertuju, t.usr as pengirim FROM verifikasi ver, proposal_peminjam pj, proposal_pemodal pm, pengembalian pn, user_tabel us, (select us.nama_user as pengirim from user_tabel us, proposal_pemodal pm where pm.id_user = us.id_user) p,(select us.nama_user as usr from user_tabel us, proposal_peminjam pm where pm.id_user = us.id_user) t WHERE pn.id_prop_peminjam = pj.id_prop_peminjam and ver.id_verifikasi = pn.id_verifikasi and ver.id_verifikasi = 2 and pj.id_user = %s",$currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    //verifikasi transaksi
    public function verification($id,$currentSessionID){
        $this->db->set('id_verifikasi', 2);
        $this->db->set('id_user', $currentSessionID);
        $this->db->where('id_pencairan',$id);
        $confirm = $this->db->update('pencairan');
        return $confirm;
    }
    //
    public function verPeminjam($id,$currentSessionID){
        $this->db->set('id_verifikasi', 2);
        $this->db->set('id_user', $currentSessionID);
        $this->db->where('id_pengembalian',$id);
        $confirm = $this->db->update('pengembalian');
        return $confirm;
    }
    //
    public function danakembali($id){
        $this->db->select('jumlah_dana');
        $this->db->from('pengembalian');
        $this->db->where('id_pengembalian',$id);
        return $this->db->get()->row();
    }
    //
    public function PemasukanPemodal($id,$dana){
        $this->db->set('id_prop_peminjam', $id);
        $this->db->set('dana_masuk', $dana);
        $this->db->insert('pemasukan_pemodal');
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    //
    public function PemasukanPerusahaan($id,$dana){
        $this->db->set('id_prop_peminjam', $id);
        $this->db->set('dana_masuk', $dana);
        $this->db->insert('pemasukan_perusahaan');
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    //Get User
    public function get_user_data(){
        $proposal_query = sprintf("select ut.nama_user, ut.id_user, ut.username, ut.alamat, ur.nama_role from user_tabel ut, user_role ur where ut.id_role = ur.id_role");
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }
    //Hapus User
    public function hapusUser($idUser){
        $this->db->where('id_user',$idUser);
        return $this->db->delete('user_tabel');
    }
}