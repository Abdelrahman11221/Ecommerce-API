<?php
namespace App\Http\Interfaces;

interface Importinterface{
    public function view_import();
    public function import($request);
    public function export_data();
}

?>