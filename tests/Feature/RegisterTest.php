<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutExceptionHandling;

test('the user could not to be authenticated', function() {
    withoutExceptionHandling();
    login();

    get(route('register'))
        ->assertRedirect();
});

test('when the user access the register page, the view must be the register view', function() {
    get(route('register'))
        ->assertViewIs('auth.register'); 
});

test('the name should be required', function() {
    post(route('register'), ['name' => '', 'email' => 'joe@doe.com', 'password' => 'password', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('name', __('validation.required', ['attribute' => 'name']));
});

test('the name should be a string', function() {
    post(route('register'), ['name' => 123123, 'email' => 'joe@doe.com', 'password' => 'password', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('name', __('validation.string', ['attribute' => 'name']));
});

test('the name should have a minimum of 4 characters', function() {
    post(route('register'), ['name' => 'Joe', 'email' => 'joe@doe.com', 'password' => 'password', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('name', __('validation.min', ['attribute' => 'name', 'min' => 4]));
});

test('the name should have a maximum of 255 characters', function() {
    post(route('register'), ['name' => str_repeat('a', 256), 'email' => 'joe@doe.com', 'password' => 'password', 'password_confirmation' => 'password'])
    ->assertSessionHasErrors('name', __('validation.max', ['attribute' => 'name', 'max' => 255]));
});

test('the email should be required', function() {
    post(route('register'), ['name' => 'Joe Doe', 'email' => '', 'password' => 'password', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('email', __('validation.required', ['attribute' => 'email']));
});

test('the email should be an email', function() {
    post(route('register'), ['name' => 'Joe Doe', 'email' => 'joedoeman', 'password' => 'password', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('email', __('validation.email', ['attribute' => 'email']));
});

test('the email should have a minimum of 12 characters', function() {
    post(route('register'), ['name' => 'Joe Doe', 'email' => 'aa@me.com', 'password' => 'password', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('email', __('validation.min', ['attribute' => 'email', 'min' => 12]));
});

test('the email should have a maximum of 255 characters', function() {
    post(route('register'), ['name' => 'Joe Doe', 'email' => str_repeat('a', 256), 'password' => 'password', 'password_confirmation' => 'password'])
    ->assertSessionHasErrors('email', __('validation.max', ['attribute' => 'email', 'max' => 255]));
});

test('the password should be required', function() {
    post(route('register'), ['name' => 'Joe Doe', 'email' => 'joe@doe.com', 'password' => '', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('password', __('validation.required', ['attribute' => 'password']));
});

test('the password should have a minimum of 8 characters', function() {
    post(route('register'), ['name' => 'Joe Doe', 'email' => 'joe@doe.com', 'password' => 'pas', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('password', __('validation.min', ['attribute' => 'password', 'min' => 12]));
});

test('the password should have a minimum of 255 characters', function() {
    post(route('register'), ['name' => 'Joe Doe', 'email' => 'joe@doe.com', 'password' => str_repeat('a', 256), 'password_confirmation' => 'password'])
    ->assertSessionHasErrors('password', __('validation.max', ['attribute' => 'password', 'max' => 255]));
});

test('the password should have at least one special character', function(){
    post(route('register'), ['name' => 'Joe Doe', 'email' => 'joe@doe.com', 'password' => 'password', 'password_confirmation' => 'password'])
        ->assertSessionHasErrors('password');
});



