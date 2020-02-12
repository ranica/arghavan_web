<?php

namespace App;

use App\Kintype;
use App\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relative extends Model
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
     * Create new Relative
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExists($request)
    {       
        $relative = Relative::withTrashed()
                            ->where([
                                    ['mobile', $request->mobile],
                                    ['kintype_id', $request->kintype_id]
                                ])
                            ->first();

        if (is_null($relative))
        {
            $newRelative = Relative::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'phone' => $request->phone,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'kintype_id' => $request->kintype_id,
                    'people_id' => $request->people_id,
                ]);

            return $newRelative;
        }
        else
        {
            $relative->restore();

            return $relative;
        }

        return null;
    }
}
