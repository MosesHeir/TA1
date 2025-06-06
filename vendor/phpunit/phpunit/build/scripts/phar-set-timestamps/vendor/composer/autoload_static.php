<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit386a05f6676643b8b2eb49288e20d079
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Seld\\PharUtils\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Seld\\PharUtils\\' => 
        array (
            0 => __DIR__ . '/..' . '/seld/phar-utils/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Seld\\PharUtils\\Linter' => __DIR__ . '/..' . '/seld/phar-utils/src/Linter.php',
        'Seld\\PharUtils\\Timestamps' => __DIR__ . '/..' . '/seld/phar-utils/src/Timestamps.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit386a05f6676643b8b2eb49288e20d079::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit386a05f6676643b8b2eb49288e20d079::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit386a05f6676643b8b2eb49288e20d079::$classMap;

        }, null, ClassLoader::class);
    }
}
