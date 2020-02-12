<?php

namespace App\Http\Controllers;

use App\Amoeba;
use App\Http\Resources\AmoebaCollection;
use App\Http\Resources\ListDataCollection;
use Illuminate\Http\Request;

class AmoebaController extends Controller
{
    public function __construct ()
    {
    }
    /**
     * List Gate device with card data
     *
     * @param      <type>            $amoeba_ip  The amoeba ip
     *
     * @return     AmoebaCollection  ( description_of_the_return_value )
     */
    public function listAllowTraffic($amoeba_ip)
    {
        $ip = $amoeba_ip;
        $fun = [
            'gatedevices' => function($q) {
                    $q->select([
                        'id',
                        'name',
                        'ip'
                    ]);
                },

                'gatedevices.cards' => function($q) {
                    $q->select([
                        'cards.id',
                        'cards.cdn',
                    ]);
                },
        ];

        $result = Amoeba::where('ip', $ip)
                                ->whereHas('gatedevices', function($query){
                                    $query->whereHas('cards');
                                })
                                ->with($fun)
                                ->select('id', 'name')
                                ->get();

        return new AmoebaCollection($result);
    }

    /**
     * Load valid Person
     *
     * @param      <type>              $amoeba_ip  The amoeba ip
     *
     * @return     ListDataCollection  ( description_of_the_return_value )
     */
    public function listDataUser($amoeba_ip)
    {
        $ip = $amoeba_ip;
        $fun = [
            'gatedevices' => function($q) {
                    $q->select([
                        'id',
                        'name',
                        'ip'
                    ]);
                },

                'gatedevices.cards' => function($q) {
                    $q->select([
                        'cards.id',
                        'cards.cdn',
                    ]);
                },

                'gatedevices.cards.users' => function($q) {
                    $q->select([
                        'users.id',
                        'users.code',
                        'users.people_id'
                    ]);
                },

                'gatedevices.cards.users.people' => function($q) {
                    $q->select([
                        'people.id',
                        'people.name',
                        'people.lastname'
                    ]);
                },
        ];

        $result = Amoeba::where('ip', $ip)
                                ->whereHas('gatedevices', function($query){
                                    $query->whereHas('cards', function($query){
                                        $query->whereHas('users',function($query){
                                            $query->whereHas('people');
                                        } );
                                    });
                                })
                                ->with($fun)
                                ->select('id', 'name')
                                ->get();

        return new ListDataCollection($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Amoeba  $amoeba
     * @return \Illuminate\Http\Response
     */
    public function show(Amoeba $amoeba)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Amoeba  $amoeba
     * @return \Illuminate\Http\Response
     */
    public function edit(Amoeba $amoeba)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amoeba  $amoeba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amoeba $amoeba)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amoeba  $amoeba
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amoeba $amoeba)
    {
        //
    }

    /**
     * insert log traffic from raspberry
     */
    public static function getDataAmoeba()
    {
       $list=['mysqlRaspberryOneConnection', 'mysqlRaspberryTwoConnection'];

        try
        {

            for ($i=0; $i < 2; $i++)
            {
                // if(\DB::connection($list[$i])->getPdo())
                // {
                //     return "not connect";
                // }

                $result = \DB::connection($list[$i])
                            ->select('select * from traffic_histories where sync_status = 0');


                if (!isset($result) || empty($result))
                {
                    return;
                }

                foreach ($result as $value)
                {

                    $fnc = [ 'users' => function($q){
                                $q->select([
                                                'id',
                                                'people_id',
                                                'code',
                                                'group_id'
                                            ]);
                                },
                            ];

                    $res = \App\Card::where('cdn', $value->cart_number)
                                ->wherehas('users')
                                ->with($fnc)
                                ->select(['id', 'cdn'])
                                ->first();

                    if (isset($res) || !empty($res))
                    {
                        $res_gatedevice = \App\Gatedevice::where('ip', $value->gate_ip)
                                            ->select(['id', 'ip'])
                                            ->first();

                        $update_remote = \DB::connection($list[$i])
                                                ->update('update traffic_histories set sync_status = 1 where id = ?'
                                                        , array($value->id));

                        \App\Gatetraffic::create([
                            'user_id' => $res->users[0]->id,
                            'gatedate' => $value->traffic_date,
                            'gatedevice_id' => $res_gatedevice->id ,
                            'gatepass_id' => 1, //Pass by Card
                            'gatedirect_id' => $value->direct_id,
                            'gatemessage_id' => $value->message_id,
                            'gateoperator_id' => 1
                        ]);
                    }
                }

            }
        }
        catch (Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" );
        }
    }
}
