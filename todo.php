<?php

//! display only the first two appointments if bi weekly and only one if monthly in the
//! view customer and also in add appointments table
//! sorting the appointments by date and showing them

select * from appointments
     where date > current_date + interval 1 month;;

     select * from appointments
     where customer_id=22 AND date >= current_date + interval 1 month;



     select * from appointments
     where customer_id=22 AND date >= current_date AND date<= CURRENT_DATE+ interval 1 month;


     SELECT id FROM things 
   WHERE MONTH(happened_at) = 1 AND YEAR(happened_at) = 2009

     SELECT * from appointments where Month(date)=4;


     "SELECT * from `appointments` where Month(date)=`$month`;"

     






"SELECT date,time,employee_id,customer_id from `appointments` where customer_id='$idd' AND"
     "SELECT date,time,employee_id,customer_id from `appointments` where customer_id='$idd' AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month;"
?>