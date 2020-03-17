<?php

namespace App\Http\Controllers;

use App\Entities\Style;
use App\Http\Requests\Api\Page\StoreRequest;


class StyleController extends Controller
{
    public function show($id)
    {
        return Style::where('styles.company_id', '=', $id)->get();
    }

    public function store(StoreRequest $request)
    {
        return Style::create($request->validated());
    }
}
