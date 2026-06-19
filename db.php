<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$conn = new mysqli(
  "sql107.infinityfree.com",
  "if0_42221288",
  "MRMPVwoaDSDG",
  "if0_42221288_projets"
);

if ($conn->connect_error) {
    die("Connexion echouee: " . $conn->connect_error);
}
?>