<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserRoleNormalizationTest extends TestCase
{
    public function test_role_is_normalized_when_reading_and_writing()
    {
        $user = new User();
        $user->rol = ' Admin ';

        $this->assertSame('admin', $user->rol);
        $this->assertSame('admin', $user->getAttributes()['rol']);
    }
}
