<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSessionRequest;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::all();
        return response()->json([
            "success" => true,
            "data" => [
                'sessions' => $sessions
            ]
        ]);
    }

    public function store(CreateSessionRequest $request)
    {
        $session = Session::create($request->all());
        return response()->json([
            'success' => true,
            'data'=> [
                'session'=> $session
            ]
        ]);
    }
    
    public function show(string $id)
    {
        //
    }   
    
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
