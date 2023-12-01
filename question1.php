<?php

function checkDownload($memberType){

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
    
    //get member details
    $sql='
    select member_last_download_time,total_downloaded
    from members
    where members_id = "'.$_SESSION['member_id'].'"
    ';
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();

    $member_download_time = $row['member_last_download_time'];
    $total_downloaded = $row['total_downloaded'];
    $current_date_time = date("Y-m-d H:i:s",time());

    $download_second = date_diff(date_create($member_download_time),date_create($current_date_time))->format("%s");

    if($download_second > 6){
       
        $total_downloaded = 1;

        //if download time more than 5 sec then allow to download
        $sql_update_download_time = '
        UPDATE members SET 
        member_last_download_time = "'.$current_date_time.'",
        total_downloaded = "'.$total_downloaded.'"
        WHERE id="'.$_SESSION['member_id'].'"
        ';
        $conn->query($sql_update_download_time);

        return 'Your download is starting...';

        

    }else if($memberType == 'member' && $total_downloaded == 1){
        //if is member and total download is 1 and download time within 5 sec then allow to download again
        $total_downloaded++;

        $sql_update_download_time = '
        UPDATE members SET 
        total_downloaded = "'.$total_downloaded.'"
        WHERE id="'.$_SESSION['member_id'].'"
        ';
        $conn->query($sql_update_download_time);

        return 'Your download is starting...';

    }else{

        //if is non member and download time within 5 sec then not allow to download
        //if is member and total download is 2 and download time within 5 sec then not allow to download again
        
        return 'Too many downloads';
        
    
    }


}

?>

