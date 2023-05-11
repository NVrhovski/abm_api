<?php

if($_POST['email'] && $_POST['password'])
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $server = 'localhost';
    $user = 'id20737217_root';
    $dbpassword = '@Cascotazo1';
    $dbname = 'id20737217_abm_coderhouse';

    $connection = mysqli_connect($server, $user, $dbpassword, $dbname);
    if(!$connection){
        die('Database connection error: '.mysqli_error($connection));
    }
    $query = "SELECT * FROM users where email = '$email' and password = '$password'";
    $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
    $formatedArray = array();
    while($row =mysqli_fetch_assoc($result)){
        $formatedArray[] = $row;
    }
    if(json_encode($formatedArray) == '[]')
    {
        die ('{"error": "Wrong credentials"}');
    }else
    {
        die (json_encode($formatedArray[0]));
    }
    
}else{
    echo 'Wrong Data. Only POST method allowed';
}

?>