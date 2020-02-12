<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Material extends Model
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
    public function materialType()
    {
        return $this->belongsTo(\App\MaterialType::class);
    }

    /**
     * Create new field
     *     but before create check conflicts
     * @param  Request $request
     * @return Field         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $material = Material::withTrashed()
                            ->where([
                                    ['material_type_id', $request->material_type_id],
                                    ['code', $request->code],
                                ])
                            ->first();

        if (is_null($material))
        {
            $newMaterial = Material::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'material_type_id' => $request->material_type_id,
                ]);

            return $newMaterial;
        }
        else
        {
            $material->restore();

            return $material;
        }
        return null;
    }
}
