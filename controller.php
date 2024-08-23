<?php
require_once 'DAO.php';
session_start();

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($action === 'doPost') {
        $marka = isset($_POST['marka']) ? test_input($_POST['marka']) : '';
        $cena = isset($_POST['cena']) ? test_input($_POST['cena']) : 0;

        if (!empty($marka) && !empty($cena)) {
            $dao = new DAO();
            $postoji = $dao->postoji($marka);

            if ($postoji) {
                $auta = $dao->lista($marka, $cena);
                $_SESSION['auta'] = $auta;
                include 'prikaz.php';
            } else {
                $msg = "Marka automobila ne postoji.";
                include 'index.php';
            }
        } else {
            $msg = "Popunite sva polja.";
            include 'index.php';
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
    if ($action === 'logout') {
        session_unset();
        session_destroy();
        include 'index.php';
    } else {
        header("Location: index.php");
        die();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
