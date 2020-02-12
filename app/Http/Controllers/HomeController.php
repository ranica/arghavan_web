<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileCollection;
use User;

use App\HelperTraffic\Traffic;
use App\HelperTraffic\Helper;


class HomeController extends Controller
{
    public const C_SESSION_LOCK = 'is_locked';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $vars = new Traffic();

        // $vars->cdn = "1010";
        // $vars->ip = "192.168.10.10";
        // $vars->serviceId = "1";
        // $vars->userId = "5";
        // $vars->dateReceive =  \Carbon\Carbon::now();

        // $collectionTraffic = new Helper();

        // $collectionTraffic->addItem($vars, "1010");



        // \App\CommandParser\CommandFactory::runCommand("CMD_5000", [
        //     "args1" => 100,
        //     "id" => 10000
        // ]);


        // $validator = \App\TrafficValidator\TrafficValidatorFactory::chainValidtor();
        // $result = $validator->validate("null", "null", "null");
        // dd($result);

        // \App\CommandParser\CommandFactory::runCommand("CMD_5000", [
        //     "args1" => 100,
        //     "id" => 10000
        // ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.home');
    }
    /**
     * Show the application car dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCar()
    {
        return view('dashboard.car.car');
    }

    /**
     * Edit profile
     * @return [type] [description]
     */
    public function editProfile(Request $request)
    {
        if($request->ajax())
        {
            $data = \App\User::join('people','people.id', '=', 'users.people_id')
                                ->join('groups', 'groups.id', 'users.group_id')
                                ->join('cities','cities.id', 'people.city_id')
                                ->join('provinces', 'provinces.id', 'cities.province_id')
                                ->join('melliats', 'melliats.id', 'people.melliat_id')
                                ->join('genders', 'genders.id', 'people.gender_id')
                                ->select([
                                    'users.id as user_id',
                                    'users.code as user_code',
                                    'users.state as user_state',
                                    'users.email as user_email',
                                    'people.name as people_name',
                                    'people.lastname as people_lastname',
                                    'people.picture as people_picture',
                                    'people.mobile as people_mobile',
                                    'people.address as people_address',
                                    'groups.name as group_name',
                                    'genders.gender as gender',
                                    'melliats.name as melliat',
                                    'cities.name as city',
                                    'provinces.name as province',
                                ])
                                ->where('users.id', \Auth::user()->id)
                                ->get();
            return new ProfileCollection($data);
        }
        return view('auth.edit');
    }

    /**
    * Lock Profile
    */
    public function lockPage(Request $request)
    {
        static::lockUser ();

        if($request->ajax())
        {
            $fun = [
                'people'=>function($q){
                    $q->select([
                        'id',
                        'name',
                        'lastname'
                    ]);
                }
            ];
            $data = \App\User::with($fun)
                              ->where('users.id', \Auth::user()->id)
                              ->select(['id', 'code', 'people_id'])
                              ->get();
            return $data;
        }

        return view('auth.lock');
    }

    /**
     * Lock user
     */
    public static function lockUser ()
    {
        \Session::put (self::C_SESSION_LOCK, true);
    }

    /**
     * unLock user
     */
    public function unlockUser (Request $request)
    {
      if (! \Auth::check()) {
        return [
          "success" => false,
          "data" => "Invalid User data"
        ];
      }

      $user = \Auth::user();
      $password = $request->password;

      if (! \Hash::check($password, $user->password)){
          return [
              "success" => false,
              "data" => "Invalid user credential"
          ];
      }
      else {
        \Session::put (self::C_SESSION_LOCK, false);

        return [
          "success" => true,
          "data" => Route("home")
        ];
      }
    }

    /**
     * Is locked user?
     */
    public static function isLocked ()
    {
        $isLocked = \Session::get(self::C_SESSION_LOCK, false);

        return $isLocked;
    }


    public function checkAndUnlockUser (Request $request)
    {
        return \App\Http\Controllers\HomeController::unlockUser ($request);
    }


}
