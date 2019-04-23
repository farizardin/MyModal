<?php
class Berita_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
        }

        public function getBerita()
        {
            $hasil = $this->db->query("select * from user_tabel ut, berita br where ut.id_user = br.id_user");
            return $hasil;
        }
}