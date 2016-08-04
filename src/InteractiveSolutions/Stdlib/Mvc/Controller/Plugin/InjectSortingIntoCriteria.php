<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions AB
 */

namespace InteractiveSolutions\Stdlib\Mvc\Controller\Plugin;

use Doctrine\Common\Collections\Criteria;
use DomainException;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use ZfrRest\Mvc\Controller\AbstractRestfulController;

/**
 * Controller plugin that takes the sorting from the query string and injects it into a doctrine criteria object
 */
class InjectSortingIntoCriteria extends AbstractPlugin
{
    public function __invoke(Criteria $criteria)
    {
        if (!$this->getController() instanceof AbstractRestfulController) {
            throw new DomainException('Dude, wtf really ?');
        }

        $sort = $this->getController()->params()->fromQuery('sorting');
        if ($sort) {

            $fields = explode(',', $sort);

            $orderBy = [];
            foreach ($fields as $field) {
                $parts = explode(':', $field);

                // Ignore it
                if (count($parts) != 2) continue;

                $orderBy[$parts[0]] = $parts[1];
            }

            $criteria->orderBy($orderBy);
        }
    }
}
