<?php
// var_dump($aquarium_details);
// die;
$this->session->set_userdata('aquarium_id', $aquarium_details[0]['id']);
?>
<!doctype html>
<html>

<head>
<title>Aquarium</title>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link href="<?php echo base_url("assets/css/normalize.css");?>" rel="stylesheet" />
<link href="<?php echo base_url("assets/css/foundation.css");?>" rel="stylesheet" />
<link href="<?php echo base_url("assets/css/mystyle.css");?>" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $("#update_aquarium").on("submit", function(){
          var form = $(this);
          $.post(form.attr("action"), form.serialize(), function(data){

          		 if (data['errors'] == true){
                    $("#errors").html(data['messages']);
                  }
                  else{
                     location.href="../aquarium/"+ data['id']+"";
                  }
            // $("#errors").html(html);
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
					<li><a href="<?php echo base_url("/calendar");?>">Calendar</a></li>
					<li class="divider"></li>
					<li class="has-dropdown"><a href="#">Show</a>
					<ul class="dropdown">
						<li><a href="<?php echo base_url("user/profile");?>">Profile</a></li>
						<li><a href="<?php echo base_url("user/graphs/".$aquarium_details[0]['id']."");?>">Graphs</a></li>
						<li>
						<a href="../energy/<?php echo $aquarium_details[0]['id'] ?>">
						Energy Page</a></li>
						<li><a href="<?php echo base_url("user/log/". $aquarium_details[0]['id']."");?>">Log</a></li>
					</ul>
					</li>
					<li class="divider"></li>
					<li class="has-dropdown"><a href="#">Edit</a>
					<ul class="dropdown">
						<li><a data-reveal-id="aquariumModal" href="#">Aquarium 
						Details</a></li>
						<!-- <li><a href="../photos/<?php echo $aquarium_details->id ?>">Aquarium Photos</a></li> -->
						<li>
						<a href="../../pix/edit_pix/<?php echo $aquarium_details[0]['id'] ?>">
						Aquarium Photos</a></li>
						<li>
						<a href="../delete_aquarium/<?php echo $aquarium_details[0]['id'] ?>">
						Delete This Aquarium</a></li>
					</ul>
					</li>
					<li class="divider"></li>
				</ul>
			</section>
		</nav>
	</div>
	<div class="row">
		<?php echo "<h1>" . $aquarium_details[0]['name'] . "</h1>"; ?>
		<div class="large-6 columns">
			<div id="aquarium">
				<div class="photo_div">
					<a href="<?php echo site_url('pix/simple_photo_gallery/'. $aquarium_details[0]['id'] .'')?>">
					<img height="350" src="../../assets/uploads/<?php echo $aquarium_details[0]['url'] ?>" width="350"></a>
					<a href="<?php echo site_url('pix/simple_photo_gallery/'. $aquarium_details[0]['id'] .'')?>">Slideshow</a>
				</div>
			</div>
		</div>
		<div class="large-6 columns">
			<div id="aquarium_details">
				<h2>Aquarium Details</h2>
				<p>Size: <?php echo $aquarium_details[0]['size']. " " . $aquarium_details[0]['units'] ?>
				</p>
				<p>Inhabitants: <?php echo $aquarium_details[0]['inhabitants'] ?>
				</p>
				<p>Notes: <?php echo $aquarium_details[0]['notes'] ?></p>
			</div>
		</div>
	</div>
	<div class="horizontal_dotted_line"></div>
	<div class="row">
				<div class="large-5 columns">
					<h3>Post Comment</h3>
			<form action="../post_message/<?php echo $aquarium_details[0]['id'] ?>" method="post">
				<textarea class="textarea" name="message"></textarea>
				<input name="action" type="hidden" value="post_message">
				<input type="submit" value="submit">
			</form>
		</div>
		<div class="large-7 columns">
		<h3 class="bold">Comments</h3>
		<div id="comments">
			<?php
				foreach ($messages as $message){
					$post_time = new DateTime($message['created_at']);
					$post_time = date_format($post_time, 'l jS F Y \a\t g:ia');
					echo "<h4>" . $message['display_name'] . " posted on " . $post_time . "<h4>";
					echo "<p class='aquarium-message'>" . $message['message'] . "</p>";
				}

				?></div>

	</div>
</div>

	  <div id="footer">
          <ul>
              <li class="bdrRt">Hello <?php echo $this->session->userdata('user_session')['display_name']; ?>!</li>
              <li class="bdrRt"><a href="<?php echo base_url("/user/logout");?>">Logout</a></li>
              <li>Aqua-Keep.com, 2014</li>
          <ul>
      </div>
	<div id="aquariumModal" class="reveal-modal small" data-reveal="" data-reveal-ajax="true">
		<h1>Edit Aquarium Details</h1>
		<div id="errors">
		</div>
		<form id="update_aquarium" action="../update_aquarium/" method="POST">
			<div class="row">
				<div class="small-6 columns">
					<label>Aquarium Name</label>
					<input name="name" type="text" value="<?php echo $aquarium_details[0]['name'] ?>">
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns">
					<label>Aquarium Size</label>
					<input name="size" type="text" value="<?php echo $aquarium_details[0]['size'] ?>">
				</div>
				<div class="large-6 columns left">
					<label class="lil_top_nudge">&nbsp;</label>
		              <input checked name="units" type="radio" value="gallons"><label>Gallons</label>
		              <input name="units" type="radio" value="liters"><label>Liters</label>
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns">
					<label>Aquarium Inhabitants</label>
					<input name="inhabitants" type="text" value="<?php echo $aquarium_details[0]['inhabitants'] ?>">
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<label>Aquarium Notes</label> <textarea name="notes" class="textarea"><?php echo $aquarium_details[0]['notes'] ?></textarea>
					<input name="id" type="hidden" value="<?php echo $aquarium_details[0]['id'] ?>">
				</div>
			</div>
			<input type="submit" value="submit">
		</form>
		<a class="close-reveal-modal">×</a> </div>
</div>

</body>
</div>
<script src="<?php echo base_url("/assets/js/foundation/foundation.js");?>"></script>
<script src="<?php echo base_url("/assets/js/foundation/foundation.topbar.js");?>"></script>
<script src="<?php echo base_url("/assets/js/foundation/foundation.reveal.js");?>"></script>
<script>
    $(document).foundation();
  </script>

</body>

</html>

