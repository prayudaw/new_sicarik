</div>
<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="<?php echo base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="<?php echo base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="<?php echo base_url() ?>assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="<?php echo base_url() ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="<?php echo base_url() ?>assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?php echo base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="<?php echo base_url() ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Sweet Alert -->
<script src="<?php echo base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Atlantis JS -->
<script src="<?php echo base_url() ?>assets/js/atlantis.min.js"></script>

<script type="text/javascript">
    $('#logout').click(function(e) {
        e.preventDefault();
        swal({
            title: 'Apa anda yakin ingin keluar?',
            text: "",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Ya, Saya Mau Keluar ',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                swal({
                    title: 'Anda Sudah Logout',
                    text: '',
                    type: 'success',
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    }
                });
                window.location.href = "<?php echo base_url('login/logout') ?>";
            } else {
                swal.close();
            }
        });
    });
    $(function() {
        var url = window.location.href;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav li.nav-item a').filter(function() {
            console.log(this.href);
            // console.log(url);

            return this.href == url;
        }).parent('li').addClass('active');
    })
</script>

</body>

</html>