<?php
defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . '/core/BaseController.php';

class Login extends BaseController
{
    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if ($isLoggedIn == TRUE) {
            redirect('dashboard/dashboard');
        }

        //ucapan waktu berdasarkan jam
        $jam = date("G");
        if ($jam < 10) {
            $waktu = "Selamat Pagi";
        } else if ($jam < 15) {
            $waktu = "Selamat Siang";
        } else if ($jam < 18) {
            $waktu = "Selamat Sore";
        } else if ($jam < 19) {
            $waktu = "Selamat Petang";
        } else if ($jam < 24) {
            $waktu = "Selamat Malam";
        }
        $data = array(
            'kalimat_bijak' => $this->kalimatBijak(), //kumpulan kalimat bijak
            'jam' => $waktu
        );
        $this->load->view('login/view', $data);
    }

    public function auth()
    {
        $post = $this->input->post();
        $username = preg_replace('/\s+/', '', $post['username']);
        $pass = preg_replace('/\s+/', '', $post['password']);

        if ($pass == PASS_PETUGAS) {
            $raw[0]['NamaPengguna'] = $post['username'];
        } else {
            $url = API_SUPER . "&uss=" . $username . "&pss=" . $post['password'];
            #$raw = file_get_contents($url);
            $raw = file_get_contents('authUser.txt');
            $raw = json_decode($raw, true);
        }

        if ($raw[0] != NULL) {
            $id_mhs = $raw[0]['NamaPengguna'];
            $getData = $this->checkUser($id_mhs);
            // echo "<pre>";
            // print_r($_SERVER);
            // die();
            if ($getData != 2) {
                $timeout = 2000;
                $sessionArray = array(
                    'no_mhs' => $getData['no_mhs'],
                    'Fullname' => $getData['nama'],
                    'jurusan' => $getData['jurusan'],
                    'fakultas' => $getData['fakultas'],
                    'angkatan' => $getData['angkatan'],
                    'status' => $getData['status'],
                    'isLoggedIn' => TRUE,
                    'expires_time' => time() + $timeout
                );

                //insert log login
                $getDataClient = $this->getInfoClient($getData['no_mhs']);

                // var_dump($getDataClient);
                // die();
                $this->insert_log_login($getDataClient);

                $this->session->set_userdata($sessionArray);
                $response = array(
                    'status' => 1,
                    'message' => 'Berhasil login',
                );
            } else {
                $response = array(
                    'status' => 2,
                    'message' => 'Data Tidak Ditemukan',
                );
            }

            echo json_encode($response);
        } else {
            $response = array(
                'status' => 2,
                'message' => 'Username atau Password salah',
            );


            echo json_encode($response);
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }


    public function checkUser($id_mhs)
    {

        $url = API . 'mahasiswa.php?no_mhs=' . $id_mhs;
        $raw = file_get_contents($url);
        //$raw = file_get_contents('getMhs.txts');
        $raw = json_decode($raw, true);
        if ($raw['status'] != 2) {
            return $raw['data'][0];
        }
        return $raw['status'];
    }

    private function getInfoClient($no_mhs)
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $device = 'Unknown';
        $platform = 'Unknown';
        $bname = 'Unknown';
        $version = "-";

        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';


        // first get the platform
        $u_info = preg_split('/[\/();,]/', $_SERVER["HTTP_USER_AGENT"]);
        $platform = $u_info[2] . " " . $u_info[3];

        // next get the device
        $u_info = preg_split('/[\/();,]/', $_SERVER["HTTP_USER_AGENT"]);
        $device = $u_info[4];


        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        } elseif (preg_match('/Edge/i', $u_agent)) {
            $bname = 'Edge';
            $ub = "Edge";
        } elseif (preg_match('/Trident/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        $countryCode = '';
        $isp = '';
        $city = '';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ipaddress));
        if ($query && $query['status'] == 'success') {
            $countryCode = $query['countryCode'];
            $isp = $query['isp'];
            $city = $query['city'];
        }

        if ($version == null || $version == "") {
            $version = "?";
        }


        // var_dump($bname . " " . $version);
        // die();
        $data = array(
            'is_login' => 1,
            'nim' => $no_mhs,
            'ip' =>  $ipaddress,
            'device' => $device,
            'nameBrowser'      => $bname . " " . $version,
            'platform'  => $platform,
            'countryCode' => $countryCode,
            'isp' => $isp,
            'city' => $city
        );


        return $data;
    }


    public function kalimatBijak()
    {
        $kalimatBijak = array(
            "Menangislah agar dadamu lapang, sholatlah agar hatimu kembali tenang, berdoalah agar pertolongan segera datang.",
            "Hidup sederhana tanpa ada hasrat untuk mencari perhatian di hadapan manusia adalah di antara sebab ketenangan hati dan bahagia.",
            "Allah akan mendatangkan hari-hari yang membuat kita bahagia, sebab hidup takkan selamanya sulit.",
            "Tetaplah bersabar meskipun terasa seluruh duniamu berantakan. Allah tahu lelahmu.",
            "Semoga apa pun yang kamu perjuangkan hari ini Allah berikan kelancaran, sehingga berakhir dengan hasil yang memuaskan.",
            "Jangan biarkan hatimu mendapat kesenangan karena pujian dari orang lain, kamu akan sedih dengan kecaman mereka suatu hari nanti. - Imam Ghazali",
            "Jika kamu mencintai seseorang, biarkan dia pergi. Jika ia kembali, maka ia milikmu. Namun jika tidak kembali, ketahuilah maka dia bukan milikmu. - Ali bin Abi Thalib",
            "Dan barangsiapa bertawakal kepada Allah, niscaya Allah akan mencukupkan keperluannya. - QS Ath-Thalaq 8",
            "Takdir itu milik Allah, namun usaha dan doa adalah milik kita.",
            "Jika kamu belajar dari kegagalan, maka kamu tidak akan pernah gagal.",
            "Terkadang yang membuatmu gelisah bukanlah masalah yang menguji, tetapi bahasa rindu Allah yang gagal kamu pahami.",
            "Dalam hidup, banyak hadiah terbungkus dengan masalah, maka jangan cepat membenci apa yang tidak kamu senangi.",
            "Semoga Allah membimbing di setiap langkah, sehingga apapun yang kulakukan menjadi berkah. Dan apapun yang kuusahakan berbuah indah.",
            "Sholatlah agar hatimu tenang, istighfarlah agar kecewamu hilang. Dan berdoalah agar bahagiamu segera datang.",
            "Masa-masa sulit akan mengajarkanmu bagaimana menjadi kuat dan bagaimana terus berharap kepada Allah.",
            "Jangan pernah mendahului apa yang akan terjadi dengan berkata tidak mampu, tidak sanggup, tidak kuat, sebelum ada usaha yang menjadikan dirimu menjadi mampu, sanggup, serta kuat.",
            "Takkan pernah ada yang senantiasa bersamamu dalam setiap situasi, kecuali Allah.",
            "Titik lelahnya diganti bahagia, fase diamnya diganti senyuman, usahanya diganti keberhasilan, doanya Allah ijabah tepat dengan waktunya.",
            "Bercermin itu penting agar kita mengetahui siapa diri kita, apa saja kekurangan kita, sebelum memutuskan untuk menilai orang lain.",
            "Kurangi rasa ingin tahumu tentang orang lain, niscaya ghibahmu juga akan berkurang. - Sufyan Ats Tsaury rahimahullah, Siyar A'lam An Nubala 5/62",
            "Ceritakan harapan-harapanmu dalam sholat, sebab Allah tak akan mengecewakanmu.",
            "Jika memulai karena Allah, maka jangan menyerah karena manusia.",
            "Jika ada orang yang menjatuhkanmu bangkitlah karena Allah. Jangan putus asa hanya karena manusia. Jangan menyerah hanya karena urusan dunia, ingat ada Allah. Dia Maha Segalanya. Mohonlah pertolongan pada-Nya.",
            "Ketika kamu merasa hidupmu terlalu berat, sudahkah kamu bersyukur atas napasmu hari ini? Sudahkah kamu senyum atas indahnya hari ini?",
            "Abaikan rasa sakit hatimu, atau jika tidak, maka kamu akan sulit merasa bahagia.",
            "Hidup terasa lebih tenang apabila ikhlas dalam memaafkan.",
            "Cara terbaik menghukum orang yang telah melakukan kesalahan terhadap kita ialah dengan berbuat baik kepadanya.",
            "Sabar adalah perbendaharaan surga yang tidak diberikan oleh Allah kecuali bagi hamba yang mulia di sisi-Nya. - Imam Abu Hasan Asy'ari",
            "Ketahuilah bahwa dunia pergi semakin jauh, sedangkan akhirat semakin dekat.",
            "Jangan khawatir, kamu mungkin tak tahu jodohmu siapa dan jodohmu mungkin tak tahu kamu di mana. Tapi Allah tahu kapan waktu yang tepat untuk mempertemukan kalian berdua.",
            "Segala sesuatu dimulai dari yang kecil, kemudian tumbuh membesar, kecuali musibah. Dia besar pada awalnya, kemudian semakin mengecil.",
            "Lelahmu akan berubah manis ketika niatnya lillah karena Allah.",
            "Semakin kamu menyerahkan semua urusanmu kepada Allah, maka semakin tenang hatimu.",
            "Jangan sampai tampilan sudah baik tapi hati masih munafik karena Allah melihat ikhlasnya hati, bukan sucinya penampilan fisik.",
            "Terkadang kita terlalu sibuk mencari tanpa kita sadari Allah telah menyiapkan. Kita hanya perlu menjaga dan mempersiapkan.",
            "Jangan merasa bahwa rencanamu paling hebat karena sehebat apa pun rencanamu, jika menurut Allah itu tidak baik, Allah tidak akan merestui.",
            "Harimu mungkin melelahkan, hatimu merasa terisaukan. Janganlah larut dan tenggelam, Allah selalu menunggumu di sepertiga malam.",
            "Saat kamu mulai merasa kehilangan tujuan, ingatlah untuk pulang dan mulailah bersujud pada Tuhan.",
            "Jangan bersedih saat keikhlasanmu diragukan, jangan berhenti meski kebaikanmu dilupakan. Saat kita tidak mengharapkan pujian dari orang lain, maka balasan Allah lebih baik dari yang kita harapkan.",
            "Jangan berusaha melupakan karena itu akan sangat sulit untuk dilakukan, tapi belajarlah menerima kenyataan agar perlahan hatimu bisa merelakan.",
            "Melihatlah ke atas untuk urusan akhiratmu dan melihatlah ke bawah untuk urusan duniamu, maka hidup akan tenteram.",
            "Barangsiapa di malam hari merasa kelelahan karena upaya keterampilan kedua tangannya pada siang hari, maka pada malam hari itu ia diampuni oleh Allah. - HR Ahmad",
            "Dan hendaklah mereka memaafkan dan berlapang dada. Apakah kamu tidak ingin bahwa Allah mengampunimu? Dan Allah adalah Maha Pengampun lagi Maha Penyayang - QS An-Nuur: 22",
            "Jika orang yang kau bantu tidak berterima kasih kepadamu, bisa jadi itu tanda bahwa Allah ingin membesarkan pahalamu dan ingin melihatmu merasakan kelezatan ikhlas.",
            "Yakinlah, Allah akan memberikan yang terbaik, bukan yang tercepat.",
            "Yakin saja jika melibatkan Allah dalam setiap urusan kita, maka tiada hal yang tidak mungkin.",
            "Orang yang hebat adalah orang yang memiliki kemampuan menyembunyikan kemelaratannya, sehingga orang lain menyangka bahwa dia berkecukupan karena dia tidak pernah meminta. - Imam Syafi'i",
            "Barangsiapa mengadu domba untuk kepentinganmu, maka dia akan mengadu domba dirimu, dan barangsiapa menyampaikan fitnah kepadamu, maka ia akan memfitnahmu. - Imam Syafi'i",
            "Dan jadikan sebagian kamu sebagai cobaan bagi sebagian yang lain. Maukah kamu bersabar? - QS Al-Furqan: 20",
            "Balas dendam terbaik adalah menjadikan dirimu lebih baik. - Ali bin Abi Thalib",
            "Kekayaan yang hakiki bukanlah dari banyaknya harta, namun kekayaan yang hakiki adalah hati yang selalu merasa cukup. - HR Bukhari & Muslim",
            "Barangsiapa yang tidak mensyukuri yang sedikit, maka ia tidak akan mampu mensyukuri sesuatu yang banyak.",
            "Bila hati kita merasa kurang, itu yang bermasalah adalah hati, bukan rezeki.",
            "Kebaikan tidak akan usang, dosa tidak akan dilupakan. Sementara Allah tidak pernah tidur, maka berbuatlah sesukamu, tapi ketahuilah bahwa kelak kau akan dibalas.",
            "Kita tahu ini haram, tapi kenapa kita terkadang masih melakukannya? Itu tandanya ilmu kita baru sampai di kepala, belum sampai masuk ke dalam hati.",
            "Gelarmu hanyalah selembar kertas, kamu terdidik dengan baik atau tidak lebih terlihat dalam perilakumu.",
            "Tiap wadah itu memercikkan isinya. Jika yang keluar dari lisanmu busuk, maka berarti apa yang ada di dalam hatimu pun busuk.",
            "Jangan ucapkan segala yang kamu pikirkan. Tapi pikirkanlah segala yang kamu ucapkan.",
            "Dtangnya kematian itu tidak menunggu hingga kamu akan menjadi lebih baik, jadilah orang baik dan tunggulah kematian.",
            "Sayangilah mereka yang ada di bumi, niscaya mereka yang ada di langit akan menyayangimu. - HR Tirmidzi",
            "Perbanyaklah mengingat Allah karena itu adalah obat. Jangan buat dirimu terlalu banyak mengingat manusia karena itu adalah penyakit. - Umar bin Khattab",
            "Untuk mendapatkan apa yang kamu suka, pertama-tama kamu harus bisa bersabar dengan apa yang kamu benci. - Imam Ghazali",
            "Terkadang orang dengan masa lalu paling kelam akan menciptakan masa depan yang paling cerah. - Umar bin Khattab",
            "Barangsiapa yang tidak menyayangi, maka ia tidak akan disayangi. - HR Bukhari",
            "Dunia itu hanyalah cita-cita yang sirna, ajal yang berkurang, dan jalan menuju akhirat, serta perjalanan menuju kematian. - Umar bin Khattab",
            "Tidak penting siapa kamu di masa lalu, yang terpenting adalah siapa kamu hari ini dan kebaikan apa yang kamu lakukan saat ini.",
            "Tidak ada kalimat 'semua akan indah pada waktunya' karena setiap hari pun semuanya terlihat indah jika kita pandai bersyukur.",
            "Tidak usah sedih saat rencanamu gagal karena Tuhan menghancurkan rencanamu, agar rencanamu tidak menghancurkanmu.",
            "Jika sudah waktunya, hujan akan turun, jika sudah masanya, bunga akan mekar. Jika sudah waktunya, doa-doa pasti akan dikabulkan.",
            "Barangsiapa menyalakan api fitnah, maka dia sendiri yang akan menjadi bahan bakarnya. - Ali bin Abi Thalib",
            "Janganlah engkau mengucapkan perkataan yang engkau sendiri tak suka mendengarnya jika orang lain mengucapkannya kepadamu. - Ali bin Abi Thalib",
            "Siapa yang menuntut ilmu dengan niat yang ikhlas, dia akan mendapat kehormatan sebagai muhajid, pejuang Allah. - Ahmad Fuadi",
            "Boleh jadi dosa yang kita anggap remeh adalah dosa besar di sisi Allah. Maka kita perlu selalu berhati-hati dan banyak beristighfar kepada-Nya - Achmad Mustafa Bisri",
            "Berbahagialah orang yang tidak pernah bergantung pada amal ikhtiarnya. Tubuh bersimbah keringat, berkuah peluh, tetapi hati tidak 100% tawakal kepada Allah. - Abdullah Gymnastiar",
            "Berikhtiarlah sambil berdoa kepada Allah. Karena hasil ikhtiarmu tidak di tanganmu. Tapi di tangan-Nya. - Achmad Mustafa Bisri",
            "Sempurnakanlah ikhtiar dan janganlah menjadi takabur manakala ikhtiar itu berbuah sukses karena sukses adalah karunia Allah semata. - Abdullah Gymnastiar",
            "Keislaman bukan hanya Allah ada di dalam jiwamu tetapi kehidupan Islam menjadi nyata melalui perilakumu. - Ahmad Dahlan",
            "Tak ada waktu yang terlalu cepat atau terlalu lambat untuk masalah jodoh. Dia akan datang kapan pun dia mau. Karena Allah telah menuliskannya dalam garis takdirmu. - Nima Mumtaz",
            "Seseorang yang dekat dengan Allah, bukan berarti tidak ada air mata. - Dahlan Iskan",
            "Yang paling nampak pada diri manusia adalah kelemahanya, maka barang siapa melihat kelemahan dirinya sendiri, ia akan menggapai keseimbangan terhadap perintah Allah. - Imam Syafi'i",
            "Kewajiban berusaha adalah miliki kita, hasil adalah milik Allah. - Cut Nyak Dhien",
            "Tidak ada yang bisa mengusir syahwat atau kecintaan pada kesenangan duniawi selain rasa takut kepada Allah yang menggetarkan hati, atau rasa rindu kepada Allah yang membuat hati merana. - Habiburrahman El Shirazy",
            "Dengan mengingat Allah hati menjadi tenang. Dalam segala aktivitas kita akan bernilai ibadah. - Bob Sadino",
            "Putuskan setiap harapan selain kepada Allah. Putuskan setiap kerinduan selain rindu ingin berjumpa dengan Allah. - Abdullah Gymnastiar",
            "Pada waktu kita khawatir, kita terkadang lebih percaya pada masalah kita daripada janji Allah. - Cut Nyak Dhien",
            "Sabar memiliki dua sisi, sisi yang satu adalah sabar, sisi yang lain adalah bersyukur kepada Allah. - Ibnu Mas'ud",
            "Benar, mencintai makhluk itu sangat berpeluang mengalami kehilangan. Kebersamaan bersama makhluk juga berpeluang mengalami perpisahan. Hanya cinta kepada Allah yang tidak. - Habiburrahman El Shirazy",
            "Di antara yang membuat kita dihargai orang lain adalah karena Allah masih menutupi aib, keburukan dan kekurangan kita. - Abdullah Gymnastiar",
            "Apa yang kita lakukan di dunia ini, kelak semuanya akan dipertanggungjawabkan melalui pengadilan Allah. - Mohammad Hatta",
            "Jika Allah yang menjadi tujuan, kenapa harus dikalahkan oleh rintangan-rintangan yang kecil di hadapan Allah? - Syeikh Imam Nawawi al-Bantani",
            "Tali yang paling kuat untuk tempat bergantung adalah tali pertolongan Allah. - Buya Hamka",
            "Jika mencari nafkah merupakan ibadah, semakin kerja keras kita, insyaallah semakin besar pahala yang akan diberikan oleh Allah. - Syeikh Imam Nawawi al-Bantani",
            "Satu-satunya alasan kita untuk hadir di dunia ini adalah untuk menjadi saksi atas keesaan Allah. - Buya Hamka",
            "Siapa yang mengenal dan menaati Allah, maka ia akan bahagia walaupun berada di dalam penjara yang gelap gulita. Dan siapa yang lalai dan melupakan Allah, ia akan sengsara walaupun berada di istana yang megah memesona. - Habiburrahman El Shirazy",
            "Mungkin selama ini Allah meghijabmu dari mahligai pernikahan yang loe harapkan karena maksiat loe tetap jalan. - Felix Siauw",
            "Kebaikan itu ada di lima perkara: Kekayaan hati, bersabar atas kejelekan orang lain, mengais rezeki yang halal, takwa, dan yakin akan janji Allah SWT. - Imam Syafi'i",
            "Allah tidak melihat bentuk rupa dan harta benda kalian, tapi Dia melihat hati dan amal kalian. - Nabi Muhammad SAW",
            "Bila engkau hendak memuji seseorang, pujilah Allah. Karena tiada seorang manusia pun lebih banyak dalam memberi kepadamu dan lebih santun lembut kepadamu selain Allah. - Umar bin Khattab",
            "Kemampuan merasakan nikmat sabar tergantung sejauh mana keimanan kita terhadap takdir yang Allah tetapkan. - Abdullah Gymnastiar",
            "Tetap sabar, semangat, dan tersenyum. Karena kamu sedang menimba ilmu di Universitas Kehidupan. Allah menaruhmu di tempatmu yang sekarang bukan karena kebetulan. - Dahlan Iskan",
            "Demi Allah yang jiwaku berada di tangan-Nya, seseorang tidak beriman hingga ia mencintai saudaranya sebagaimana ia mencintai dirinya sendiri"
        );

        return $kalimatBijak;
    }
}
