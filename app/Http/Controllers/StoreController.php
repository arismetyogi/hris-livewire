<?php

namespace App\Http\Controllers;

use App\Exports\StoreExport;
use App\Imports\StoreImport;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Excel;

class StoreController extends Controller
{
    use Importable;

    public function export()
    {
        return (new StoreExport)->download('data_outlet.csv', Excel::CSV, ['Content-Type' => 'text/csv']);
    }

    /**
     * @param Request $request
     * @param Excel $excel
     * @return Application|RedirectResponse|Redirector
     */
    public function import(Request $request, Excel $excel)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx|max:2048',
        ]);
        // dd($request->file('file'));
        $excel->import(new StoreImport, $request->file('file'), null, Excel::XLSX);
        return back()->with('success', 'File imported successfully.');
    }

    public function uniqueBy()
    {
        return 'outlet_sap_id';
    }
}
