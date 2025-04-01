<!-- header -->
<?php $this->load->view('dashboard/template/header'); ?>
<!-- End Header -->

<!-- Navbar Header -->
<?php $this->load->view('dashboard/template/navbar'); ?>
<!-- End Navbar -->
</div>

<!-- Sidebar -->
<?php $this->load->view('dashboard/template/sidebar'); ?>
<!-- End Sidebar -->

<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"><?php echo $this->session->userdata('Fullname'); ?></h2>
                        <h5 class="text-white pb-2 fw-bold"><?php echo $this->session->userdata('no_mhs'); ?></h5>
                        <h5 class="text-white op-7 mb-2">Jurusan : <?php echo $this->session->userdata('jurusan'); ?> | Status : <?php echo $this->session->userdata('status'); ?></h5>
                    </div>

                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <?php if ($is_borrow['status'] == 1) {   ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #FFAD46;">
                                <div class="card-title" style="text-align: center;color:#FFF;"><i class="fas fa-bell"></i> Perhatian</div>
                            </div>
                            <div class="card-body pb-0">
                                <?php $date = date('Y-m-d');
                                foreach ($is_borrow['data'] as $list) {
                                ?>
                                    <div class="d-flex">
                                        <div class="avatar">
                                            <img src="<?php echo base_url() ?>assets/img/book_logo.svg" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                        <div class="flex-1 pt-1 ml-2">
                                            <h3 class="fw-bold mb-1"><?php echo $list['judul'] ?></h3>
                                            <small class="text-muted" style="font-size: 15px;"><strong style="color: green;"> Buku -</strong> dipinjam tanggal <?php echo $list['tgl_pinjam'] ?> Harap dikembalikan <?php echo $list['tgl_kembali'] ?></small>
                                            <?php if ($list['tgl_kembali'] < $date) { ?>
                                                <br /><br /> <span style="background-color: red;color:#FFF;padding:3px 4px">Lama terlambat <b><?php echo $list['list_denda']['jhd'] ?></b> hari Jumlah Denda <?php echo $list['list_denda']['denda'] ?></span>
                                            <?php  } ?>

                                        </div>
                                        <div class="d-flex ml-auto align-items-center">
                                            <h3 class="text-danger fw-bold">
                                                <?php if ($list['list_denda']['jhd'] > 0) { ?>
                                                    Denda
                                                <?php } ?>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>

                                <?php } ?>



                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Tanggungan</div>
                            <div class="card-category"></div>

                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    <a href="<?php echo base_url() ?>dashboard/tanggungan/buku">
                                        <div class="card p-3">
                                            <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-secondary mr-3">
                                                    <i class="fa fa-book"></i>
                                                </span>
                                                <div>
                                                    <h5 class="mb-1"><b><?php echo $jumlah_tanggungan_buku ?> <small>Pinjaman Buku</small></b></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3 col-lg-3">
                                    <a href="<?php echo base_url() ?>dashboard/tanggungan/skripsi">
                                        <div class="card p-3">
                                            <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-success mr-3">
                                                    <i class="fas fa-book-open"></i>
                                                </span>
                                                <div>
                                                    <h5 class="mb-1"><b><?php echo $jumlah_tanggungan_skripsi ?> <small>Pinjaman Skripsi</small></b></h5>

                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-sm-3 col-lg-3">
                                    <a href="<?php echo base_url() ?>dashboard/tanggungan/tandon">
                                        <div class="card p-3">
                                            <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-success mr-3">
                                                    <i class="fas fa-book-open"></i>
                                                </span>
                                                <div>
                                                    <h5 class="mb-1"><b><?php echo $jumlah_tanggungan_tandon ?> <small>Pinjaman Buku Tandon</small>
                                                        </b>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3 col-lg-3">
                                    <div class="card p-3">
                                        <div class="d-flex align-items-center">
                                            <span class="stamp stamp-md bg-danger mr-3">
                                                <i class="fas fa-key"></i>
                                            </span>
                                            <div>
                                                <h5 class="mb-1"><b><a href="#"><?php echo $jumlah_transaksi_loker ?> <small>Pinjaman Kunci Loker</small></a></b></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer1 -->
    <?php $this->load->view('dashboard/template/footer1'); ?>
    <!-- Footer1 -->
</div>


<!-- Footer -->
<?php $this->load->view('dashboard/template/footer'); ?>
<!-- Footer -->