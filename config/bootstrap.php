<?php

use Symfony\Component\Dotenv\Dotenv;

/**
\App\Doctrine\ContainerIdType::setClass(\App\Entity\ContainerId::class);
\App\Doctrine\ContainerIdType::setDataType(\Doctrine\DBAL\Types\Type::INTEGER);
\Doctrine\DBAL\Types\Type::addType(\App\Doctrine\ContainerIdType::NAME, \App\Doctrine\ContainerIdType::class);

/**
MyDomainIdType::setClass(MyDomainId::class);
MyDomainIdType::setDataType(Type::GUID);

Type::addType(MyDomainIdType::NAME, MyDomainIdType::class);*/

require dirname(__DIR__).'/vendor/autoload.php';

if (!array_key_exists('APP_ENV', $_SERVER)) {
    $_SERVER['APP_ENV'] = $_ENV['APP_ENV'] ?? null;
}

if ('prod' !== $_SERVER['APP_ENV']) {
    if (!class_exists(Dotenv::class)) {
        throw new RuntimeException('The "APP_ENV" environment variable is not set to "prod". Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
    }

    (new Dotenv())->loadEnv(dirname(__DIR__).'/.env');
}

$_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = $_SERVER['APP_ENV'] ?: $_ENV['APP_ENV'] ?: 'dev';
$_SERVER['APP_DEBUG'] = $_SERVER['APP_DEBUG'] ?? $_ENV['APP_DEBUG'] ?? 'prod' !== $_SERVER['APP_ENV'];
$_SERVER['APP_DEBUG'] = $_ENV['APP_DEBUG'] = (int) $_SERVER['APP_DEBUG'] || filter_var($_SERVER['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
