<?php
class Auth_model extends CI_Model {

    public function auth($user, $pass)
    {
        $this->db->select('id_user, username, pass_user, id_role, nama_user');
        $this->db->from('user_tabel');
        $this->db->where('username',$user);
        $this->db->where('pass_user',$pass);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1){
            return $query->result();
        }else{
            return false;
        }
    }

    public function simpan($data){
        return $this->db->insert('user_tabel', $data);
    }

    public function compair($user)
    {
        $this->db->select('username');
        $this->db->from('user_tabel');
        $this->db->where('username',$user);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()==1){
            return $query->result();
        }else{
            return false;
        }
    }
}