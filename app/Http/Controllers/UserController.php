<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserActivatedEvent;
use App\Events\UserRegisteredEvent;
use App\Events\UserDeactivatedEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Mail\RegistrationConfirmationEmail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type_id', 2)->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { /*
        $users = User::get();

           return view('users.create');  */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'type_id' => 'required'
        ]); */


        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            //  Mail::to($request->email)->send(new RegistrationConfirmationEmail());
            event(new UserRegisteredEvent($user));
            return response()->json($user);
        }
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
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function dashboarduser()
    {
        $users = User::get();

        return view('users.dashboarduser', compact('users'));
    }

    public function activate(User $user)
    {
        $user->is_active = true;
        $user->save();

        event(new UserActivatedEvent($user->email));
        return redirect()->route('dashboard');
    }

    public function deactivate(User $user)
    {
        $user->is_active = false;
        $user->save();

        event(new UserDeactivatedEvent($user->email));
        return redirect()->route('dashboard');
    }
}