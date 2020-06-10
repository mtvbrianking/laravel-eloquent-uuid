<?php

namespace Bmatovu\Uuid\Tests\Support;

use Bmatovu\Uuid\Support\Util;
use Bmatovu\Uuid\Tests\TestCase;

class UtilTest extends TestCase
{
    public function test_generate_v1_uuids()
    {
        foreach ([1,3,4,5] as $version) {
            $uuid_v{$version} = Util::generateUuid($version);

            $this->assertInstanceOf(\Ramsey\Uuid\Uuid::class, $uuid_v{$version});
            $this->assertEquals($version, $uuid_v{$version}->getVersion());
        }
    }

    public function test_validate_uuids()
    {
        $valid_uuid = Util::generateUuid();
        $invalid_uuid = '3f6f8cb0-c57d-11e1-9b21-0800200c9a6';

        $this->assertTrue(Util::validateUuid($valid_uuid));
        $this->assertTrue(Util::validateUuid($valid_uuid, 4));

        $this->assertFalse(Util::validateUuid($invalid_uuid, 1));
    }
}
