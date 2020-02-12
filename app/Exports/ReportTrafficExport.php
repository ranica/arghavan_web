<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;
use App\User;


class ReportTrafficExport implements FromCollection
{
    use Exportable;

    public $startDate;
    public $endDate;

    public function __construct($request)
    {
        $this->code = $request->code;
        $this->group_id = $request->groupId;
        $this->type_filter = $request->type_filter;
        $this->commonrange_id = $request->commonrangeId;
        $this->gender_id = $request->genderId;
        $this->gatedevice_id = $request->deviceId;
        $this->gatemessage_id = $request->messageId;
        $this->gatedirect_id = $request->directId;
        $this->startDate = $request->beginDateTime;
        $this->endDate = $request->endDateTime;
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function collection()
    {
        $dateRange = [
                        $this->startDate,
                        $this->endDate
                    ];

        $fields = [
            'gatetraffics.gatedate',
            'gatemessages.message',
            'gatedirects.name as direct',
            'genders.gender as gender',
            'users.code',
            'people.name as name',
            'people.lastname as lastname',
            'people.nationalId'
        ];


        $res = \App\Gatetraffic::whereBetween('gatedate',$dateRange);
        $res = $res->join ('users', 'gatetraffics.user_id', 'users.id')
                   ->join ('people', 'people.id', 'users.people_id')
                   ->join ('genders', 'genders.id', 'people.gender_id')
                   ->join ('groups', 'groups.id', 'users.group_id')
                   ->join('gatedevices', 'gatedevices.id', 'gatetraffics.gatedevice_id')
                   ->join('gatepasses', 'gatepasses.id', 'gatetraffics.gatepass_id')
                   ->join('gatedirects', 'gatedirects.id', 'gatetraffics.gatedirect_id')
                   ->join('gatemessages', 'gatemessages.id', 'gatetraffics.gatemessage_id');


        if (! is_null($this->group_id) && ($this->group_id > 0)){
            $res = $res->where('users.group_id', $this->group_id);
        }

        if (! is_null($this->code)){
            $res = $res->where('users.code','like', "%$this->code%");
        }

        if (!is_null ($this->gatemessage_id)) {
            $res = $res->Where ('gatemessages.id', '=', $this->gatemesage_id);
        }

        if (!is_null ($this->gatedevice_id)) {
            $res = $res->Where ('gatedevices.id', '=', $this->gatedevice_id);
        }

        if (!is_null ($this->gatedirect_id)) {
            $res = $res->Where ('gatedirects.id', '=', $this->gatedirect_id);
        }

        if (!is_null ($this->gender_id)) {
            $res = $res->Where ('genders.id', '=', $this->gender_id);
        }
        $res = $res->select ($fields)
                   ->get();

        $res = $res->map (function ($item) {
            return [
                $item['code'],
                $item['name'],
                $item['lastname'],
                $item['nationalId'],
                $item['gender'],
                miladiToPersianDateTime($item['gatedate']) ,
                $item['message'],
                $item['direct']
            ];
        });

      return $res;
    }


    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //        $res2 = [
    //             [
    //                 'name' => 'ali',
    //                 'lastname' => 'alavi'
    //             ],
    //             [
    //                 'name' => 'ali2',
    //                 'lastname' => 'alavi'
    //             ],
    //         ];

    //        $res2 = collect ($res2);

    //     return $res2;
    //     // $user = user::select('id', 'code')
    //     //             ->get();
    //     // return $user;
    // }
}
