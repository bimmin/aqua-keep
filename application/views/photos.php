<!doctype html>

<html>

  <head>
    <title>A blank HTML5 page</title>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../../assets/css/normalize.css" rel="stylesheet" />
	<link href="../../assets/css/foundation.css" rel="stylesheet" />
	<link rel="stylesheet" href="../../assets/css/mystyle.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
  </head>

  <body>

<div class="wrapper">
  <div class="row">
    <div class="large-12 columns">
	
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
            	<li><a href="#">Calendar</a></li>
                <li class="divider"></li>
               	<li class="has-dropdown">
                	<a href="#">Show</a>
                	<ul class="dropdown">
                		<li><a href="#">Graphs</a></li>
                		<li><a href="#">Energy Page</a></li>
                		<li><a href="#">Log</a></li>
                	</ul>
                </li>
            
                <li class="divider"></li>
            
                <li class="has-dropdown">
                	<a href="#">Edit</a>
                	<ul class="dropdown">
                		<li><a href="#" data-reveal-id="aquariumModal">Aquarium Details</a></li>
                		<li><a href="#">Aquarium Photos</a></li>
                	</ul>
                </li>
                <li class="divider"></li>
                </ul>
                
            
          </section>

        </nav>
      </div>



      <div class="row">
        <div class="large-12 columns">
          <h1>Edit Aquarium Photos</h1>
          <?php echo $error;?>
<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
        </div>
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