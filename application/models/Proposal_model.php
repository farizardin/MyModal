<?php
class Proposal_model extends CI_Model {

    public function getRmk($currentSession)
    {
        $this->db->distinct();
        $this->db->select('bidang.nama_bidang, bidang.id_bidang');
        $this->db->from('bidang, departemen ,user_tabel');
        $this->db->where('user_tabel.id_departemen = departemen.id_departemen');
        $this->db->where('bidang.id_departemen = departemen.id_departemen');
        $this->db->where('departemen.id_departemen',$currentSession);
        $this->db->order_by('bidang.nama_bidang','asc');
        
        $query1 = $this->db->get();
        return $query1->result();
    }

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

    public function insert_proposal($currentSessionID, $dana, $judulTA, $abstrakTA, $filename){
        $this->db->set('id_user', $currentSessionID);
        $this->db->set('id_status', 3);
        $this->db->set('jml_dana', $dana);
        $this->db->set('judul_nama', $judulTA);
        $this->db->set('keterangan', $abstrakTA);
        $this->db->set('file_proposal', $filename);
        $this->db->set('tgl_pengajuan', 'NOW()', false);

        $this->db->insert('proposal_pendanaan');

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_proposal($currentSessionID){
        $proposal_query = sprintf("select pd.`id_ta` as id, pd.id_user as user, st.nama_status as statname, pd.id_status as status, pd.judul_nama as judul, pd.`keterangan` as abstrak, pd.jml_dana as dana from status_judul st, proposal_pendanaan pd where pd.id_user = %s and st.id_status = pd.id_status", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function diterima_proposal($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE (judul_ta.id_status = 2 AND judul_ta.id_plotting = 2) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 and judul_ta.id_user = %s", $currentSessionID);
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

    public function get_proposal_petugas($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE (judul_ta.id_status = 3 AND judul_ta.id_plotting = 1) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 AND (conf1.idstatdos1 = 2 AND conf2.idstatdos2 = 2) AND user_tabel.id_departemen = %s;", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function confirmPetugas($id){
        $this->db->where('id_ta',$id);
        $this->db->set('id_status', 2);

        $confirm = $this->db->update('judul_ta');
        return $confirm;
    }

    public function tolakPetugas($id){
        $this->db->where('id_ta',$id);
        $this->db->set('id_status', 1);

        $confirm = $this->db->update('judul_ta');
        return $confirm;
    }

    public function setujuKaprodi($id){
        $this->db->where('id_ta',$id);
        $this->db->set('id_plotting', 2);

        $confirm = $this->db->update('judul_ta');
        return $confirm;
    }

    public function ditolak_proposal_petugas($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE (judul_ta.id_status = 1 AND judul_ta.id_plotting = 1) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 AND (conf1.idstatdos1 = 2 AND conf2.idstatdos2 = 2) and user_tabel.id_departemen = %s;", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function ditolak_proposal($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE (judul_ta.id_status = 1 AND judul_ta.id_plotting = 1) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 AND (conf1.idstatdos1 = 3 OR conf2.idstatdos2 = 3) and judul_ta.id_user = %s;", $currentSessionID);
        $proposal_query = $this->db->query($proposal_query);
        return $proposal_query->result();
    }

    public function diterima_proposal_petugas($currentSessionID){
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, user_tabel.username as usrname, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE (judul_ta.id_status = 2 AND judul_ta.id_plotting = 1) and judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 AND (conf1.idstatdos1 = 2 AND conf2.idstatdos2 = 2) AND user_tabel.id_departemen = %s;", $currentSessionID);
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
        $this->db->set('id_ta', $id);
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
        $proposal_query = sprintf("select distinct judul_ta.id_ta as id,status_judul.id_status as status_id, status_plotting.id_plotting as plotting_id, status_plotting.nama_plotting as plotting, status_judul.nama_status as status, user_tabel.nama_user as user, test.dosen1, test2.dosen2, conf1.statusdosen1, conf2.statusdosen2, conf1.idstatdos1, conf2.idstatdos2, judul_ta.judul_nama as judul, judul_ta.keterangan as keterangan, bidang.nama_bidang as nama from status_plotting, judul_ta, user_tabel, status_judul, bidang, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen1 FROM user_tabel WHERE user_tabel.id_role = 2) test, (SELECT user_tabel.id_user, user_tabel.nama_user as dosen2 FROM user_tabel WHERE user_tabel.id_role = 2) test2, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us1, status_dosen.nama_status as statusdosen1, status_dosen.id_konfirm as idstatdos1, judul_ta.id_ta as ta1 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing1 and konfirmasi.id_ta = judul_ta.id_ta) conf1, (SELECT konfirmasi.id_konfirm, konfirmasi.id_user as us2, status_dosen.nama_status as statusdosen2, status_dosen.id_konfirm as idstatdos2, judul_ta.id_ta as ta2 FROM konfirmasi, judul_ta, status_dosen WHERE konfirmasi.id_konfirm = status_dosen.id_konfirm and konfirmasi.id_user = judul_ta.pembimbing2 and konfirmasi.id_ta = judul_ta.id_ta) conf2 WHERE judul_ta.id_status = status_judul.id_status and judul_ta.id_bidang = bidang.id_bidang and judul_ta.id_user = user_tabel.id_user and judul_ta.id_plotting = status_plotting.id_plotting and test.id_user = judul_ta.pembimbing1 and test2.id_user = judul_ta.pembimbing2 and judul_ta.pembimbing1 = conf1.us1 and judul_ta.pembimbing2 = conf2.us2 and judul_ta.id_ta = conf1.ta1 and judul_ta.id_ta = conf2.ta2 and judul_ta.id_ta = %s", $currentProposalID);
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
}