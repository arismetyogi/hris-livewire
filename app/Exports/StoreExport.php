<?php

namespace App\Exports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StoreExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): \Illuminate\Support\Collection
    {
        return Store::join('departments', 'departments.id', '=', 'stores.department_id')->select('stores.*', 'departments.name as department_name')->get();
    }

    public function headings(): array
    {
        return ['department_id', 'department_name', 'outlet_sap_id', 'name', 'store_type', 'operational_date', 'address', 'latitude', 'longitude'];
    }

    public function map($store): array
    {
        return [
            $store->department_id,
            $store->department_name,
            $store->outlet_sap_id,
            $store->name,
            $store->store_type,
            $store->operational_date,
            $store->address,
            $store->latitude,
            $store->longitude
        ];
    }
}
