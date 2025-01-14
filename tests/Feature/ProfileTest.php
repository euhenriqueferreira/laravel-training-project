<?php

use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Laravel\put;
use function Pest\Laravel\withoutExceptionHandling;

beforeEach(function(){
    $user = login();
});

test('the profile page should have the user information', function(){
    get(route('profile'))
        ->assertViewHas('user');
});

test('the profile photo is required to update the profile photo', function(){
    put(route('profile.update.profile_photo'), ['profile_photo' => ''])
    ->assertSessionHasErrors('profile_photo', __('validation.required', ['attribute' => 'profile_photo']));
});

test('the cover photo is required to update the cover photo', function(){
    put(route('profile.update.cover_photo'), ['cover_photo' => ''])
        ->assertSessionHasErrors('cover_photo', __('validation.required', ['attribute' => 'cover_photo']));
});

test('the name should be required', function() {
    put(route('profile.update.infos'), ['name' => '', 'email' => 'joe@doe.com', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
        ->assertSessionHasErrors('name', __('validation.required', ['attribute' => 'name']));
});

test('the name should be a string', function() {
    put(route('profile.update.infos'), ['name' => 131321, 'email' => 'joe@doe.com', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
        ->assertSessionHasErrors('name', __('validation.string', ['attribute' => 'name']));
});

test('the name should have a minimum of 4 characters', function() {
    put(route('profile.update.infos'), ['name' => 'Joe', 'email' => 'joe@doe.com', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
        ->assertSessionHasErrors('name', __('validation.min', ['attribute' => 'name', 'min' => 4]));
});

test('the name should have a maximum of 255 characters', function() {
    put(route('profile.update.infos'), ['name' => str_repeat('a', 256), 'email' => 'joe@doe.com', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
    ->assertSessionHasErrors('name', __('validation.max', ['attribute' => 'name', 'max' => 255]));
});

test('the email should be required', function() {
    put(route('profile.update.infos'), ['name' => 'Joe Doe', 'email' => '', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
        ->assertSessionHasErrors('email', __('validation.required', ['attribute' => 'email']));
});

test('the email should be an email', function() {
    put(route('profile.update.infos'), ['name' => 'joedoetheman', 'email' => 'joe@doe.com', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
        ->assertSessionHasErrors('email', __('validation.email', ['attribute' => 'email']));
});

test('the email should have a minimum of 12 characters', function() {
    put(route('profile.update.infos'), ['name' => 'aa@me.com', 'email' => 'joe@doe.com', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
        ->assertSessionHasErrors('email', __('validation.min', ['attribute' => 'email', 'min' => 12]));
});

test('the email should have a maximum of 255 characters', function() {
    put(route('profile.update.infos'), ['name' => str_repeat('a', 256). '@email.com', 'email' => 'joe@doe.com', 'bio' => 'djaks', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
    ->assertSessionHasErrors('email', __('validation.max', ['attribute' => 'email', 'max' => 255]));
});

test('if the user updates the profile info, it should redirect back to profile page', function(){
    put(route('profile.update.infos'), ['name' => 'Joe Doe', 'email' => 'joedoe@email.com', 'bio' => 'Minha bio', 'password' => 'password*', 'new_password' => '', 'new_password_confirmation' => ''])
        ->assertRedirect();
});

test('if the user deletes the account, the user should be removed from database', function(){
    $user = auth()->user();
    get(route('profile.delete'), ['password_' => 'password*'])
    ->assertRedirect();

    assertDatabaseMissing('users', ['id' => $user->id]);
});
