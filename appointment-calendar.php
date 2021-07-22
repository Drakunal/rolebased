<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "admin") {
    header("location:index.php");
}
error_reporting(0);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Kalender</title>
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <!-- <script src=" js/lang-all.js"></script> -->

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
        .fc-title {
            /* background-color: black; */
            color: black;
            font-size: 10px;
        }
    </style>

    <?php
    $id = $_GET['id'];
    ?>
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



            // });


            // window.location.reload();
            var employee = $("#employee-id").val();
            console.log(employee);
            if (employee != "") {
                d = 'load.php?ids=' + employee;
                console.log(d);
                // loadData("employeeData", employee);
                $('#calendar').fullCalendar({
                    monthNames: ['Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December'],
                    monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
                    dayNames: ['Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag'],
                    dayNamesShort: ['Sön', 'Mån', 'Tis', 'Ons', 'Tor', 'Fre', 'Lör'],
                    buttonText: {
                        today: 'I dag',
                        week: 'Vecka',
                    },
                    weekNumberTitle: 'V',
                    // locale: 'es',
                    editable: false,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: '',
                        display: 'none',
                    },
                    events: d,
                    selectable: true,
                    displayEventTime: false,

                    weekends: true,
                    editable: false,
                    weekNumbers: true,
                    firstDay: 1,

                    selectHelper: true,







                    eventClick: function(event) {
                        // if (confirm("View details?")) {
                            var id = event.id;
                            //   $.ajax({
                            var url = "show.php?id=" + id;
                            //    type:"POST",
                            //    data:{id:id},
                            //    success:function()
                            //    {
                            //     calendar.fullCalendar('refetchEvents');
                            //     alert("Event Removed");
                            //    }
                            //   })

                            window.location.href = url;
                        // }
                    },
                    select: function(start, end, allDay) {
                        // var title = prompt("Add appointment in this day?");
                        if (confirm("Lägg till bokning den här dagen?")) {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                            // var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                            // $.ajax({
                            var url = "add-extra-appointment.php?date=" + start;
                            window.location.href = url;
                            // type:"POST",
                            // data:{title:title, start:start, end:end},
                            // success:function()
                            // {
                            //     calendar.fullCalendar('refetchEvents');
                            //     alert("Added Successfully");
                            // }
                            // })
                        }
                    },

                    // eventRender: function eventRender(event, element, view) {
                    //     return ['all', event.customer_id].indexOf($('#customer-id').val()) >= 0
                    // }

                });




            }


            //   else{
            // 	// $("#calendar").html("");
            // }


            // $('#customer-id').on('change', function() {
            //     $('#calendar').fullCalendar('rerenderEvents');
            // });
            // $('#search').on('change',function(){
            //     $('#calendar').fullCalendar('rerenderEvents');
            // });



        });
    </script>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <?php include "sidebar.php"; ?>
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
                                        $role1 = 'customer';
                                        $customer_list_query = mysqli_query($db, "SELECT user_id,id,name from `users` where role='$role1' AND deleted_at is NULL;") or die("Unsuccessful");
                                        ?>
                                        <div class="col-sm-4">
                                            <form method="POST">
                                                <label class="form-label">Kund</label>
                                                <!-- <select class="form-control"id="customer-id" name="customer-id"> -->
                                                <!-- <input class="form-control" type=number name="user_id">
                                                <button class="form" type="submit" name="submit">search</button> -->

                                                <div class="input-group">
                                                    <div class="form-outline">
                                                        <input type="search" required id="form1" name="user_id" placeholder="Sök kund-id" class="form-control" />



                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-primary">
                                                        <i class="fas fa-search"></i></button>

                                                </div>
                                            </form>
                                            <!-- <option value="all"selected>Select a Customer</option> -->
                                            <!-- <option value="41" >Bal</option> -->
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                $user_id = $_POST['user_id'];
                                                $role1 = 'customer';
                                                $customer_query = mysqli_query($db, "SELECT id from `users` where role='$role1' AND user_id='$user_id' AND deleted_at is NULL;") or die("Unsuccessful");
                                                $row = $customer_query->fetch_assoc();
                                                $id = $row['id'];
                                            ?>
                                                <script>
                                                    window.location.href = "appointment-calendar.php?id=<?php echo $row['id'] ?>";
                                                </script>
                                                <!-- <a class="sidebar-link" href="appointment-calendar.php?id=<?php echo $row['id'] ?>"> -->

                                            <?php   } ?>
                                            <!-- </select> -->


                                        </div>
                                        <!-- <div class="input-group rounded">
                                 <div class="col-sm-4">
                                 <input id="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                                    aria-describedby="search-addon" />
                                <span class="input-group-text border-0" id="search-addon">
                                </div>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div> -->
                                        </br>
                                        <?php
                                        $role2 = "employee";
                                        $result2 = mysqli_query($db, "SELECT id,name from `users` where role='$role2';");
                                        ?>

                                        <input type=number id="employee-id" hidden value="<?php echo $id ?>">
                                        <!-- <select class="form-control mb-3" id="employee-id">
											<option value="0"selected>All Employees</option>
											<?php
                                            // while($row2 = $result2->fetch_assoc())
                                            // echo "<option value='".$row2['id']."'>".$row2['name']."</option>"
                                            ?>
										</select> -->
                                    </div>
                                    <div id="calendar"></div>
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
</body>

</html>