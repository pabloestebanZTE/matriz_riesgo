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

    function printMatrizRecords(PHPExcel &$objPhpExcel, $array) {
        //Ahora pintamos los datos...
        $max = count($array);
        for ($i = 0; $i < $max; $i++) {
            $record = $array[$i];
//            echo "<pre>";
//            var_dump($record);
//            echo "</pre>";
//            echo $record->k_id_zona_geografica;
            //Se escriben las causas...
            if (is_array($record->causas)) {
                $numCausas = 0;
                foreach ($record->causas as $causa) {
                    $objPhpExcel->getActiveSheet()->setCellValue("M" . ($i + 6 + $numCausas), $record->n_proceso);
                    $numCausas++;
                }
                //Se actualizan las celdas...
                if ($numCausas > 1) {
                    $objPhpExcel->getActiveSheet()->mergeCells('A' . ($i + 6) . ':A' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('B' . ($i + 6) . ':B' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('C' . ($i + 6) . ':C' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('D' . ($i + 6) . ':D' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('E' . ($i + 6) . ':E' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('F' . ($i + 6) . ':F' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('G' . ($i + 6) . ':G' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('H' . ($i + 6) . ':H' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('I' . ($i + 6) . ':I' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('J' . ($i + 6) . ':J' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('K' . ($i + 6) . ':K' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('L' . ($i + 6) . ':L' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('O' . ($i + 6) . ':O' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('P' . ($i + 6) . ':P' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->mergeCells('N' . ($i + 6) . ':N' . ($i + 6 + $numCausas));
                    $objPhpExcel->getActiveSheet()->getStyle('A' . ($i + 6) . ':R' . ($i + 6 + $numCausas))->applyFromArray(
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
                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                ),
                                'borders' => array(
                                    'allborders' => array(
                                        'style' => PHPExcel_Style_Border::BORDER_THIN
                                    )
                                )
                    ));
//                    $objPhpExcel->getActiveSheet()->mergeCells('Q' . ($i + 6) . ':R' . ($i + 6 + $numCausas));
                }
            }
//            $objPhpExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(30);
            $objPhpExcel->getActiveSheet()->setCellValue("A" . ($i + 6), (($record->k_id_zona_geografica) ? $record->k_id_zona_geografica->n_nombre : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("B" . ($i + 6), $record->n_macro_proceso);
            $objPhpExcel->getActiveSheet()->setCellValue("C" . ($i + 6), $record->n_proceso);
            $objPhpExcel->getActiveSheet()->setCellValue("D" . ($i + 6), $record->n_servicio);
            $objPhpExcel->getActiveSheet()->setCellValue("E" . ($i + 6), $record->n_objetivo);
            $objPhpExcel->getActiveSheet()->setCellValue("F" . ($i + 6), (($record->k_id_riesgo) ? $record->k_id_riesgo->nombre_riesgo : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("G" . ($i + 6), (($record->k_id_riesgo) ? $record->k_id_riesgo->n_responsable : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("H" . ($i + 6), (($record->k_id_riesgo) ? $record->k_id_riesgo->n_riesgo : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("I" . ($i + 6), (($record->k_id_riesgo) ? $record->k_id_riesgo->n_riesgo_descripcion : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("J" . ($i + 6), $record->n_tipo_activad);
            $objPhpExcel->getActiveSheet()->setCellValue("K" . ($i + 6), (($record->k_id_tipo_evento_2) ? $record->k_id_tipo_evento_2->k_id_tipo_evento_1->n_descripcion : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("L" . ($i + 6), (($record->k_id_tipo_evento_2) ? $record->k_id_tipo_evento_2->n_descripcion : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("O" . ($i + 6), (($record->k_id_probabilidad) ? $record->k_id_probabilidad->n_descripcion : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("P" . ($i + 6), (($record->k_id_impacto) ? $record->k_id_impacto->n_descripcion : "Indefinido"));
            $objPhpExcel->getActiveSheet()->setCellValue("Q" . ($i + 6), (($record->n_severidad_riesgo_inherente) ? $record->n_severidad_riesgo_inherente->n_calificacion : "Indefinido"));
            $objPhpExcel->getActiveSheet()->mergeCells("Q" . ($i + 6) . ":R" . ($i + 6 + (($numCausas > 1 ? $numCausas : 0))));
            $objPhpExcel->getActiveSheet()->getStyle('Q' . ($i + 6) . ':R' . ($i + 6))->applyFromArray(
                    array(
                        'font' => array(
                            'bold' => false,
                            'size' => 13
                        ),
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => (($record->n_severidad_riesgo_inherente->n_color) ? str_replace("#", "", $record->n_severidad_riesgo_inherente->n_color) : "ffffff"))
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
            $objPhpExcel->getActiveSheet()->getStyle('A' . ($i + 6) . ':P' . ($i + 6))->applyFromArray(
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
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
            ));
            $objPhpExcel->getActiveSheet()->getStyle('L5:L' . $objPhpExcel
                            ->getActiveSheet()->getHighestRow())
                    ->getAlignment()->setWrapText(true);
        }
    }

    function printControlsRecords($array) {
        
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
        $this->createHeaderTable1($objPhpExcel);
        $this->createHeaderTable2($objPhpExcel);
        $this->createHeaderTable3($objPhpExcel);

        //Consultamos las matrices...
        $matrizModel = new RiesgoEspecificoModel();
        $array = $matrizModel->get();
        $this->getFkRecords($array);
        $this->printMatrizRecords($objPhpExcel, $array);

        //Ponemos un nombre a la hoja.
        $objPhpExcel->getActiveSheet()->setTitle('Matriz de riesgos');
        //Hacemos la hoja activa...
        $objPhpExcel->setActiveSheetIndex(0);
        //Guardamos.
        $objWriter = new PHPExcel_Writer_Excel2007($objPhpExcel);
        $filename = 'Reporte Comentarios - (' . date("Y-m-d") . ').xlsx';
        $objWriter->save($filename);
        echo "<a href=\"" . Redirect::to(URL::to($filename)) . "\">Descargar</a>";
    }

    public function createHeaderTable2(&$objPhpExcel) {
        $objPhpExcel->getActiveSheet()->mergeCells('T1:AF1');
        $objPhpExcel->getActiveSheet()->setCellValue('T1', 'Inventario de Controles');
        $objPhpExcel->getActiveSheet()->getStyle('T1:AF1')->applyFromArray(
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
        $objPhpExcel->getActiveSheet()->mergeCells('T2:AF2');
        $objPhpExcel->getActiveSheet()->setCellValue('T2', 'Proceso:');
        $objPhpExcel->getActiveSheet()->getStyle('T2:AF2')->applyFromArray(
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
        $objPhpExcel->getActiveSheet()->mergeCells('T3:AF3');
        $objPhpExcel->getActiveSheet()->setCellValue('T3', 'Plataforma:');
        $objPhpExcel->getActiveSheet()->getStyle('T3:AF3')->applyFromArray(
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
        $img = new PHPExcel_Worksheet_MemoryDrawing();
        $img->setName('Sample image');
        $img->setDescription('Sample image');
        $img->setImageResource($gdImage);
        $img->setOffsetX(15);
        $img->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
        $img->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $img->setHeight(90);
        $img->setCoordinates('AG1');
        $img->setWorksheet($objPhpExcel->getActiveSheet());

        $objPhpExcel->getActiveSheet()->getStyle('AG1:AI3')->applyFromArray(
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


        $objPhpExcel->getActiveSheet()->mergeCells('AG1:AI2');

        $objPhpExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);

        $objPhpExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPhpExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
        $objPhpExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);

        $objPhpExcel->getActiveSheet()->setCellValue("AG3", "Versión: 1");
        $objPhpExcel->getActiveSheet()->mergeCells('AG3:AI3');

        $objPhpExcel->getActiveSheet()->getStyle('AG3:AI3')->applyFromArray(
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

        $objPhpExcel->getActiveSheet()->getStyle('AF5:AH6')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffe699')
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
        $objPhpExcel->getActiveSheet()->getStyle('AI5:AI6')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'fffccc')
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

        //Creando las cabeceras de la tabla... 85c2ff
        $objPhpExcel->getActiveSheet()->getStyle('T5:AE6')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'b4c6e7')
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

        //Escribir cabecearas.
        $objPhpExcel->getActiveSheet()->setCellValue("T5", "Descripción del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("U5", "Responsabilidad del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("U6", "Asignación");
        $objPhpExcel->getActiveSheet()->setCellValue("V6", "Cargo");
        $objPhpExcel->getActiveSheet()->setCellValue("W5", "Tipo de Control");
        $objPhpExcel->getActiveSheet()->setCellValue("W6", "Tipo");
        $objPhpExcel->getActiveSheet()->setCellValue("X6", "Funcionalidad");
        $objPhpExcel->getActiveSheet()->setCellValue("Y5", "Naturaleza del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("Z5", "Frecuencia del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("Z6", "Periodicidad");
        $objPhpExcel->getActiveSheet()->setCellValue("AA6", "Funcionalidad");
        $objPhpExcel->getActiveSheet()->setCellValue("AB5", "Documentación del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("AC5", "Actividades que componen el Control");
        $objPhpExcel->getActiveSheet()->setCellValue("AD5", "Ejecución del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("AE5", "Importancia del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("AF5", "Disminuye la Probabilidad");
        $objPhpExcel->getActiveSheet()->setCellValue("AG5", "Disminuye el Impacto");
        $objPhpExcel->getActiveSheet()->setCellValue("AH5", "Calificación del Control");
        $objPhpExcel->getActiveSheet()->setCellValue("AI5", "Riesgo Residual");


        $objPhpExcel->getActiveSheet()->mergeCells('T5:T6');
        $objPhpExcel->getActiveSheet()->mergeCells('U5:V5');
        $objPhpExcel->getActiveSheet()->mergeCells('W5:X5');
        $objPhpExcel->getActiveSheet()->mergeCells('Y5:Y6');
        $objPhpExcel->getActiveSheet()->mergeCells('Z5:AA5');
        $objPhpExcel->getActiveSheet()->mergeCells('AB5:AB6');
        $objPhpExcel->getActiveSheet()->mergeCells('AC5:AC6');
        $objPhpExcel->getActiveSheet()->mergeCells('AD5:AD6');
        $objPhpExcel->getActiveSheet()->mergeCells('AE5:AE6');
        $objPhpExcel->getActiveSheet()->mergeCells('AF5:AF6');
        $objPhpExcel->getActiveSheet()->mergeCells('AG5:AG6');
        $objPhpExcel->getActiveSheet()->mergeCells('AH5:AH6');
        $objPhpExcel->getActiveSheet()->mergeCells('AI5:AI6');

        //Aplicamos las dimenciones a las celdas...
        //SET WIDTHs
        $objPhpExcel->getActiveSheet()->getColumnDimension('T')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(30);
        //SET HEIGHTs
//        $objPhpExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(30);
    }

    public function createHeaderTable3(PHPExcel &$objPhpExcel) {
        $objPhpExcel->getActiveSheet()->mergeCells('AK1:AS1');
        $objPhpExcel->getActiveSheet()->setCellValue('AK1', 'Indicadores para Administrar el Riesgo');
        $objPhpExcel->getActiveSheet()->getStyle('AK1:AS1')->applyFromArray(
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
        $objPhpExcel->getActiveSheet()->mergeCells('AK2:AS2');
        $objPhpExcel->getActiveSheet()->setCellValue('AK2', 'Proceso:');
        $objPhpExcel->getActiveSheet()->getStyle('AK2:AS2')->applyFromArray(
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
        $objPhpExcel->getActiveSheet()->mergeCells('AK3:AS3');
        $objPhpExcel->getActiveSheet()->setCellValue('AK3', 'Plataforma:');
        $objPhpExcel->getActiveSheet()->getStyle('AK3:AS3')->applyFromArray(
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
        $img = new PHPExcel_Worksheet_MemoryDrawing();
        $img->setName('Sample image');
        $img->setDescription('Sample image');
        $img->setImageResource($gdImage);
        $img->setOffsetX(15);
        $img->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
        $img->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $img->setHeight(90);
        $img->setCoordinates('AT1');
        $img->setWorksheet($objPhpExcel->getActiveSheet());

        $objPhpExcel->getActiveSheet()->getStyle('AT1:AU3')->applyFromArray(
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


        $objPhpExcel->getActiveSheet()->mergeCells('AT1:AU2');

        $objPhpExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(20);

        $objPhpExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPhpExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
        $objPhpExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);

        $objPhpExcel->getActiveSheet()->setCellValue("AT3", "Versión: 1");
        $objPhpExcel->getActiveSheet()->mergeCells('AT3:AU3');

        $objPhpExcel->getActiveSheet()->getStyle('AT3:AU3')->applyFromArray(
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

        $objPhpExcel->getActiveSheet()->getStyle('AK5:AU6')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'b4c6e7')
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
        //Escribir cabecearas.
        $objPhpExcel->getActiveSheet()->setCellValue("AK5", "Desempeño");
        $objPhpExcel->getActiveSheet()->setCellValue("AK6", "KPI");
        $objPhpExcel->getActiveSheet()->setCellValue("AL6", "Unidad de medida");
        $objPhpExcel->getActiveSheet()->setCellValue("AM6", "Frecuencia");
        $objPhpExcel->getActiveSheet()->setCellValue("AN6", "Meta");
        $objPhpExcel->getActiveSheet()->setCellValue("AO6", "Responsable");
        $objPhpExcel->getActiveSheet()->setCellValue("AP5", "Control");
        $objPhpExcel->getActiveSheet()->setCellValue("AP6", "KCI");
        $objPhpExcel->getActiveSheet()->setCellValue("AQ6", "Unidad de medida");
        $objPhpExcel->getActiveSheet()->setCellValue("AR6", "Frecuencia");
        $objPhpExcel->getActiveSheet()->setCellValue("AS6", "Meta");
        $objPhpExcel->getActiveSheet()->setCellValue("AT6", "Responsable");
        $objPhpExcel->getActiveSheet()->setCellValue("AU5", "Riesgo");
        $objPhpExcel->getActiveSheet()->setCellValue("AU6", "KRI");
//
//
        $objPhpExcel->getActiveSheet()->mergeCells('AK5:AO5');
        $objPhpExcel->getActiveSheet()->mergeCells('AP5:AT5');
//
//        //Aplicamos las dimenciones a las celdas...
//        //SET WIDTHs
        $objPhpExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(10);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(10);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(10);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(10);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(25);
        //SET HEIGHTs
//        $objPhpExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(30);
    }

    function createHeaderTable1(&$objPhpExcel) {
        $objPhpExcel->getActiveSheet()->mergeCells('A1:O1');
        $objPhpExcel->getActiveSheet()->setCellValue('A1', 'Matriz de riesgos');
        $objPhpExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray(
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
        $objPhpExcel->getActiveSheet()->mergeCells('A2:O2');
        $objPhpExcel->getActiveSheet()->setCellValue('A2', 'Proceso:');
        $objPhpExcel->getActiveSheet()->getStyle('A2:O2')->applyFromArray(
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
        $objPhpExcel->getActiveSheet()->mergeCells('A3:O3');
        $objPhpExcel->getActiveSheet()->setCellValue('A3', 'Responsable:');
        $objPhpExcel->getActiveSheet()->getStyle('A3:O3')->applyFromArray(
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
        $objDrawing->setCoordinates('P1');
        $objDrawing->setWorksheet($objPhpExcel->getActiveSheet());

        $objPhpExcel->getActiveSheet()->getStyle('P1:R2')->applyFromArray(
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


        $objPhpExcel->getActiveSheet()->mergeCells('P1:R2');

        $objPhpExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);

        $objPhpExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objPhpExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
        $objPhpExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);

        $objPhpExcel->getActiveSheet()->setCellValue("P3", "Versión: 1");
        $objPhpExcel->getActiveSheet()->mergeCells('P3:R3');

        $objPhpExcel->getActiveSheet()->getStyle('P3:R3')->applyFromArray(
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

        $objPhpExcel->getActiveSheet()->mergeCells('Q5:R5');
        $objPhpExcel->getActiveSheet()->getStyle('Q5:R5')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'fffccc')
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

        //Creando las cabeceras de la tabla... 85c2ff
        $objPhpExcel->getActiveSheet()->getStyle('A5:P5')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true,
                        'size' => 13
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'b4c6e7')
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

        //Escribir cabecearas.
        $objPhpExcel->getActiveSheet()->setCellValue("A5", "Zona Geográfica");
        $objPhpExcel->getActiveSheet()->setCellValue("B5", "Macro proceso");
        $objPhpExcel->getActiveSheet()->setCellValue("C5", "Proceso");
        $objPhpExcel->getActiveSheet()->setCellValue("D5", "Servicios");
        $objPhpExcel->getActiveSheet()->setCellValue("E5", "Objetivo");
        $objPhpExcel->getActiveSheet()->setCellValue("F5", "ID");
        $objPhpExcel->getActiveSheet()->setCellValue("G5", "Responsable");
        $objPhpExcel->getActiveSheet()->setCellValue("H5", "Riesgo");
        $objPhpExcel->getActiveSheet()->setCellValue("I5", "Descripción del Riesgo");
        $objPhpExcel->getActiveSheet()->setCellValue("J5", "Tipo de Actividad");
        $objPhpExcel->getActiveSheet()->setCellValue("K5", "Tipo de Evento (nivel 1)");
        $objPhpExcel->getActiveSheet()->setCellValue("L5", "Tipo de Evento (nivel 2)");
        $objPhpExcel->getActiveSheet()->setCellValue("M5", "Causa");
        $objPhpExcel->getActiveSheet()->setCellValue("N5", "Factor de Riesgo");
        $objPhpExcel->getActiveSheet()->setCellValue("O5", "Probabilidad");
        $objPhpExcel->getActiveSheet()->setCellValue("P5", "Impacto");
        $objPhpExcel->getActiveSheet()->setCellValue("Q5", "Severidad del Riesgo Inherente");
//
//        //Aplicamos las dimenciones a las celdas...
//        //SET WIDTHs
        $objPhpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('M')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        //SET HEIGHTs
        $objPhpExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(30);
    }

    function getFkRecords(&$array) {
        $max = count($array);
        for ($i = 0; $i < $max; $i++) {
            $record = new ObjUtil($array[$i]);
            $record->k_id_zona_geografica = (new ZonaGeograficaModel())->where("k_id_zona_geografica", "=", $record->k_id_zona_geografica)->first();
            $record->k_id_riesgo = (new RiesgoModel())->where("k_id_riesgo", "=", $record->k_id_riesgo)->first();
            $record->k_id_tipo_evento_2 = (new TipoEvento2Model())->where("k_id_tipo_evento_2", "=", $record->k_id_tipo_evento_2)->first();
            if ($record->k_id_tipo_evento_2) {
                $record->k_id_tipo_evento_2->k_id_tipo_evento_1 = (new TipoEvento1Model())->where("k_id_tipo_evento_1", "=", $record->k_id_tipo_evento_2->k_id_tipo_evento_1)->first();
            }
            $record->causas = (new CausaModel())->where("k_id_riesgo_especifico", "=", $record->k_id_riesgo_especifico)->get();
            $record->k_id_probabilidad = (new ProbabilidadModel())->where("k_id_probabilidad", "=", $record->k_id_probabilidad)->first();
            $record->k_id_impacto = (new ImpactoModel())->where("k_id_impacto", "=", $record->k_id_impacto)->first();
            $record->n_severidad_riesgo_inherente = (new RefProbabilidadImpactoModel())->where("n_calificacion", "=", $record->n_severidad_riesgo_inherente)->first();
            $array[$i] = $record;
        }
    }

}
