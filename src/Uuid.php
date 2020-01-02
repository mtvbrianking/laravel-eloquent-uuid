<?php

namespace Bmatovu\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

class Uuid
{
    /**
     * Generate UUID by version.
     *
     * @param int                               $version UUID Version
     * @param string|\Ramsey\Uuid\UuidInterface $ns The UUID namespace in which to create the named UUID
     * @param string                            $name The name to create a UUID for
     *
     * @throws \Ramsey\Uuid\Exception\UnsatisfiedDependencyException
     *
     * @return \Ramsey\Uuid\UuidInterface UUID
     */
    public static function generate(int $version = 4, $ns = null, string $name = null): UuidInterface
    {
        $ns = $ns ? $ns : RamseyUuid::NAMESPACE_DNS;

        $name = $name ? $name : php_uname('n');

        switch ($version) {
            case 1:
                $uuid = RamseyUuid::uuid1();
            break;
            case 3:
                $uuid = RamseyUuid::uuid3($ns, $name);
            break;
            case 5:
                $uuid = RamseyUuid::uuid5($ns, $name);
            break;
            default:
                $uuid = RamseyUuid::uuid4();
            break;
        }

        return $uuid;
    }

    /**
     * Validate UUID plus version.
     *
     * @param  string   $uuid
     * @param  int|null $version UUID Version
     *
     * @return bool True for valid.
     */
    public static function validate(string $uuid, int $version = null)
    {
        if ($version === null) {
            return RamseyUuid::isValid($value);
        }

        try {
            $uuid = RamseyUuid::fromString($value);

            return $uuid->getVersion() === $version;
        } catch (InvalidUuidStringException $e) {
            return false;
        }
    }
}
