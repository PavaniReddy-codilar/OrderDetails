<?php

namespace Codilar\OrderDetails\Model\ResourceModel\OrderDetails;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Codilar\OrderDetails\Model\OrderDetails as Model;
use Codilar\OrderDetails\Model\ResourceModel\OrderDetails as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
