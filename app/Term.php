<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    protected $guarded = [
    	'id'
    ];

    /*
    Get Semester
     */
    public function semester()
    {
    	return $this->belongsTo(\App\Semester::class);
    }

      /**
     * Create new term
     *     but before create check conflicts
     * @param  Request $request
     * @return term         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $term = Term::withTrashed()
                        ->where([
                                    ['semester_id', $request->semester_id],
                                    ['year', $request->year]
                                ])
                        ->first();

        if (is_null($term))
        {
            $newTerm = Term::create([
                   'semester_id'   => $request->semester_id,
                    'year'         => $request->year,
                    'startDate'     => $request->startDate,
                    'endDate'       => $request->endDate
                ]);

            return $newTerm;
        }
        else
        {
            $term->restore();

            return $term;
        }

        return null;
    }
}
