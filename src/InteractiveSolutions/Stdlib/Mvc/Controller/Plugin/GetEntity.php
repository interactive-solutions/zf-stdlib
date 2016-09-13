<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Mvc\Controller\Plugin;

use Doctrine\ORM\EntityManager;
use DomainException;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use ZfcRbac\Service\AuthorizationService;
use ZfrRest\Http\Exception\Client\ForbiddenException;
use ZfrRest\Http\Exception\Client\NotFoundException;
use ZfrRest\Http\Exception\Client\UnauthorizedException;

/**
 * Controller plugin extracts an entity by its primary key, throws a 404 if entity was not found
 */
final class GetEntity extends AbstractPlugin
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var AuthorizationService
     */
    private $authorizationService;

    /**
     * GetEntity constructor.
     * @param EntityManager $entityManager
     * @param AuthorizationService $authorizationService
     */
    public function __construct(EntityManager $entityManager, AuthorizationService $authorizationService)
    {
        $this->entityManager        = $entityManager;
        $this->authorizationService = $authorizationService;
    }

    /**
     * @param string $className
     * @param $id
     * @param string|null $permission
     * @param string $notFoundMessage
     *
     * @return object
     *
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \DomainException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \ZfrRest\Http\Exception\Client\NotFoundException
     * @throws \ZfrRest\Http\Exception\Client\UnauthorizedException
     * @throws \ZfrRest\Http\Exception\Client\ForbiddenException
     */
    public function __invoke(
        string $className,
        $id,
        string $permission = null,
        string $notFoundMessage = 'The resource you were looking for was not found'
    ) {
        $entity = $this->entityManager->find($className, $id);

        if (!$entity) {
            throw new NotFoundException($notFoundMessage);
        }

        if ($permission && !$this->authorizationService->isGranted($permission, $entity)) {
            if ($this->authorizationService->getIdentity()) {
                throw new ForbiddenException();
            }

            throw new UnauthorizedException();
        }

        return $entity;
    }
}

