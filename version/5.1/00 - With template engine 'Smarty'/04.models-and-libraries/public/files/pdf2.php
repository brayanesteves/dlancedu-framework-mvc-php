<?php
    $this->_pdf->AddPage();
    $this->_pdf->SetFont('Arial', 'B', 16);
    $this->_pdf->Cell(40, 10, utf8_decode('¡Hola, Mundo!'));
    $this->_pdf->Cell(40, 20, utf8_decode($nombre . ' ' . $apellido));
    $this->_pdf->Output();
?>