<?php

    $dbhost = "34.130.59.212";
    $dbuser = "root";
    $dbpass = "she owes me money";
    $db = "vids";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    $data= [];
    $errors= [];

   function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
         ');';
        if ($with_script_tags) {
         $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
        $output = implode(',', $output);

         echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }


    $query="SELECT COUNT(*) AS `count` FROM `videos`";
    if(!mysqli_query($conn, $query))
    {
        $errors['connection']= "That didn't work... try again!";
    }
    else
    {
        $gettotal = mysqli_query($conn,$query);
        $num = mysqli_fetch_assoc($gettotal);
        $vid = rand(1, $num['count']);
        $sql = "SELECT * FROM videos WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param("i", $vid);
        $stmt->execute();
        $stmt->bind_result($num, $link, $channel, $title, $suggested);
        $stmt ->fetch();


        $linkid = explode("=", $link);

        $data['video']= "<div id=\"video\"><iframe width=\"560\" height=\"315\"src=\"https://www.youtube-nocookie.com/embed/".$linkid[1]."\"title=\"YouTube video player\"frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe></div><br>";
        
        $data['title'] = "<div id=\"video_title\">".$title."</div>";
        $data['channel'] = "<div id=\"video_channel\">".$channel."</div><br>";     

        $data['suggested'] = "<div id=\"video_suggestion\">Suggested by:".$suggested."</div>";
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

    echo json_encode($data);
    
    $stmt ->close();
    
 
?>