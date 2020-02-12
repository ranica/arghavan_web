<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use SoftDeletes;

    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";

    public static $GROUP_STUDENTS   = 3;
    public static $GROUP_TEACHERS   = 2;
    public static $GROUP_STAFFS  = 1;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates   = [
        'deleted_at'
    ];

    protected $appends = [
        'pictureUrl',
        'pictureThumbUrl',
        'stateStr'
    ];

    protected $guarded =[
        'id'
    ];


    /**
     * Get picture Url
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function getPictureUrl($value)
    {
        if (is_null($value) || ($value == ''))
        {
            return asset("images/default-avatar.png");
        }

        return \Storage::url($value);
    }

    /**
     * Get picture-thumb Url
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function getPictureThumbUrl($value)
    {
        if (is_null($value) || ($value == ''))
        {
            return asset("images/default-avatar.png");
        }

        $value = str_replace('.jpeg', '-t.jpeg', $value);

        return \Storage::url($value);
    }

    /**
     * Get Picture Url
     * @return [type] [description]
     */
    public function getPictureUrlAttribute(){
        return static::getPictureUrl($this->picture);
    }

    /**
     * Get Picture Url
     * @return [type] [description]
     */
    public function getPictureThumbUrlAttribute(){
        return static::getPictureThumbUrl($this->picture);
    }

    /**
     * Get Uesr
     */
    public function user()
    {
        return $this->hasOne(\App\User::class);
    }

    /**
     * Get Gender
     */
    public function gender()
    {
    	return $this->belongsTo(\App\Gender::class);
    }

    /**
     * Get Group
     */
    public function group()
    {
    	return $this->belongsTo(\App\Group::class);
    }

    /**
     * Get Situation
     */
    public function situation()
    {
    	return $this->belongsTo(\App\Situation::class);
    }

    /**
     * Get city
     */
    public function city()
    {
    	return $this->belongsTo(\App\City::class);
    }

    /**
     * Get  Melliat
     */
    public function melliat()
    {
    	return $this->belongsTo(\App\Melliat::class);
    }

    /**
     * Get  Province
     */
    public function province()
    {
        return $this->belongsTo(\App\Province::class);
    }
    /**
     * Get  Degree
     */
    public function degree()
    {
        return $this->belongsTo(\App\Degree::class);
    }

    /**
     * Get  field
     */
    public function field()
    {
        return $this->belongsTo(\App\Field::class);
    }

    /**
     * Get  university
     */
    public function university()
    {
        return $this->belongsTo(\App\University::class);
    }

    /**
     * Get  part
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
    /**
     * Create new people
     *     but before create check conflicts
     * @param  Request $request
     * @return people         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $people = People::withTrashed()
                            ->where('nationalId', $request->nationalId)
                            ->first();

        if (is_null($people))
        {
            $newRegister = People::create([
                'name'       => $request->name,
                'lastname'   => $request->lastname,
                'nationalId' => $request->nationalId,
                'birthdate'  => $request->birthdate,
                // 'father'  => $request->father,
                'phone'      => $request->phone,
                'mobile'     => $request->mobile,
                'address'    => $request->address,
                'gender_id'  => $request->gender_id,
                'melliat_id' => $request->melliat_id,
                'city_id'    => $request->city_id,
                ]);

            return $newRegister;
        }
        else
        {
            $people->restore();

            return $people;
        }

        return null;
    }

    /**
     * Update people by Request
     */
    public static function updateByRequest($people)
    {
        $orginal_people = People::find($people->id);

        $orginal_people->update([
                'name'       => $people->name,
                'lastname'   => $people->lastname,
                'nationalId' => $people->nationalId,
                // 'picture'    => $people->picture,
                'birthdate'  => $people->birthdate,
                'phone'      => $people->phone,
                'mobile'     => $people->mobile,
                'address'    => $people->address,
                'gender_id'  => $people->gender_id,
                'melliat_id' => $people->melliat_id,
                'city_id'    => $people->city_id,
            ]);
        $relation_people = [
                'gender',
                'city',
                'melliat',
                'province',
            ];

        $orginal_people->load($relation_people)->get();

        return [
                'status' => 0,
                'people'   => $orginal_people
            ];
    }

    /**
     * Save Image people
     */
    public static function updateImage($people)
    {
        $orginal_people = People::find($people['people_id']);

        $orginal_people->update([
            'picture' => $people['picture'],
        ]);

        return [
                'status' => 0,
                'people'   => $orginal_people
            ];
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

    /**
     * Load relatives
     */
    public function relatives ()
    {
        return $this->hasMany(\App\Relative::class);
    }

    /**
     * Remove Picture
     */
    public function removePicture ()
    {
        $picture = $this->picture;

        if (is_null ($picture))
        {
            return;
        }

        $disk = \Storage::disk ('local');

        // Remove picture
        $picFile = 'public/' . $picture;
        $fileExists = $disk->has ($picFile);

        if (! $fileExists)
        {
            return;
        }


        // Remove file
        $disk->delete($picFile);

        // Update database
        $this->picture = null;
        $this->save ();
    }
}
