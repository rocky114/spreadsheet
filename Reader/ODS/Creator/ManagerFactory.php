<?php

namespace Rocky114\Excel\Reader\ODS\Creator;

use Rocky114\Excel\Reader\Common\Manager\RowManager;

/**
 * Class ManagerFactory
 * Factory to create managers
 */
class ManagerFactory
{
    /**
     * @param InternalEntityFactory $entityFactory Factory to create entities
     * @return RowManager
     */
    public function createRowManager($entityFactory)
    {
        return new RowManager($entityFactory);
    }
}
