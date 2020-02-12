<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
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
     * Creates if not exist.
     */
    public static function
    createIfNotExist($request)
    {
        $block = Block::withTrashed()
                            ->where('name', $request->name)
                            ->first();

        if (is_null($block))
        {
            $newBlock = Block::create([
                    'name' => $request->name,
                    'code' => $request->code,
                ]);

            return $newBlock;
        }
        else
        {
            $block->restore();

            return $block;
        }

        return null;
    }
}
