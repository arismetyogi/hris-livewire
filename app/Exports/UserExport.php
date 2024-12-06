<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UserExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return User::with('department')->select('users.*', 'departments.name as department_name')
            ->get()
            ->map(function ($user) {
                // Combine first name and last name
                $user->full_name = $user->first_name . ' ' . $user->last_name;

                // Remove first_name and last_name if you don't need them in the export
                unset($user->first_name, $user->last_name);

                return $user;
            });
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->username,
            $user->full_name,
            $user->email,
            $user->created_at,
            $user->updated_at,
        ];
    }

    public function headings(): array
    {
        return ['id', 'username', 'full_name', 'email', 'created_at', 'updated_at'];
    }

}

