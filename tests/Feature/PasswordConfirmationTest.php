<?php

namespace Tests\Feature;

use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    public function test_confirm_password_returns_404()
    {
        $response = $this->get('/confirm-password');
        $response->assertStatus(404);
    }
}
