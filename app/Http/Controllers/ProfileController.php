<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateCoverPhotoRequest;
use App\Http\Requests\ProfileUpdateInfosRequest;
use App\Http\Requests\UpdateProfilePhotoRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    public function index(){
        return view('profile', [
            'user' => auth()->user(),
            'languages' => ['en', 'es', 'pt'],
            'preferred_language' => App::getLocale(),
        ]);
    }

    public function updateInfos(ProfileUpdateInfosRequest $request){
        $data = $request->validated();
        $user = auth()->user();
 
        if(!Hash::check($data['password'], $user->password)){
            return back()->with('errorMessage', __('profile.password_incorrect'));
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
    
        return back()->with('successMessage', __('profile.update_profile_success'));
    }

    public function updateCoverPhoto(UpdateCoverPhotoRequest $request){
        $file = $request['cover_photo'];
        $data['photo'] = $file->store('cover_photos', 'public');

        $user = auth()->user();

        $user->update([
            'cover_photo' => $data['photo'],
        ]);

        return back()->with('successMessage', __('profile.update_cover_success'));
    }

    public function updateProfilePhoto(UpdateProfilePhotoRequest $request){
        $file = $request['profile_photo'];
        $data['photo'] = $file->store('profile_photos', 'public');

        $user = auth()->user();

        $user->update([
            'profile_photo' => $data['photo'],
        ]);

        return back()->with('successMessage',  __('profile.update_photo_success'));
    }

    public function deleteAccount(Request $request){
        $user = auth()->user();
        $data = $request->validate([
            'password_' => ['required', 'min:8', 'max:255', 'regex:/[\W_]+/'],
        ]);

        if(!Hash::check($data['password_'], $user->password)){
            return back()->with('errorMessage', __('profile.password_incorrect'));
        }
        
        Auth::logout();
        session()->invalidate();
        $user->delete();

        return to_route('login')->with('successMessage', __('profile.delete_success'));
    }

    public function setLocale(Request $request){
        App::setLocale($request->preferred_lang);
        session(['preferred_lang' => $request->preferred_lang]);
 
        return back()->with('successMessage', __('profile.language_success'));
    }
}
