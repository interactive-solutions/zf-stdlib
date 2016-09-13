<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

use Doctrine\ORM\EntityManager;
use InteractiveSolutions\Stdlib\Factory\Mvc\Controller\Plugin\GetEntityFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\AllEntitiesExistsValidatorFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\ArrayElementValidatorFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\InputFilterCollectionValidatorFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\NoObjectExistsFactory;
use InteractiveSolutions\Stdlib\Factory\Validator\ObjectExistsFactory;
use InteractiveSolutions\Stdlib\Mvc\Controller\Plugin\GetEntity;
use InteractiveSolutions\Stdlib\Mvc\Controller\Plugin\InjectSortingIntoCriteria;
use InteractiveSolutions\Stdlib\Validator\AllEntitiesExistsValidator;
use InteractiveSolutions\Stdlib\Validator\ArrayElementValidator;
use InteractiveSolutions\Stdlib\Validator\InputFilterCollectionValidator;
use InteractiveSolutions\Stdlib\Validator\NoObjectExists;
use InteractiveSolutions\Stdlib\Validator\ObjectExists;

return [
    'service_manager' => [
       'aliases' => [
            'InteractiveSolutions\Stdlib\ObjectManager' => EntityManager::class
        ]
    ],

    'controller_plugins' => [
        'factories' => [
            GetEntity::class => GetEntityFactory::class,
        ],

        'invokables' => [
            InjectSortingIntoCriteria::class => InjectSortingIntoCriteria::class
        ],

        'aliases' => [
            'injectSortingIntoCriteria' => InjectSortingIntoCriteria::class,
            'getEntity'                 => GetEntity::class,
        ]
    ],

    'validators' => [
        'factories' => [
            AllEntitiesExistsValidator::class     => AllEntitiesExistsValidatorFactory::class,
            NoObjectExists::class                 => NoObjectExistsFactory::class,
            ObjectExists::class                   => ObjectExistsFactory::class,
            ArrayElementValidator::class          => ArrayElementValidatorFactory::class,
            InputFilterCollectionValidator::class => InputFilterCollectionValidatorFactory::class
        ]
    ]
];
