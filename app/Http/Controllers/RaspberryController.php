<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\MessageGate;
use DateTime;
use Image;
use App\Enums\Directions;
use App\Enums\CommandType;
use App\HelperTraffic\Logic\GateTraffic as HelperTraffic;


class RaspberryController extends Controller
{
    public $successStatus = 200;
    public $failedStatus  = 401;
    public $list_card = array();


    public function __construct ()
    {
    }

    /**
     * Parse Data Received from Raspberry
     *
     * @param      <type>  $cdn      The cdn
     * @param      <type>  $ip       { parameter_description }
     * @param      <type>  $command  The command
     *
     * @return     array   ( description_of_the_return_value )
     */
    public function parseData($cdn, $ip, $command)
    {
        $cmd = "CMD_$command";

        // Goto Command Parser::
        $result = \App\CommandParser\CommandFactory::runCommand($cmd, [
            "ip" => $ip,
            "cdn" => $cdn
        ]);


        $fields= [
            'ip' => $ip,
            'command' => $result
        ];

        return [
            "data" => $fields,
            "success" => $this->successStatus
        ];
    }

    /**
     * Save Duplicate Card
     */
    public function duplicate_data($cdn, $ip, $command)
    {
        //TODO:: Duplicate Traffic
        $resultType = MessageGate::duplicat_pass;
        $SERVICE_ID = \Config::get('core.service_id'); // default = 1
        $direct = 0;

        $current_date = \Carbon\Carbon::now()->setTimeZone('Asia/Tehran');
        $validator = \App\TrafficValidator\TrafficValidatorFactory::chainValidtor();

        $raw_base_gate = \DB::raw ("CALL sp_load_gate_device_by_ip('$ip');");
        $opResult_base_gate = \DB::select ($raw_base_gate);

        $raw_traffic_last_user= \DB::raw ("CALL sp_load_user_by_cdn('$cdn');");
        $opResult_traffic_last_user = \DB::select ($raw_traffic_last_user);

        // Unknow Device
        if (!isset($opResult_base_gate) || empty($opResult_base_gate))
        {
            return;
        }

        $gateData = $opResult_base_gate[0];

         // Unknow Card
        if (!isset($opResult_traffic_last_user) || empty($opResult_traffic_last_user))
        {
            return;
        }

        $personData =  $opResult_traffic_last_user[0];

        if ($command == "5308"){
            $direct = Directions::input;
        }

        elseif ($command == "5408") {
            $direct = Directions::output;
        }

        $result_array = HelperTraffic::prepareData($gateData->gatedevice_id,
                                                    $gateData->gatepass_id,
                                                    $personData->user_id,
                                                    $resultType,
                                                    $direct,
                                                    $SERVICE_ID);

        HelperTraffic::register_traffic_DB($result_array);
    }
    /**
     * Update Status Network Gate
     *
     * @param      <type>  $ip      { parameter_description }
     * @param      <type>  $status  The status
     */
    public function updateStatusNetworkGate($ip, $state)
    {
        $raw_base_gate = \DB::select ("CALL sp_update_network_status_gateDevice('$ip', '$state');");
    }

    /**
     * Disconnect Al Status GateDevices
     */
    public function disconnectAllGate($state)
    {
        $raw_base_gate = \DB::select ("CALL sp_disconnect_gate_device();");
    }

    /**
     * Save Data received from Raspbery
     *
     * @param      <type>  $card     The card
     * @param      <type>  $ip       The Gate IP
     * @param      <type>  $date     The date
     * @param      <type>  $diret    The diret
     * @param      <type>  $message  The message
     */
    public function saveData($card, $ip, $date, $diret, $message)
    {
        dd([$card, $ip, $data, $diret, $message])
        $result_array = HelperTraffic::prepareData($gateData->gatedevice_id,
                                                    $gateData->gatepass_id,
                                                    $personData->user_id,
                                                    $resultType,
                                                    $direct,
                                                    $SERVICE_ID);

        HelperTraffic::register_traffic_DB($result_array);
    }

