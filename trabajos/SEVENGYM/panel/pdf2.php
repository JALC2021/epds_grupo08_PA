<?php 

ob_start();
include(dirname(__FILE__).'/pdf.php');
$content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf_v4.03/html2pdf.class.php');
    try

    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        ob_end_clean();

        $html2pdf->Output('factura.pdf');  
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>
  