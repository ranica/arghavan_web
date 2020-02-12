<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PeopleRequest;
use App\Http\Controllers\RegistrationController;
use App\Http\Resources\PeopleCollection;
use Image;
use App\People;
use App\User;
use Response;

class PeopleController extends Controller
{
    public static $relation = [
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
            'gateplans',
            'terms',
            // 'fingerprints',
        ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (request()->ajax())
        // {
        //     return static::loadPersonsData();
        // }

        return view('people.index');
    }


   /**
    * Upload Image
    */

    public function uploadImage(Request $request)
    {
        $peopleId = $request->peopleId;

        if ($request->hasFile('image'))
        {
            $IMAGE_SIZE = Config::get('core.personal_image_size');

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $fullSizeImageAddr = $image->store('');

            $th_name = str_replace(".$ext", "-t.$ext", $fullSizeImageAddr);
            $th_name = \Storage::path($th_name);
            $thumbnailImage = Image::make($image);
            $thumbnailImage->fit($IMAGE_SIZE, $IMAGE_SIZE)
                           ->save($th_name);

            $data = [
                'picture'       => $fullSizeImageAddr,
                'people_id'     => $peopleId
            ];

            $update_people  = People::updateImage($data);

            $th_name = str_replace('.jpeg', '-t.jpeg', $thumbnailImage);
            $pictureUrl = \Storage::url($fullSizeImageAddr);
            $pictureThumbUrl = \Storage::url($th_name);

            return [
                'people' => $update_people,
                'pictureUrl' => $pictureUrl,
                'pictureThumbUrl' => $pictureThumbUrl
            ];
        }

        return 'file not found';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $person)
    {
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleRequest $request, People $person)
    {
        if ($request->ajax())
        {
            $person->update([
                'name'         => $request->name,
                'lastname'     => $request->lastname,
                'nationalId'   => $request->nationalId,
                'birthdate'    => $request->birthdate,
                'father'       => $request->father,
                'phone'        => $request->phone,
                'mobile'       => $request->mobile,
                'address'      => $request->address,
                'melliat_id'   => $request->melliat_id,
                'group_id'     => $request->group_id,
                'gender_id'    => $request->gender_id,
                'situation_id' => $request->situation_id,
                // 'city_id'      => $request->city_id,
            ]);

            // dd(static::loadPersonsData($person->id));

            return [
                'status' => 0,
                'people' => static::loadPersonsData($person->id)
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, People $person)
    {
         if ($request->ajax())
         {
            $person->delete();

            return [
                'status' => 0
            ];
        }
    }
    /**
     * Set Group_Permit to User
     */
    public function setGrouppermit(Request $request, User $user)
    {
        if ($request->ajax() || true)       ///TODO: Remove true criteria ! just for test
        {
            $grouppermits = $request->grouppermits;
            $user->giveGroupPermitTo($grouppermits);

            $user = static::loadPersonsData($user->id);

            return [
                'status'   => is_null($user) ? 1 : 0,
                'user'     => $user
            ];
        }
    }

    /**
     * Set Term to User
     */
    public function setTerm(Request $request, User $user)
    {
        if ($request->ajax())
        {
            $terms = $request->terms;
            $user->giveTermTo($terms);

            $user = static::loadPersonsData($user->id);

            return [
                'status'   => is_null($user) ? 1 : 0,
                'user'     => $user
            ];
        }
    }

    /**
     * Set Gate Group to User
     */
    public function setGateGroup(Request $request, User $user)
    {
        //dd($request->gategroups);
        if ($request->ajax())       ///TODO: Remove true criteria ! just for test
        {
            $gategroups = $request->gategroups;

            $user->giveGateGroupTo($gategroups);
            $user = static::loadPersonsData($user->id);

            return [
                'status'   => is_null($user) ? 1 : 0,
                'user'     => $user
            ];
        }
    }

     /**
     * Set Gate Plan to User
     */
    public function setGatePlan(Request $request, User $user)
    {
        if ($request->ajax())
        {
            $gateplans = $request->gateplans;

            $user->giveGatePlanTo($gateplans);
            $user = static::loadPersonsData($user->id);

            return [
                'status'   => is_null($user) ? 1 : 0,
                'user'     => $user
            ];
        }
    }

     /**
     * Load Persons data
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function loadPersonsData($id = null)
    {
        if (is_null ($id))
        {
            $person = \App\User::with(self::$relation)
                            ->paginate(Controller::C_PAGINATE_SIZE);           // TODO: Read from BaseController
        }
        else {
           $person = \App\User::where('id' ,'=', $id)
                          ->with(self::$relation)
                          ->get();
       }
       return $person;
   }

    /**
     * Load people by groupType_id
     */
    public function filterPeople (Request $request, $groupType, $id = null)
    {
        $group_id = $groupType;
        $search = $request->search;
        $fun = [
            'group' => function($q) {
                $q->select([
                    'id',
                    'name'
                ]);
            },

            'people' => function($q) {
                $q->select([
                    'id',
                    'name',
                    'lastname',
                    'nationalId',
                    'birthdate',
                    'mobile',
                    'phone',
                    'address',
                    'gender_id',
                    'city_id',
                    'melliat_id',
                    'picture'
                ]);
            },
            'people.gender' => function($query){
                $query->select([
                    'id',
                    'gender'
                ]);
            },
            'people.melliat' => function($query){
                $query->select([
                    'id',
                    'name'
                ]);
            },
            'people.city' => function($query){
                $query->select([
                    'id',
                    'name',
                    'province_id'
                ]);
            },
            'people.city.province' => function($query){
                $query->select([
                    'id',
                    'name'
                ]);
            },

            'terms.semester' => function ($query){
                $query->select([
                    'id',
                    'name'
                ]);
            },
            'student' => function($query){
                $query->select([
                    'id',
                    'term_id',
                    'user_id',
                    'degree_id',
                    'field_id',
                    'part_id',
                    'situation_id',
                    'suit',
                    'native'
                ]);
            },
            'student.term' => function ($query){
                $query->select([
                    'id',
                    'year',
                    'semester_id'
                ]);
            },
            'student.degree' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'student.field' => function($query){
                $query->select([
                    'id',
                    'name',
                    'university_id'
                ]);
            },
            'student.field.university' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'student.part' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'student.situation' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'teacher' => function($query){
                $query->select([
                    'id',
                    'user_id',
                    'semat'
                ]);
            },
            'staff' => function($query){
                $query->select([
                    'id',
                    'user_id',
                    'department_id',
                    'contract_id'
                ]);
            },
            'staff.department' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'staff.contract' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'grouppermits' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'gategroups' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },

            'gateplans' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },

            'fingerprint' => function($query){
                $query->select([
                    'id',
                    'user_id',
                    'fingerprint_user_id',
                    'image_quality',
                    'type_fingerprint',
                ]);
            },

            'cards' => function($query){
                $query->select([
                    'id',
                    'cdn',
                    'startDate',
                    'endDate',
                    'state',
                     'cardtype_id',
                ]);
            },

            'cards.cardtype' => function($query){
                $query->select([
                    'id',
                    'name'
                ]);
            },
        ];
        $res = \App\User::where('group_id', $group_id)
                    ->whereHas('people' , function($q) use($search) {
                        if (! is_null($search)){
                            $q->where('users.code', 'like', "%$search%");
                            $q->orwhere ('people.name', 'like' , "%$search%");
                            $q->orwhere ('people.lastname', 'like' , "%$search%");
                            $q->orwhere ('people.nationalId', 'like' , "%$search%");
                        }
                    })
                    // ->orWhereHas('terms')
                    // ->orWhereHas('grouppermits')
                    // ->orWhereHas('gategroups')
                    ->leftjoin('students', 'students.user_id', 'users.id')
                    ->leftjoin('teachers', 'teachers.user_id', 'users.id')
                    ->leftjoin('staff', 'staff.user_id', 'users.id')
                    ->with($fun)
                    ->select(['users.id', 'code', 'email', 'state', 'level_id', 'people_id', 'group_id'])
                    ->paginate(Controller::C_PAGINATE_SIZE);

        return $res;
    }
    /**
     * Loads a parent.
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      \App\People               $people   The people
     *
     * @return     array                     ( description_of_the_return_value )
     */
    public function loadParent(Request $request, People $people)
    {
        if ($request->ajax())       ///TODO: Remove true criteria ! just for test
        {
            $relatives =\App\People::with('relatives', 'relatives.kintype')->find($people->id);

            return [
                'status'   => is_null($relatives) ? 1 : 0,
                'relative'     => $relatives
            ];
        }
    }

