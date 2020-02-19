<?php

namespace App\Http\Controllers;

use App\Entities\SpotsType;

class SpotTypeController extends Controller
{

    public function index()
    {
        return SpotsType::get();
    }

}
