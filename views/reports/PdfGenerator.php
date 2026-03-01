<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfGenerator {

    public static function render($html, $filename = "documento.pdf", $orientation = "portrait") {

        $options = new Options();
        $options->set('isRemoteEnabled', true); //Permite imágenes externas
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', $orientation);
        $dompdf->render();
        $dompdf->stream($filename, ["Attachment" => false]);
    }
}