    /**
     * Check Data gate
     *
     * @param      <type>  $cdn      The cdn
     * @param      <type>  $ip       ip gate
     * @param      <type>  $command  The command
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function routin_check_data($cdn, $ip, $command)
    {
        $validator = \App\TrafficValidator\TrafficValidatorFactory::chainValidtor();
        $result = $validator->validate(null, null, null);
        return;



        // $command = "5308";
        // $ip = '192.168.0.2';
        // $cdn = '2047437529';
        $direct_input = 1;
        $direct_output = 2;
        switch ($command)
        {
            case '5308':{
                            $response = $this->Cmd5308($cdn, $ip, $direct_input);
                            return $this->sendResponseWebService($response, $ip, $direct_input);
                        }
                        break;
            case '5408':
                        {
                            $response = $this->Cmd5408($cdn, $ip, $direct_output);
                            return $this->sendResponseWebService($response, $ip, $direct_output);
                        }
                        break;
            case '63011':
                        $this->Cmd63011($cdn, $direct_input);
                        break;

            case '63010':
                        $this->Cmd63010($cdn, $direct_input);
                        break;

            case '64011':
                        $this->Cmd64011($cdn, $direct_output);
                        break;

            case '64010':
                        $this->Cmd64010($cdn, $direct_output);
                        break;
        }
    }
    /**
     * Command 5308
     *
     * @param      <type>  $cdn     The cdn
     * @param      <type>  $ip      gate ip
     * @param      <type>  $direct  The direct
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function Cmd5308($cdn, $ip, $direct)
    {
        $result =  $this->main_check($cdn, $ip, $direct);
        return $result;
    }
    /**
     * Command 63011
     *
     * @param      <type>  $cdn     The cdn
     * @param      <type>  $direct  The direct
     */
    public function Cmd63011($cdn, $direct)
    {
        $this->update_traffic_db($cdn, MessageGate::pass, $direct);
    }
    /**
     * Command 63010
     *
     * @param      <type>  $cdn     The cdn
     * @param      <type>  $direct  The direct
     */
    public function Cmd63010($cdn, $direct)
    {
        $this->update_traffic_db($cdn, MessageGate::dontPass, $direct);
    }

    /**
     * Command 5408
     *
     * @param      <type>  $cdn     The cdn
     * @param      <type>  $ip      ip gate
     * @param      <type>  $direct  The direct
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function Cmd5408($cdn, $ip, $direct)
    {
        $result =  $this->main_check($cdn, $ip, $direct);
        return $result;
    }

    /**
     * Command 64011
     *
     * @param      <type>  $cdn     The cdn
     * @param      <type>  $direct  The direct
     */
    public function Cmd64011($cdn, $direct)
    {
        $this->update_traffic_db($cdn, MessageGate::pass, $direct);
    }

    /**
     * Command 64010
     *
     * @param      <type>  $cdn     The cdn
     * @param      <type>  $direct  The direct
     */
    public function Cmd64010($cdn, $direct)
    {
        $this->update_traffic_db($cdn, MessageGate::dontPass, $direct);
    }

