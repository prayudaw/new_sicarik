<!-- header -->
<?php $this->load->view('admin/template/header'); ?>
<!-- End Header -->

<!-- Navbar Header -->
<?php $this->load->view('admin/template/navbar'); ?>
<!-- End Navbar -->
</div>

<!-- Sidebar -->
<?php $this->load->view('admin/template/sidebar'); ?>
<!-- End Sidebar -->

<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"></h2>
                        <h5 class="text-white pb-2 fw-bold">
                        </h5>
                        <h5 class="text-white op-7 mb-2">Jurusan :</h5>
                    </div>

                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">


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
                                                    <h5 class="mb-1"><b> <small>Pinjaman Buku</small></b></h5>
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
                                                    <h5 class="mb-1"><b> <small>Pinjaman Skripsi</small></b></h5>

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
                                                    <h5 class="mb-1"><b> <small>Pinjaman Buku Tandon</small>
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
                                                <h5 class="mb-1"><b><a href="#"> <small>Pinjaman Kunci Loker</small></a></b></h5>
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
<?php $this->load->view('admin/template/footer'); ?>
<!-- Footer -->