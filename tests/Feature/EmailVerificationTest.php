<?php

namespace Tests\Feature;

use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    public function test_verify_email_returns_404()
    {
        $response = $this->get('/verify-email');
        $response->assertStatus(404);
    }
}
