<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Welcome to Sistem Informasi Catatan Riwayat Pemustaka Perpustakaan UIN Sunan Kalijaga</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?php echo base_url() ?>assets/img/perpus/logo-perpus.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Fonts and icons -->
    <script src="<?php echo base_url() ?>assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['<?php echo base_url() ?>assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="<?php echo base_url() ?>admin/home" class="logo">
                    <img src="<?php echo base_url() ?>assets/img/perpus/logo-perpus.png" alt="navbar brand"
                        class="navbar-brand" style="width:50px;"> <span
                        style="font-size:20px;color:white;font-weight:bold"><strong
                            style="color:#FBC02D;">SI</strong>CARIK</span>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->