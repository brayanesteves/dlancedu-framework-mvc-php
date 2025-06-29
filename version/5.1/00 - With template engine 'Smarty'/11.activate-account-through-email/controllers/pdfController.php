<?php
    class pdfController extends Controller {

        private $_pdf;

        public function __construct() {
            parent::__construct();
            $this->getLibrary('fpdf');
            $this->_pdf = new FPDF;
        }

        public function index() {

        }

        /**
         * @param $nombre
         * @param $apellido
         * 
         * Nomenclature:
         * http://localhost/mvc/pdf/pdf1/$nombre/$apellido
         * Example:
         * 1) http://localhost/mvc/pdf/pdf1/Jaisiel/Delance
         */
        public function pdf1($nombre, $apellido) {
            $this->getLibrary('fpdf');
            $pdf = new FPDF;
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(40, 10, utf8_decode('¡Hola, Mundo!'));
            $pdf->Cell(40, 20, utf8_decode($nombre . ' ' . $apellido));
            $pdf->Output();
        }

        /**
         * @param $nombre
         * @param $apellido
         * 
         * N
         * http://localhost/mvc/pdf/pdf1/$nombre/$apellido
         * Example:
         * 1) http://localhost/mvc/pdf/pdf2/Jaisiel/Delance
         */
        public function pdf2($nombre, $apellido) {
            $this->getLibrary('fpdf');
            $this->_pdf->AddPage();
            $this->_pdf->SetFont('Arial', 'B', 16);
            $this->_pdf->Cell(40, 10, utf8_decode('¡Hola, Mundo!'));
            $this->_pdf->Cell(40, 20, utf8_decode($nombre . ' ' . $apellido));
            $this->_pdf->Output();
        }

        /**
         * @param $nombre
         * @param $apellido
         * 
         * N
         * http://localhost/mvc/pdf/pdf1/$nombre/$apellido
         * Example:
         * 1) http://localhost/mvc/pdf/pdf3/Jaisiel/Delance
         */
        public function pdf3($nombre, $apellido) {
            require_once ROOT . 'public' . DS . 'files' . DS . 'pdf2.php';
        }
    }
?>