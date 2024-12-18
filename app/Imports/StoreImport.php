<?php

namespace App\Imports;

use App\Models\Store;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StoreImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return Store
     */
    public function model(array $row): Store
    {
        return new Store([
            'department_id' => $row['kode_bm'],
            'outlet_sap_id' => $row['kode_apotek'],
            'name' => $row['nama_apotek'],
            'store_type' => $row['type_store'],
            'operational_date' => Carbon::parse($row['tanggal_operasional']),
            'phone' => $row['no_telp'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'zip_id' => $row['kode_pos'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
