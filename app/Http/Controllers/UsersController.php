<?php

namespace App\Http\Controllers;

use App\Services\Auth;
use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\User\StoreUser;
use App\Http\Requests\Api\User\UpdateUser;
use Symfony\Component\ErrorHandler\Error\FatalError;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return User::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $id = auth()->user()->id;
        $pass=$request->oldPassword;
        $user= User::find($id);

//        dd(Hash::check($pass,$user->password));

        if(Hash::check($pass,$user->password))
        {
            $user->update(['name' => $request->name, 'login' => $request->login, 'password' => $request->password,
                'last_online' => $request->last_online, 'last_ip' => $request->last_ip]);
            return response($user,200);
        }
        else
            return response('Error',402);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
