<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;

class PdfGenerator {
    public static function render($html, $filename = "documento.pdf", $orientation = "portrait") {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', $orientation);
        $dompdf->render();
        $dompdf->stream($filename, ["Attachment" => false]);
    }
}
