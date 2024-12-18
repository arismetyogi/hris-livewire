<?php

namespace App\Imports;

use App\Models\Store;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StoreImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return Store
     */
    public function model(array $row): Store
    {
        $excelDate = $row['tanggal_operasional'];

        // Convert the Excel date or parse the string
        $operationalDate = is_numeric($excelDate)
            ? Carbon::instance(Date::excelToDateTimeObject($excelDate))
            : Carbon::createFromFormat('m/d/Y', $excelDate);

        return new Store([
            'department_id' => $row['kode_bm'],
            'outlet_sap_id' => $row['kode_apotek'],
            'name' => $row['nama_apotek'],
            'store_type' => $row['type_store'],
            'operational_date' => $operationalDate,
            'phone' => $row['no_telp'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'zip_id' => $row['kode_pos'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
