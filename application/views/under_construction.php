<!doctype html>

<html>

  <head>
    <title>Calendar</title>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../../assets/css/normalize.css" rel="stylesheet" />
	<link href="../../assets/css/foundation.css" rel="stylesheet" />
	<link rel="stylesheet" href="../../assets/css/mystyle.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
      <img src="<?php echo base_url("/assets/img/goldiUnderConstruction.jpg");?>">
      <p>Check back soon!</p>
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



<script src="/assets/js/foundation/foundation.js"></script>
<script src="/assets/js/foundation/foundation.topbar.js"></script>


 <script>
    $(document).foundation();
  </script>

  </body>

</html>