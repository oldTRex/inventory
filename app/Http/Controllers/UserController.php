<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Retrieve the users .
     *

     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['data' => User::all()]);

    }


    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $name = $request->input('name');
        $username = $request->input('username');

        $password =  $request->input('password');
        $role = $request->input('role');

        $user = User::firstOrCreate(
            ['username' => $username],
               [
                  'name' => $name,
                  'username' => $username,
                  'password_text' => Hash::make($password),
                  'role' => $role
               ]
        );

        return response()->json(['data' => $user]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function authenticate(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->input('username'))->first();
        if(Hash::check($request->input('password'), $user->password_text)){
            $apikey = base64_encode(str_random(40));
            User::where('username', $request->input('username'))->update(['api_key' => "$apikey"]);;
            return response()->json(['status' => 'success','api_key' => $apikey]);
        }else{
            return response()->json(['status' => 'fail', 'data' => $user->password_text ],401);
        }
    }

}