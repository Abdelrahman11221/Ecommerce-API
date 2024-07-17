<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ImportInterface;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    protected $interface;
    public function __construct(ImportInterface $interface)
    {
        $this->interface = $interface;
    }
    public function viewer()
    {
        return $this->interface->view_import();
    }

    public function uploader(Request $request)
    {
        $this->interface->import($request);
    }

    public function  export_data() 
    {
        return $this->interface->export_data();
    }
}
