<!doctype html>
<html>

<head>
<title>About- Aqua-Keep.com</title>
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
  <div class="row">
    <!--  <div class="large-3 columns">
      <h1>Aqua-Keep.com</h1>
    </div> -->
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
                <li class="divider"></li>
                <li class="active"><a href="<?php echo base_url("/user/about");?>">About</a></li>
                <li class="divider"></li>
                <li><a href="#" data-reveal-id="myModal">Get Started</a></li>
                <li class="divider"></li>
                <li><a href="#" data-reveal-id="myModal">Login</a></li>
                <li class="divider"></li>
            </ul>
          </section>
        </nav>
      </div>
      <h1>About</h1>
      <div class="row">
        <div class="large-4 columns">
          <img class="top_nudge" src="/assets/img/devices.png"> </div>
        <div class="large-8 columns">
          <h4>Welcome to Aqua-Keep.com</h4>
          <div class="row">
            <div class="large-12 columns">
              <p>Aqua-keep.com is a website designed to help you with 
              aquarium maintenance. Create a profile for your aquarium 
              and set up tasks for the types of maintenance you do 
              on your aquarium. The system will remind you when a 
              certain task needs to be done. Forget the last time 
              you changed the filter media? Aqua-keep will serve as 
              log so you know exactly what needs to be done and when.</p>
              <p>Aqua-keep was started as a project by the creator 
              to learn web development. If there is a feature you 
              would like to see in a future version of Aqua-Keep.com 
              please <a href="mailto:info@aqua-keep.com">email me</a>.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="large-8 columns">
          <h4>Additional Features</h4>
          <p>Aqua-Keep allows you to add you aquarium equipment such as 
          filter, lights and heaters. The system wil calculate how much 
          money you spend over time on electricty. If you are concidering 
          a new lighitng system you can put the new light in Aqua-Keep 
          to find out the difference it will cost you in your electric 
          bill.</p>
          <p>When you test your aquarium water you can store the information 
          in Aqua-Keep.com The system will graph this iformation for you 
          overtime. This can be helpful when something changes in your 
          tank such as an algea outbreak. You can review your water parameters 
          and see what has changed.</p>
        </div>
        <div class="large-4 columns">
          <img src="/assets/img/chart.jpg"> </div>
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

