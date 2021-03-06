
<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "admin") {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Calendar</title>
  <link href="css/app.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  
  <!-- <script src="https://www.officeholidays.com/ics-local-name/sweden"></script> -->
  <style>
/*  
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        } */
        
        #calendar {
            /* max-width: 900px; */
            margin: 0 auto;
        }
        /* .fc-content{ */
            /* background-color: yellow; */

        /* } */
        .fc-title{
            /* background-color: black; */
            color:black;
            font-size: 10px;
        }
 
</style>
  <script>
   
        $(document).ready(function() {
        //  var d='load.php';
        // var calendar = $('#calendar').fullCalendar({
        //     editable:false,
        //     header:{
        //     left:'prev,next today',
        //     center:'title',
        //     right:'',
        //     display:'none',
        //     //  right:'month,agendaWeek,agendaDay'
        //     },
        //     if(True){
        //         var c=2;
        //         console.log(c);
        //     },
        //     events: d,
            

        //     selectable:false,
        //     displayEventTime: false,
        //     selectHelper:false,
        //     weekends: true,
        //     // select: function(start, end, allDay)
        //     // {
        //     //  var title = prompt("Enter Event Title");
        //     //  if(title)
        //     //  {
        //     //   var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        //     //   var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        //     //   $.ajax({
        //     //    url:"insert.php",
        //     //    type:"POST",
        //     //    data:{title:title, start:start, end:end},
        //     //    success:function()
        //     //    {
        //     //     calendar.fullCalendar('refetchEvents');
        //     //     alert("Added Successfully");
        //     //    }
        //     //   })
        //     //  }
        //     // },
        //     editable:false,
        //     // eventResize:function(event)
        //     // {
        //     //  var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        //     //  var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        //     //  var title = event.title;
        //     //  var id = event.id;
        //     //  $.ajax({
        //     //   url:"update.php",
        //     //   type:"POST",
        //     //   data:{title:title, start:start, end:end, id:id},
        //     //   success:function(){
        //     //    calendar.fullCalendar('refetchEvents');
        //     //    alert('Event Update');
        //     //   }
        //     //  })
        //     // },

        //     // eventDrop:function(event)
        //     // {
        //     //  var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        //     //  var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        //     //  var title = event.title;
        //     //  var id = event.id;
        //     //  $.ajax({
        //     //   url:"update.php",
        //     //   type:"POST",
        //     //   data:{title:title, start:start, end:end, id:id},
        //     //   success:function()
        //     //   {
        //     //    calendar.fullCalendar('refetchEvents');
        //     //    alert("Event Updated");
        //     //   }
        //     //  });
        //     // },

        //     // eventClick:function(event)
        //     // {
        //     //  if(confirm("Are you sure you want to remove it?"))
        //     //  {
        //     //   var id = event.id;
        //     //   $.ajax({
        //     //    url:"show.php",
        //     //    type:"POST",
        //     //    data:{id:id},
        //     //    success:function()
        //     //    {
        //     //     calendar.fullCalendar('refetchEvents');
        //     //     alert("Event Removed");
        //     //    }
        //     //   })
        //     //  }
        //     // },

        // });

        $("#employee-id").on("change",function(){
            // window.location.reload();
  		var employee = $("#employee-id").val();
	console.log(employee);
  		if(employee != ""){
              d='load.php?ids='+employee;
              console.log(d);
  			// loadData("employeeData", employee);
           $('#calendar').fullCalendar({
                editable:false,
                header:{
                left:'prev,next today',
                center:'title',
                right:'',
                display:'none',
                },
                events: d,
                selectable:false,
                displayEventTime: false,
                selectHelper:false,
                weekends: true,
                editable:false,
                
               
             });
             

  		}
        //   else{
  		// 	// $("#calendar").html("");
  		// }
         
  		
  	})
     
        
    });
   
  </script>
 </head>
 <body>
 <div class="wrapper">
        <nav  id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
            <?php include "sidebar.php";?>
            </div>
        </nav>
        
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

				<?php include("navbar.php"); ?>
				
			</nav>
           <main class="content">
           <div class="container-fluid p-0">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div>
									<?php 
										$role2="employee";
										$result2 = mysqli_query($db,"SELECT id,name from `users` where role='$role2';");
									?>
										<select class="form-control mb-3" id="employee-id">
											<option value="0"selected>All Employees</option>
											<?php 
											while($row2 = $result2->fetch_assoc())
											echo "<option value='".$row2['id']."'>".$row2['name']."</option>"
											 ?>
										</select>
								</div>
                                <!-- <div id="calendar"> -->
                                <iframe src="appointment-calendar-ajax.php" title="W3Schools Free Online Web Tutorials">
                                <!-- </div> -->
                            </div>
                        
                        </div>
                        

                    </div>
                
                        
                </div>
           
           
            </div>

           </main>
            
            
            <?php include("footer.php"); ?>

        </div>
    
   
 </div>

 <script src="js/app.js"></script>
 <script type="text/javascript">
  $(document).ready(function(){
  	function loadData(type, e_id){
  		$.ajax({
  			url : "dashboard-hours-worked-ajax.php",
  			type : "POST",
  			data: {type : type, e_id:e_id},
  			success : function(data){
  				if(type == "employeeData"){
  					$("#hours-worked").html(data);
  				}else{
  					$("#employee_id2").append(data);
  				}
  				
  			}
  		});
  	}


  	$("#employee-id").on("change",function(){
  		var employee = $("#employee-id").val();
	console.log(employee);
  		if(employee != ""){
  			loadData("employeeData", employee);
  		}
        //   else{
  		// 	// $("#calendar").html("");
  		// }

  		
  	})


	
  });
</script>
 </body>
</html>
