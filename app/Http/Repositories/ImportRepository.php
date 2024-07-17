<?php

namespace App\Http\Repositories;

use App\Exports\ProductExport;
use App\Http\Interfaces\Importinterface;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class ImportRepository implements  Importinterface{

    public function view_import()
    {
        return view('import');
    }
    public function import($request)
    {
        Excel::import(new UsersImport, $request->file);
        return redirect()->back()->with('success', 'All good!');
    }

    public function export_data()
    {
        return Excel::download(new ProductExport , 'users.xlsx');
    }

}