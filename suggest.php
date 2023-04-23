<?php

    $dbhost = "34.130.59.212";
    $dbuser = "root";
    $dbpass = "she owes me money";
    $db = "vids";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    $errors= [];
    $data = [];

    if(!empty($_POST))
    {
        $link = $_POST['link'];
        $title = trim(htmlspecialchars($_POST['title']));
        $uploader = trim(htmlspecialchars($_POST['channel']));
        $name = trim(htmlspecialchars($_POST['name']));

        if(!(str_contains($link, "https://www.youtube.com/watch?v=")))
        {
            $errors['link']= "Must be a complete youtube link with the format \"https://www.youtube.com/watch?v=...\"";
        }
        else
        {
            
            $query = "INSERT INTO suggestion (link, title, name, channel) VALUES('$link','$title', '$name', '$uploader')";
    
            if(!mysqli_query($conn, $query))
            {
                $errors['connection']= "That didn't work... try again!";
            }
            
            $query2 = "INSERT INTO videos (link, uploader, title, suggested) VALUES('$link', '$uploader', '$title', '$name')";
            if(!mysqli_query($conn, $query2))
            {
                $errors['connection']= "That didn't work... try again!";
            }
        }   
        if (!empty($errors)) 
        {
            $data['success'] = false;
            $data['errors'] = $errors;
        } 
        else 
        {
            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        $conn->close();

        echo json_encode($data);
    }
  

        




?>  
