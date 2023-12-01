<?php

function checkDiscount($purchaseValue){
    $totalDiscount = 0;
    if($purchaseValue > 500){
        //10% discount for purchases over 500

        return 'Purchase Value is '.$purchaseValue.' , discount is 10%';

   }else if($purchaseValue > 99){
        //a 5% discount for purchases under 500

        return 'Purchase Value is '.$purchaseValue.' , discount is 5%';

   }else{
        //no discount for purchases below 100
        return 'Purchase Value is '.$purchaseValue.' , there are no discount';

   }

   
}

?>

