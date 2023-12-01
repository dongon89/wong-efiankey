<?php

function roll_item($vip_rank){

    date_default_timezone_set("Asia/Kuala_Lumpur");
    //connect database
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //get item details from database item_tier_rarity = [1,2,3,4,5] // 1 = common , 5 = legend
    $item_tier_rarity = array();

    $sql = '
    select item_tier_rarity_name
    from item_tier_rarity
    order by tier asc
    ';
    $result= $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $item_tier_rarity[] = $row['item_tier_rarity_name'];
    }

    //get vip details from database vip_rank = [v1,v2,v3,v4,v5] //v1 = lowest rank
    $vip_rank = array();

    $sql = '
    select vip_rank_name
    from vip_rank
    order by rank asc
    ';
    $result= $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $vip_rank[] = $row['vip_rank_name'];
    }

    $total_item = count($item_tier_rarity); //7
    $total_vip = count($vip_rank); //7
    $item = array();
  	$data = array();
    $min = 1;
    $item_percentage  = 100/count($item_tier_rarity);//20
    $item_percentage2  = 100-(100/count($item_tier_rarity));//20
    $vip_percentage  = count($vip_rank)*20/count($vip_rank);
   	$item_decrease_chance = 0;
    $vip_increase_chance = 0;
    $vip_count = 0;
    $vip_decrease_chance = 50;
    foreach($vip_rank as $i){ //run all vip
    	$vip_count++;
    	//next vip increase chance
        if($vip_count > (count($vip_rank)/2)){
        	$item_decrease_chance = $item_percentage2;
        
        
        
    		$chance =  $item_decrease_chance; //20%
        }else{
        	$item_decrease_chance = $item_percentage;
        
        
        
    		$chance =  $item_decrease_chance; //20%
        }
    	
        
        
        for($k=0;$k<100;$k++){//run 100 times
        
        	//echo '<br>'.$k.' | ';
            
    		for($j=1; $j <= $total_item; $j++){
            	$rand_num = rand(0,100);
                //echo '<br>';
                //echo 'rand_num = '.$rand_num.' | ';
               
               
               // echo $rand_num.' >= '.$chance.' | ';
              	if($rand_num >= $chance || $j == $total_item){
                 	if($data[$i][$j] == ''){
                    	$data[$i][$j] = 0;
                    }
                	//echo $data[$i][$j].' = '.$data[$i][$j].'+1 | ';
                  	$data[$i][$j] = $data[$i][$j]+1;
                    
                    //echo $chance.' = '.$item_decrease_chance.' | ';
                    $chance = $item_decrease_chance;
                    
                    break;
                    
              	
                }else{
                	//echo $chance.' = '.$chance.' + '.$item_decrease_chance.' | ';
                    if($vip_count > (count($vip_rank)/2)){
                    }
                  	
                    
					
              	}
                
                
			}
        }
        
        
    
    }

    foreach($data as $i =>$i_value){
    	echo '<br>vip = '.$i.'<br>';
		ksort($i_value);
		foreach($i_value as $j => $j_value){
        	echo 'item = '.$j.' / percentage = '.$j_value.'<br>';
        }
    }

    



}

?>

