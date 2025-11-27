<?php

test()->skip('Not applicable to this project.');

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