    /**
     * Main check data
     *
     * @param      <type>  $cdn     The cdn
     * @param      <type>  $ip      ip gate
     * @param      <type>  $direct  The direct
     *
     * @return     string  ( description_of_the_return_value )
     */
    public function main_check($cdn, $ip, $direct)
    {
        $current_date = \Carbon\Carbon::now()->setTimeZone('Asia/Tehran');

        $raw_base_gate = \DB::raw ("CALL sp_load_gate_device_by_ip('$ip');");
        $opResult_base_gate = \DB::select ($raw_base_gate);

        $raw_traffic_last_user= \DB::raw ("CALL sp_load_user_by_cdn('$cdn');");
        $opResult_traffic_last_user = \DB::select ($raw_traffic_last_user);

         // Unknow Device
        if (!isset($opResult_base_gate) ||
             empty($opResult_base_gate))
            return MessageGate::unknown_device;

         // Unknow Card
        if (!isset($opResult_traffic_last_user) ||
            empty($opResult_traffic_last_user))
        {
            // save traffic unkown card;
            $this->prepare_db_unknown_card($ip, $direct);
            return MessageGate::unknown_card;
        }


        $gate_data = $opResult_base_gate[0];
        $user_data =  $opResult_traffic_last_user[0];



        // prepare data array
        $list_traffic = array();
        $list_traffic["user_id"] = $user_data->user_id ;
        $list_traffic["gate_id"] = $gate_data->gatedevice_id ;
        $list_traffic["gate_pass_id"] = 1 ;
        $list_traffic["gate_direct_id"] = $direct;
        $list_traffic["gate_operator_id"] = 1;

        if($user_data->gatedate >= $current_date->modify('-3 seconds') and
            MessageGate::allow == $user_data->message_id)
        {
            $list_traffic["gate_message_id"] = MessageGate::duplicat_pass;
            $this->register_traffic_DB($list_traffic);
            return MessageGate::duplicat_pass; // Duplicate pass
        }


        if (!($gate_data->gate_option_start <= $current_date and
            $gate_data->gate_option_end >= $current_date))
        {
            $list_traffic["gate_message_id"] = MessageGate::expaired_department;
            $this->register_traffic_DB($list_traffic);
            return MessageGate::expaired_department;
        }

        if (!$user_data->user_state)
        {
            $list_traffic["gate_message_id"] = MessageGate::disable_user;
            $this->register_traffic_DB($list_traffic);
            return MessageGate::disable_user;
        }

        if (!($user_data->card_start <= $current_date and
                $user_data->card_end >= $current_date))
        {
            $list_traffic["gate_message_id"] = MessageGate::expaired_card;
            $this->register_traffic_DB($list_traffic);
            return MessageGate::expaired_card;
        }

        $gender_gate_device = $gate_data->gender_id;

        if (!($gender_gate_device == $user_data->gender_id or
            $gender_gate_device == 1 ))
        {
            $list_traffic["gate_message_id"] = MessageGate::mismatch_gender;
            $this->register_traffic_DB($list_traffic);
            return MessageGate::mismatch_gender;
        }

        $gender_sensitive = 0;
        switch ($user_data->gender_id) {
            case '1':
                $gender_sensitive = $gate_data->genZoneMan;
                break;

            case '2':
                $gender_sensitive = $gate_data->genZoneWoman;
                break;
        }

        // check switch data
        switch ($gender_sensitive) {
            case '1':
                $list_traffic["gate_message_id"] = MessageGate::allow;
                $this->register_traffic_DB($list_traffic);
                return MessageGate::allow;
                break;

            case '2':
                if (!is_null($user_data->direct_id))
                {
                    if ($user_data->direct_id != $direct)
                    {
                        $list_traffic["gate_message_id"] = MessageGate::allow;
                        $this->register_traffic_DB($list_traffic);
                        return MessageGate::allow;
                    }
                    else
                    {
                        $list_traffic["gate_message_id"] = MessageGate::exists_pass;
                        $this->register_traffic_DB($list_traffic);
                        return  MessageGate::exists_pass;
                    }
                }
                else
                {
                    if (! is_null($user_data->message_id))
                    {
                        switch ($user_data->message_id) {
                            case MessageGate::dontPass:
                            case  MessageGate::licensed_by_user:
                            case  MessageGate::store_by_auto:
                                //save traffic
                            {
                                $list_traffic["gate_message_id"] = MessageGate::allow;
                                $this->register_traffic_DB($list_traffic);
                                return MessageGate::allow;
                                break;
                            }

                        }
                    }
                    $list_traffic["gate_message_id"] = MessageGate::allow;
                    $this->register_traffic_DB($list_traffic);
                    return MessageGate::allow;
                }
                break;

            case '3':
                //'save auto traffic
                // Save traffic
                return MessageGate::allow;
                break;
        }
    }

    /**
     * Register Traffic in DB
     *
     * @param      <type>  $list   The list
     */
    public function register_traffic_DB($list)
    {
        $userId = $list["user_id"];
        $gatedeviceId = $list["gate_id"];
        $gatepassId = $list["gate_pass_id"];
        $gatedirectId = $list["gate_direct_id"];
        $gatemessageId = $list["gate_message_id"];
        $gateoperatorId = $list["gate_operator_id"];

        /* TODO: USE PARAMETRIC FORM  */
        $raw_base_gate = \DB::select ("CALL sp_register_traffic('$userId',
                                                                '$gatedeviceId',
                                                                '$gatepassId',
                                                                '$gatedirectId',
                                                                '$gatemessageId',
                                                                '$gateoperatorId');");
    }

