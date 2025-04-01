<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/core/BaseController.php';
class Dashboard extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->loginCheck();
    }

    public function index()
    {
        $no_mhs = $this->session->userdata('no_mhs');


        //get data buku yg sedang dipinjam
        $url = API . 'transaksi.php?no_mhs=' . $no_mhs . '&action=get_is_borrow';
        $list = file_get_contents($url);
        $list = json_decode($list, true);

        //get total transaksi buku
        $total_transaksi_buku = API . 'transaksi.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_transaksi_buku = file_get_contents($total_transaksi_buku);

        //get total transaksi skripsi
        $total_transaksi_skripsi = API . 'transaksi_skripsi.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_transaksi_skripsi = file_get_contents($total_transaksi_skripsi);


        //get total transaksi loker
        $total_transaksi_loker = API . 'loker.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_transaksi_loker = file_get_contents($total_transaksi_loker);
        //echo $total_transaksi_skripsi;die();

        //get total transaksi kunjungan
        $total_transaksi_pintumasuk = API . 'pintumasuk.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_transaksi_pintumasuk = file_get_contents($total_transaksi_pintumasuk);


        //get total kunjungan serial
        $total_kunjungan_serial = API . 'serial.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_kunjungan_serial = file_get_contents($total_kunjungan_serial);

        //get total kunjungan serial
        $total_kunjungan_referensi = API . 'referensi.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_kunjungan_referensi = file_get_contents($total_kunjungan_referensi);


        // get total tanggungan buku
        $total_kunjungan_tanggungan_buku = API . 'tanggungan_buku.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_kunjungan_tanggungan_buku = file_get_contents($total_kunjungan_tanggungan_buku);


        // get total tanggungan buku
        $total_tanggungan_buku = API . 'tanggungan_buku.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_tanggungan_buku = file_get_contents($total_tanggungan_buku);


        // get total tanggungan skripsi
        $total_tanggungan_skripsi = API . 'tanggungan_skripsi.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_tanggungan_skripsi = file_get_contents($total_tanggungan_skripsi);
        // var_dump($total_tanggungan_skripsi);
        // die();

        // get total tanggungan tandon
        $total_tanggungan_tandon = API . 'tanggungan_tandon.php?no_mhs=' . $no_mhs . '&action=get_total';
        $total_tanggungan_tandon = file_get_contents($total_tanggungan_tandon);



        $data['jumlah_transaksi_loker'] = (int)$total_transaksi_loker;
        $data['jumlah_transaksi_buku'] = (int)$total_transaksi_buku;
        $data['jumlah_transaksi_skripsi'] = (int)$total_transaksi_skripsi;
        $data['jumlah_transaksi_pintumasuk'] = (int)$total_transaksi_pintumasuk;
        $data['jumlah_kunjungan_serial'] = (int)$total_kunjungan_serial;
        $data['jumlah_kunjungan_referensi'] = (int)$total_kunjungan_referensi;
        $data['total_kunjungan_tanggungan_buku'] = (int)$total_kunjungan_tanggungan_buku;
        $data['jumlah_tanggungan_tandon'] = (int)$total_tanggungan_tandon;
        $data['jumlah_tanggungan_buku'] = (int)$total_tanggungan_buku;
        $data['jumlah_tanggungan_skripsi'] = (int)$total_tanggungan_skripsi;
        $data['is_borrow'] = $list;

        // echo "<pre>";
        // print_r($list);
        // die();


        $this->load->view('dashboard/home', $data);
    }
}
