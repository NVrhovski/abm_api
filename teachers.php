<?php

$server = 'localhost';
$user = 'id20737217_root';
$password = '@Cascotazo1';
$dbname = 'id20737217_abm_coderhouse';

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if($_GET['delete'] == 'true')
    {
        $id_teacher = $_GET['id_teacher'];
        $connection = mysqli_connect($server, $user, $password, $dbname);
        if(!$connection){
            die('Database connection error: '.mysqli_error($connection));
        }
        $query = "DELETE FROM teachers where id_teacher = $id_teacher";
        $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
        echo '{"result": "Profesor eliminado correctamente"}';
    }else
    {
        $limit = $_GET['limit'];
        $connection = mysqli_connect($server, $user, $password, $dbname);
        if(!$connection){
            die('Database connection error: '.mysqli_error($connection));
        }
        $query = "SELECT * FROM teachers LIMIT $limit";
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
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $document = $_POST['document'];
    $admissionDate = $_POST['admissionDate'];
    $salary = $_POST['salary'];
    $course = $_POST['course'];

    $connection = mysqli_connect($server, $user, $password, $dbname);
    if(!$connection){
        die('Database connection error: '.mysqli_error($connection));
    }
    $query = "INSERT INTO teachers (firstname, lastname, document, admissionDate, salary, course) VALUES ('$firstname', '$lastname', $document, '$admissionDate', $salary, '$course')";
    $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
    echo '{"result": "Profesor registrado correctamente"}';
}else
{
    echo '{"error": "Wrong Data or method"}';
}

?>