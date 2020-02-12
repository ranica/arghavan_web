<?php

namespace App;
use App\Kintype;
use App\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kin extends Model
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
     * @return mixed
     */
    public function kintype()
    {
        return $this->belongsTo(Kintype::class);
    }

     /**
     * @return mixed
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    
    /**
     * Create new Kin
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExist($request)
    {       
        $kin = Kin::withTrashed()
                            ->where([
                                    ['mobile', $request->mobile],
                                    ['kintype_id', $request->kintype_id]
                                ])
                            ->first();

        if (is_null($kin))
        {
            $newKin = Kin::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'phone' => $request->phone,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'kintype_id' => $request->kintype_id,
                ]);

            return $newKin;
        }
        else
        {
            $kin->restore();

            return $kin;
        }

        return null;
    }
}
