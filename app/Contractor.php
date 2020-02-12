<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contractor extends Model
{
    use SoftDeletes;

    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";

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
    protected $appends = [
        'stateStr'
    ];

    protected $guarded = [
        'id'
    ];


    /**
     * Create new contractor
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExists($request)
    {
        $contractor = Contractor::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($contractor))
        {
            $new_contractor = Contractor::create([
                    'name'      => $request->name,
                    'beginDate' => $request->beginDate,
                    'endDate'   => $request->endDate,
                    'state'     => $request->state,
                ]);

            return $new_contractor;
        }
        else
        {
            $contractor->restore();

            return $contractor;
        }

        return null;
    }

    /**
     * Get state value
     */
    public function getStateStrAttribute()
    {
        if (! isset ($this->attributes['state']))
        {
            return static::$C_STR_ACTIVE;
        }

        return $this->attributes['state'] ? static::$C_STR_ACTIVE : static::$C_STR_DEACTIVE;
    }
}
