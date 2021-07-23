<?php

namespace App\Repositories;

use App\Models\Pin;

class PinRepository
{
    public function checkPinExistance(string $pin) :?Pin
    {
        return Pin::where('pin_code', $pin)->first();
    }

    public function createPin(array $data)
    {
        Pin::create($data);
    }
}
