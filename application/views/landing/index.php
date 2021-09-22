<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="RKG DIGITAL INDONESIA" />
    <meta name="author" content="RKG DIGITAL INDONESIA" />
    <meta property="og:site_name" content="RKG DIGITAL INDONESIA">
    <meta property="og:type" content="website">
    <meta property="og:title" content="RKG DIGITAL INDONESIA">
    <title>RKG DIGITAL INDONESIA</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url() . 'uploads/logo/LOGO.png' ?>">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <link href="<?php echo base_url() ?>front/css/styles.css" rel="stylesheet" />
    <script src="<?= base_url("js/vue/qs.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("js/vue/vue.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("js/vue/axios.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("js/vue/accounting.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("js/vue/vue-numeric.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("js/lodash.min.js") ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= base_url("js/moment.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("js/daterangepicker.min.js") ?>"></script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="<?php echo base_url() . 'uploads/logo/LOGO.png' ?>" style="" alt="..." /> RKG Digital Indonesia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#page-top" style="text-shadow: 1px 1px 1px black;">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team" style="text-shadow: 1px 1px 1px black;">Team</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact" style="text-shadow: 1px 1px 1px black;">Kontak Kami</a></li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading" style="text-shadow: 1px 1px 1px black;">SELAMAT DATANG DI RKG DIGITAL INDONESIA</div>
            <div class="masthead-heading text-uppercase" style="text-shadow: 1px 1px 1px black;">SEHAT BERSAMA KAMI</div>
            <a class="btn btn-light btn-md text-uppercase" style="box-shadow: 1px 1px 1px black;" href="<?=$login_button?>"> <img src="<?php echo base_url('uploads/google button.png')?>" width="40px" alt=""> Daftar atau Masuk </a>

        </div>
    </header>
    
    <!-- Team-->
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Team Kami</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row">
                <div class="col-lg-4" v-for="(tm,index) of teams">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" v-bind:src="'<?php echo base_url('uploads/user_image/') ?>'+ tm.foto" alt="..." />
                        <h4>{{tm.nama}}</h4>
                        <p class="text-muted">{{tm.jabatan}}</p>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo base_url() ?>uploads/logo/LOGO.png" alt="" width="40%">
                    <br>
                    <h5 style="color: white;text-shadow: 1px 1px 1px black;">RKG DIGITAL INDONESIA</h5>
                </div>

                <div class="col-md-6">
                    <h4 style="color: white;text-shadow: 1px 1px 1px black;">Kontak Kami</h5>
                        <p style="color: white;text-shadow: 1px 1px 1px black;">Kantor RKG Digital Indonesia
                            Satu Atap Surabaya Coworking Space
                            Jl. Pacar No.2, Ketabang, Kecamatan Genteng, Kota Surabaya, Jawa Timur 60272</p>
                        <p style="color: white;text-shadow: 1px 1px 1px black;">+623133100711 <br>
                            @rkg_digital
                            <br>
                            rkg.digital
                            <br>
                            kantor@rkg.digital
                        </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->

    <footer class="footer py-4">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12 text-lg-center">Copyright &copy; 2021 RKG DIGITAL INDONESIA. ALL RIGHT RESERVED</div>
               
            </div>
        </div>
    </footer>
    <?php $this->load->view('landing/modal_register') ?>
    <?php $this->load->view('landing/login') ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo base_url() ?>front/js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * * -->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script>
    <?php $gambar = $this->db->get('team')->result() ?>
    var carousels = new Vue({
        el: '#team',
        data: {
            teams: <?php echo json_encode($gambar) ?>,
        }
    });

</script>

</body>

</html>