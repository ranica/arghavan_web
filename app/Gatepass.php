<?php

namespace App;
use App\Gatedevice;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gatepass extends Model
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

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

     public function gatedevices()
    {
        return $this->hasMany(Gatedevice::class);
    }

       
    /**
     * Create new Gatepass
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {       
        $gatepass = Gatepass::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($gatepass))
        {
            $newGatePass = Gatepass::create([
                    'name' => $request->name,
                ]);

            return $newGatePass;
        }
        else
        {
            $gatepass->restore();

            return $gatepass;
        }

        return null;
    }
}
