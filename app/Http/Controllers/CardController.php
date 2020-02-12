<?php

namespace App\Http\Controllers;

use App\Card;
use App\User;
use App\People;
use Illuminate\Http\Request;
use App\Http\Requests\CardRequest;
use App\Http\Resources\CardCollection;
use App\Http\Resources\CardFilterCollection;
use Carbon\Carbon;
use Response;
use Image;

class CardController extends Controller
{
    public $successStatus = 200;
    public $failedStatus  = 401;

    public static $relation = [
        'cardtype',
        'users',
        'users.people',
        'users.group',
        'gatedevices'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $cards = Card::paginate(Controller::C_PAGINATE_SIZE);

            return $cards;
        }

        return view('cards.index');
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
    public function store(CardRequest $request)
    {
         if (! $request->ajax())
        {
            return $this->makeStoreResult(0, null);
        }

        \DB::beginTransaction();

        $user       = (object)$request->user;
        $card       = (object)$request->card;

        // Check for duplicate
        $newCard  = \App\Card::createIfNotExists($card);

        $newCard->giveUserTo($user->id);


        $newCard->load(static::$relation)->get();

        // Validate new user data
        if (is_null($newCard))
        {
            \DB::rollBack();

            return $this->makeStoreResult(0, null);
        }

         \DB::commit();

        return [
            'status' => is_null($newCard) ? 1 : 0,
            'card' => $newCard
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(CardRequest $request, Card $card)
    {
        if ($request->ajax())
        {
            $user       = (object)$request->user;
            $card       = (object)$request->card;

            $update_card  = Card::updateByRequest($card);
            return [
                'status' => 0,
                'card'   => $update_card
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Card $card)
    {
        if ($request->ajax())
        {

           $data = \App\Card::whereHas('users')
                        ->where('id', $card->id)
                        ->with('users')
                        ->get();

            $user =(object)$data[0]->users[0];

            $card->takeUserFrom($user);

            $card->delete();

            return [
                'status' => 0
            ];
        }
    }
    /**
     * Load Card and Order by search data
     *
     * @param      \Illuminate\Http\Request  $request    The request
     * @param      <type>                    $groupType  The group type
     * @param      <type>                    $id         The identifier
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function filterCard(Request $request, $groupType, $id = null)
    {
        $groupId = $groupType;
        $cardtype_id = 5;
        $search = $request->search;

        $fnc = [
                    'gatedevices' => function($q){
                        $q->select([
                                'id',
                                'name',
                                'ip'

                        ]);
                    },
                    'cardtype' => function($q){
                        $q->select([
                                        'id',
                                        'name'
                                    ]);
                    },
                    'users' => function($q){
                        $q->select([
                                        'id',
                                        'people_id',
                                        'code',
                                        'group_id'
                                    ]);
                    },
                    'users.group' => function($q){
                        $q->select([
                                        'id',
                                        'name'
                                    ]);
                    },
                    'users.people' => function ($q){
                        $q->select([
                                        'id',
                                        'name',
                                        'lastname',
                                        'nationalId'
                                    ]);
                    },
                 ];
        $res = \App\Card::where('cardtype_id', '<>', $cardtype_id)
                        ->wherehas('users.people', function($q) use($search, $groupId){
                            $q->where('users.group_id', $groupId);
                            if(! is_null($search)){
                                $q->where ('users.code', 'like' , "%$search%");
                                $q->orwhere ('people.name', 'like' , "%$search%");
                                $q->orwhere ('people.lastname', 'like' , "%$search%");
                                $q->orwhere ('people.nationalId', 'like' , "%$search%");
                            }
                        })
                        ->with($fnc)
                        ->select(['id','cdn', 'startDate', 'endDate', 'state', 'cardtype_id'])
                        ->paginate(Controller::C_PAGINATE_SIZE);
        return $res;


        // $res = \DB::raw("CALL spLoadCard('$search', $groupId);");
        // $mydata = \DB::select($res);
        // return $mydata;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Request $request)
    {
        $group_id = $request->group_id;
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
                    'nationalId'
                ]);
            },

            'cards' => function($q) {
                $q->select([
                    'id',
                    'cdn',
                    'startDate',
                    'state',
                    'endDate',
                    'cardtype_id',
                ]);
            },

            'cards.cardtype' => function($q) {
                $q->select([
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
                        ->with($fun)
                        ->select(['id', 'code', 'people_id', 'group_id'])
                        ->paginate(Controller::C_PAGINATE_SIZE);
        // return new CardFilterCollection($res);
        return $res;
    }

    /**
     * Load Data Card in wizard 3
     */
    public function loadCard(Request $request)
    {
         $items = Card::where([
                                ['user_id', '=', $request->user_id],
                                ['group_id', '=', $request->group_id],
                            ])->get();

         return $items;
    }

    /**
     * Search User By code or group_id or nationalid or name or lastname or serial card or date
     */
    public function cardSearch(Request $request)
    {
        $items = User::leftJoin('groups', 'groups.id', '=', 'users.group_id')
                    ->leftJoin('cards', function($join) use ($request)
                        {
                            $join->on ('cards.user_id', 'users.id');
                            $join->whereNull('cards.deleted_at');

                             if (! is_null ($request->cdn)){
                                    $join->where('cards.cdn', '=', $request->cdn);
                                }
                        })
                    ->leftJoin('cardtypes', 'cardtypes.id', '=', 'cards.cardtype_id')
                    ->leftJoin('people', function($join) use ($request)
                        {
                            $join->on ('people.id', '=', 'users.people_id');

                            if (! is_null ($request->nationalId)){
                                $join->orWhere('people.nationalId', '=', $request->nationalId);
                            }

                            if (! is_null ($request->name)){
                                $join->orWhere('people.name', 'like', '%' . $request->name . '%');
                            }

                            if (! is_null ($request->lastname)){
                                $join->orWhere('people.lastname', 'like', '%' .  $request->lastname . '%');
                            }
                        })
                    ->OrWhere('users.code', '=', $request->code)
                    ->select([
                        'groups.id as group_id',
                        'groups.name as group_name',
                        'users.id as user_id',
                        'users.code as user_code',
                        'people.name as user_people_name',
                        'people.lastname as user_people_lastname',
                        'cards.cdn as card_cdn',
                        'cards.startDate as card_start_date',
                        'cards.endDate as card_end_date',
                        'cards.state as card_state',
                        'cardtypes.id as cardtype_id',
                        'cardtypes.name as cardtype_name'
                    ])
                    ->paginate(Controller::C_PAGINATE_SIZE);

        return new CardCollection($items);
    }

     /**
     * Set Gatedevice to Card
     */
    public function setGatedevice(Request $request, Card $card)
    {
        $gatedevices = $request->gatedevices;

        if ($request->ajax())
        {
            $card->giveGatedeviceTo($gatedevices);
            $card->load(self::$relation);

            return [
                'status'   => is_null($card) ? 1 : 0,
                'card'     => $card
            ];
        }
    }

    public function reportCardChart($groupId, $cardtypeId)
    {
        $labels = [];
        $series = [];
        
        $groupId = $groupId;
        $cardtypeId = $cardtypeId;

        $res_all = \App\User::where('group_id', $groupId)
                        ->whereHas('people')
                        ->where('state', 1)
                        ->count();

      

        $res_has_card = \App\User::where('group_id', $groupId)
                                    ->whereHas('people')
                                    ->whereHas('cards')
                                    ->where('state', 1)
                                    ->count();

        

        $res_Dont_have_card = \App\User::where('group_id', $groupId)
                                        ->whereHas('people')
                                        ->whereDoesntHave('cards')
                                        ->where('state', 1)
                                        ->count();

    
        $labels[] = "بدون کارت";
        $series[] = $res_Dont_have_card;

        $labels[] = "دارای کارت";
        $series[] = $res_has_card;

        $labels[] = "کل";
        $series[] = $res_all;

        $output = [
            'labels' => $labels,
            'series' => $series
        ];
        return $output;
    }



}
