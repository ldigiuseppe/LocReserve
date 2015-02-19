<?php

//echo $content_for_layout;

require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload');
$dompdf = new DOMPDF();
$dompdf->set_paper = 'A4';
$dompdf->load_html(utf8_decode($content_for_layout), Configure::read('App.encoding'));
$dompdf->render();
//$res = file_put_contents("/abc.pdf", $dompdf->output());
echo $dompdf->output();
//echo $res;
