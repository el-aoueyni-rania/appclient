<?php
if (!empty($_POST)) {
    include './classes/client.class.php';
    $client = new Client;
    $client->addNewClient($_POST['firstname'], $_POST['lastname'], $_POST['dateN'], $_POST['adresse'], $_POST['phone']);
    header('Location:index.php?notif=add');
    exit();
}

include 'create.phtml';
