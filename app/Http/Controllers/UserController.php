<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Maatwebsite\Excel\Excel;

class UserController extends Controller
{
    public function export()
    {
        return (new UserExport)->download('users.csv', Excel::CSV, ['Content-Type' => 'text/csv']);
    }

}