
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link href=<?php echo base_url("assets/css/normalize.css");?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/foundation.css");?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/mystyle.css");?> rel="stylesheet" />
</head>
<body>
<div class="wrapper">
	
      <div class="contain-to-grid">
        <nav class="top-bar" data-topbar>
          <ul class="title-area">
              <li class="name">
               <h1>Aqua-Keep.com</h1>
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
              <li><a href="<?php echo base_url("user/profile");?>">Profile</a></li>

            
                <li class="divider"></li>
            
                </ul>
                
            
          </section>

        </nav>
      </div>

    <div class="row">
      <div class="large-12 columns">
      <h1>Aquarium Log</h1>
      <h4>Add a New Entry</h4>
      <form action="../add_log_event/<?php echo $aquarium_id ?>" method="POST">
        <textarea class="textarea" name="text"></textarea>
        <input class="right" type="submit" value="submit">
      </form>
      </div>
      </div>
      <div class="row">
      <div class="large-12 columns">
        <?php foreach($log as $entry){
          echo "<p class='log-text'>". $entry['text'] . "</p>";
          echo "<p class='log_date'> Posted on ". $entry['date'] . "</p>";
          echo "<div class='horizontal_dotted_line'></div>";
        } ?>

      </div>
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
<script src="/assets/js/foundation/foundation.js"></script>
<script src="/assets/js/foundation/foundation.topbar.js"></script>


 <script>
    $(document).foundation();
  </script>

  </body>

</html>