<?php

if($_POST['email'] && $_POST['password'] && $_POST['user_name'])
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_name = $_POST['user_name'];

    $server = 'localhost';
    $user = 'id20737217_root';
    $dbpassword = 'password';
    $dbname = 'id20737217_abm_coderhouse';

    $connection = mysqli_connect($server, $user, $dbpassword, $dbname);
    if(!$connection){
        die('Database connection error: '.mysqli_error($connection));
    }
    $query = "SELECT * FROM users where email = '$email'";
    $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
    $formatedArray = array();
    while($row =mysqli_fetch_assoc($result)){
        $formatedArray[] = $row;
    }
    if(json_encode($formatedArray) == '[]')
    {
        $query = "INSERT INTO users (email, password, user_name) VALUES ('$email', '$password', '$user_name')";
        $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
        echo '{"result": "Usuario registrado correctamente"}';
    }else
    {
        die ('{"error": "Email en uso"}');
    }
    
}else{
    echo 'Wrong Data. Only POST method allowed';
}

?>