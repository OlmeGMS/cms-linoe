<?php
session_start();
unset($_SESSION["login"]);
session_unset();
session_destroy();
header("Location: ../views/mensajes/cierre_seguro.html");
 ?>
