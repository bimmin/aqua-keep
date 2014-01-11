<!doctype html>
<html>

<head>
<title>Profile Page</title>
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
          <li><a href="<?php echo base_url("/calendar");?>">Calendar</a></li>
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

      <h2>My Aquariums</h2>
      <?php
 
foreach($aquariums as $aquarium){
  echo "<div class='aquariums left'><h3>" . $aquarium['name'] . "</h3><a href='" . base_url('/user/aquarium/'. $aquarium['id']). "'><img width='300' src='". base_url('/assets/uploads/'. $aquarium['url']) ."'></a></div>";
// var_dump($aquarium);
}

  ?>
      <div class="clear">
      </div>

      <a class="button" data-reveal-id="addAquariumModal" href="#">Add Aquarium</a>

      <div id="footer">
          <ul>
              <li class="bdrRt">Hello <?php echo $this->session->userdata('user_session')['display_name']; ?>!</li>
              <li class="bdrRt"><a href="<?php echo base_url("/user/logout");?>">Logout</a></li>
              <li>Aqua-Keep.com, 2014</li>
          <ul>
      </div>
      <div id="addAquariumModal" class="reveal-modal small" data-reveal="" data-reveal-ajax="true">
        <h1>Add a New Aquarium</h1>
        <div id="errors">
        </div>
        <form id="add_aquarium" action="add_aquarium/" method="POST">
          <div class="row">
            <div class="small-6 columns">
              <label>Aquarium Name</label>
              <input name="name" type="text"> </div>
          </div>
          <div class="row">
            <div class="small-2 columns">
              <label>Aquarium Size</label>
              <input name="size" type="text"> </div>
            <div class="small-10 columns">
              <label class="lil_top_nudge">&nbsp;</label>
              <input checked name="units" type="radio" value="gallons"><label>Gallons</label>
              <input name="units" type="radio" value="liters"><label>Liters</label>
            </div>
          </div>
          <div class="row">
            <div class="small-6 columns">
              <label>Aquarium Inhabitants</label>
              <input id="inhabitants" name="inhabitants" type="text" placeholder="e.g. 2 Angelfish, 6 Cardinal Tetras, Hairgrass">
            </div>
          </div>
          <div class="row">
            <div class="small-12 columns">
              <label>Aquarium Notes</label> <textarea class="textarea" name="notes"></textarea>
              <input name="user_id" type="hidden" value="<?php echo $logged_in_user?>">
            </div>
          </div>
          <input type="submit" value="submit">
        </form>
        <a class="close-reveal-modal">×</a> </div>
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

