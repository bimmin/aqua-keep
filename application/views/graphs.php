<!doctype html>
<html>
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <title>Graphs</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url("assets/css/normalize.css");?>" rel="stylesheet" />
    <link href="<?php echo base_url("assets/css/foundation.css");?>" rel="stylesheet" />
    <link href="<?php echo base_url("assets/css/mystyle.css");?>" rel="stylesheet" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script>
      $(function() {
        $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
        $( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd'});
      });
    </script>
    <script>
      $(function () {
           $("#push_down").change(function() {
                var val = $(this).val();
                if (val == 'add_new'){
                  $("#new_type").foundation('reveal', 'open'); 
                  // $(".new_type").show();
                  $("#datepicker2").css("z-index", "9999");
           }
          
           });
          
         series = JSON.parse('<?php echo json_encode($types_array) ?>');
      
      
              $('#container').highcharts({
                  chart: {
                      type: 'spline'
                  },
                  title: {
                      text: 'Water Parameters'
                  },
                  subtitle: {
                      text: 'For '+JSON.parse('<?php echo json_encode($aquarium_name) ?>')
                  },
                  xAxis: {
                      type: 'datetime',
                      dateTimeLabelFormats: { // don't display the dummy year
                          month: '%e. %b',
                          year: '%b'
                      }
                  },
                  yAxis: {
                      title: {
                          text: 'Measurement'
                      },
                      min: 0
                  },
                  tooltip: {
                      formatter: function() {
                              return '<b>'+ this.series.name +'</b><br/>'+
                              Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' m';
                      }
                  },
                  
                  series: series
      
               });
          });
      
    </script>
  </head>
  <div class="wrapper min_height">
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
          <li><a href="<?php echo base_url("/calendar");?>">Calendar</a></li>
          <li class="divider"></li>
          <li class="has-dropdown">
            <a href="#">Show</a>
            <ul class="dropdown">
              <li><a href="<?php echo base_url("user/profile");?>">Profile</a></li>
              <li><a href="<?php echo base_url("user/graphs/".$aquarium_id."");?>">Graphs</a></li>
              <li>
                <a href="../energy/<?php echo $aquarium_id ?>">
                Energy Page</a>
              </li>
              <li><a href="<?php echo base_url("user/log/". $aquarium_id."");?>">Log</a></li>
            </ul>
          </li>
          <li class="divider"></li>
        </ul>
      </section>
    </nav>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <h1>Graphs</h1>
      <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns center">
      <h4>Add Data</h4>
    </div>
    <form action="<?php echo base_url("/user/add_data/".$aquarium_id."");?>" method="POST">
      <div class="large-4 columns center">
        <label>Water Parameter</label>
        <select name="type">
          <option></option>
          <?php foreach($types_array as $types){
            echo "<option>".$types['name']."</option>";
            } ?>
          <option value="add_new">Add new</option>
        </select>
      </div>
      <div class="large-4 columns center">
        <label>Date</label>
        <input type="text" name="date" id="datepicker">
      </div>
      <div class="large-4 columns center">
        <label>Value</label>
        <input type="text" name="value">
      </div>
      <div class="large-12 columns">
        <input type="submit" class="right" value="submit">
        <!--  <input type="hidden" name="aquarium_id" value=" <?php echo $aquarium_id; ?>"> -->
    </form>
    </div>
    <div class="clear"></div>
    <div id="footer">
      <ul>
      <li class="bdrRt">Hello <?php echo $this->session->userdata('user_session')['display_name']; ?>!</li>
      <li class="bdrRt"><a href="<?php echo base_url("/user/logout");?>">Logout</a></li>
      <li>Aqua-Keep.com, 2014</li>
      <ul>
    </div>
    <div id="new_type" class="reveal-modal small" data-reveal>
      <h2>Add Water Parameter you test for</h2>
      <p>To get started add one water test result. When you come back to the graphs page you will be able to select the type added.</p>
      <form action="<?php echo base_url("/user/add_data/".$aquarium_id."");?>" method="POST">
        <label>Type</label>
        <input type="text" name="type" placeholder="e.g. Nitrate, Phosphate, PH, etc.">
        <label>Date</label>
        <input type="text" name="date" id="datepicker2">
        <label>Test Result Value</label>
        <input type="text" name="value">
        <input type="submit" value="submit">
        <a class="close-reveal-modal">&#215;</a>
      </form>
    </div>
  </div>
  <script src="<?php echo base_url("/assets/js/foundation/foundation.js");?>"></script>
  <script src="<?php echo base_url("/assets/js/foundation/foundation.topbar.js");?>"></script>
  <script src="<?php echo base_url("/assets/js/foundation/foundation.reveal.js");?>"></script>
  <script>
    $(document).foundation();
  </script>
  </body>
</html>
