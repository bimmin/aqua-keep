<!doctype html>
<html>
  <head>
    <title>Contact- Aqua-Keep.com</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="/assets/css/foundation.css" rel="stylesheet">
    <link href="/assets/css/mystyle.css" rel="stylesheet">
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
              // $("#errors").html(html);
            }, "json");
        return false;
        });
      
        $("#register").on("submit", function(){
            var form = $(this);
            $.post(form.attr("action"), form.serialize(), function(html){
              $("#errors").html(html);
            }, "json");
        return false;
        });
      
      });
    </script>
  </head>
  <body>
    <div class="wrapper">
    <div class="row">
      <div class="large-12 columns">
        <div class="contain-to-grid">
          <nav class="top-bar">
            <ul class="title-area">
              <li class="name">
                <h1><a href="<?php echo base_url();?>">Aqua-Keep.com</a></h1>
              </li>
              <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a>
              </li>
            </ul>
            <section class="top-bar-section">
              <ul class="right">
                <li class="active">
                  <a href="<?php echo base_url("/user/about");?>">About</a>
                </li>
                <li><a data-reveal-id="myModal" href="#">Get Started</a></li>
                <li><a data-reveal-id="myModal" href="#">Login</a></li>
              </ul>
            </section>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="large-12 columns">
          <h1>Contact</h1>
          <div class="row">
            <div class="large-12 columns">
              <p>I created aqua-keep.com as a way to learn programing. I am continuing to make changes to this site and add new features. If you have any questions or comments please send me an email by filling out the form below:</p>
              <p>I look forward to hearing from you!</p>
              <p>David Ethier</p>
              <form action="../form_contact.php" id="contactform" method="post" name=
                "contactform">
                <div class="row">
                  <div class="large-6 columns">
                    <label for="first_name">Name <input maxlength="50" name=
                      "first_name" type="text"></label> 
                    <label for="email">Email
                    Address <input maxlength="80" name="email" type="text"></label>
                    <label for="comments">Questions/Comments 
                    <textarea maxlength="1000" name="comments" id="contact_textarea">
                    </textarea></label> 
                    <a class="button" onclick=
                      "$(this).parents('form').submit();">Send</a>
                  </div>
                  <div class="large-6 right">
                    <img src="<?php echo base_url("/assets/img/David-Ethier.jpg");?>">
                    <p>Showing off Aqua-Keep at CodingDojo Demo Day</p>
                  </div>
                </div>
              </form>
            </div>
          </div>
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
    <div id="myModal" class="reveal-modal small" data-reveal="" data-reveal-ajax="true">
      <div id="errors">
      </div>
      <h3>Already have an account? Login here:</h3>
      <form id="login" action="<?php echo base_url("/user/process_login");?>" method="post">
        <input type="text" name="email" placeholder="Email address" />
        <input type="password" name="password" placeholder="Password" />
        <input type="submit" value="Login" />
      </form>
      <h3>Create a new account</h3>
      <form id="register" action="/user/process_registration" method="post">
        <input name="action" type="hidden" value="register" />
        <input name="display_name" placeholder="Display Name" type="text" /><br />
        <input name="email" placeholder="Email address" type="text" /><br />
        <input name="password" placeholder="Password" type="password" /><br />
        <input name="confirm_password" placeholder="Confirm Password" type="password" /><br />
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
