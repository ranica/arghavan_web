<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Field;
use App\Part;
use App\Degree;
use App\Student;

class Student extends Model
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

    /**
     * @var array
     */
    protected $guarded =[
        'id'
    ];

    /**
     * @return Get user
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return Get Field
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * @return Get Term
     */
    public function term()
    {
        return $this->belongsTo(\App\Term::class);
    }

    /**
     * @return Get Part
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * @return Get Degree
     */
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    /**
     * @return Get Situation
     */
    public function situation()
    {
        return $this->belongsTo(Situation::class);
    }
    /**
     * Create new people
     *     but before create check conflicts
     * @param  Request $request
     * @return people         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $count = Student::where([
                // ['term_id', $request->term_id],
                // ['native', $request->native],
                // ['suit', $request->suit],
                // ['degree_id', $request->degree_id],
                // ['part_id', $request->part_id],
                // ['field_id', $request->field_id],
                // ['situation_id', $request->situation_id],
                ['user_id', $request->user_id],
            ])
            ->get()
            ->count();

        if (0 == $count)
        {
            // Create new Student
            $newRegister = Student::create([
                'term_id'         => $request->term_id,
                'native'       => $request->native,
                'suit'         => $request->suit,
                'degree_id'    => $request->degree_id,
                'part_id'      => $request->part_id,
                'field_id'     => $request->field_id,
                'situation_id' => $request->situation_id,
                'user_id'      => $request->user_id,
            ]);

            return $newRegister;
        }

        return null;
    }

    /**
     * Update student by Request
     */
    public static function updateByRequest($student)
    {
        $orginal_student = Student::find($student->id);

        $orginal_student->update([
                'term_id'         => $student->term_id,
                'native'       => $student->native,
                'suit'         => $student->suit,
                'degree_id'    => $student->degree_id,
                'field_id'     => $student->field_id,
                'situation_id' => $student->situation_id,
            ]);
        $relation_student = [
                'field',
                'situation',
                'degree',
                'part',
                'term',
            ];

        $orginal_student->load($relation_student)->get();

        return [
                'status' => 0,
                'student'   => $orginal_student
            ];
    }
}
