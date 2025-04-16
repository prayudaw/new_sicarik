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
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Report Pengunjung</h4>
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
                        <a href="#">Report</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Pengunjung</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-search"></i> PENCARIAN</h4>
                        </div>
                        <div class="card-body">
                            <form id="form-filter">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="NIM">NIM</label>
                                            <input type="text" class="form-control" id="nim" name="nim" placeholder="Input NIM">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="tgl" name="tgl" value="" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar-check"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary" id="btn-filter"><i class="fas fa-search"></i> Search</button>
                            <button class="btn btn-default" id="btn-reset">Reset</button>
                            <button class="btn btn-success" id="btn-excel"><i class="far fa-file-excel"></i> Excel</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Tanggal</th>
                                            <th>device</th>
                                            <th>Nama Browser</th>
                                            <th>Plaftform</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Tanggal</th>
                                            <th>device</th>
                                            <th>Nama Browser</th>
                                            <th>Plaftform</th>
                                        </tr>
                                    </tfoot>
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
<?php $this->load->view('admin/template/footer'); ?>
<!-- Footer -->

<script type="text/javascript">
    $(document).ready(function() {

        $('#tgl').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#tgl').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        var table;
        table = $('#basic-datatables').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "ajax": {
                "url": "<?php echo base_url() ?>admin/pengunjung/ajax_list",
                'data': function(data) {
                    data.searchNim = $('#nim').val();
                    data.searchTanggal = $('#tgl').val();
                },
                "type": "POST"
            },
            "createdRow": function(row, data, dataIndex) {}
        });

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });

        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(); //just reload table
        });

        $('#btn-excel').click(function() { //button reset event click
            // if ($('#tgl').val() == '') {
            //     alert('Tanggal Harus Diisi');
            //     return false;
            // }

            var nim = $("#nim").val();
            var tanggal = $("#tgl").val();
            location.href = "<?= base_url() ?>admin/pengunjung/export_excel?tanggal=" + tanggal + "&nim=" + nim;
        });



    });
</script>