<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'message' => 'required',
            'to_id' => 'required',
        ]);

        $from_id = session('id');

        $conversation = new Conversation();
        $conversation->from_id = $from_id;
        $conversation->to_id = $request->to_id;
        $conversation->message = $request->message;
        $conversation->save();

        return response()->json('success', 200);
    }

    public function getConversations($to_id){

        $from_id = session('id');

        // $conversations = Conversation::whereIn('from_id', [$from_id, $to_id])->whereIn('to_id', [$from_id, $to_id])->get();
        $conversations = DB::table('conversations')
                        ->join('users', 'users.id', '=', 'conversations.from_id')
                        ->select('users.*', 'conversations.*')
                        ->whereIn('conversations.from_id', [$from_id, $to_id])
                        ->whereIn('conversations.to_id', [$from_id, $to_id])
                        ->orderBy('conversations.id', 'asc')
                        ->get();
        
        return response()->json($conversations, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
