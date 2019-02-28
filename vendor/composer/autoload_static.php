<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit30d48e93f1e1f947cce2b1cb63c2686b
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Windwalker\\Dom\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Windwalker\\Dom\\' => 
        array (
            0 => __DIR__ . '/..' . '/windwalker/dom',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit30d48e93f1e1f947cce2b1cb63c2686b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit30d48e93f1e1f947cce2b1cb63c2686b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
