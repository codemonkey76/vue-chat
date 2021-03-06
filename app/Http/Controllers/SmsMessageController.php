<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\SmsMessage;
use Illuminate\Http\Request;

class SmsMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Conversation $conversation)
    {
        return $conversation->messages;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SmsMessage  $smsMessage
     * @return \Illuminate\Http\Response
     */
    public function show(SmsMessage $smsMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SmsMessage  $smsMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsMessage $smsMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SmsMessage  $smsMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsMessage $smsMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SmsMessage  $smsMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsMessage $smsMessage)
    {
        //
    }
}
