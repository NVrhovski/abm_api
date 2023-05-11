<?php

$server = 'localhost';
$user = 'id20737217_root';
$password = '@Cascotazo1';
$dbname = 'id20737217_abm_coderhouse';

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if($_GET['delete'] == 'true')
    {
        $id_course = $_GET['id_course'];
        $connection = mysqli_connect($server, $user, $password, $dbname);
        if(!$connection){
            die('Database connection error: '.mysqli_error($connection));
        }
        $query = "DELETE FROM courses where id_course = $id_course";
        $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
        echo '{"result": "Curso eliminado correctamente"}';
    }else
    {
        $limit = $_GET['limit'];
        $connection = mysqli_connect($server, $user, $password, $dbname);
        if(!$connection){
            die('Database connection error: '.mysqli_error($connection));
        }
        $query = "SELECT * FROM courses LIMIT $limit";
        $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));

        $formatedArray = array();
        while($row =mysqli_fetch_assoc($result)){
            $formatedArray[] = $row;
        }

        echo json_encode($formatedArray);
    }
}else 
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $course_name = $_POST['course_name'];
    $teacher = $_POST['teacher'];
    $price = $_POST['price'];
    $format = $_POST['format'];

    $connection = mysqli_connect($server, $user, $password, $dbname);
    if(!$connection){
        die('Database connection error: '.mysqli_error($connection));
    }
    $query = "INSERT INTO courses (course_name, teacher, price, format) VALUES ('$course_name', '$teacher', $price, '$format'";
    $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
    echo '{"result": "Curso registrado correctamente"}';
}else
{
    echo '{"error": "Wrong Data or method"}';
}

?>