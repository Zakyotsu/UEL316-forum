<?php

namespace App\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class Enum extends StringType
{
    const utilisateur = 'utilisateur';
    const admin = 'admin';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, [self::utilisateur, self::admin])) {
            throw new \InvalidArgumentException("Invalid user value");
        }

        return $value;
    }

    public function getName()
    {
        return 'enum';
    }
}