<?php
include("../config.php");
if (isset($_SESSION['user'])) {
  header("Location: /BSU/Home");
  exit();
}
?>