    /**
     * Update traffic in DB
     *
     * @param      <type>  $cdn             The cdn
     * @param      <type>  $gatemessage_id  The gatemessage identifier
     * @param      <type>  $direct          The direct
     */
    public function update_traffic_DB($cdn, $gatemessage_id, $direct)
    {
        $raw_base_gate = \DB::select ("CALL sp_update_traffic('$cdn', '$gatemessage_id', '$direct');");
    }

    public function prepare_db_unknown_card($ip, $direct)
    {
            // Save unknown card
            $gatedevice_id = $this->load_gate_device_by_ip($ip);
            $array_data = array();
            $array_data["user_id"] = 1 ;
            $array_data["gate_id"] = $gatedevice_id;
            $array_data["gate_pass_id"] = 1 ;
            $array_data["gate_direct_id"] = $direct;
            $array_data["gate_operator_id"] = 1;
            $array_data["gate_message_id"] = MessageGate::unknown_card;
            $this->register_traffic_DB($array_data);

    }

    /**
     * Loads a gate device by ip.
     *
     * @param      <type>   $ip     { parameter_description }
     *
     * @return     integer  ( description_of_the_return_value )
     */
    public function load_gate_device_by_ip($ip)
    {

        $gate_device = \App\Gatedevice::where('ip', $ip)
                                        ->select('id')
                                        ->first();

        if (!isset($gate_device))
            return 0;
       return $gate_device->id;
    }

    public function check_gate_option()
    {
        $current_date = \Carbon\Carbon::now();

        $result_gate_option = \App\Gateoption::where('startDate','<=', $current_date )
                                              ->where('endDate', '>=', $current_date)
                                              ->count();
        return $result_gate_option;
    }

    public function check_list_card_push($card, $userId, $ip)
    {
        $bottom = 0;
        $elem = $card;
        while($bottom <= $top)
        {
            if($this->list_card[$bottom]["cdn"] == $elem){
                // dd($this->list_card);
                return false;
            }

            $bottom++;
        }
        array_push($this->list_card, ["cdn"=>$card, "ip"=> $ip, "userId"=>$userId]);
        return true;
    }

    public function check_list_card_unset($card, $gatemessageId)
    {
        $top = sizeof($this->list_card) - 1;
        $bottom = 0;
        $elem = $card;
        while($bottom <= $top)
        {
            if($this->list_card[$bottom]["cdn"] == $elem)
            {
                // $this->update_traffic_db($this->list_card[$bottom]["user_id"], $gatemessageId)
                unset($this->list_card[$bottom]);
            }

            $bottom++;
        }
    }

    public function check_amoeba_allow($card, $ip)
    {
        $current_date = \Carbon\Carbon::now();
         $fun = [
            'cards' => function($q) {
                $q->select([
                    'cards.id',
                    'cards.cdn',
                    'cards.startDate',
                    'cards.endDate',
                ]);
            },

            'cards.users' => function($q) {
                $q->select([
                    'users.id',
                    'users.code',
                    'users.people_id',
                    'users.state',
                ]);
            },

            'cards.users.people' => function($q) {
                $q->select([
                    'people.id',
                    'people.name',
                    'people.lastname',
                    'people.gender_id'
                ]);
            },
        ];
        $result = \App\Gatedevice::where('ip', $ip , function($query) use($card_cdn){
                                    $query->whereHas('cards', function($query) use($card_cdn){
                                        $query->where('cards.cdn', $card_cdn);
                                        $query->whereHas('users',function($query){
                                            $query->whereHas('people');
                                        });
                                    });
                                })
                                ->with($fun)
                                ->select('id', 'name', 'ip')
                                ->first();


        if (! isset($result[0]->cards))
            return 10;
        $card_data = $result[0]->cards;
        $user_data = $result[0]->cards[0]->users;
        $people_data = $result[0]->cards[0]->users[0]->people;

        // شماره کارت برمی گردد

        if(!($card_data->startDate <= $current_date and $card_data->endDate >= $current_date))
            return 11; // expired card;

                    // if($card->user[0])
        if(0 ==  $user_data->state)
            return 12; // disable user

        // $res_gender_people = $people_data->gender_id;
        $gate_option_data = \App\Gateoption::select(['genzonew_id', 'genzonem_id'])
                                ->get();

        switch ($people_data->gender_id)
        {
            case '1':
                $res_gender = $gate_option_data->genzonem_id;
                break;
            case '2':
                $res_gender = $gate_option_data->genzonew_id;
                break;
        }
        switch ($res_gender) {
            // Dont Sensitive
            case '1':
                return '53011';
                // save traffic
                break;

            // default:
            //     # code...
            //     break;
        }


    }

