<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MaterialType extends Model
{
     use SoftDeletes;
     /**
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    protected $guarded = [
        'id'
    ];
    /**
     * Create new Material Type
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function createIfNotExists($request)
    {
        $material_type = MaterialType::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($material_type))
        {
            $new_material_type = MaterialType::create([
                    'name' => $request->name,
                ]);

            return $new_material_type;
        }
        else
        {
            $material_type->restore();

            return $material_type;
        }

        return null;
    }
}
