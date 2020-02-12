<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    /*****************************************
     * Constants
    *****************************************/
    public static $C_STR_DEACTIVE = "غیر فعال";
    public static $C_STR_ACTIVE   = "فعال";
    public const ROOT_USERNAME = 'root';
    protected $rememberTokenName = false;

    /**
     * @var Defined State
     */
    protected $appends = [
        'stateStr'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'email',
        'password',
        'state',
        'group_id',
        'people_id',
        'api_token',
        'last_login_at',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
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
     * List of related sms
     */
    public function sms()
    {
        return $this->hasMany(\App\Sms::class);
    }

    /**
     * List of related Vaction request
     */
    public function vactionRequest()
    {
        return $this->hasMany(\App\VactionRequest::class);
    }

     /**
     * List of related group
     */
    public function group()
    {
        return $this->belongsTo(\App\Group::class);
    }

    /**
     * List of cars assigned to user
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function cars()
    {
        return $this->belongsToMany(\App\Car::class);
    }

    /**
     * List of related person
     */
    public function people()
    {
        return $this->belongsTo(\App\People::class);
    }

    public function fingerprint()
    {
        return $this->hasOne(\App\Fingerprint::class);
    }

    /**
     * List of related student
     */
    public function student()
    {
        return $this->hasOne(\App\Student::class);
    }

    /**
     * List of related staff
     */
    public function staff()
    {
        return $this->hasOne(\App\Staff::class);
    }

    /**
     * List of related teacher
     */
    public function teacher()
    {
        return $this->hasOne(\App\Teacher::class);
    }

	/**
	*List of related Card
	 */
    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }

    /**
     * Get assigned Group permit
     */
    public function grouppermits()
    {
        return $this->belongsToMany(\App\GroupPermit::class);
    }

    /**
     * Get assigned Group permit
     */
    public function terms()
    {
        return $this->belongsToMany(\App\Term::class);
    }

    /**
     * Get assigned Gate Group
     */
    public function gategroups()
    {
        return $this->belongsToMany(\App\Gategroup::class);
    }

      /**
     * Get assigned Gate Plan
     */
    public function gateplans()
    {
        return $this->belongsToMany(\App\GatePlan::class);
    }

    /**
     * Get assigned Gate Traffic
     */
    public function gatetraffics()
    {
        return $this->hasMany(\App\Gatetraffic::class);
    }

    /**
     * List of related level
     */
    public function level()
    {
        return $this->belongsTo(\App\Level::class);
    }

     /**
     * List of related level
     */
    public function fingerprints()
    {
        return $this->hasMany(\App\Fingerprint::class);
    }

    /**
     * Create new user
     *     but before create check conflicts
     * @param  Request $request
     * @return user         created instance or null if exists
     */
    public static function createIfNotExists($request)
    {
        $count = User::where([
                ['code', $request->code],
                ['group_id', $request->group_id],
                // ['email', $request->email],
                // ['password', $request->password],
                // ['state', $request->state],

            ])
            ->get()
            ->count();

        if (0 == $count)
        {
            // Create new user
            $newRegister = User::create([
                'code'      => $request->code,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'api_token' => str_random(60),
                'state'     => $request->state,
                'group_id'  => $request->group_id,
                'people_id' => $request->people_id,
                'level_id'  => 3,
            ]);

            return $newRegister;
        }

        return null;
    }

    /**
     * Update user by Request
     */
    public static function updateByRequest($user)
    {
        $orginal_user = User::find($user->id);

        $orginal_user->update([
            'email'    => $user->email,
            'group_id' => $user->group_id,
            'state'    => $user->state,
        ]);

        $orginal_user->load('group')->get();

        return [
                'status' => 0,
                'user'   => $orginal_user
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
     * Give Group Permit
     */
    public function giveGroupPermitTo($grouppermit)
    {
        $this->grouppermits()->sync($grouppermit);
    }

    /**
     * Give Term
     */
    public function giveTermTo($term)
    {
        $this->terms()->sync($term);
    }

    /**
     * Give Gate Group
     */
    public function giveGateGroupTo($gategroup)
    {
        $this->gategroups()->sync($gategroup);
    }

    /**
     * Give Gate Plan
     */
    public function giveGatePlanTo($gateplan)
    {
        $this->gateplans()->sync($gateplan);
    }

    /**
     * Has Group Permit
     */
    public function hasGroupPermit($grouppermit)
    {
        if(is_string($grouppermit))
        {
           return $this->grouppermits()->roles()->contains('key', $grouppermit);
        }

        return !! $grouppermit->intersect($this->grouppermits)->count();
    }

    /**
     * Check permissin has for user
     */
    public function hasPermission($permission)
    {
        $grouppermit =  $this->grouppermits;

        $roles = [];
        $dataPermissions = [];

        foreach ($grouppermit as $p)
        {
            $roles[] = $p->roles;
        };

        foreach ($roles as $role) {
            $dataPermissions[] = $role[0]->permissions;
        };

        if (null != $dataPermissions)
        {
             foreach ($dataPermissions[0] as $data){
                if ($data->subkey == $permission)
                {
                    return true;
                }
            };
        }
        else
            return false;

        return false;
    }

    /**
     * Remove old picture
     */
    public function removeOldPicture ()
    {
        $people = $this->people;

        $people->removePicture ();
    }


    /**
     * Set Last-Login Information
     *
     * @param      <type>  $loginDate  The login date
     * @param      <type>  $deviceIP   The device ip
     */
    public function setLastLoginInfo($loginDate,
                                     $deviceIP){
        // Save on Users table
        $this->last_login_at = $loginDate;
        $this->last_login_ip = $deviceIP;

        $this->save();


        // Insert new record in history-table
        \App\LoginHistory::create([
            "user_id"       => $this->id,
            "last_login_at" => $loginDate,
            "last_login_ip" => $deviceIP
        ]);
    }
}
