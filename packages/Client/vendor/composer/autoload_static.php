<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8fe2b3cc5c221384424b33f81b04f86b
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Laravel\\Client\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Laravel\\Client\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8fe2b3cc5c221384424b33f81b04f86b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8fe2b3cc5c221384424b33f81b04f86b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8fe2b3cc5c221384424b33f81b04f86b::$classMap;

        }, null, ClassLoader::class);
    }
}
