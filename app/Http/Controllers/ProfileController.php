<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateCoverPhotoRequest;
use App\Http\Requests\ProfileUpdateInfosRequest;
use App\Http\Requests\UpdateProfilePhotoRequest;

class ProfileController
{
    public function index(){
        return view('profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateInfos(ProfileUpdateInfosRequest $request){
        $data = $request->validated();
        $user = auth()->user();
 
        if(!Hash::check($data['password'], $user->password)){
            return back()->with('errorMessage', 'Password Incorrect');
        }

        if($data['new_password']){
            $user->forceFill([
                'password' => Hash::make($data['new_password']),
            ]);
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'bio' => $data['bio'],
        ]);

        $user->save();
    
        return back()->with('successMessage', 'Profile successfully updated!');
    }

    public function updateCoverPhoto(UpdateCoverPhotoRequest $request){
        $file = $request['cover_photo'];
        $data['photo'] = $file->store('cover_photos', 'public');

        $user = auth()->user();

        $user->update([
            'cover_photo' => $data['photo'],
        ]);

        return back()->with('successMessage', 'Cover photo successfully updated!');
    }

    public function updateProfilePhoto(UpdateProfilePhotoRequest $request){
        $file = $request['profile_photo'];
        $data['photo'] = $file->store('profile_photos', 'public');

        $user = auth()->user();

        $user->update([
            'profile_photo' => $data['photo'],
        ]);

        return back()->with('successMessage', 'Profile photo successfully updated!');
    }
}
