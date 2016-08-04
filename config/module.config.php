<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 2014-09-10
 * Time: 17:28
 */

use Doctrine\ORM\EntityManager;
use InteractiveSolutions\Stdlib\Factory\Validator\AllEntitiesExistsValidatorFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\ArrayElementValidatorFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\NoObjectExistsFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\ObjectExistsFactory;
use InteractiveSolutions\Stdlib\Mvc\Controller\Plugin\InjectSortingIntoCriteria;
use InteractiveSolutions\Stdlib\Validator\AllEntitiesExistsValidator;
use InteractiveSolutions\Stdlib\Validator\ArrayElementValidator;
use InteractiveSolutions\Stdlib\Validator\NoObjectExists;
use InteractiveSolutions\Stdlib\Validator\ObjectExists;

return [
    'service_manager' => [
       'aliases' => [
            'InteractiveSolutions\Stdlib\ObjectManager' => EntityManager::class
        ]
    ],

    'controller_plugins' => [
        'invokables' => [
            InjectSortingIntoCriteria::class => InjectSortingIntoCriteria::class
        ],

        'aliases' => [
            'injectSortingIntoCriteria' => InjectSortingIntoCriteria::class
        ]
    ],

    'validators' => [
        'factories' => [
            AllEntitiesExistsValidator::class => AllEntitiesExistsValidatorFactory::class,
            NoObjectExists::class             => NoObjectExistsFactory::class,
            ObjectExists::class               => ObjectExistsFactory::class,
            ArrayElementValidator::class      => ArrayElementValidatorFactory::class,
        ]
    ]
];
