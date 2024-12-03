<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UserExport implements FromCollection, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return User::select('id', 'username', 'first_name', 'last_name', 'email', 'created_at')
            ->get()
            ->map(function ($user) {
                // Combine first name and last name
                $user->full_name = $user->first_name . ' ' . $user->last_name;

                // Remove first_name and last_name if you don't need them in the export
                unset($user->first_name, $user->last_name);

                return $user;
            });
    }

    public function headings(): array
    {
        return ['id', 'username', 'email', 'created_at', 'full_name'];
    }
}
