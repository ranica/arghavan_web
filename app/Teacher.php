<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\People;
use App\User;

class Teacher extends Model
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
	
    /**
     * Get People
     */
    public function people()
    {
    	return $this->belongsTo(People::class);
    }

    /**
     * @return Get user
     */
    public function user()
    {
    	return $this->hasOne(User::class);
    }
 	

    public static function createIfNotExists($request)
    {   
        $teacher = Teacher::withTrashed()
                            ->where('user_id', $request->user_id)
                            ->first();

        if (is_null($teacher))
        {
            $newTeacher = Teacher::create([
                    'semat'         => $request->semat,               
                    'user_id'      => $request->user_id,
                ]);

            return $newTeacher;
        }
        else
        {
            $teacher->restore();

            return $teacher;
        }

        return null;    

       
    }

    /**
     * Update teacher by Request
     */
    public static function updateByRequest($teacher)
    {
        $orginal_teacher = Teacher::find($teacher->id);

        $orginal_teacher->update([
                'semat'         => $teacher->semat,
            ]);

        $relation_teacher = [
                'user'
            ];

        $orginal_teacher->load($relation_teacher)->get();

        return [
                'status' => 0,
                'teacher'   => $orginal_teacher
            ];
    }
 }
