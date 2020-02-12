<?php

namespace App;

use App\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class University extends Model
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

    public function fields()
    {
    	return $this->hasMany(Field::class);
    }

    /**
     * Create new university
     * 	but before create check conflicts
     * @param  Request $request
     * @return University         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $university = University::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($university))
        {
            $newUniversity = University::create([
                    'name' => $request->name,
                ]);

            return $newUniversity;
        }
        else
        {
            $university->restore();

            return $university;
        }

        return null;
    }
}
