<?php

namespace App\Http\Controllers;

use App\Exports\StoreExport;
use Maatwebsite\Excel\Excel;

class StoreController extends Controller
{
    public function export()
    {
        return (new StoreExport)->download('data_outlet.csv', Excel::CSV, ['Content-Type' => 'text/csv']);
    }
}
