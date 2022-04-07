<?php

namespace Codilar\OrderDetails\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar\OrderDetails\Model\ResourceModel\OrderDetails as ResourceModel;

class OrderDetails extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
