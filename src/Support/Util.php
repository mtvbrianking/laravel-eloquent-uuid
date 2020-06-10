<?php

namespace Bmatovu\Uuid\Support;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Util
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
    public static function generateUuid(int $version = 4, $ns = null, string $name = null): UuidInterface
    {
        $ns = $ns ? $ns : Uuid::NAMESPACE_DNS;

        $name = $name ? $name : php_uname('n');

        switch ($version) {
            case 1:
                $uuid = Uuid::uuid1();
            break;
            case 3:
                $uuid = Uuid::uuid3($ns, $name);
            break;
            case 5:
                $uuid = Uuid::uuid5($ns, $name);
            break;
            default:
                $uuid = Uuid::uuid4();
            break;
        }

        return $uuid;
    }

    /**
     * Validate UUID plus version.
     *
     * @param  string   $str
     * @param  int|null $version UUID Version
     *
     * @return bool True for valid.
     */
    public static function validateUuid(string $str, int $version = null)
    {
        if ($version === null) {
            return Uuid::isValid($str);
        }

        try {
            return Uuid::fromString($str)->getVersion() === $version;
        } catch (InvalidUuidStringException $e) {
            return false;
        }
    }
}
