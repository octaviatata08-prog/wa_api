<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "wa_api";

$db = new mysqli($host, $user, $pass, $db_name);

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}