    /**
     * Show page upload
     */
    public function upload(Request $request)
    {
        return view('people.uploadImages');
    }

    /**
     * Upload Image from Folder upload_images
     */
    public function uploadImageFromFolder(Request $request)
    {
        $time = 0;
        ini_set('max_execution_time', $time);
        $files = \File::files(public_path() . "/upload_images");

        foreach ($files as $file)
        {
            $originalFileName = $file->getFileName ();

            // Update student record
            $studentCode = pathinfo($file, PATHINFO_FILENAME);
            // $extension = pathinfo($file, PATHINFO_EXTENSION);

            // Find student record
            $user = \App\User::where('code', $studentCode)
                             ->first();

            if (is_null ($user))
            {
                continue;
            }

            $user->removeOldPicture ();

            // Generate output filename
            $outputFileName = str_random(60);
            $savePath = storage_path ('app/public/' . $outputFileName . ".jpg");

            // For windows
            // $savePath = storage_path ('app\public\\' . $outputFileName . ".jpg");

            // get real filename
            $filename = $file->getRealPath();

            // Save resized image
            $image_resize = Image::make(file_get_contents($filename));

            $image_resize->resize (300, 300);
            $image_resize->save ($savePath);

            // Update record
            $orginal_people = \App\People::where('id', $user->people_id)
                                         ->first();

            $updateData = [
                'picture' => $outputFileName . ".jpg",
            ];

            $orginal_people->update($updateData);
        }

        return [
            'status'   => 0

        ];
    }

