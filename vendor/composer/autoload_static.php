<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite99ea551f2420f3e99d7a9480ff3ee3f
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Database\\' => 9,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Database\\' => 
        array (
            0 => __DIR__ . '/../..' . '/ADO',
        ),
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite99ea551f2420f3e99d7a9480ff3ee3f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite99ea551f2420f3e99d7a9480ff3ee3f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite99ea551f2420f3e99d7a9480ff3ee3f::$classMap;

        }, null, ClassLoader::class);
    }
}
