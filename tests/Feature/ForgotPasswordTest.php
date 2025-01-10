<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(function(){
    Auth::logout();
});

test('if the user click on the button "Forgot your password?" should be redirected to the Forgot Password page', function (){
    get(route('password.request'))
        ->assertViewIs('auth.forgot-password');
});

test('if the user enter an email and click on the button "Send Password Reset Link" the email has to be required', function (){
    post(route('password.email'), ['email' => ''])
    ->assertSessionHasErrors('email', __('validation.required', ['attribute' => 'email']));
}); 

test('if the user enter an email and click on the button "Send Password Reset Link" the email has to be an email', function (){
    post(route('password.email'), ['email' => 'quinhoemail.com'])
    ->assertSessionHasErrors('email', __('validation.email', ['attribute' => 'email']));
}); 

test('if the user enter an email and click on the button "Send Password Reset Link" the email should have a minimum of 12 characters', function (){
    post(route('password.email'), ['email' => 'a@email.com'])
    ->assertSessionHasErrors('email', __('validation.min', ['attribute' => 'email', 'min' => 12]));
});

test('if the user enter an email and click on the button "Send Password Reset Link" the email should have a maximum of 255 characters', function (){
    post(route('password.email'), ['email' => str_repeat('a', 256).'@email.com'])
    ->assertSessionHasErrors('email', __('validation.max', ['attribute' => 'email', 'max' => 255]));
});

test('if the user enter an email and click on the button "Send Password Reset Link" should be redirected to the login page with a message "We have emailed your password reset link!"', function (){
    User::factory()->create(['email' => 'test@example.com']);

    post(route('password.email'), ['email' => 'test@example.com'])
        ->assertRedirect(route('login'))
        ->assertSessionHas('status', __('We have emailed your password reset link.'));
}); 