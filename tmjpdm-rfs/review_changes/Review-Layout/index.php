<?php
//function to find the wp-config file.
function base_dir() {
  $config_path = dirname(__FILE__);

  while (true) {
    if (file_exists($config_path."\wp-config.php")) {
      return $config_path."\wp-config.php";
    }
    $config_path = dirname($config_path);
  }
}
//To run the wp-config in this content
include_once(base_dir());

//To know if the plugin in network active is activated
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
// Check if plugin is activated
if(in_array('font-conversion/font-conversion.php', apply_filters('active_plugins', get_option('active_plugins')))  || is_plugin_active_for_network( 'font-conversion/font-conversion.php' )){
  $fonts_db = get_option('font_settings');
  if (!empty($fonts_db['font_class'])) {
    $class = esc_html($fonts_db['font_class']);
  }else {
    $class = '';
  }

  //For Displaying class condition
  for ($i=1; $i <= 6; $i++) {
    ${'class_'.$i} = $class;

    if (!empty(${'class_'.$i})) {
      ${'class_'.$i} = " & Class : ".$class."-$i";
    }else {
      ${'class_'.$i} = "";
    }
  }

// Review Layout HTML
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Font-size Conversion Review Layout</title>
  <meta name="description">
  <meta name="keywords">
  <meta name="author" content="TMJP Digital Marketing">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=home_url('/wp-content/plugins/font-conversion/assets/style.php'); ?>">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-10 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="index.html">Lorem<span>.</span></a></h1>

          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li class="active"><a href="#header">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#services">Services</a></li>
              <!-- <li><a href="#faq">FAQ</a></li> -->
              <li><a href="#team">Team</a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="#about" class="get-started-btn scrollto">Get Started</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= Masthead Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container-fluid" data-aos="zoom-out" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="row">
            <div class="col-xl-5">
              <h1 data-toggle="tooltip" title="Tag : H1<?=$class_1?>"><span class=" <?=$class_1?>">Lorem ipsum dolor sit amet.</span> </h1>
              <h3 data-toggle="tooltip" title="Tag : H1<?=$class_3?>"><span class=" <?=$class_3;?>">Nunc porttitor quam vitae ligula commodo lobortis. Etiam dignissim felis nisi.</span> </h3>
              <a href="#about" class=" btn-get-started scrollto <?=$class_5?>" data-toggle="tooltip" title="Tag : button<?=$class_5?>">Get Started</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section><!-- End Masthead -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about ">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2 data-toggle="tooltip" title="Tag : H2<?=$class_2?>"><span class="<?=$class_2?>">About</span></h2>
          <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo lorem vel magna hendrerit gravida. Nunc porttitor quam vitae ligula commodo lobortis.</span></p>
        </div>

        <div class="row no-gutters">
          <div class="content col-xl-5 d-flex align-items-stretch">
            <div class="content">
              <h3 data-toggle="tooltip" title="Tag : H3<?=$class_3?>"><span class="<?=$class_3?>">Lorem ipsum dolor sit amet</span></h3>
              <p data-toggle="tooltip" title="Tag : P<?=$class_6?>">
                <span class="<?=$class_6?>">Quisque at accumsan felis. Duis eget consequat quam. Sed fringilla quis ex quis rhoncus. Sed iaculis interdum efficitur. Cras et libero vulputate, euismod nisl ac, aliquet neque.</span>
              </p>
              <a href="#" class=" about-btn <?=$class_5?>" data-toggle="tooltip" title="Tag : button<?=$class_5?>" style="color:#000000;"><span>About us</span> <i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
          <div class="col-xl-7 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-receipt"></i>
                  <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><span class="<?=$class_4?>" >Lorem ipsum dolor sit amet</span> </h4>
                  <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>" >Aliquam tincidunt sem malesuada enim bibendum consectetur. Mauris finibus justo sed cursus laoreet.</span> </p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-cube-alt"></i>
                  <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><span class="<?=$class_4?>" >Lorem ipsum dolor sit amet</span> </h4>
                  <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>" >Aliquam tincidunt sem malesuada enim bibendum consectetur. Mauris finibus justo sed cursus laoreet.</span> </p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-images"></i>
                  <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><span class="<?=$class_4?>" >Lorem ipsum dolor sit amet</span> </h4>
                  <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>" >Aliquam tincidunt sem malesuada enim bibendum consectetur. Mauris finibus justo sed cursus laoreet.</span> </p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-shield"></i>
                  <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><span class="<?=$class_4?>" >Lorem ipsum dolor sit amet</span> </h4>
                  <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>" >Aliquam tincidunt sem malesuada enim bibendum consectetur. Mauris finibus justo sed cursus laoreet.</span> </p>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 data-toggle="tooltip" title="Tag : H2<?=$class_2?>"><span class="<?=$class_2?>" >Services</span> </h2>
          <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo lorem vel magna hendrerit gravida. Nunc porttitor quam vitae ligula commodo lobortis.</span> </p>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <i class="icofont-computer"></i>
              <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><a href="#"><span class=" <?=$class_4?>">Lorem Ipsum</span> </a></h4>
              <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo lorem vel magna hendrerit gravida.</span> </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <i class="icofont-chart-bar-graph"></i>
              <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><a href="#"><span class=" <?=$class_4?>">Lorem Ipsum</span> </a></h4>
              <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo lorem vel magna hendrerit gravida.</span> </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <i class="icofont-image"></i>
              <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><a href="#"><span class=" <?=$class_4?>">Lorem Ipsum</span> </a></h4>
              <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo lorem vel magna hendrerit gravida.</span> </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <i class="icofont-settings"></i>
              <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><a href="#"><span class=" <?=$class_4?>">Lorem Ipsum</span> </a></h4>
              <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo lorem vel magna hendrerit gravida.</span> </p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 data-toggle="tooltip" title="Tag : H2<?=$class_2?>"><span class="<?=$class_2?>" >Our Team</span> </h2>
          <p data-toggle="tooltip" title="Tag : P<?=$class_6?>"><span class="<?=$class_6?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo lorem vel magna hendrerit gravida. Nunc porttitor quam vitae ligula commodo lobortis.</span> </p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="text-center member-info">
                <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><data class=" <?=$class_4?>">Walter White</data></h4>
                <span data-toggle="tooltip" title="Tag : SPAN<?=$class_6?>"><span  class=" <?=$class_6?>">Chief Executive Officer</span></span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="text-center member-info">
                <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><data class=" <?=$class_4?>">Sarah Jhonson</data></h4>
                <span data-toggle="tooltip" title="Tag : SPAN<?=$class_6?>"><span  class=" <?=$class_6?>">Product Manager</span> </span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="text-center member-info">
                <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><data class=" <?=$class_4?>">William Anderson</data> </h4>
                <span data-toggle="tooltip" title="Tag : SPAN<?=$class_6?>"><span  class=" <?=$class_6?>">CTO</span> </span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="text-center member-info">
                <h4 data-toggle="tooltip" title="Tag : H4<?=$class_4?>"><data class=" <?=$class_4?>">Amanda Jepson</data> </h4>
                <span data-toggle="tooltip" title="Tag : SPAN<?=$class_6?>"><span  class=" <?=$class_6?>">Accountant</span> </span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>lorem<span>.</span></h3>
            <p>
              Lorem Ipsum Street <br>
              Manila, <br>
              Philippines <br><br>
              <strong>Phone:</strong> +639 - 1234 - 5678<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Duis tristique sed elit vitae ultrices duis accumsan elit justo eget congue enim dignissim sit amet.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Lorem</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">LoremIpsum</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php }else {
  // Empty output for deactivated plugin...
} ?>
