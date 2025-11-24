<?php
require_once('vendor/autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = isset($_POST['year']) ? $_POST['year'] : date('Y');
    $month = isset($_POST['month']) ? strtoupper($_POST['month']) : 'ENERO';
    $center_name = isset($_POST['center_name']) ? strtoupper($_POST['center_name']) : '';

    // Create new PDF document
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('Sistema de Asistencia');
    $pdf->SetAuthor('Usuario');
    $pdf->SetTitle('Parte Diario de Asistencia - ' . $center_name);

    // Remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Set margins
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(TRUE, 10);

    // Add a page
    $pdf->AddPage();

    // Fonts
    $pdf->SetFont('helvetica', 'B', 8);

    // --- Header ---
    $html_header = '
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="50%" align="left">
                RED DE SALUD VALLE DEL MANTARO<br>
                MICRORED CHUPACA<br>
                ' . $center_name . '
            </td>
            <td width="50%" align="right"></td>
        </tr>
    </table>
    <br>
    <div style="text-align: center; font-size: 12px;">PARTE DIARIO DE ASISTENCIA DEL PERSONAL</div>
    <div style="text-align: center; font-size: 12px;">AÑO - ' . $year . '</div>
    <br>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="right" style="font-size: 10px;">MES: ' . $month . '...................................................</td>
        </tr>
    </table>
    <br>
    ';

    $pdf->writeHTML($html_header, true, false, true, false, '');

    // --- Table Content ---

    // Table Header Structure
    // Using HTML tables for complex rowspan/colspan structure

    $tbl = '
    <style>
        table {
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            text-align: center;
            font-weight: bold;
            font-size: 7px;
            vertical-align: middle;
        }
        td {
            border: 1px solid black;
            font-size: 8px;
            height: 15px; /* Minimal height */
        }
    </style>
    <table cellpadding="2">
        <thead>
            <tr>
                <th colspan="3" width="9%">FECHA</th>
                <th rowspan="2" width="25%">APELLIDOS Y NOMBRES</th>
                <th rowspan="2" width="9%">CARGO</th>
                <th rowspan="2" width="5%">NIVEL</th>
                <th colspan="4" width="36%">MAÑANAS</th>
                <th rowspan="2" width="16%">OBSERVACIONES</th>
            </tr>
            <tr>
                <th width="3%">DIA</th>
                <th width="3%">MES</th>
                <th width="3%">AÑO</th>

                <th width="6%">HORA<br>ENTRADA</th>
                <th width="12%">FIRMA</th>
                <th width="6%">HORA<br>SALIDA</th>
                <th width="12%">FIRMA</th>
            </tr>
        </thead>
        <tbody>';

    // Generate empty rows
    for ($i = 0; $i < 25; $i++) {
        $tbl .= '
            <tr>
                <td></td><td></td><td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td><td></td><td></td><td></td>
                <td></td>
            </tr>';
    }

    $tbl .= '</tbody></table>';

    $pdf->writeHTML($tbl, true, false, false, false, '');

    // Output PDF
    $filename = 'Asistencia_' . str_replace(' ', '_', $center_name) . '_' . $month . '_' . $year . '.pdf';
    $pdf->Output($filename, 'I'); // I = Inline (preview in browser)
} else {
    echo "Método no permitido.";
}
