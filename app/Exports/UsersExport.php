<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromQuery
{
    use Exportable;

    public function __construct(int $code)
    {
        $this->code = $code;
    }
     public function query()
    {
        return User::query()->where('code', $this->code);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = user::select('id', 'code')
                    ->get();
        return $user;
    }
}
