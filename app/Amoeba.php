<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amoeba extends Model
{
    public function gatedevices()
    {
        return $this->belongsToMany(\App\Gatedevice::class);
    }

    /**
     * Give Gate device
     */
    public function giveGatedeviceTo($gatedevice)
    {
        $this->gatedevices()->sync($gatedevice);
    }
}
