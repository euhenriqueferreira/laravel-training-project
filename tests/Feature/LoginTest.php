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

    get(route('login'))
        ->assertRedirect();
});

test('the email should be required', function() {
    post(route('login'), ['email' => '', 'password' => 'password'])
        ->assertSessionHasErrors('email', __('validation.required', ['attribute' => 'email']));
});

test('the email should be an email', function() {
    post(route('login'), ['email' => 'joedoetheman', 'password' => 'password'])
        ->assertSessionHasErrors('email', __('validation.email', ['attribute' => 'email']));
});

test('the email should have a minimum of 12 characters', function() {
    post(route('login'), ['email' => 'aa@me.com', 'password' => 'password'])
        ->assertSessionHasErrors('email', __('validation.min', ['attribute' => 'email', 'min' => 12]));
});

test('the email should have a maximum of 255 characters', function() {
    post(route('login'), ['email' => str_repeat('a', 256).'@gmail.com', 'password' => 'password'])
    ->assertSessionHasErrors('email', __('validation.max', ['attribute' => 'email', 'max' => 255]));
});

test('the password should be required', function() {
    post(route('login'), ['email' => 'joe@doe.com', 'password' => ''])
        ->assertSessionHasErrors('password', __('validation.required', ['attribute' => 'password']));
});

test('the password should have a minimum of 8 characters', function() {
    post(route('login'), ['password' => 'joe@doe.com', 'password' => 'haha'])
        ->assertSessionHasErrors('password', __('validation.min', ['attribute' => 'password', 'min' => 12]));
});

test('the password should have a minimum of 255 characters', function() {
    post(route('login'), ['email' => 'joe@doe.com', 'password' => str_repeat('a', 256)])
    ->assertSessionHasErrors('password', __('validation.max', ['attribute' => 'password', 'max' => 255]));
});

test('the password should have at least one special character', function(){
    post(route('login'), ['email' => 'joe@doe.com', 'password' => 'wowmanthatsnice'])
        ->assertSessionHasErrors('password');
});


test('the email and password should be validated on the database', function() {
    $user = User::factory()->create();

    post(route('login'), ['email' => $user->email, 'password' => $user->password])
        ->assertRedirect('/');
});


