<!doctype html>

<html>

  <head>
    <title>Calendar</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href=<?php echo base_url("assets/css/normalize.css");?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/foundation.css");?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/mystyle.css");?> rel="stylesheet" />

  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script>
    $(document).ready(function(){

        $("#recurring").hide();


        function get_date(){
          var selected_day = $.trim($('.selected').text());

          if(selected_day.length>2){
            selected_day = $.trim($('.selected > .days').text());
          }

          var year_month = $("th.title").text();

          var space = new RegExp("\\s+");
          year_month = year_month.split(space);
            // console.log("The event added is" + event_input);
          month = year_month[0];
          switch(month)
          {
          case "January":
            month = "01";
            break;
          case "February":
            month = "02";
            break;
          case "March":
            month = "03";
            break;
          case "April":
            month = "04";
            break;
          case "May":
            month = "05";
            break;
          case "June":
            month = "06";
            break;
          case "July":
            month = "07";
            break;
          case "August":
            month = "08";
            break;
          case "September":
            month = "09";
            break;
          case "October":
            month = 10;
            break;
          case "November":
            month = 11;
            break;
          case "December":
            month = 12;
            break;
          }

          date = year_month[1]+"-"+month+"-"+selected_day;

          return date;
        }
////////////////////////////////////////////////////
        $(".this_day").click(function() {
          
            $(".this_day").removeClass('selected');
            // $(".this_day:hover").css('background', 'orange');
            $(this).addClass('selected');

            var selected_day = $.trim($('.selected').text()); 

            if(selected_day == ''){
                 alert('Please select a valid day.');
                 $(".this_day").removeClass('selected');
                 exit;
            }

            var day_events = $('.selected > .event_content').text();
            $('#day_event').val(day_events);

               $(".event_form").slideDown();
        });
////////////////////////////////////////////////////
        $("#show_hide").click(function(){
            $("#recurring").toggle("slide");
        });
////////////////////////////////////////////////////
        $("#cancel").click(function(){
            $(".event_form").slideUp();
        });
////////////////////////////////////////////////////
        $(document).on("submit", "#delete", function(){
          var form = $(this);
          //need to place alert here "Are you sure you want to delete this days events?"
            $.post(
                    form.attr("action"),
                    {
                        date: get_date(),
                    },
                    function(msg) {
                        alert("Event deleted");
                        window.location.reload()
                    },
                    "json");
            return false;
        });
////////////////////////////////////////////////////
        $(".unit").click(function(){
            if($(".unit").val() == "Daily"){
              $("#unit_display").html("Day(s)");
            }
            if($(".unit").val() == "Weekly"){
              $("#unit_display").html("Week(s)");
            }
            if($(".unit").val() == "Monthly"){
              $("#unit_display").html("Month(s)");
            }
        })
////////////////////////////////////////////////////
        $(document).on("submit", "#new_event", function(){ 
          var form = $(this);
          var event_input = $.trim($('#day_event').val());
          var interval_every = $.trim($('.interval_every').val());
       
            if(event_input == ''){
                alert('enter an event');
                exit;
            }
            else{
              
                $.post(
                    form.attr("action"),
                    {
                        date: get_date(),
                        event_name: event_input,
                        interval_unit: $('.interval_unit').val(),
                        interval_every: interval_every
                    },
                    function(msg) {
                        alert("Event added");
                        window.location.reload()
                    },
                    "json");
            return false;
            }
        });
////////////////////////////////////////////////////
    });
    </script>

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
               
                <li><a href="<?php echo base_url("user/profile");?>">Profile</a></li>
            
                <li class="divider"></li>
            </ul>
            
          </section>

        </nav>
      </div>
<div class="event_form">
    <div class="row">
        <div class="large-12 columns">
            <form id="new_event" action="/calendar/add_event" method="POST">
            <h4>Set Tasks for the Day</h4>
            <label>Task Name</label>
            <input id="day_event" name="event_name" type="text" placeholder="Name of task, ie water change">

        </div>
    </div>


    <div id="recurring">
        <div class="row">
            <div class="large-3 columns left">
              <label class="left">Reccours</label>
                <select class="unit interval_unit">
                    <option></option>
                    <option>Daily</option>
                    <option>Weekly</option>
                    <option>Monthly</option>
                </select>
            </div>
            <div class="large-3 columns left">
              <label class="left">Every</label>
                <input class="interval_every" type="text" placeholder="# of days/weeks">
            </div>
            <div class="large-3 columns left">
                <div id="unit_display"></div>
            </div>
        </div>
    </div>


    <div class="row">
            <input type="submit" class="inline left" value="add task">
            <a href="#" class="right" id="show_hide">Show reccouring Task Options</a>
            </form>
            <div class="clear"></div>
            <form class="inline right" id="cancel"><input type="submit" value="cancel"></form>
            <form action="/calendar/delete_event" method="POST" class="inline right" id="delete"><input type="submit" value="delete"></form>
    </div>
</div>

    
    <div class="row">
        <div class="large-12 columns">
            <?php echo $calendar; ?>
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



<script src="/assets/js/foundation/foundation.js"></script>
<script src="/assets/js/foundation/foundation.topbar.js"></script>


 <script>
    $(document).foundation();
  </script>

  </body>

</html>