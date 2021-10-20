<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[] = "Vul de naam van de attractie in.";
}

$type = $_POST['type'];

if(empty($attractie))
{
    $errors[] = "Vul een type in.";
}

$capaciteit = $_POST['capaciteit']; 
if(!is_numeric($capaciteit))
{
    $errors[] = "Vul een geldig getal in voor de capaciteit.";
}

if(isset($_POST['prioriteit']))
{
    $prioriteit = true;
}
else
{
    $prioriteit = false;
}

$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[] = "Vul de naam van de melder in" ;
}

$overig = $_POST['overig'];

if(isset($errors))
{
    var_dump($errors);
    die();
}

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info )";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":capaciteit" => $capaciteit,
    ":prioriteit" => $prioriteit,
    ":melder" => $melder,
    ":overige_info" => $overig,

]);

header("Location:../meldingen/index.php?msg=Meldingopgeslagen");