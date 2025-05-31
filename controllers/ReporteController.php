<?php
namespace Controllers;
use MVC\Router;
use Model\Venta;
use Model\Pedido;
use Model\Inventario;
use Model\Compra;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReporteController
{
    public static function index(Router $router)
    {

        $router->renderAdmin('Reportes/gestionarReportes', [
            'titulo' => 'Panel de Reportes'

        ]);
    }
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
    public static function ventasPorVendedor(Router $router)
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');

        $reporte = Venta::ventasPorVendedor($fechaInicio, $fechaFin);

        $router->renderAdmin('Reportes/ventas_vendedor', [
            'titulo' => 'Reporte de Ventas por Vendedor',
            'reporte' => $reporte,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ]);
    }


    public static function exportarVentasVendedorPdf()
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Venta::ventasPorVendedor($fechaInicio, $fechaFin);

        ob_start();
        include __DIR__ . '/../views/Reportes/pdf/ventas_Vendedor.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("VentasPorVendedor_{$fechaInicio}_{$fechaFin}.pdf", ['Attachment' => false]);
    }

    public static function exportarVentasVendedorExcel()
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Venta::ventasPorVendedor($fechaInicio, $fechaFin);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Ventas por Vendedor');
        $sheet->setCellValue('A1', 'Nombre del Vendedor');
        $sheet->setCellValue('B1', 'Total Ventas');
        $sheet->setCellValue('C1', 'Monto Total (C$)');

        $fila = 2;
        foreach ($reporte as $r) {
            $sheet->setCellValue("A{$fila}", $r['nombre_vendedor']);
            $sheet->setCellValue("B{$fila}", $r['total_ventas']);
            $sheet->setCellValue("C{$fila}", $r['monto_total']);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=VentasPorVendedor_{$fechaInicio}_{$fechaFin}.xlsx");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    public static function ventasProducto(Router $router)
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');

        $reporte = Venta::ventasPorProducto($fechaInicio, $fechaFin);

        $router->renderAdmin('Reportes/ventas_producto', [
            'titulo' => 'Reporte de Ventas por Producto',
            'reporte' => $reporte,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ]);
    }
    public static function exportarVentasProductoPdf()
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Venta::ventasPorProducto($fechaInicio, $fechaFin);

        ob_start();
        include __DIR__ . '/../views/Reportes/pdf/ventas_producto.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("VentasPorProducto_{$fechaInicio}_{$fechaFin}.pdf", ['Attachment' => false]);
    }
    public static function exportarVentasProductoExcel()
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Venta::ventasPorProducto($fechaInicio, $fechaFin);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Ventas por Producto');

        $sheet->setCellValue('A1', 'Producto');
        $sheet->setCellValue('B1', 'Total Vendidos');
        $sheet->setCellValue('C1', 'Monto Total (C$)');

        $fila = 2;
        foreach ($reporte as $r) {
            $sheet->setCellValue("A{$fila}", $r['nombre_producto']);
            $sheet->setCellValue("B{$fila}", $r['total_vendidos']);
            $sheet->setCellValue("C{$fila}", $r['monto_total']);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=VentasPorProducto_{$fechaInicio}_{$fechaFin}.xlsx");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    public static function ventasCategoria(Router $router)
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');

        $reporte = Venta::ventasPorCategoria($fechaInicio, $fechaFin);

        $router->renderAdmin('Reportes/ventas_categoria', [
            'titulo' => 'Reporte de Ventas por Categoría',
            'reporte' => $reporte,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ]);
    }
    public static function exportarVentasCategoriaPdf()
    {
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Venta::ventasPorCategoria($inicio, $fin);

        ob_start();
        include __DIR__ . '/../views/Reportes/pdf/ventas_categoria.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("VentasPorCategoria_{$inicio}_{$fin}.pdf", ['Attachment' => false]);
    }

    public static function exportarVentasCategoriaExcel()
    {
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Venta::ventasPorCategoria($inicio, $fin);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Ventas por Categoría');

        $sheet->setCellValue('A1', 'Categoría');
        $sheet->setCellValue('B1', 'Total Vendidos');
        $sheet->setCellValue('C1', 'Monto Total (C$)');

        $fila = 2;
        foreach ($reporte as $r) {
            $sheet->setCellValue("A{$fila}", $r['categoria']);
            $sheet->setCellValue("B{$fila}", $r['total_vendidos']);
            $sheet->setCellValue("C{$fila}", $r['monto_total']);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=VentasPorCategoria_{$inicio}_{$fin}.xlsx");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    public static function pedidosRepartidor(Router $router)
    {
        $fechaInicio = $_GET['inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fin'] ?? date('Y-m-d');

        $reporte = Pedido::pedidosPorRepartidor($fechaInicio, $fechaFin);

        $router->renderAdmin('Reportes/pedidos_repartidor', [
            'titulo' => 'Reporte de Pedidos por Repartidor',
            'reporte' => $reporte,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ]);
    }
    public static function exportarPedidosRepartidorPdf()
    {
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Pedido::pedidosPorRepartidor($inicio, $fin);

        ob_start();
        include __DIR__ . '/../views/Reportes/pdf/pedidos_Repartidor.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("PedidosPorRepartidor_{$inicio}_{$fin}.pdf", ['Attachment' => false]);
    }
    public static function exportarPedidosRepartidorExcel()
    {
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin = $_GET['fin'] ?? date('Y-m-d');
        $reporte = Pedido::pedidosPorRepartidor($inicio, $fin);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Pedidos por Repartidor');

        $sheet->setCellValue('A1', 'Repartidor');
        $sheet->setCellValue('B1', 'Total Pedidos Entregados');

        $fila = 2;
        foreach ($reporte as $r) {
            $sheet->setCellValue("A{$fila}", $r['p_nombre'] . ' ' . $r['p_apellido']);
            $sheet->setCellValue("B{$fila}", $r['total_pedidos']);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=PedidosPorRepartidor_{$inicio}_{$fin}.xlsx");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    public static function movimientoStock(Router $router)
    {
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin = $_GET['fin'] ?? date('Y-m-d');

        $reporte = Inventario::movimientoStock($inicio, $fin);

        $router->renderAdmin('Reportes/movimiento_stock', [
            'titulo' => 'Movimiento de Stock',
            'reporte' => $reporte,
            'fechaInicio' => $inicio,
            'fechaFin' => $fin
        ]);
    }


    public static function exportarMovimientoStockPdf()
    {
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin = $_GET['fin'] ?? date('Y-m-d');

        $datos = Inventario::movimientoStock($inicio, $fin);

        ob_start();
        include_once __DIR__ . '/../views/Reportes/pdf/movimiento_stock_pdf.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('movimiento_stock.pdf', ['Attachment' => false]);
    }

    public static function exportarMovimientoStockExcel()
    {
        $inicio = $_GET['inicio'] ?? date('Y-m-01');
        $fin = $_GET['fin'] ?? date('Y-m-d');

        $datos = Inventario::movimientoStock($inicio, $fin);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Movimiento de Stock');

        $sheet->setCellValue('A1', 'Producto');
        $sheet->setCellValue('B1', 'Cantidad Comprada');
        $sheet->setCellValue('C1', 'Cantidad Vendida');
        $sheet->setCellValue('D1', 'Saldo Neto');

        $fila = 2;
        foreach ($datos as $dato) {
            $sheet->setCellValue("A{$fila}", $dato['nombre_producto']);
            $sheet->setCellValue("B{$fila}", $dato['cantidad_comprada']);
            $sheet->setCellValue("C{$fila}", $dato['cantidad_vendida']);
            $sheet->setCellValue("D{$fila}", $dato['cantidad_comprada'] - $dato['cantidad_vendida']);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="movimiento_stock.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    public static function valorizacionInventario(Router $router)
    {
        $datos = Inventario::valorizacionInventario();

        $router->renderAdmin('Reportes/valorizacion_inventario', [
            'titulo' => 'Valorización del Inventario',
            'datos' => $datos
        ]);
    }


    public static function valorizacionInventarioPdf()
    {
        $datos = Inventario::valorizacionInventario();

        ob_start();
        include_once __DIR__ . '/../views/Reportes/pdf/valorizacion_inventario_pdf.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("valorizacion_inventario.pdf", ["Attachment" => false]);
    }

    public static function valorizacionInventarioExcel()
    {
        $datos = Inventario::valorizacionInventario();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Inventario');

        $sheet->setCellValue('A1', 'Producto');
        $sheet->setCellValue('B1', 'Precio Unitario');
        $sheet->setCellValue('C1', 'Cantidad');
        $sheet->setCellValue('D1', 'Valor Total');

        $fila = 2;
        foreach ($datos as $row) {
            $sheet->setCellValue("A{$fila}", $row['nombre_producto']);
            $sheet->setCellValue("B{$fila}", $row['precio']);
            $sheet->setCellValue("C{$fila}", $row['cantidad_actual']);
            $sheet->setCellValue("D{$fila}", $row['valor_total']);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="valorizacion_inventario.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    // controllers/ReporteController.php
    public static function productosComprados(Router $router)
    {
        $reporte = Compra::productosComprados();

        $router->renderAdmin('Reportes/productos_comprados', [
            'titulo' => 'Productos Comprados',
            'reporte' => $reporte
        ]);
    }

    public static function productosCompradosPDF()
    {
        $reporte = Compra::productosComprados();

        ob_start();
        include __DIR__ . '/../views/Reportes/pdf/productos_comprados_pdf.php';
        $html = ob_get_clean();

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $pdf = new Dompdf($options);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream("productos_comprados.pdf", ["Attachment" => false]);
    }


    public static function productosCompradosExcel()
    {
        $reporte = Compra::productosComprados();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Productos Comprados');

        // Encabezados
        $sheet->setCellValue('A1', 'Producto');
        $sheet->setCellValue('B1', 'Total Comprado');
        $sheet->setCellValue('C1', 'Costo Total (C$)');

        // Contenido
        $row = 2;
        foreach ($reporte as $fila) {
            $sheet->setCellValue("A{$row}", $fila->nombre_producto);
            $sheet->setCellValue("B{$row}", $fila->total_comprado);
            $sheet->setCellValue("C{$row}", $fila->costo_total);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="productos_comprados.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}