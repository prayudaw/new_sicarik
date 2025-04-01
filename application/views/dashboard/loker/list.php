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
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Transaksi Peminjaman Skripsi</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Transaski</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Loker</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="display table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No Loker</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tgl Kembali</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>

                                </table>
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
<style>
    .redClass {
        background-color: red;
        color: white;
    }
</style>
<script type="text/javascript">
    // Call the dataTables jQuery plugin
    $(document).ready(function() {

        var table;
        var base_url = '<?php echo base_url() ?>';

        table = $('#table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "ajax": {
                "url": "<?php echo site_url('dashboard/loker/ajax_list') ?>",
                "type": "POST"
            },
            "createdRow": function(row, data, dataIndex) {

                if (data[3] == 'Belum Dikembalikan') {
                    $(row).addClass('redClass');
                }
            }
        });
    });
</script>