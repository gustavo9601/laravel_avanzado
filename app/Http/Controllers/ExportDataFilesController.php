<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportDataFilesController extends Controller
{

    public function index(){
        return view('reports.export-files');
    }

    public function exportToPdf(){
        // Cargando configuraciones de la libreraia
        $pdf = \App::make('dompdf.wrapper');

        // Cargando una vista
        $pdf->loadView('reports.pdf');
        // Cargando el html
        // $pdf->loadHTML('<h1>Test</h1>');


        // Visualizacion en el navegador
        return $pdf->stream();

        // Descarga del archivo
        // return $pdf->download();
    }

}
