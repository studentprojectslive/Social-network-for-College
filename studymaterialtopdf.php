<?php
    $content = "
<page>
    <h1>Exemple dutilisation</h1>
    <br>
    Ceci est un <b>exemple dutilisation</b>
    de <a href=http://html2pdf.fr/>HTML2PDF</a>.<br>
</page>";

    require_once(dirname(__FILE__)./html2pdf/html2pdf.class.php);
    $html2pdf = new HTML2PDF(P,A4,fr);
    $html2pdf->WriteHTML($content);
    $html2pdf->Output(exemple.pdf);
?>