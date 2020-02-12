<?php

namespace App;

use App\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{

    use SoftDeletes;
    /**
     * @var array
     */
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
     * @return mixed
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }


    /**
     * @return mixed
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Create new field
     *     but before create check conflicts
     * @param  Request $request
     * @return Field         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $field = Field::withTrashed()
                            ->where([
                                    ['name', $request->name],
                                    ['university_id', $request->university_id]
                                ])
                            ->first();

        if (is_null($field))
        {
            $newField = Field::create([
                    'name' => $request->name,
                    'university_id' => $request->university_id
                ]);

            return $newField;
        }
        else
        {
            $field->restore();

            return $field;
        }

        return null;

        /*$count = Field::where([
                ['name', $request->name],
                ['university_id', $request->university_id],
            ])
            ->get()
            ->count();

        if (0 == $count)
        {
            // Create new field
            $newField = Field::create([
                'name'          => $request->name,
                'university_id' => $request->university_id
            ]);

            return $newField;
        }

        return null;*/
    }
}
