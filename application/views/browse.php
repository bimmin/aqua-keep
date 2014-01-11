<!doctype html>
<html>

<head>
<title>Browse User Aquariums</title>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link href="<?php echo base_url("assets/css/normalize.css");?>" rel="stylesheet" />
<link href="<?php echo base_url("assets/css/foundation.css");?>" rel="stylesheet" />
<link href="<?php echo base_url("assets/css/mystyle.css");?>" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
            $("#add_aquarium").on("submit", function(){
                var form = $(this);
                $.post(form.attr("action"), form.serialize(), function(html){

                  if (html['errors'] == true){
                    $("#errors").html(html['messages']);
                  }
                  else{
                    location.href='profile';
                  }
                  
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
    <nav class="top-bar" data-topbar="">
      <ul class="title-area">
        <li class="name">
        <h1>Aqua-Keep.com</h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href=""><span>Menu</span></a>
        </li>
      </ul>
      <section class="top-bar-section">
        <ul class="right">
          <li class="divider"></li>
          <li><a href="<?php echo base_url("/user/browse");?>">Browse</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url("/user/profile");?>">Profile</a></li>
          <li class="divider"></li>
          <li class="has-dropdown"><a href="#">Account</a>
          <ul class="dropdown">
            <li><a href="<?php echo base_url("/user/edit_account");?>">Edit Account</a></li>
            <li><a href="<?php echo base_url("/user/logout");?>">Logout</a></li>
          </ul>
          </li>
          <li class="divider"></li>
        </ul>
      </section>
    </nav>
  </div>
  <div class="row">
    <div class="large-12 columns">

      <h2>Browse Aquariums</h2>
      <?php
 
foreach($aquariums as $aquarium){
  echo "<div class='aquariums left'><h3>" . $aquarium['name'] . "</h3><a href='" . base_url('/user/public_aquarium/'. $aquarium['id']). "'><img class='browse_img' src='". base_url('/assets/uploads/'. $aquarium['url']) ."'></a></div>";
// var_dump($aquarium);
}

  ?>
      <div class="clear">
      </div>


      <div id="footer">
          <ul>
              <li class="bdrRt">Hello <?php echo $this->session->userdata('user_session')['display_name']; ?>!</li>
              <li class="bdrRt"><a href="<?php echo base_url("/user/logout");?>">Logout</a></li>
              <li>Aqua-Keep.com, 2014</li>
          <ul>
      </div>
    </div>
  </div>
      
    <script src="<?php echo base_url("/assets/js/foundation/foundation.js");?>"></script>
    <script src="<?php echo base_url("/assets/js/foundation/foundation.topbar.js");?>"></script>
    <script src="<?php echo base_url("/assets/js/foundation/foundation.reveal.js");?>"></script>
    <script>
       $(document).foundation();
    </script>

</div>

</div>

</body>

</html>

