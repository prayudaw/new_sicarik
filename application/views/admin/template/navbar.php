<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

    <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <?php

                        $img = base_url('assets/img/perpus/uin_default.png');
                        ?>
                        <img src="<?php echo $img ?>" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="dropdown-divider"></div>
                            <!-- <a class="dropdown-item" href="#">My Profile</a> -->
                            <!-- <a class="dropdown-item" id="logout">Logout</a> -->
                            <a class="dropdown-item" href="<?php echo base_url() ?>login_admin/logout">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>