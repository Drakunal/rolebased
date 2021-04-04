<?php
$date=date("Y/m/d");
for ($x = 1; $x <= 12; $x++) {
    // mysqli_query($db,"INSERT INTO `appointments` (customer_id, employee_id, date, time) VALUES('$customer_id','$employee_id', '$date','$time');");	
    $date_temp=date('Y-m-d', strtotime($date));
    $date_temp_month=date("F",strtotime($date_temp)); //month
    // $date_temp_week=date("d",$date_temp); // day of the date
    // $temp_week_number=ceil($date_temp_week/7); // week of the date
    // echo $date_temp_week;
    $date=date('Y-m-d', strtotime($date. '+1 year'));
    // $date=date('Y-m-d', strtotime($date. ' + 28 days'));
    $date_month=date("F",strtotime($date));
    // $date_week=date("d",$date);
    // $week_number=ceil($date_week/7);
    if( $date_temp_month== $date_month){
        // echo "HI" ;// it means the previous and current appointment are in same month so add +7
        $date=date('Y-m-d', strtotime($date. ' + 7 days'));
    }
echo "/n";
    echo ($date);
    // if($week_number!=$temp_week_number){

    // 	$difference=abs($week_number-$temp_week_number);
    // 	$difference_in_days=$difference*7;
    // 	$date=date('Y-m-d', strtotime($date. ' - '.$difference_in_days.' days'));

    // }

}
?>