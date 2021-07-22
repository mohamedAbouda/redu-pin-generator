<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Libraries\PinLibrary;
use Illuminate\Http\Request;

class PinController extends Controller
{
    private $pinLibrary ;

    public function __construct()
    {
        $this->pinLibrary = new PinLibrary();
    }

    public function generate()
    {
        $x = $this->pinLibrary->generate();
        return $x;
    }
}
