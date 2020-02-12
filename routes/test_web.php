<?php
Route::get("data", "RaspberryController@parseData");
// Route::view('test', 'report-test');
// Route::get('test2',  function () {
//   sleep(5);
//   return [
//     "success" => true
//   ];
// });

Route::get('test', function(){
  $traffic = \App\Gatetraffic::join('users', function($query) use ($level) {
            $join->on ('users.id', '=', 'gatetraffics.user_id');
                if (! is_null ($request->code)){
                        $join->where('users.code', '=', $request->code);
                }
          $query->on ('users.id', 'gatetraffics.user_id');
          if ($level != 1 )
              $query->where('user_id', \Auth::user()->id);
          })
          ->join('people', 'people.id', 'users.people_id')
          ->join('gatedevices', 'gatedevices.id', 'gatetraffics.gatedevice_id')
          ->join('gatepasses', 'gatepasses.id', 'gatetraffics.gatepass_id')
          ->join('gatedirects', 'gatedirects.id', 'gatetraffics.gatedirect_id')
          ->join('gatemessages', 'gatemessages.id', 'gatetraffics.gatemessage_id')

          ->where(function($query) use ($id){
                  if (! is_null ($id)){
                      $query->where('gatetraffics.user_id', $id);
                  }
              })
          ->orderBy('gatedate','DESC')
          ->where(function($query) use ($id, $plucked){
                  $query->whereIn('gatetraffics.gatedevice_id', $plucked);
                  if (! is_null ($id)){
                      $query->where('gatetraffics.user_id', $id);
                  }
              })
          ->limit(10)
          ->select([
                  'gatetraffics.id as gatetrafficsId',
                  'users.id as user_id',
                  'users.code as user_code',
                  'people.name as user_people_name',
                  'people.lastname as user_people_lastname',
                  'people.picture as user_people_picture',
                  'gatedevices.name as gatedevice_name',
                  'gatedirects.name as gatedirect_name',
                  'gatemessages.message as gatemessage_message',
                  'gatemessages.id as gatemessage_id',
                  'gatetraffics.gatedate as gatedate'
          ])
          ->get();

});

Route::get('device', function(){
   $relation = [
        'gatedirect',
        'gategender',
        'zone',
        'gatepass',
        'deviceType',
    ];

 $devs = \DB::table("gatedevices")->select('gatedevices.id')
            ->join('gatedevice_gategroup', 'gatedevice_gategroup.gatedevice_id', 'gatedevices.id')
            ->join('gategroups', 'gategroups.id', 'gatedevice_gategroup.gategroup_id')
            ->join('gategroup_user', 'gategroup_user.gategroup_id', 'gategroups.id')
            ->join('users', 'users.id', 'gategroup_user.user_id')
            ->where('users.id', \Auth::user()->id)
            ->get();
  $plucked = $devs->pluck('id');

 $gatedevices = \App\Gatedevice::with($relation)
                            ->where('type', '=', 0)
                            ->whereIn('id', $plucked)
                            ->get();

  return $gatedevices;
});