     /**
         * Load User By user.code
         */
    public function loadPeopleByNationalCode(Request $request)
    {
        if (!$request->ajax())
        {
            return;
        }

       $data = $request->nationalId;
        $fun = [
            'group' => function($q) {
                $q->select([
                    'id',
                    'name'
                ]);
            },

            'people' => function($q) {
                $q->select([
                    'id',
                    'name',
                    'lastname',
                    'nationalId',
                    'birthdate',
                    'mobile',
                    'phone',
                    'address',
                    'gender_id',
                    'city_id',
                    'melliat_id'
                ]);
            },

            'people.gender' => function($query){
                $query->select([
                    'id',
                    'gender'
                ]);
            },
            'people.melliat' => function($query){
                $query->select([
                    'id',
                    'name'
                ]);
            },
            'people.city' => function($query){
                $query->select([
                    'id',
                    'name',
                    'province_id'
                ]);
            },
            'people.city.province' => function($query){
                $query->select([
                    'id',
                    'name'
                ]);
            },

            'terms.semester' => function ($query){
                $query->select([
                    'id',
                    'name'
                ]);
            },
            'student' => function($query){
                $query->select([
                    'id',
                    'user_id',
                    'term_id',
                    'degree_id',
                    'field_id',
                    'part_id',
                    'situation_id',
                    'suit',
                    'native'
                ]);
            },
            'student.term' => function ($query){
                $query->select([
                    'id',
                    'year',
                    'semester_id'
                ]);
            },
            'student.degree' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'student.field' => function($query){
                $query->select([
                    'id',
                    'name',
                    'university_id'
                ]);
            },
            'student.field.university' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'student.part' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'student.situation' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'teacher' => function($query){
                $query->select([
                    'id',
                    'user_id',
                    'semat'
                ]);
            },
            'staff' => function($query){
                $query->select([
                    'id',
                    'user_id',
                    'department_id',
                    'contract_id'
                ]);
            },
            'staff.department' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'staff.contract' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'grouppermits' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
            'gategroups' => function($query){
                $query->select([
                    'id',
                    'name',
                ]);
            },
        ];
        $res = \App\User::whereHas('people' , function($q) use($data) {
                        if (! is_null($data)){
                            $q->where ('people.nationalId', 'like' , "%$data%");
                        }
                    })
                    ->WhereHas('grouppermits')
                    ->orWhereHas('gategroups')
                    ->leftjoin('students', 'students.user_id', 'users.id')
                    ->leftjoin('teachers', 'teachers.user_id', 'users.id')
                    ->leftjoin('staff', 'staff.user_id', 'users.id')
                    ->with($fun)
                    ->select(['users.id', 'code', 'email', 'state', 'level_id', 'people_id', 'group_id'])
                    ->first();

        $res->cities = $res->people->city->province->cities;

        return $res;
    }

    public function checkNationaExsit(Request $request)
    {
        if ($request->ajax())
        {
            $exsitPeople = \App\People::where('nationalId' , $request->nationalId)
                            ->first();

            if (! is_null($exsitPeople))
            {
                return [
                    'exists' => true,
                    'data'  => [
                        'nationalId'=> $exsitPeople->nationalId
                    ],
                ];
            }

            return [
                'exists' => false,
                'data' => []
            ];
        }
    }

    public function getPicFingerprint(Request $request)
    {
        $user_id = $request->userId;
        $res = \App\Fingerprint::where('user_id', $user_id)
                            ->get();

        $pic = Image::make($res[0]->image)->resize(320, 240);
        $response = Response::make($pic->encode('jpeg'));

        //setting content-type
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

}

