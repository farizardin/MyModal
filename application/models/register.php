<?php
class auth_model extends CI_Model {

        public function auth($user, $pass)
        {
            $this->db->select('username, pass_user, id_role, nama_user');
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
}