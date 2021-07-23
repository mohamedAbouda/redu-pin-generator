<?php

namespace App\Libraries;

use App\Repositories\PinRepository;
use Illuminate\Support\Facades\Auth;

class PinLibrary
{
    private $pinRepository;
    private $pinLength = 4;
    private $retriesCount = 1;

    public function __construct()
    {
        $this->pinRepository = new PinRepository();
    }

    public function generate()
    {
        $pin = $this->generatePIN($this->pinLength); // generate pin
        while($this->pinRepository->checkPinExistance($pin)){
            // check if pin is already exists in the DB or not
            // we should add break point so the system don't go in infity loop or request take more time.
            // i haved retry count < 30 generate again but after 30 try the system will use the generated pin however it's duplicated
            if ($this->retriesCount < config('app.pin_generator_retries_count')){
                $this->generate();
                $this->retriesCount++;
            }else{
                // here i break the while loop and use the duplicated pin but there are many ways here we can use for Ex:
                // $this->pinLength++;
                // $this->generate();
                // $this->retriesCount = 1;
                // the pervious 3 lines will generate 5 digits pin and system will add more 1 digit after all the possibilities
                break;
            }
        }
        $this->pinRepository->createPin([
            'user_id' => Auth::id(),
            'pin_code' => $pin
        ]);
        return $pin;
    }

    private function generatePIN($digits = 4){
        $i = 0; //counter
        $pin = ""; //our default pin is blank
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        if(count(array_unique(str_split($pin))) > 1) // check if pin contains 2 different numbers at least
            return $pin;

        return $this->generatePIN();
    }
}
