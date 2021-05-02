<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = session('id');

        $user_info = User::find($id);

        return response()->json($user_info, 200);
    }

    public function getAllUsers(){
        $id = session('id');

        $user_info = User::find($id);
        $user_country = $user_info->country;
        
        $users = User::where('status', 1)
                ->where('id', '<>', $id)
                ->orderByRaw('country', '=', $user_country)
                ->orderBy('country', 'desc')
                ->get();

        return response()->json($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_code' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'country' => 'required',
            'state' => 'required',
            // 'country_flag' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->user_code = $request->user_code;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->country_flag = $request->country_flag;
        $user->status = 1;
        $user->save();

        session(['id'=>$user->id]);

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user){
            return response()->json($user, 200);
        }else{
            return response()->json('Failed', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    public function logout(){
        $id = session('id');

        Conversation::where('from_id', $id)->orWhere('to_id', $id)->delete();
        User::destroy($id);
        
        session()->flush();

        return response()->json('success', 200);
    }
}
