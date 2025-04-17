<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?php echo base_url() ?>assets/img/perpus/logo-perpus.png" type="image/x-icon" />

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
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/atlantis.css">
</head>

<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">

            <h3 class="text-center">Admin SICARIK</h3>
            <div class="login-form">
                <div class="form-group">
                    <label for="username" class="placeholder"><b>Username</b></label>
                    <input id="username" name="username" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password" class="placeholder"><b>Password</b></label>
                    <div class="position-relative">
                        <input id="password" name="password" type="password" class="form-control" required>
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group form-action-d-flex mb-3">
                    <div class="custom-control custom-checkbox">

                    </div>
                    <a href="#" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold btn-login">Login</a>
                </div>
                <div class="login-account">
                    <!-- <span class="msg">Don't have an account yet ?</span>
                    <a href="#" id="show-signup" class="link">Sign Up</a> -->
                </div>
            </div>
        </div>

    </div>
    <script src="<?php echo base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/atlantis.min.js"></script>


    <!-- Sweet Alert -->
    <script src="<?php echo base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-login").click(function(e) {
            e.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();
            if (username.length == "") {
                swal("Oops...", "Username Harus Diisi!", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
                return false;
            } else if (password.length == "") {
                swal("Oops...", "Password Harus Disii!", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
                return false;
            } else {
                //ajax
                $.ajax({
                    url: "<?php echo base_url() ?>login_admin/auth",
                    type: "POST",
                    data: {
                        "username": username,
                        "password": password
                    },
                    success: function(response) {
                        console.log(response);
                        response = JSON.parse(response);
                        if (response.status == 1) {
                            swal("Success", "Login Berhasil", {
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                },
                            });

                            setTimeout(function() {
                                window.location.href =
                                    "<?php echo base_url('admin/home') ?>";
                            }, 720);

                        } else {
                            swal("Oops...", response.message, {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-danger'
                                    }
                                },
                            });
                            // $("#username").val('');
                            // $("#password").val('');
                            return false;
                        }


                    },
                    error: function(response) {
                        swal("Good job!", "You clicked the button!", {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-danger'
                                }
                            },
                        });
                    }

                })

            }

        });


    });
</script>