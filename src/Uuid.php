<?php

namespace Bmatovu\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    /**
     * Generate UUID by version.
     *
     * @param int version UUID Version
     *
     * @throws \Ramsey\Uuid\Exception\UnsatisfiedDependencyException
     *
     * @return string UUID
     */
    public static function generate(int $version = 4):string
    {
        switch ($version) {
            case 1:
                $uuid = RamseyUuid::uuid1();
            break;
            case 3:
                $uuid = RamseyUuid::uuid3(RamseyUuid::NAMESPACE_DNS, php_uname('n'));
            break;
            case 5:
                $uuid = RamseyUuid::uuid5(RamseyUuid::NAMESPACE_DNS, php_uname('n'));
            break;
            default:
                $uuid = RamseyUuid::uuid4();
            break;
        }

        return $uuid->toString();
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
