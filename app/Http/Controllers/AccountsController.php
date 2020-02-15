<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    public function index()
    {
        $accounts = User::all();
        return view('admin.account.index', compact("accounts"));
    }

    public function create()
    {

        return view('admin.account.create', );
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create_account($request->all());

        return redirect('/admin/accounts');
    }

    public function destroy(Request $request,$id)
    {
        $account = user::find($id)->first();
        $account->delete();
        return redirect()->back();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create_account(array $data)
    {
        //管理者註冊不寄信


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
