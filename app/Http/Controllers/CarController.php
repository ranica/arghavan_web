<?php
namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CardFilterCollection;


class CarController extends Controller
{
     public static $relation = [
            'carColor',
            'carFuel',
            'carLevel',
            'carSystem',
            'carModel',
            'carType',
            'carPlateType',
            'carPlateCity',
            'card.cardtype',
            'users.people',
            'users.group',
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $car = Car::with(self::$relation)
                        ->paginate(Controller::C_PAGINATE_SIZE);

            return $car;
        }
         return view('cars.index');
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
    public function store(CarRequest $request)
    {
        if (! $request->ajax())
        {
            return $this->makeStoreResult(0, null);
        }

        \DB::beginTransaction();

        $car        = (object)$request->car;
        $user       = (object)$request->user;
        $card       = (object)$request->card;

        // Check for duplicate
        $newCard  = \App\Card::createIfNotExists($card);

        $newCard->giveUserTo($user->id);

        $car->card_id    = $newCard->id;
        $newCar    = Car::createIfNotExists($car);

        $newCar->giveUserTo($user->id);

        $newCar->load(static::$relation);

        // Validate new user data
        if (is_null($newCar))
        {
            \DB::rollBack();

            return $this->makeStoreResult(0, null);
        }

         \DB::commit();

        return [
            'status' => is_null($newCar) ? 1 : 0,
            'car' => $newCar
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $Car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $Car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $Car
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, Car $car)
    {
      if ($request->ajax())
      {
        $car        = (object)$request->car;
        $user       = (object)$request->user;
        $card       = (object)$request->card;

        $update_card  = \App\Card::updateByRequest($card);

        $update_car  = Car::updateByRequest($car);

        $result = $update_car['car']->load(static::$relation);

        return [
            'status' => 0,
            'car'   => $result
        ];
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $Car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Car $car)
    {
        if ($request->ajax())
        {
            $data = \App\Car::whereHas('users')
                        ->where('id', $car->id)
                        ->with('users')
                        ->get();

            $user =(object)$data[0]->users[0];

            $car->takeUserFrom($user);

            $car->delete();

            return [
                'status' => 0
            ];
        }
    }

    /**
     * Search Car and People and Tag
     */
    public function search(Request $request)
    {
        $group_id = $request->group_id;
        $search = $request->search;

        $fun = [
            'people' => function ($query){
              $query->select(['id',
                              'name as people_name',
                              'lastname as people_lastname'
                            ]);
              },
            'cars' => function ($q){
                $q->select (['id',
                            'plate_first',
                            'plate_second',
                            'plate_word',
                            'card_id',
                            'capacity',
                            'chasiscode',
                            'enginecode',
                            'car_color_id',
                            'car_fuel_id',
                            'car_level_id',
                            'car_model_id',
                            'car_system_id',
                            'car_type_id',
                            'car_plate_type_id',
                            'car_plate_city_id',
                          ]);
              },
             'cars.card' => function($q){
                  $q->select([
                                'id',
                                'cdn',
                                'cardtype_id',
                                'startDate',
                                'endDate',
                                'state'
                              ]);
              },
              'cars.card.cardtype' => function($q){
                  $q->select([
                                'id',
                                'name'
                              ]);
              },
        ];
        $result = \App\User::where ('group_id', $group_id)
                            ->whereHas('people' , function($q) use($search) {
                                if (! is_null($search)){
                                  $q->where('users.code', 'like', "%$search%");
                                  $q->orwhere ('people.name', 'like' , "%$search%");
                                  $q->orwhere ('people.lastname', 'like' , "%$search%");
                                  $q->orwhere ('people.nationalId', 'like' , "%$search%");
                                }
                              })
                            ->with ($fun)
                            ->select ('id', 'code', 'people_id', 'state')
                            ->get();
        return $result;
    }
    /**
     * Load Car
     */
    public function loadCar(Request $request)
    {
        $cardtype_id = 4;
        $search = $request->search;
        $fnc = [
                'card' => function($q){
                    $q->select([
                                    'id',
                                    'cdn',
                                    'cardtype_id',
                                    'startDate',
                                    'endDate',
                                    'state'
                                ]);
                },
                'card.cardtype' => function($q){
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
               'carColor' => function ($q){ $q->select(['id','name' ]);},
                'carModel' => function ($q){$q->select([ 'id','name']);},
                'carType' => function ($q){ $q->select(['id','name' ]);},
                'carLevel' => function ($q){ $q->select(['id','name' ]);},
                'carSystem' => function ($q){ $q->select(['id','name' ]);},
               'carFuel' => function ($q){ $q->select([ 'id','name']);},
               'carPlateType' => function ($q){ $q->select(['id', 'name']);},
               'carPlateCity' => function ($q){ $q->select(['id', 'key']);},
            ];
        $result = Car::whereHas('users.people', function($q) use($search){
                            if(! is_null($search)){
                                $q->where ('users.code', 'like' , "%$search%");
                                $q->orwhere ('people.name', 'like' , "%$search%");
                                $q->orwhere ('people.lastname', 'like' , "%$search%");
                                $q->orwhere ('people.nationalId', 'like' , "%$search%");
                            }
                        })
                        ->whereHas('card', function($q) use($cardtype_id) {
                            $q->where('cardtype_id', $cardtype_id);
                        })
                        ->with($fnc)
                        ->select(['id', 'plate_first', 'plate_second', 'plate_word',
                                  'card_id',
                                  'car_color_id',
                                  'car_fuel_id',
                                  'car_level_id',
                                  'car_system_id',
                                  'car_model_id',
                                  'car_type_id',
                                  'car_plate_type_id',
                                  'car_plate_city_id',
                                  'model',
                                  'capacity',
                                  'chasiscode',
                                  'enginecode'
                         ])
                        ->paginate(Controller::C_PAGINATE_SIZE);

        return $result;
    }
}
