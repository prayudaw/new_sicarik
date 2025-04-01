<?php
class login_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function insert_login_log($data)
    {
        $this->db->insert('log_login', $data);
    }

    public function insert_queue_email($data)
    {
        $this->db->insert('queue_email', $data);
    }

    public function checkQueueEmail($nim)
    {
        $this->db->from('queue_email');
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getData()
    {
        $this->db->from('queue_email');
        $this->db->where('status', 0);
        $query = $this->db->get();
        //$this->db->limit(1); 
        //echo $this->db->last_query();die();
        return $query->result_array();
    }

    public function getStatus($nim)
    {
        $this->db->select('status');
        $this->db->from('queue_email');
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        //$this->db->limit(1); 
        //echo $this->db->last_query();die();
        return $query->row_array();
    }

    public function check_barcode_and_tgl_pinjam($nama, $barcode, $tgl_pinjam, $tgl_kembali)
    {
        $this->db->select('id,status');
        $this->db->from('queue_email');
        $this->db->where('no_barcode', $barcode);
        $this->db->where('tgl_pinjam', $tgl_pinjam);
        $this->db->where('nama', $nama);
        $this->db->where('tgl_kembali', $tgl_kembali);
        $query = $this->db->get();
        //$this->db->limit(1); 
        //echo $this->db->last_query();die();
        return $query->row_array();
    }


    public function update_queue_email($id, $set)
    {
        $this->db->set('tgl_pinjam', $set['tgl_pinjam']);
        $this->db->set('tgl_kembali', $set['tgl_kembali']);
        $this->db->set('no_barcode', $set['no_barcode']);
        $this->db->set('denda', $set['denda']);
        $this->db->set('telat', $set['telat']);
        $this->db->set('keterangan', '');
        $this->db->where('id', $id);
        $this->db->update('queue_email');
    }

    public function updateQueueEmail($nim, $set)
    {
        $this->db->set('buku_telat', $set);
        $this->db->where('nim', $nim);
        $this->db->update('queue_email');
    }

    public function updateQueue($no_barcode, $data)
    {
        $this->db->set($data);
        $this->db->where('no_barcode', $no_barcode);
        $this->db->update('queue_email');
    }
}
