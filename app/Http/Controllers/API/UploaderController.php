<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;

class UploaderController extends Controller
{
    public function __construct ()
    {
    }
    /**
     * Uploads a finger.
     */
    public function UploadFingerprint(Request $request)
    {
        $user = \App\User::where('code', $request->code)
                            ->first();
        if (! is_null($user))
        {
            $fingerprint = \App\Fingerprint::withTrashed()
                            ->where('user_id', $user->id)
                            ->first();
            if (is_null($fingerprint))
            {
                // Create new Fingerprint
                $registerFinger = \App\Fingerprint::create([
                    'user_id'                   => $user->id,
                    'fingerprint_user_id'      => $request->finger_id,
                ]);

                    return [
                    "success" => true,
                    "data" => [
                        "code" => $request->code
                    ]
                ];
            }
        }
        else
        {
            return [
                "failed" => false,
                "data" => [
                    "code" => $request->code
                ]
            ];
        }
    }

    /**
     * Uploads a data.
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     array                     ( description_of_the_return_value )
     */
    public function UploadData(Request $request)
    {

    	$image = $request->image;  // your base64 encoded

		// if (! is_null($image)) {

  //   		$image = str_replace('data:image/jpeg;base64,', '', $image);
  //   		$image = base64_decode($image);

  //   		$resized_image = Image::make($image)->resize(100, 100);

  //   	//	$image->fit(320, 240);
		// 	$th_name = str_replace('.jpg', '-t.jpeg', $resized_image);

  //           return $th_name;
		// 	$pictureThumbUrl = storage_path('app/public') . '/' .($th_name);
		// 	\File::put($pictureThumbUrl, $th_name);


  //           return $pictureThumbUrl;
  //       }

    	if (! is_null($image)) {

    		$image = str_replace('data:image/jpeg;base64,', '', $image);
    		$image = base64_decode($image);
        	$imageName = str_random(60).'.'.'jpg';
        	$imagePath = storage_path('app/public') . '/' . $imageName;

	        \File::put($imagePath, $image);
    	}
    	else {
    		$imageName = null;
    	}

    	$people = \App\People::withTrashed()
                            ->where('nationalId', $request->nationalId)
                            ->first();

        if (is_null($people))
    	{
        	$registerPeople = \App\People::create([
	                'name'       	=> $request->name,
	                'lastname'   	=> $request->lastname,
	                'nationalId' 	=> $request->nationalId,
	                'birthdate'  	=> $request->birthdate,
	                'father'  		=> $request->father,
	                'phone'      	=> $request->phone,
	                'mobile'     	=> $request->mobile,
	                'address'   	=> $request->address . " , " . $request->code_address,
	                'gender_id'  	=> $request->gender_id,
                    // 'melliat_id'     => $request->melliat_id,
	                 'melliat_id' 	=> 1,
                    // 'city_id'       => $request->city_id,
	                'city_id'   	=> 17,
	                'picture'    	=> $imageName,
                ]);

             if (is_null($request->email))
            {
                $item_email = $request->code . '@cfu.ac.ir';
            }
            else
            {
                $item_email = $request->email;
            }

	        // Create new user
            $registerUser = \App\User::create([
                'code'      => $request->code,
                'email'     => $item_email,
                // 'email'     => $request->code . '@ikiu.ac.ir',
                'password'  => bcrypt(123456),
                'api_token' => str_random(60),
                'state'     => 1,
                'group_id'  => 3,
                'people_id' => $registerPeople->id,
                'level_id'  => 3,
            ]);

             // Create new Student
            $registerStudent = \App\Student::create([
                'term_id'   	=> $request->term_id,
                'native'       	=> 1,
                'suit'         => $request->suit,
                'degree_id'    => $request->degree_id,
                'part_id'      => $request->part_id,
                'field_id'     => $request->field_id,
                'situation_id' => $request->situation_id,
                'user_id'      =>  $registerUser->id,
            ]);

            $registerUser->giveTermTo( $request->term_id);

        	return [
	    		"success" => true,
	    		"data" => [
	    			"code" => $request->code
	    		]
	    	];

        }
        else
        {
    		return [
	    		"failed" => false,
	    		"data" => [
	    			"code" => $request->code
	    		]
	    	];
        }



    }
}
