<!DOCTYPE html>
<html>
  
<head>
    <title>
          How to Automatically Close Alerts 
          using Twitter Bootstrap ?
      </title>
  
    <!-- Including Bootstrap CSS -->
    <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  
    <!-- Including jQuery -->
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js">
    </script>
  
    <!-- Including Bootstrap JS -->
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
    </script>
</head>
  
<body>
    <h3>Automatically closing the alert</h3>
  
    <!-- Showing alert -->
    <div id="alert" class="alert alert-danger">
        This alert will automatically 
        close in 5 seconds.
    </div>
  
    <script type="text/javascript">
        setTimeout(function () {
  
            // Closing the alert
            $('#alert').alert('close');
        }, 5000);
    </script>
</body>
  
</html>