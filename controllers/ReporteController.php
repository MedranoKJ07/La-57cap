<?php
namespace Controllers;
use MVC\Router;
use Model\Venta;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class ReporteController
{
    public static function ventasFecha(Router $router)
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');

        $reporte = Venta::ventasPorFecha($fechaInicio, $fechaFin);

        $router->renderAdmin('Reportes/ventas_fecha', [
            'titulo' => 'Reporte de Ventas por Fecha',
            'reporte' => $reporte,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ]);
    }
    public static function ventasFechaPDF()
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');
        $ventas = Venta::ventasPorFecha($fechaInicio, $fechaFin);

        // Generar HTML
        ob_start();
        include __DIR__ . '/../views/Reportes/pdf/ventas_fecha_pdf.php';
        $html = ob_get_clean();

        // Generar PDF con Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("ventas_por_fecha_{$fechaInicio}_{$fechaFin}.pdf", ["Attachment" => true]);
    }


    public static function ventasFechaExcel()
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');
        $ventas = Venta::ventasPorFecha($fechaInicio, $fechaFin);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Ventas por Fecha");

        // Encabezados
        $sheet->setCellValue('A1', 'Fecha');
        $sheet->setCellValue('B1', 'Total de Ventas');
        $sheet->setCellValue('C1', 'Monto Total (C$)');

        // Cuerpo
        $fila = 2;
        foreach ($ventas as $venta) {
            $sheet->setCellValue("A{$fila}", $venta['fecha']);
            $sheet->setCellValue("B{$fila}", $venta['total_ventas']);
            $sheet->setCellValue("C{$fila}", $venta['monto_total']);
            $fila++;
        }

        // Enviar archivo al navegador
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"ventas_por_fecha_{$fechaInicio}_{$fechaFin}.xlsx\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


}