<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $guarded = [
    	'id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Create new Department
     *     but before create check conflicts
     * @param  Request $request
     * @return Department         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $department = Department::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($department))
        {
            $newDepartment = Department::create([
                    'name' => $request->name,
                ]);

            return $newDepartment;
        }
        else
        {
            $department->restore();

            return $department;
        }

        return null;
    }
}
