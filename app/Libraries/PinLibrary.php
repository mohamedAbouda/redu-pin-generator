<?php

namespace App\Libraries;

class PinLibrary
{
    public function generate()
    {
        $pin = $this->generatePIN();
    }

    private function generatePIN($digits = 4){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        if(count(array_unique(str_split($pin))) > 1)
            return $pin;

        return $this->generatePIN();
    }
}
