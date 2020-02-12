<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficReportViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement( 'CREATE OR REPLACE VIEW viwreportlog AS
        //     SELECT               
        //           gatetraffics.us       AS us,
        //           gatetraffics.dat      AS dat,
        //           people.nationalId     AS nationalcode,
        //           people.name           AS name,
        //           people.lastname       AS lastname,
        //           people.picture        AS picture,
        //           cards.cdn             AS serialcard,
        //           gatedirects.name      AS direct,
        //           gatepasses.name       AS pass,
        //           gatedevices.name      AS device,
        //           gatemessages.message  AS message
                  
        //  FROM gatetraffics    

        //   JOIN users        ON (users.code = gatetraffics.us)
        //   JOIN cards        ON (cards.cdn = gatetraffics.cdn)
        //   JOIN people       ON (users.people_id = people.id)
        //   JOIN gatedevices  ON (gatedevices.id = gatetraffics.device_id)
        //   JOIN gatepasses   ON (gatepasses.id = gatetraffics.passtype_id)
        //   JOIN gatedirects  ON (gatedirects.id = gatetraffics.direct_id)
        //   JOIN gatemessages ON (gatemessages.id = gatetraffics.msg_id)
        //  ' );

        // DB::statement( 'CREATE OR REPLACE VIEW viwgateuser AS
        //      SELECT
        //            users.code        as us,       
        //            users.state       as state,
        //            users.group_id    as type,
        //            people.name       as name,
        //            people.lastname   as lastname,
        //            people.gender_id  as gender,
        //            people.picture    as picture,
        //            cards.cdn         as cdn,
        //            cards.startDate   as startDate,
        //            cards.endDate     as endDate
        //   FROM users    

        //    JOIN people ON (people.id = users.people_id)
        //    JOIN cards  ON (cards.user_id = users.id)
        //   ' );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement('DROP VIEW viwreportlog');
        // DB::statement('DROP VIEW viwgateuser');
    }

}
