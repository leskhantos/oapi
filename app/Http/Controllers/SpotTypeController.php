<?php

namespace App\Http\Controllers;

use App\Entities\SpotsType;
use Illuminate\Http\Request;

class SpotTypeController extends Controller
{

    public function index()
    {
        return SpotsType::get();
    }

}
