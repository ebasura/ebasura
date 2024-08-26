<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7ee244b17f65a8c078492fcf84bd8b17
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RobThree\\Auth\\' => 14,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'H' => 
        array (
            'Hybridauth\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RobThree\\Auth\\' => 
        array (
            0 => __DIR__ . '/..' . '/robthree/twofactorauth/lib',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Hybridauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/hybridauth/hybridauth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7ee244b17f65a8c078492fcf84bd8b17::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7ee244b17f65a8c078492fcf84bd8b17::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7ee244b17f65a8c078492fcf84bd8b17::$classMap;

        }, null, ClassLoader::class);
    }
}