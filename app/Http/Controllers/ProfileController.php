<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'address' => 'nullable|string',
            'phone_number' => 'nullable|numeric|min:10',
            'avatar' => 'nullable|image'
        ]);
        $user->edit($request->all());
        $user->uploadAvatar($request->file('avatar'));
        $user->generatePassword($request->get('password'));

        return redirect()->route('tasks.index');
    }
}

