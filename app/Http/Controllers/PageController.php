<?php

namespace App\Http\Controllers;

use App\Entities\Page;
use App\Http\Requests\Api\Page\StoreRequest;


class PageController extends Controller
{
    public function show($id)
    {
        return Page::where('pages.company_id','=',$id)->get();
    }

    public function store(StoreRequest $request){
        return Page::create($request->all());
    }
}