    public function check_expired_card()
    {
        $cdn ='2047437529';
        $raw_traffic_last_user= \DB::raw ("CALL sp_load_user('$cdn');");
        $opResult_traffic_last_user = \DB::select ($raw_traffic_last_user);
        dd($opResult_traffic_last_user[0]);
    }
     /**
    * Get Response Web Service [63011] | [64011]
    */
    public function sendResponseWebService($response, $ip, $direct)
    {

        $command = "5000";
        switch ($response)
        {
            case MessageGate::allow:
                if(1 == $direct )
                    $command = "53011";
                else
                    $command = "54011";
                break;
            case MessageGate::unknown_card:
            case MessageGate::duplicat_pass:
                if(1 == $direct )
                    $command = "53010";
                else
                    $command = "54010";
                break;
        }

        $fields= [
            // 'response' => $response,
            'ip' => $ip,
            'command' => $command
        ];
        return response()->json ($fields,
                                 $this->successStatus);
    }

      /**
     * Send Response  webservice [53011] | [54011]
     *
     * @param      <type>  $code   The code
     * @param      <type>  $ip     { parameter_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function webService($code, $ip)
    {
        $fields= [
            'ip' => $ip,
            'code' => $code
        ];

        $data = [
            'ip' => $ip,
            'data' => '53011'
        ];

        return response()->json ($data,
                                     $this->successStatus);
    }

     /**
     * Gets the data user by cdn.
     *
     * @param      <type>  $cdn    The cdn
     *
     * @return     <type>  The data user by cdn.
     */
    public function getDataUserByCDN($cdn)
    {
        $card = $cdn;

        $fun = [
            'users' => function($query) {
                    $query->select([
                        'id',
                        'code',
                        'people_id',
                        'state',
                    ]);
                },
              'users.people' => function($query) {
                    $query->select([
                        'id',
                        'name',
                        'lastname'
                    ]);
                },
        ];

        $res = Card::where('cdn', $card)
                        ->whereHas('users.people')
                        ->with($fun)
                        ->select('id', 'cdn', 'state')
                        ->first();

        $fields = [
            'code' => $res->users[0]->code,
            // 'enabled_user' => $res->users[0]->state,
            'name' => $res->users[0]->people->name,
            'lastname' => $res->users[0]->people->lastname,
            'card' => $res->cdn,
            // 'enabled_card' => $res->state
        ];

        return response()->json($fields,
                                $this->successStatus);
    }

    /**
     * Gets the picture user by cdn.
     */
    public function getPictureUserByCDN($cdn)
    {
        $card = $cdn;
        $fun = [
            'users' => function($q) {
                    $q->select([
                        'id',
                        'code',
                        'people_id'
                    ]);
                },
            'users.people' => function($q) {
                    $q->select([
                        'id',
                        'name',
                        'lastname',
                        'picture'
                    ]);
                },
        ];

        $res = \App\Card::where('cdn', $card)
                        ->whereHas('users.people')
                        ->with($fun)
                        ->first();


        $value = $res->users[0]->people->picture;
        $value = str_replace('.jpeg', '-t.jpeg', $value);

        $localFileName = \Storage::path($value);

        return Image::make($localFileName)->response();

        // $response = Response::make($th_name, 200);
        // $response->header('Content-Type', 'image/jpeg');
        // return $response;

        // $localFileName = \Storage::path($th_name);
        // $fileData = file_get_contents($localFileName);
        // $ImgfileEncode = base64_encode($fileData);


        // $fields = [
        //     'cdn' => $cdn,
        //     'picture' => $ImgfileEncode
        // ];

        // return response()->json ($fields,
        //  $this->successStatus);
    }
}
