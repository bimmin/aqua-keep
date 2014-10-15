<!doctype html>
<html>
  <head>
    <title>Privacy Policy</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/css/normalize.css" rel="stylesheet" />
    <link href="../../assets/css/foundation.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/mystyle.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#login").on("submit", function(){
            var form = $(this);
            $.post(form.attr("action"), form.serialize(), function(data){
      
              if (data['errors'] == true){
                      $("#errors").html(data['messages']);
                    }
                    else{
                       location.href="../user/profile";
                    }
            }, "json");
        return false;
        });
      
        $("#register").on("submit", function(){
            var form = $(this);
            $.post(form.attr("action"), form.serialize(), function(html){
      
              // console.log(html);
              $("#errors").html(html);
            }, "json");
        return false;
        });
      
      });
    </script>
  </head>
  <body>
    <div class="wrapper">
      <div class="contain-to-grid">
        <nav class="top-bar" data-topbar>
          <ul class="title-area">
            <li class="name">
              <h1><a href="<?php echo base_url();?>">Aqua-Keep.com</a></h1>
            </li>
            <li class="toggle-topbar menu-icon">
              <a href=""><span>Menu</span></a>
            </li>
          </ul>
          </section>
        </nav>
      </div>
      <div class="row">
        <div class="large-12 columns">
          <h3>Privacy is my policy!</h3>
          <p>When you register for an account on aqua-keep.com we ask only for an email address, password and display name. Your email address will be used to login to the website but is not used for any other purposes. Your email address will not dispaly anywhere on this website and we will not share or sell your email address. We do not ask for your name or any other personal informaion. You may use your real name on aqua-keep.com but will never require you to. Any info, including photos and comments made on an aquarium page are availble for public viewing. Enjoy the site!</p>
          <p class="text-center"><img src="<?php echo base_url("/assets/img/clownfish.jpg");?>"></p>
        </div>
      </div>
      <footer class="row">
        <div class="large-12 columns">
          <hr />
          <div class="row">
            <div class="large-6 columns">
              <p>&copy; 2014 Aqua-Keep.com</p>
            </div>
            <div class="large-6 columns">
              <ul class="inline-list right">
                <li><a href="#" data-reveal-id="myModal">Login</a></li>
                <li><a href="<?php echo base_url("/user/about");?>">About</a></li>
                <li><a href="<?php echo base_url("/user/privacy");?>">Privacy</a></li>
                <li><a href="<?php echo base_url("/user/contact");?>">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <div data-reveal-ajax="true" id="myModal" class="reveal-modal small" data-reveal>
      <div id="errors"></div>
      <h3>Already have an account? Login here:</h3>
      <form id="login" action="/user/process_login" method="post">
        <!--  <input type="hidden" name="action" value="login" /> -->
        <input type="text" name="email" placeholder="Email address" />
        <input type="password" name="password" placeholder="Password" />
        <input type="submit" value="Login" />
      </form>
      <h3>Create a new account</h3>
      <form id="register" action="/user/process_registration" method="post">
        <input type="hidden" name="action" value="register" />
        <input type="text" name="display_name" placeholder="Display Name" /><br />
        <input type="text" name="email" placeholder="Email address" /><br />
        <input type="password" name="password" placeholder="Password" /><br />
        <input type="password" name="confirm_password" placeholder="Confirm Password" /><br />
        <input type="submit" value="Register" />
      </form>
      <a class="close-reveal-modal">×</a>
    </div>
    <script src="/assets/js/foundation/foundation.js"></script>
    <script src="/assets/js/foundation/foundation.topbar.js"></script>
    <script src="/assets/js/foundation/foundation.reveal.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
