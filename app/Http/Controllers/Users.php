<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Users extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function update()
    {
        return "actualizado!";
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user)
        {
            session()->flash('error', 'User not found');

            return Redirect::to('users');
        }

        $user->delete();
        session()->flash('success', 'Successfully deleted the user' . $user->name);
        return Redirect::to('users');
    }
}
