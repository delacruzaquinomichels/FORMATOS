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
    $pdf->SetAutoPageBreak(false, 10); // Disable auto page break to control layout

    // Add a page
    $pdf->AddPage();

    // --- Content ---
    $pdf->SetFont('helvetica', '', 10);

    // HTML for a single exit slip with modern font and underlined fields
    $html_content = '
    <table border="0" cellpadding="6" cellspacing="0" style="width: 100%; font-family: helvetica, sans-serif;">
        <tr>
            <td colspan="2" style="text-align: center; font-weight: bold; font-size: 14pt; border-bottom: 1px solid #000;">PAPELETA DE SALIDA N° ' . $exit_slip_no . '</td>
        </tr>
        <tr>
            <td width="35%" style="font-weight: bold; font-size: 10pt;">Nombres y Apellidos:</td>
            <td width="65%" style="font-size: 10pt; border-bottom: 1px solid #999;">' . $full_name . '</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size: 10pt;">Motivo de Salida:</td>
            <td style="font-size: 10pt; border-bottom: 1px solid #999;">' . $reason . '</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size: 10pt;">Lugar de Destino:</td>
            <td style="font-size: 10pt; border-bottom: 1px solid #999;">' . $destination . '</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size: 10pt;">Distrito:</td>
            <td style="font-size: 10pt; border-bottom: 1px solid #999;">' . $district . '</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size: 10pt;">Fecha:</td>
            <td style="font-size: 10pt; border-bottom: 1px solid #999;">' . date("d/m/Y", strtotime($date)) . '</td>
        </tr>
        <tr>
            <td colspan="2" style="height: 70px; text-align: center; vertical-align: bottom;">
                <div style="width: 60%; border-top: 1px solid #000; margin: 0 auto; padding-top: 5px; font-size: 10pt;">FIRMA</div>
            </td>
        </tr>
    </table>
    ';

    // Calculate dimensions
    $page_width = $pdf->getPageWidth();
    $page_height = $pdf->getPageHeight();
    $margin_left = $pdf->getMargins()['left'];
    $margin_right = $pdf->getMargins()['right'];
    $margin_top = $pdf->getMargins()['top'];
    $margin_bottom = $pdf->getMargins()['bottom'];

    $usable_width = $page_width - $margin_left - $margin_right;
    $usable_height = $page_height - $margin_top - $margin_bottom;
    $half_height = $usable_height / 2;
    $mid_point_y = $page_height / 2;

    // First copy (top)
    $pdf->writeHTMLCell($usable_width, $half_height, $margin_left, $margin_top, $html_content, 0, 1, 0, true, 'J', true);

    // Second copy (bottom)
    $pdf->writeHTMLCell($usable_width, $half_height, $margin_left, $mid_point_y + 5, $html_content, 0, 1, 0, true, 'J', true);

    // Dotted line in the middle
    $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2,2', 'color' => array(0, 0, 0)));
    $pdf->Line($margin_left, $mid_point_y, $page_width - $margin_right, $mid_point_y);

    // --- Output ---
    $filename = 'Papeleta_Salida_' . str_replace(' ', '_', $full_name) . '.pdf';
    $pdf->Output($filename, 'I'); // I = Inline preview

} else {
    echo "Método no permitido.";
}