Route::get('traffic', function(){
    $level = \Auth::user()->level_id;
    $id = null;

    $devs = DB::table("gatedevices")->select('gatedevices.id')
            ->join('gatedevice_gategroup', 'gatedevice_gategroup.gatedevice_id', 'gatedevices.id')
            ->join('gategroups', 'gategroups.id', 'gatedevice_gategroup.gategroup_id')
            ->join('gategroup_user', 'gategroup_user.gategroup_id', 'gategroups.id')
            ->join('users', 'users.id', 'gategroup_user.user_id')
            ->where('users.id', \Auth::user()->id)
            // ->whereIn('gatedevices.id',function($query){
            //      $query->select('users.id')->from('users')
            //             ->where('users.id', 2);
            // })
            ->get();
$plucked = $devs->pluck('id');

$traffic = \App\Gatetraffic::join('users', function($query) use ($level) {
                            $query->on ('users.id', 'gatetraffics.user_id');
                            if ($level != 1 )
                                $query->where('user_id', \Auth::user()->id);
                            })
                            ->join('people', 'people.id', 'users.people_id')
                            ->leftjoin('students', 'students.user_id', 'users.id')
                            ->leftjoin('teachers', 'teachers.user_id', 'users.id')
                            ->leftjoin('staff', 'staff.user_id', 'users.id')
                            ->join('gatedevices', 'gatedevices.id', 'gatetraffics.gatedevice_id')
                            ->join('gatepasses', 'gatepasses.id', 'gatetraffics.gatepass_id')
                            ->join('gatedirects', 'gatedirects.id', 'gatetraffics.gatedirect_id')
                            ->join('gatemessages', 'gatemessages.id', 'gatetraffics.gatemessage_id')
                            ->leftjoin('degrees', 'degrees.id', 'students.degree_id')

                            ->where(function($query) use ($id){
                                    if (! is_null ($id)){
                                        $query->where('gatetraffics.user_id', $id);
                                    }
                                })
                            ->orderBy('gatedate','DESC')
                            ->where(function($query) use ($id, $plucked){
                                    $query->whereIn('gatetraffics.gatedevice_id', $plucked);
                                    if (! is_null ($id)){
                                        $query->where('gatetraffics.user_id', $id);
                                    }
                                })
                            ->limit(10)
                            ->select([
                                    'gatetraffics.id as gatetrafficsId',
                                    'users.id as user_id',
                                    'users.code as user_code',
                                    'people.name as user_people_name',
                                    'people.lastname as user_people_lastname',
                                    'people.picture as user_people_picture',
                                    'gatedevices.name as gatedevice_name',
                                    'gatedirects.name as gatedirect_name',
                                    'gatemessages.message as gatemessage_message',
                                    'gatemessages.id as gatemessage_id',
                                    'gatetraffics.gatedate as gatedate',
                                    'degrees.id as degree_id',
                                    'degrees.name as degree_name',
                            ])
                            ->get();
        return $traffic;
    // return $devs;
//     SELECT
//     gatedevices.id
// FROM
//     gatedevices
// INNER JOIN gatedevice_gategroup ON gatedevice_gategroup.gatedevice_id = gatedevices.id
// INNER JOIN gategroups ON gategroups.id = gatedevice_gategroup.gategroup_id
// INNER JOIN gategroup_user ON gategroup_user.gategroup_id = gategroups.id
// INNER JOIN users ON users.id = gategroup_user.user_id
// WHERE
//     users.id = 2

   //  $y = \App\User::join('gategroup_user', 'gategroup_user.user_id', 'users.id')
   //                  ->join('gategroups', 'gategroups.id', 'gategroup_user.gategroup_id')
   //                  ->join('gatedevice_gategroup', 'gatedevice_gategroup.gategroup_id', 'gategroups.id')
   //                  ->join('gatedevices', 'gatedevices.id', 'gatedevice_gategroup.gatedevice_id')
   //                  // ->select(['gatedevices.id'])
   //                  ->get();
   //  return new \App\Http\Resources\TrafficCollection($y);
   //                 dd($y);
   //      // foreach ($y as $name ) {
   //      //     echo "$name";
   //      // }
   // return $y;

   //  $t = \App\User::with(['gategroups' =>function($query){
   //      $query->with(['gatedevices' => function($f){
   //          $f->select(['id', 'number', 'ip']);
   //      }]);
   //  }])
   //  ->where('users.id', 2)
   //  ->get();
   //  return $t[0]->gategroups;
   //      $test = \App\Gategroup::with(['users'=> function($query){
   //                                      $query->where('id', 2);
   //                                      $query->select('id', 'code');
   //                                  },
   //                                  'gatedevices' => function($query){
   //                                      $query->select('id', 'number', 'name');
   //                                  }])
   //                              ->get();

   //      // $t = \App\Gatetraffic::join('users', function($query) {
   //      //                                 $query->on ('users.id', 'gatetraffics.user_id');
   //      //                                 $query->on( 'users.id', 'gategroup_user.user_id');
   //      //                             })->get();

   //      return $test;





});




// Route::view('clock', 'report-test');
// Route::view('ipass', 'referrals.test');
Route::get('who',function () {

       $item =  bcrypt('admin2018');
        return $item;
});


// // Route::get('upload', 'PeopleController@upload');
// Route::get('get-identify', 'API\PassportController@getIdentify');
// Route::get('test', function () {

//         $card = \App\Card::leftjoin('card_user', 'card_id', 'cards.id')
//                             ->where ('cdn', '1046343769')
//                             ->select([
//                                 'card_user.card_id',
//                                 'card_user.user_id',
//                                 'cdn',
//                                 'state',
//                                 'startDate',
//                                 'endDate',
//                                 'cardtype_id'
//                             ])
//                             ->get ()
//                             ->first ();
//         return $card;


//         $res = \App\User::leftjoin('card_user', 'user_id', 'users.id')
//                         ->leftjoin('cards', 'card_id', 'cards.id')
//                         ->where('users.id', 3)
//                         ->select([
//                                     'users.id as userId',
//                                     'card_user.user_id',
//                                     'card_user.card_id' ,
//                                     'cards.cdn',
//                                     'cards.state',
//                                     'cards.startDate',
//                                     'cards.endDate',
//                                     'cards.cardtype_id'
//                                 ])
//                         ->get()
//                         ->first();



