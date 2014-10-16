<!doctype html>
<html>
  <head>
    <title>Energy Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=<?php echo base_url("assets/css/normalize.css");?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/foundation.css");?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/mystyle.css");?> rel="stylesheet" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
            $("#add_device").on("submit", function(){
                var form = $(this);
                $.post(form.attr("action"), form.serialize(), function(html){
      
                if (html['errors'] == true){
                    $("#errors").html(html['messages']);
                  }
                  else{
                    location.href='../energy/'+html['aquarium_id'];
                  }
      
                }, "json");
            return false;
            });
      
            $("#kWh").change(function(){
                var new_kWh = $(this).val();
                console.log(new_kWh);
      
                $.post(
                      "../change_kWh/"+<?php echo $aquarium_id?>,
                      {
                        kWh_cost: new_kWh,
                      },
                      function(msg){
                        window.location.reload();
                    },
                    "json");
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
            <h1><a href="index.html">Aqua-Keep.com</a></h1>
          </li>
          <li class="toggle-topbar menu-icon">
            <a href=""><span>Menu</span></a>
          </li>
        </ul>
        <section class="top-bar-section">
          <ul class="right">
            <li class="divider"></li>
            <li><a href="<?php echo base_url("/calendar");?>">Calendar</a></li>
            <li class="divider"></li>
            <li class="has-dropdown">
              <a href="#">Show</a>
              <ul class="dropdown">
                <li><a href="../profile">Profile</a></li>
                <li><a href="<?php echo base_url("user/graphs/".$aquarium_id."");?>">Graphs</a></li>
                <li><a href="<?php echo base_url("user/log/". $aquarium_id."");?>">Log</a></li>
              </ul>
            </li>
            <li class="divider"></li>
            <li class="has-dropdown">
              <a href="#">Edit</a>
              <ul class="dropdown">
                <li><a href="#">Devices</a></li>
              </ul>
            </li>
            <li class="divider"></li>
          </ul>
        </section>
      </nav>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <h1><?php echo $aquarium_name; ?> Energy Page</h1>
        <?php 
          $total_cost = 0;
          $kWh_cost = $kWh[0]['kWh_cost'] * .01;
          
          // $kWh = $this->input->post('kWh');
          if (count($devices) > 0){
            echo "<div class='left'><table id='devices-table'>" .
                      "<tr>" .
                         " <th>Device Name</th>" .
                          "<th>Device Wattage</th>" .
                          "<th>Hours on per day</th>" .
                          "<th>Remove Device</th>" .
                      "</tr>";
          
              foreach ($devices as $device) {
                echo "<tr><td>".$device['name']."</td><td>".$device['watts']."</td><td>".$device['hours_on_per_day']."</td><td><a href='../delete_device/".$device['id']."/".$aquarium_id."'>X</a></td></tr>";
                $device_kW = $device['watts'] / 1000;
                $energy = $device_kW * $device['hours_on_per_day'];
                $cost = $energy * $kWh_cost;
                $total_cost += $cost;
              }
              echo "</table></div>";
          }
          else{
              echo "<p>You have not added any of your aquarium devices yet. Please click the button below to get started.</p>";
          }
          ?>
        <?php
          if($total_cost>0){
              echo "<div id ='energy_box'>";
              echo "<p>Cost per day:</p><p class='energy_money'> $" . round($total_cost, 2) . "<p>";
              echo "<p>Cost per year:</p><p class='energy_money'> $" . round($total_cost*365, 2) . "<p>";
              echo "<form action='../change_kWh/".$aquarium_id."' method='POST'><label>kWh Cost (Click to Edit)</label><input name='kWh' id='kWh' type='text' value='".$kWh[0]['kWh_cost']."'><a href='#' class='button postfix set'>Set</a></form>";
              echo "</div>";
          }
          ?>
        <div class="clear"></div>
        <a href="#" data-reveal-id="addDeviceModal" class="button">Add Device</a>
        <div id="footer">
          <ul>
          <li class="bdrRt">Hello <?php echo $this->session->userdata('user_session')['display_name']; ?>!</li>
          <li class="bdrRt"><a href="<?php echo base_url("/user/logout");?>">Logout</a></li>
          <li>Aqua-Keep.com, 2014</li>
          <ul>
        </div>
        <div data-reveal-ajax="true" id="addDeviceModal" class="reveal-modal small" data-reveal>
          <h1>Add an Aquarium Device</h1>
          <div id="errors"></div>
          <form id="add_device" action="../add_device" method="POST">
            <div class="row">
              <div class="small-12 columns">
                <label>Device Name</label>
                <input type="text" name="name">
              </div>
            </div>
            <div class="row">
              <div class="small-3 columns">
                <label>Wattage of Device</label>
                <input type="text" name="watts">
              </div>
              <div class="small-3 columns left">
                <label>Hours of use per day</label>
                <input type="text" name="hours_on_per_day">
              </div>
              <div class="clear"> 
                <input type="hidden" name="aquarium_id" value="<?php echo $aquarium_id; ?>">
                <input type="submit" value="Add">
              </div>
          </form>
          </div>
          <a class="close-reveal-modal">×</a>
        </div>
        <script src="../../assets/js/foundation/foundation.js"></script>
        <script src="../../assets/js/foundation/foundation.topbar.js"></script>
        <script src="../../assets/js/foundation/foundation.reveal.js"></script>
        <script>
          $(document).foundation();
        </script>
      </div>
    </div>
  </body>
</html>
