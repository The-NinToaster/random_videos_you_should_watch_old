<?php

    $dbhost = "34.130.59.212";
    $dbuser = "root";
    $dbpass = "she owes me money";
    $db = "vids";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    $data= [];
    $errors= [];

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
        $output = implode(',', $output);

         echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }


    $query="SELECT * FROM `suggestion`";
    if(!mysqli_query($conn, $query))
    {
        $errors['connection']= "That didn't work... try again!";
    }
    else
    {
        $result = mysqli_query($conn, $query);
        $history = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $history[] = $row;
        };

        $data = $history;

    }
    
    if (!empty($errors)) 
    {
        $data['success'] = false;
        $data['errors'] = $errors;
    } 
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    
    $stmt ->close();
    
 
?>