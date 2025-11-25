<?php
if (!file_exists('vendor/autoload.php')) {
    die('<div style="font-family: sans-serif; padding: 20px; background: #ffebee; border: 1px solid #f44336; color: #b71c1c; border-radius: 4px;">
        <strong>Error:</strong> No se encontraron las librerías necesarias.<br><br>
        Por favor, asegúrese de haber instalado las dependencias.<br>
        Si está usando Laragon, abra la terminal en la carpeta del proyecto y ejecute: <code>composer install</code>
    </div>');
}

require_once('vendor/autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- Data Retrieval ---
    $exit_slip_no = isset($_POST['exit_slip_no']) ? htmlspecialchars($_POST['exit_slip_no']) : '';
    $full_name = isset($_POST['full_name']) ? strtoupper(htmlspecialchars($_POST['full_name'])) : '';
    $reason = isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : '';
    $destination = isset($_POST['destination']) ? htmlspecialchars($_POST['destination']) : '';
    $district = isset($_POST['district']) ? htmlspecialchars($_POST['district']) : '';
    $date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';

    // --- PDF Generation ---
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Document Information
    $pdf->SetCreator('Sistema de Formatos de Salud');
    $pdf->SetAuthor('Usuario');
    $pdf->SetTitle('Papeleta de Salida - ' . $full_name);

    // No header or footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Margins
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(TRUE, 10);

    // Add a page
    $pdf->AddPage();

    // --- Content ---
    $pdf->SetFont('helvetica', '', 10);

    // HTML for a single exit slip
    $html_content = '
    <style>
        .slip-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 5px;
        }
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .field {
            margin-bottom: 8px;
        }
        .label {
            font-weight: bold;
        }
        .signature {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #000;
            width: 60%;
            margin-left: 20%;
        }
    </style>
    <div class="slip-container">
        <div class="header">PAPELETA DE SALIDA N° ' . $exit_slip_no . '</div>
        <div class="field"><span class="label">Nombres y Apellidos:</span> ' . $full_name . '</div>
        <div class="field"><span class="label">Motivo de Salida:</span> ' . $reason . '</div>
        <div class="field"><span class="label">Lugar de Destino:</span> ' . $destination . '</div>
        <div class="field"><span class="label">Distrito:</span> ' . $district . '</div>
        <div class="field"><span class="label">Fecha:</span> ' . date("d/m/Y", strtotime($date)) . '</div>
        <div class="signature">FIRMA</div>
    </div>
    ';

    // Calculate dimensions
    $page_width = $pdf->getPageWidth();
    $page_height = $pdf->getPageHeight();
    $margin_left = $pdf->getMargins()['left'];
    $margin_right = $pdf->getMargins()['right'];
    $usable_width = $page_width - $margin_left - $margin_right;
    $half_width = $usable_width / 2;

    // First copy (left)
    $pdf->writeHTMLCell($half_width - 5, 0, $margin_left, 10, $html_content, 0, 1, 0, true, 'J', true);

    // Second copy (right)
    $pdf->writeHTMLCell($half_width - 5, 0, $margin_left + $half_width + 5, 10, $html_content, 0, 1, 0, true, 'J', true);

    // Dotted line in the middle
    $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2,2', 'color' => array(0, 0, 0)));
    $pdf->Line($page_width / 2, 10, $page_width / 2, $page_height - 10);

    // --- Output ---
    $filename = 'Papeleta_Salida_' . str_replace(' ', '_', $full_name) . '.pdf';
    $pdf->Output($filename, 'I'); // I = Inline preview

} else {
    echo "Método no permitido.";
}
