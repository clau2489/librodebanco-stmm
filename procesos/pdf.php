<?php
if(isset($_POST["generar"])){
    //Incluimos la librería
    require_once 'html2pdf/html2pdf.class.php';
     
    //Recogemos el contenido de la vista
    ob_start();
    require_once 'vistaImprimir.php';
    $html=ob_get_clean();
 
    //Pasamos esa vista a PDF
     
    //Le indicamos el tipo de hoja y la codificación de caracteres
    $mipdf=new HTML2PDF('P','A4','es','true','UTF-8');
 
    //Escribimos el contenido en el PDF
    $mipdf->writeHTML($html);
 
    //Generamos el PDF
    $mipdf->Output('PdfGeneradoPHP.pdf');
 
}
?>