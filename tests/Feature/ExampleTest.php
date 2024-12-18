<?php

use Inertia\Testing\AssertableInertia as Assert;

it('returns a successful response', function () {
    $this->get('/')->assertInertia(fn(Assert $assert) => $assert
        ->component('Home'));
});
