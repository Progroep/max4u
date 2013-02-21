<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Max4U | Eerlijk besparen</title>
        
        <meta name="viewport" content="width=device-width">


<!--_____  ____  _    ___          ________  _____ _______       _____  
  / ____|/ __ \| |  | \ \        / /  ____|/ ____|__   __|/\   |  __ \ 
 | |  __| |  | | |  | |\ \  /\  / /| |__  | (___    | |  /  \  | |  | |
 | | |_ | |  | | |  | | \ \/  \/ / |  __|  \___ \   | | / /\ \ | |  | |
 | |__| | |__| | |__| |  \  /\  /  | |____ ____) |  | |/ ____ \| |__| |
  \_____|\____/ \____/    \/  \/   |______|_____/   |_/_/    \_\_____/ 
                                                              
      |\/|  _. ._ |   _ _|_ o ._   _    ()    |\/|  _   _| o  _. 
      |  | (_| |  |< (/_ |_ | | | (_|   (_X   |  | (/_ (_| | (_| 
                                   _|                            
                          © www.gouwestadmm.nl
-->

    
  <script src="http://progroep.github.com/max4u/js/vendor/jquery-1.8.2.min.js"></script>
        <link rel="stylesheet" href="less/style.css">

  <!--<link rel="stylesheet/less" href="less/style.less">
  <script src="http://progroep.github.com/max4u/js/libs/less-1.3.0.min.js"></script>-->

  <!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,800,700,600,300' rel='stylesheet' type='text/css'>

   <script src="http://progroep.github.com/max4u/js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>

</head>

<body >

 <!-- NAVBAR
    ================================================== -->
    <!-- Wrap the .navbar in .container to center it on the page and provide easy way to target it with .navbar-wrapper. -->
    <div class="container">
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
          <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.html"><img src="img/logo.png"/></a>
          <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
          <div class="nav-collapse collapse">
            <ul class="nav pull-right">
              <li class="active"><a href="index.html">Home</a></li>
               <li><a href="bespaarconcept.html">Ons bespaarconcept</a></li>
              <li><a href="bespaarconcept.html#wie">Over ons</a></li>
              <li><a href="faq.html">Veelgestelde vragen</a></li>
          
              <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              <li>
                <a href="contact.php">Contact</a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
        </div><!-- /.navbar-inner -->
      </div><!-- /.navbar -->
    </div><!-- /.container -->



<div class="contact-header">
</div>

<section class="contact">
<div class="container">
    <div class="row-fluid">
        <div class="span8">
         <?php
                   //init variables
                   $cf = array();
                   $sr = false;
            
                   if(isset($_SESSION['cf_returndata'])){
                     $cf = $_SESSION['cf_returndata'];
                     $sr = true;
                   }
            ?>

            <!-- Error & succes displays above the form -->
            <div id="errors" class="alert alert-error <?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                      <a class="close" data-dismiss="alert">×</a>

              <ul>
                <li id="info">Er zijn problemen met het door u ingevulde formulier:</li>

                <?php 
                        if(isset($cf['errors']) && count($cf['errors']) > 0) :
                           foreach($cf['errors'] as $error) :
                        ?>
                <li><?php echo $error ?></li>
                <?php
                           endforeach;
                          endif;
                        ?>
              </ul>
            </div>

            <div id="success" class="alert alert-success <?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">
                      <a class="close" data-dismiss="alert">×</a>
                <p>Bedankt voor uw bericht. U hoort z.s.m. van ons.</p>
            </div>


            <form method="post" action="process.php" class="form-horizontal">
                <legend>Contact formulier</legend>
                <fieldset>
                    <div class="control-group">
                        <label for="name" class="control-label">Uw naam: <span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" id="name" name="name" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['name'] : '' ?>" placeholder="Naam" required autofocus />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="email" class="control-label">Emailadres: <span class="required">*</span></label>
                        <div class="controls">
                            <input type="email" id="email" name="email" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['email'] : '' ?>" placeholder="voorbeeld@gmail.com" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="telephone" class="control-label">Telefoon: </label>
                        <div class="controls">
                            <input type="tel" id="telephone" name="telephone" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['telephone'] : '' ?>" />
                        </div>
                    </div>
                    <div class="control-group">                
                        <label for="message" class="control-label">Bericht: <span class="required">*</span></label>
                        <div class="controls">
                            <textarea id="message" name="message" placeholder="Uw bericht moet minimaal 20 tekens bevatten" required data-minlength="20"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?></textarea>
                        </div>
                    </div>
                <span id="loading"></span>
                <input type="submit" value="Verstuur" id="submit-button" class="btn btn-primary btn-large" />
                <p id="req-field-desc"><span class="required">*</span> Vereist veld</p>
                </fieldset>
            </form>
            <?php unset($_SESSION['cf_returndata']); ?>
           
     </div>
     <div class="span4">
         <address>
                  <strong>Max4U</strong><br>
                  Koraalrood 153<br>
                  2718 SB Zoetermeer<br>
                  <abbr title="Telefoon">T:</abbr> 079 -316 16 66
                </address>
                 
                <address>
                  <strong>Email</strong><br>
                  <a href="mailto:#">info@max4u.nl</a>
                </address>
        </div>
    </div>
</div>
</section>


 

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <div class="row-fluid">
        <div class="span12">
          <p class="pull-right"><a href="#">Back to top</a></p>
          <p>&copy; 2013 Max4U | Max4u is een onderdeel van Second Opinion BV | AFM nr 12012455</p>
        </div>
      </div>
    </div>
  </footer>




  <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="http://progroep.github.com/max4u/js/vendor/jquery-1.8.2.min.js"><\/script>')</script> -->

    <script src="http://progroep.github.com/max4u/js/main.js"></script>
   

    <script src="http://progroep.github.com/max4u/js/vendor/responsiveslides.min.js"></script>
    <link rel="stylesheet" href="http://progroep.github.com/max4u/js/vendor/responsiveslides.css" />
        <script>
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        speed: 1800,
        nav: true,
        prevText: "",
        nextText: ""
      });
      
    });
  </script>

      
        <script src="js/vendor/jquery.stellar.min.js"></script>
        <script src="js/vendor/waypoints.min.js"></script>
        <script src="js/vendor/jquery.easing.1.3.js"></script>
        <script src="http://progroep.github.com/max4u/js/vendor/bootstrap.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38678896-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!--[if lt IE 7 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
  <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
