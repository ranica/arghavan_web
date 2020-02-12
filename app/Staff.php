<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Department;
use App\Contract;
use App\User;
use App\People;

class Staff extends Model
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
     * @return Get user
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get People
     */
    public function people()
    {
    	return $this->belongsTo(People::class);
    }
    /**
     * @return Get department
     */
 	public function department()
    {
    	return $this->belongsTo(Department::class);
    }
    /**
     * @return Get contact
     */
    public function contract()
    {
    	return $this->belongsTo(Contract::class);
    }

    /**
     * @return Get company
     */
    public function company()
    {
        return $this->belongsTo(\App\Company::class);
    }
      /**
     * @return Get company
     */
    public function contractor()
    {
        return $this->belongsTo(\App\Contractor::class);
    }

    public static function createIfNotExists($request)
    {
        $staff = Staff::withTrashed()
                            ->where('user_id', $request->user_id)
                            ->first();

        if (is_null($staff))
        {
            $newStaff = Staff::create([
                    'department_id'     => $request->department_id,
                    'contract_id'       => $request->contract_id,
                    'user_id'           => $request->user_id,
                ]);

            return $newStaff;
        }
        else
        {
            $staff->restore();

            return $staff;
        }

        return null;
    }

     /**
     * Update staff by Request
     */
    public static function updateByRequest($staff)
    {
        $orginal_staff = Staff::find($staff->id);

        $orginal_staff->update([
                'department_id'   => $staff->department_id,
                'contract_id'     => $staff->contract_id,
            ]);
        $relation_staff = [
                'department',
                'contract',
            ];

        $orginal_staff->load($relation_staff)->get();

        return [
                'status' => 0,
                'staff'   => $orginal_staff
            ];
    }
}
