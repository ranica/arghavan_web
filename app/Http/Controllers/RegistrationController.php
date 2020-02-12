<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterationRequest;

class RegistrationController extends Controller
{
    public static  $relation = [
        // 'card',
        // 'card.cardtype',
          'group',
          'people',
          'people.gender',
          'people.city',
          'people.city.province',
          'people.melliat',
          'student',
          'student.field',
          'student.field.university',
          'student.situation',
          'student.degree',
          'student.part',
          'student.term',
          'student.term.semester',
          'staff',
          'staff.department',
          'staff.contract',
          'teacher',
          'grouppermits',
          'gategroups',
          'terms'
    ];

    /**
     * Makes a store result.
     *
     * @param      <type>  $state  The state
     * @param      <type>  $value  The value
     *
     * @return     array   ( description_of_the_return_value )
     */
    public function makeStoreResult($state, $value)
    {
        return [
            'status' => $state,
            'register' => $value
        ];
    }

    public function index(Request $request)
    {
    }

     /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RegisterationRequest $request)
    {
        if (! $request->ajax())
        {
            return $this->makeStoreResult(0, null);
        }

        \DB::beginTransaction();

        $grouptype = $request->grouptype;
        $people  = (object)$request->people;
        $user    = (object)$request->user;
        $card    = (object)$request->card;

        // Check for duplicate
        $newRegisterPeople  = \App\People::createIfNotExists($people);

        $user->people_id    = $newRegisterPeople->id;
        $newRegisterUser    = \App\User::createIfNotExists($user);

        // Validate new user data
        if (is_null($newRegisterUser))
        {
            \DB::rollBack();

            return $this->makeStoreResult(0, null);
        }

        if ($grouptype == 3)
        {
            $student = (object)$request->student;

            $student->user_id   = $newRegisterUser->id;
            $newRegisterStudent = \App\Student::createIfNotExists($student);
        }
        elseif ($grouptype == 2)
        {
           $teacher = (object)$request->teacher;

           $teacher->user_id  = $newRegisterUser->id;
           $newRegisterTeacher = \App\Teacher::createIfNotExists($teacher);
        }
         elseif ($grouptype == 1)
         {
            $staff = (object)$request->staff;
            $staff->user_id  = $newRegisterUser->id;
            $newRegisterStaff = \App\Staff::createIfNotExists($staff);
        }

        if (null != $card->cdn){
            $card->user_id    = $newRegisterUser->id;
            $newRegisterCard  = \App\Card::createIfNotExists($card);
            $newRegisterCard->giveUserTo($newRegisterUser->id);
        }

        $newRegisterUser->load(static::$relation);

        \DB::commit();

        return [
            'status' => is_null($newRegisterUser) ? 1 : 0,
            'register' => $newRegisterUser
        ];
    }

    public function update(RegisterationRequest $request)
    {
        if ($request->ajax())
        {
            $grouptype = $request->grouptype;

            $people  = (object)$request->people;
            $user    = (object)$request->user;
            $student = (object)$request->student;
            $teacher = (object)$request->teacher;
            $staff = (object)$request->staff;
            $card = (object)$request->card;

            $update_user    = \App\User::updateByRequest($user);
            $update_people  = \App\People::updateByRequest($people);

            if ($grouptype == 3)
            {
                $update_student = \App\Student::updateByRequest($student);
            }
            elseif ($grouptype == 2)
            {
                $update_teacher = \App\Teacher::updateByRequest($teacher);
            }
            elseif ($grouptype == 1)
            {
                $update_staff = \App\Staff::updateByRequest($staff);
            }

            if (0 != $card->id)
            {
                $update_card  = \App\Card::updateByRequest($card);
            }
                // new card
            else if ((0 == $card->id) && (null != $card->cdn))
            {
                $card->user_id    = $user->id;
                $register_card  = \App\Card::createIfNotExists($card);
            }

            $result = $update_user['user']->load(static::$relation);

            return [
                'status' => 0,
                'register'   => $result
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if ($request->ajax())
        {
            $id = $request->registration;

            $user = \App\User::with('cards', 'gategroups')
                          ->find($id);
            dd($user);

            if (! is_null($user->cards))
            {
              foreach ($user->cards as $value) {
                  $value->delete();
                  $value->takeUserFrom($user);
              }
            }

            dd($user);
            $user = \App\User::find ($id);
            $user->delete();

            // $count = \App\User::where('people_id', $user->people_id)->count();
            // if ($count == '1')
            // {
                $people = \App\People::find($user->people_id);
                $people->delete();


            // }

            switch ($user->group_id){
                // is staff
               case 1:
                  $staff = \App\Staff::where('user_id', '=',$user->id);

                break;
                // is teacher
              case 2:
                  $teacher = \App\Teacher::where('user_id', '=',$user->id);

              break;
                   // is student
              case 3:
                  $student = \App\Student::where('user_id', '=',$user->id);

              break;
            }

          return [
            'status' => 0
          ];
        }
    }
    /**
     * Load Base Information when load program
     */
    public function baseInformation(Request $request)
    {
        $C_BASE_INFORMATION = 'base_information';

        $result = \Cache::get ($C_BASE_INFORMATION, NULL);

        if (! is_null ($result))
        {
            return $result;
        }

        $result = \Cache::rememberForever ($C_BASE_INFORMATION, function () {
            $system_info = \App\SystemInfo::select('value')
                                            ->get();
            $groups = null;
            if($system_info[0]->value){
                $groups = \App\Group::select (['id',
                                               'name'])
                                    ->get ();
            }
            else{
                $groups = \App\Group::where('name', 'کارمند')
                                    ->select (['id',
                                               'name'])
                                    ->get ();
            }

            $genders = \App\Gender::select (['id',
                                            'gender'])
                                ->get ();
            $gateMessages = \App\Gatemessage::select (['id',
                                                        'message'])
                                      ->get ();
            $gateDirects = \App\Gatedirect::select (['id',
                                                    'name'])
                                     ->get ();
            $gatePasses = \App\Gatepass::select (['id',
                                                    'name'])
                                     ->get ();
            $gateDevices = \App\Gatedevice::select (['id',
                                                    'name'])
                                     ->get ();
            $commonRanges = \App\CommonRange::select (['id',
                                                        'name'])
                                      ->get ();
            $melliats = \App\Melliat::select (['id',
                                                'name'])
                                ->get ();
            $situations = \App\Situation::select (['id',
                                                    'name',
                                                    'state'])
                                ->get ();
            $provinces = \App\Province::select (['id',
                                                'name'])
                                ->get ();
            $degrees = \App\Degree::select (['id',
                                            'name'])
                                ->get ();
            $parts = \App\Part::select (['id',
                                        'name'])
                            ->get ();
            $universities = \App\University::select (['id',
                                                    'name'])
                            ->get ();
            $departments = \App\Department::select (['id',
                                                    'name'])
                            ->get ();
            $contracts = \App\Contract::select (['id',
                                                'name'])
                            ->get ();
            $cardtypes = \App\Cardtype::select (['id',
                                                'name'])
                            ->get ();
            $grouppermits = \App\GroupPermit::select (['id',
                                                    'name',
                                                    'description'])
                            ->get ();
            $terms = \App\Term::with('semester')
                                ->select (['id',
                                        'semester_id',
                                        'year',
                                        'startDate',
                                        'endDate'])
                            ->get ();
            $gategroups = \App\Gategroup::select (['id',
                                                'name',
                                                'description'])
                            ->get ();
            $kintypes = \App\Kintype::select (['id',
                                        'name'])
                            ->get ();

            $gateplans = \App\GatePlan::select (['id',
                                                'name'])
                            ->get ();

            $result = [
                       'groups'       => $groups,
                       'genders'      => $genders,
                       'gateMessages' => $gateMessages,
                       'gateDirects'   => $gateDirects,
                       'gateDevices'   => $gateDevices,
                       'commonRanges'  => $commonRanges,
                       'melliats'       => $melliats,
                       'situations'     => $situations,
                       'provinces'      => $provinces,
                       'degrees'        => $degrees,
                       'parts'          => $parts,
                       'universities'   => $universities,
                       'departments'    => $departments,
                       'contracts'      => $contracts,
                       'cardtypes'       => $cardtypes,
                       'grouppermits'    => $grouppermits,
                       'terms'           => $terms,
                       'gategroups'      => $gategroups,
                       'kintypes'        => $kintypes,
                       'gateplans'       => $gateplans,
                   ];

            return $result;
        });
        return $result;
    }
}
