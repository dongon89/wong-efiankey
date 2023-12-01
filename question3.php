<?php

function get_num_days($date_from,$date_to){

     date_default_timezone_set("Asia/Kuala_Lumpur");
     
    // get num days
     $date1 = strtotime($date_from);
     $date2 = strtotime($date_to);
     $datediff = $date2 - $date1;

     $num_days = round($datediff / (60 * 60 * 24)); 

     // check day odd or even
     if($num_days % 2 == 0){ 
          $odd_even = 'Even';
      }else{ 
          $odd_even = 'Odd';
          
      } 
     
    return 'Number Of Days Between Two Given Dates is '.$num_days.'. The day is'.$odd_even;
    
     
     
   
} 

?>

