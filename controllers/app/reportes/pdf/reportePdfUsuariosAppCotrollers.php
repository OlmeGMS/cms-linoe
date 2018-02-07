<?php
require_once('../../../../vendor/vendor/autoload.php');

use Spipu\Html2Pdf\Html2Pdf;

//traer el Facade
ob_start();
require_once('vista/usuariosApp.php');
$html = ob_get_clean();

$html2Pdf = new Html2Pdf('P','A4','es','true', 'UTF-8');
$html2Pdf->writeHTML($html);
$html2Pdf->output('usuarios-app.pdf');

?>
