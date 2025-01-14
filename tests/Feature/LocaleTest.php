<?php

use function Pest\Laravel\put;

beforeEach(function(){
    login();
});

test('if the user chnages the preferred language to english, the app should be translated to english', function(){
    put(route('profile.set-locale'), ['preferred_lang' => 'en'])
    ->assertSessionHas('preferred_lang', 'en');
});

test('if the user chnages the preferred language to spanish, the app should be translated to spanish', function(){
    put(route('profile.set-locale'), ['preferred_lang' => 'es'])
    ->assertSessionHas('preferred_lang', 'es');
});

test('if the user chnages the preferred language to portuguese, the app should be translated to portuguese', function(){
    put(route('profile.set-locale'), ['preferred_lang' => 'pt'])
    ->assertSessionHas('preferred_lang', 'pt');
});