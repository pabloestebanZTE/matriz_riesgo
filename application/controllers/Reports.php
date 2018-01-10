<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    function __construct() {
        parent::__construct();
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        require_once APPPATH . '/libraries/PhpExcel/PHPExcel.php';
    }

    function downloadReportMatriz() {

        if (PHP_SAPI == 'cli') {
            die('This example should only be run from a Web Browser');
        }


        $objPhpExcel = new PHPExcel();
        //Propiedades de archivo.
        $objPhpExcel->getProperties()->setCreator("ZTE");
        $objPhpExcel->getProperties()->setLastModifiedBy("ZTE");
        $objPhpExcel->getProperties()->setTitle("Reporte Comentarios");
        $objPhpExcel->getProperties()->setSubject("Reporte Comentarios - Zolid");
        $objPhpExcel->getProperties()->setDescription("Reporte Comentarios - Zolid");
        //Seleccionamos la página.
        $objPhpExcel->setActiveSheetIndex(0);
        //Aplicamos estilos a las celdas.
//        $objPhpExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray(
//                array(
//                    'font' => array(
//                        'bold' => true
//                    ),
//                    'fill' => array(
//                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
//                        'color' => array('rgb' => '85c2ff')
//                    ),
//                    'alignment' => array(
//                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//                    )
//        ));

        $objPhpExcel->getActiveSheet()->mergeCells('A1:P1');
        $objPhpExcel->getActiveSheet()->setCellValue('A1', 'Matriz de riesgos');
        $objPhpExcel->getActiveSheet()->getStyle('A1:P1')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true,
                        'size' => 20
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffffff')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
        ));
        $objPhpExcel->getActiveSheet()->mergeCells('A2:P2');
        $objPhpExcel->getActiveSheet()->setCellValue('A2', 'Proceso:');
        $objPhpExcel->getActiveSheet()->getStyle('A2:P2')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => false,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffffff')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
        ));
        $objPhpExcel->getActiveSheet()->mergeCells('A3:P3');
        $objPhpExcel->getActiveSheet()->setCellValue('A3', 'Responsable:');
        $objPhpExcel->getActiveSheet()->getStyle('A3:P3')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => false,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffffff')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
        ));

        $gdImage = imagecreatefrompng('assets/img/logo_reporte.png');
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($gdImage);
        $objDrawing->setOffsetX(15);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(90);
        $objDrawing->setCoordinates('Q1');
        $objDrawing->setWorksheet($objPhpExcel->getActiveSheet());

        $objPhpExcel->getActiveSheet()->getStyle('Q1:S2')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffffff')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
        ));


        $objPhpExcel->getActiveSheet()->mergeCells('Q1:S2');

        $objPhpExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);

        $objPhpExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPhpExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
        $objPhpExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);

        $objPhpExcel->getActiveSheet()->mergeCells('Q3:S3');
        $objPhpExcel->getActiveSheet()->getStyle('Q3:S3')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffffff')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
        ));
        $objPhpExcel->getActiveSheet()->setCellValue("Q3", "Versión: 1");

        //Escribir cabecearas.
//        $objPhpExcel->getActiveSheet()->setCellValue("A1", "Id-On Air");
//        $objPhpExcel->getActiveSheet()->setCellValue("B1", "Nombre_Estación-EB");
//        $objPhpExcel->getActiveSheet()->setCellValue("C1", "Tecnología");
//        $objPhpExcel->getActiveSheet()->setCellValue("D1", "Banda");
//        $objPhpExcel->getActiveSheet()->setCellValue("E1", "");
//        $objPhpExcel->getActiveSheet()->setCellValue("F1", "Estado EB-ResuComen");
//        $objPhpExcel->getActiveSheet()->setCellValue("G1", "Comentario-ResuComen");
//        $objPhpExcel->getActiveSheet()->setCellValue("H1", "Hora Actualización ResuComen");
//        $objPhpExcel->getActiveSheet()->setCellValue("I1", "Usuario-ResuComen");
//        $objPhpExcel->getActiveSheet()->setCellValue("J1", "Ente-Ejecutor");
//        $objPhpExcel->getActiveSheet()->setCellValue("K1", "Tipificación-ResuComen");
//        $objPhpExcel->getActiveSheet()->setCellValue("L1", "NOC");
//
//        //Aplicamos las dimenciones a las celdas...
//        $objPhpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
//        $objPhpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        //Ahora pintamos los datos...
//        for ($i = 0; $i < count($respuesta); $i++) {
//            $objPhpExcel->getActiveSheet()->setCellValue("A" . ($i + 2), $respuesta[$i]->k_id_on_air);
//            $objPhpExcel->getActiveSheet()->setCellValue("B" . ($i + 2), $respuesta[$i]->n_nombre_estacion_eb);
//            $objPhpExcel->getActiveSheet()->setCellValue("C" . ($i + 2), $respuesta[$i]->n_tecnologia);
//            $objPhpExcel->getActiveSheet()->setCellValue("D" . ($i + 2), $respuesta[$i]->n_banda);
//            $objPhpExcel->getActiveSheet()->setCellValue("E" . ($i + 2), $respuesta[$i]->n_tipo_trabajo);
//            $objPhpExcel->getActiveSheet()->setCellValue("F" . ($i + 2), $respuesta[$i]->n_estado_eb_resucomen);
//            $objPhpExcel->getActiveSheet()->setCellValue("G" . ($i + 2), $respuesta[$i]->comentario_resucoment);
//            $objPhpExcel->getActiveSheet()->setCellValue("H" . ($i + 2), $respuesta[$i]->hora_actualizacion_resucomen);
//            $objPhpExcel->getActiveSheet()->setCellValue("I" . ($i + 2), $respuesta[$i]->usuario_resucomen);
//            $objPhpExcel->getActiveSheet()->setCellValue("J" . ($i + 2), $respuesta[$i]->ente_ejecutor);
//            $objPhpExcel->getActiveSheet()->setCellValue("K" . ($i + 2), $respuesta[$i]->tipificacion_resucomen);
//            $objPhpExcel->getActiveSheet()->setCellValue("L" . ($i + 2), $respuesta[$i]->noc);
//        }
        //Ponemos un nombre a la hoja.
        $objPhpExcel->getActiveSheet()->setTitle('Reporte Comentarios');
        //Hacemos la hoja activa...
        $objPhpExcel->setActiveSheetIndex(0);
        //Guardamos.
        $objWriter = new PHPExcel_Writer_Excel2007($objPhpExcel);
        $filename = 'Reporte Comentarios - (' . date("Y-m-d") . ').xlsx';
        $objWriter->save($filename);
        echo "<a href=\"" . Redirect::to(URL::to($filename)) . "\">Descargar</a>";
    }

}
