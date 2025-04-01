<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/core/BaseController.php';

class Tanggungan extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->loginCheck();
    }

    public function index()
    {
        #$this->load->view('dashboard/tandon/list');
    }


    public function buku()
    {
        $this->load->view('dashboard/tanggungan/buku');
    }

    public function skripsi()
    {
        $this->load->view('dashboard/tanggungan/skripsi');
    }

    public function tandon()
    {
        $this->load->view('dashboard/tanggungan/tandon');
    }



    public function tandon_list()
    {
        $id_mhs = $this->session->userdata('no_mhs');
        //$id_mhs = '22101020056';

        $url = API . 'tanggungan_tandon.php';
        $postdata = http_build_query(
            array(
                'no_mhs' =>  $id_mhs,
                'length' => $_POST['length'],
                'start' => $_POST['start'],
                'search' => $_POST['search']['value']
            )
        );

        $opts = array(
            'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);
        $list = file_get_contents($url, false, $context);
        $list = json_decode($list, true);

        // end get total
        $data = array();
        $no = $_POST['start'];

        foreach ($list['data'] as $getData) {
            $no++;
            $row = array();
            $row[] = $getData['judul'];
            $row[] = $getData['tgl_pinjam'];
            $row[] = $getData['tgl_kembali'];
            //add html for action
            $row[] = '';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list['total_data'],
            "recordsFiltered" => $list['total_filtered'],
            "data" => $data,
        );

        //output to json format
        echo json_encode($output);
    }


    public function skripsi_list()
    {
        $id_mhs = $this->session->userdata('no_mhs');
        //$id_mhs = '22101020056';

        $url = API . 'tanggungan_skripsi.php';
        $postdata = http_build_query(
            array(
                'no_mhs' =>  $id_mhs,
                'length' => $_POST['length'],
                'start' => $_POST['start'],
                'search' => $_POST['search']['value']
            )
        );

        $opts = array(
            'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);
        $list = file_get_contents($url, false, $context);
        $list = json_decode($list, true);

        // end get total
        $data = array();
        $no = $_POST['start'];

        foreach ($list['data'] as $getData) {
            $no++;
            $row = array();
            $row[] = $getData['judul'];
            $row[] = $getData['tgl_pinjam'];
            $row[] = $getData['tgl_kembali'];
            //add html for action
            $row[] = '';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list['total_data'],
            "recordsFiltered" => $list['total_filtered'],
            "data" => $data,
        );

        //output to json format
        echo json_encode($output);
    }

    public function buku_list()
    {
        $id_mhs = $this->session->userdata('no_mhs');
        //$id_mhs = '22101020056';

        $url = API . 'tanggungan_buku.php';
        $postdata = http_build_query(
            array(
                'no_mhs' =>  $id_mhs,
                'length' => $_POST['length'],
                'start' => $_POST['start'],
                'search' => $_POST['search']['value']
            )
        );

        $opts = array(
            'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);
        $list = file_get_contents($url, false, $context);
        $list = json_decode($list, true);

        // end get total
        $data = array();
        $no = $_POST['start'];

        foreach ($list['data'] as $getData) {
            $no++;
            $row = array();
            $row[] = $getData['judul'];
            $row[] = $getData['tgl_pinjam'];
            $row[] = $getData['tgl_kembali'];
            $row[] = $getData['tgl_dikembalikan'];
            //add html for action
            $row[] = '';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list['total_data'],
            "recordsFiltered" => $list['total_filtered'],
            "data" => $data,
        );

        //output to json format
        echo json_encode($output);
    }
}