//         return $res;




//         $groupId = 3;
//         $cardtypeId = 2;

//          $fun = [
//             'group' => function($q) {
//                 $q->select([
//                     'id',
//                     'name'
//                 ]);
//             },

//             'people' => function($q) {
//                 $q->select([
//                     'id',
//                     'name',
//                     'lastname',
//                     'nationalId'
//                 ]);
//             },

//             'cards' => function($q) use($cardtypeId) {
//                 $q->where('cardtype_id', $cardtypeId);
//                 $q->select([
//                     'id',
//                     'cdn',
//                     'startDate',
//                     'state',
//                     'endDate',
//                     'cardtype_id',
//                 ]);
//             },

//             'cards.cardtype' => function($q) {
//                 $q->select([
//                     'id',
//                     'name'
//                 ]);
//             },
//         ];

// });


// /* TEST */

// // Route::get('suprima', function(){

// //     $code = '2';
// //         $fun = [
// //             'people' => function($query){
// //                  $query->select([
// //                     'id',
// //                     'name',
// //                     'lastname',
// //                     'nationalId'
// //                     ]);
// //                 },
// //             ];

// //         $items = \App\User::wherehas('people')
// //                 ->leftJoin('fingerprints', 'fingerprints.user_id', 'users.id', function($query) use ($code){
// //                     $query->Where('fingerprints.fingerprint_user_id', $code);
// //                 })
// //                 ->with($fun)
// //                 ->select(['users.id as user_id',
// //                             'users.code as user_code',
// //                             'groups.name as group_name',
// //                             'people_id as people_id',
// //                             'fingerprints.id as fingerprint_id',
// //                             'fingerprints.fingerprint_user_id as fingerprint_user_id',
// //                             'fingerprints.image as fingerprint_image',
// //                             'fingerprints.template as fingerprint_template',
// //                         ])
// //                 ->get();



// //         return $items;
// // });




// Route::get('send-sms', function () {
//     $lang_code = App::getLocale();
//      // dd($lang_code);
//      // Config::get('app.locale')
//     dd(Config::get('app.locale'));
//     // \App\Jobs\ProcessSendSMS::dispatch ('+989128812298', 'my message comes here', 1);
// });
//
// // use Illuminate\Support\Facades\DB;
 // $t = new \Illuminate\Pagination\Paginator();
      //  $traffic = new \Illuminate\Pagination\Paginator($traffic, $traffic->count(), $limit);

          // $id = null;
   //  $raw_traffic_last_user= \DB::raw ("CALL sp_get_50_lasted_traffic;");
   //  $res = \DB::select ($raw_traffic_last_user);
   //  $allUsers = DB::select('CALL sp_get_50_lasted_traffic()', array(101));
   // return $allUsers;

   // $items = \App\Gatetraffic::where(function($query) {
   //              $query->where('gatetraffics.user_id', '2');
   //              $query->orderBy('gatedate','DESC');
   //              $query->take(2);
   //          })
   //          ->join('users', 'users.id', 'gatetraffics.user_id')

   //          // ->join('users', 'users.id', 'gatetraffics.user_id')
   //          // ->join('people', 'users.people_id', 'people.id')
   //          // ->join('gatedevices', 'gatedevices.id', 'gatetraffics.gatedevice_id')
   //          // ->join('gatepasses', 'gatepasses.id', 'gatetraffics.gatepass_id')
   //          // ->join('gatedirects', 'gatedirects.id', 'gatetraffics.gatedirect_id')
   //          // ->join('gatemessages', 'gatemessages.id', 'gatetraffics.gatemessage_id')
   //          ->orderBy('gatedate','DESC')
   //          ->limit(1)
   //           ->select('gatetraffics.id', 'gatedate', 'user_id')
   //           ->get();
   //          // ->paginate(\App\Http\Controllers\Controller::C_PAGINATE_SIZE);

   //          return $items;
   //         // return $items;




        // ->paginate(\App\Http\Controllers\Controller::C_PAGINATE_SIZE);

        // if((\Auth::user()->level_id) == 1)
        // {
        //     $traffic = \App\Gatetraffic::with($relation);
        // }
        // elseif ((\Auth::user()->level_id) == 3) {
        //     $traffic = \App\Gatetraffic::with($relation)
        //             ->where('user_id', \Auth::user()->id);
        // }

        // if (! is_null ($id))
        // {
        //     $traffic->where('id', $id)
        //             ->with($relation);
        // }
        //     $traffic->orderBy('gatedate','DESC')->limit(2)->get();
        //     return $traffic->paginate(\App\Http\Controllers\Controller::C_PAGINATE_SIZE);


/*  END: TEST  */
