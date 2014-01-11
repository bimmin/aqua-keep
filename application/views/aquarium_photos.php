
<?php 
	foreach($aquarium_pix as $pic){
		echo "<div class='aquarium_photos'>" .
			 "<img src ='" . $pic['url'] ."'><br>" .
			 "<a class='tiny button left' href='#'>Set as Default</a>" .
			 "<a class='tiny button right' href='pix/delete_photo/". $pic['id'] ."'>Delete Image</a></div>";
	}
 ?>

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