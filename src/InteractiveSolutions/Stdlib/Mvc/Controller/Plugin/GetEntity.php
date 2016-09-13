<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Stdlib\Mvc\Controller\Plugin;

use Doctrine\ORM\EntityManager;
use DomainException;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
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
     * GetEntity constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $className
     * @param $id
     * @param string|null $permission
     * @param string $notFoundMessage
     *
     * @return object
     *
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
        /* @var AbstractController $controller */
        $controller = $this->getController();

        if (!$controller instanceof AbstractController) {
            throw new DomainException('Are you stupid ?');
        }

        $entity = $this->entityManager->find($className, $id);

        if (!$entity) {
            throw new NotFoundException($notFoundMessage);
        }
        
        if ($permission && !$controller->isGranted($permission, $entity)) {
            if ($controller->identity()) {
                throw new ForbiddenException();
            }

            throw new UnauthorizedException();
        }

        return $entity;
    }
}

