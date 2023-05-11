<?php

$server = 'localhost';
$user = 'id20737217_root';
$password = '@Cascotazo1';
$dbname = 'id20737217_abm_coderhouse';

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if($_GET['delete'] == 'true')
    {
        $id_student = $_GET['id_student'];
        $connection = mysqli_connect($server, $user, $password, $dbname);
        if(!$connection){
            die('Database connection error: '.mysqli_error($connection));
        }
        $query = "DELETE FROM students where id_student = $id_student";
        $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
        echo '{"result": "Estudiante eliminado correctamente"}';
    }else
    {
        $limit = $_GET['limit'];
        $connection = mysqli_connect($server, $user, $password, $dbname);
        if(!$connection){
            die('Database connection error: '.mysqli_error($connection));
        }
        $query = "SELECT * FROM students LIMIT $limit";
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
    $grade = $_POST['grade'];
    $admissionDate = $_POST['admissionDate'];
    $note = $_POST['note'];
    $debt = $_POST['debt'];

    $connection = mysqli_connect($server, $user, $password, $dbname);
    if(!$connection){
        die('Database connection error: '.mysqli_error($connection));
    }
    $query = "INSERT INTO students (firstname, lastname, document, grade, admissionDate, note, debt) VALUES ('$firstname', '$lastname', $document, '$grade', '$admissionDate', $note, $debt)";
    $result = mysqli_query($connection, $query) or die("Error in Selecting " . mysqli_error($connection));
    echo '{"result": "Estudiante registrado correctamente"}';
}else
{
    echo '{"error": "Wrong Data or method"}';
}

?>