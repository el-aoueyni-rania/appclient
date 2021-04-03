<?php
include './classes/client.class.php';
$client = new Client;
if (!empty($_POST)) {
    $client->updateClient($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['dateN'], $_POST['adresse'], $_POST['phone']);
    header('Location:index.php?notif=update');
    exit();
} else {
    $showClient = $client->getOneClient($_GET['id']);
    $data = $showClient->fetch();
}
include "edit.phtml";
