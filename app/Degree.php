<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Degree extends Model
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

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function peoples()
    {
        return $this->hasMany(People::class);
    }

    /**
     * Create new Degree
     *     but before create check conflicts
     * @param  Request $request
     * @return Degree         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $degree = Degree::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($degree))
        {
            $newDegree = Degree::create([
                    'name' => $request->name,
                ]);

            return $newDegree;
        }
        else
        {
            $degree->restore();

            return $degree;
        }

        return null;
    }
}
