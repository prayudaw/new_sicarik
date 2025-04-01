<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

    <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <?php
                        $nim = $this->session->userdata('no_mhs');
                        $url = 'http://siprus.uin-suka.ac.id/realtime/b/a.php?nim=' . $nim . '';
                        $html = file_get_contents($url);
                        $doc = new DOMDocument();
                        @$doc->loadHTML($html);
                        $tags = $doc->getElementsByTagName('img');
                        foreach ($tags as $tag) {
                            $img = $tag->getAttribute('src');
                        }
                        // $img = base_url('assets/img/perpus/uin_default.png');
                        ?>
                        <img src="<?php echo $img ?>" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="<?php echo $img ?>" alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4><?php echo $this->session->userdata('Fullname'); ?></h4>
                                    <p class="text-muted"><?php echo $this->session->userdata('no_mhs'); ?></p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">My Profile</a>
                            <a class="dropdown-item" id="logout">Logout</a>
                            <!-- <a class="dropdown-item" href="<?php echo base_url() ?>login/logout">Logout</a> -->
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>