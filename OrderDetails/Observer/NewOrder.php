<?php
namespace Codilar\OrderDetails\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Codilar\OrderDetails\Model\OrderDetailsFactory as ModelFactory;
use Codilar\OrderDetails\Model\ResourceModel\OrderDetails as ResourceModel;


class NewOrder implements ObserverInterface
{

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    public function __construct(
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {

        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $OrderDetails = $this->modelFactory->create();

        $orderId=$order->getEntityId();
        $items = $order->getAllVisibleItems();
        $productIds = array();
        foreach($items as $i) {
            $productIds[] = $i->getProductId();
        }
        $productId= implode(",",$productIds);
        $orderDate=$order->getCreatedAt();
        $ordertotal=$order->getGrandTotal();
        $shippingMethod=$order->getShippingMethod();
        $paymentMethod = $order->getPayment()->getMethod();

        $OrderDetails->setOrderId($orderId);
        $OrderDetails->setProductId($productId);
        $OrderDetails->setOrderCreatedAt($orderDate);
        $OrderDetails->setOrderTotal($ordertotal);
        $OrderDetails->setShippingMethod($shippingMethod);
        $OrderDetails->setPaymentMethod($paymentMethod);
        
        $this->resourceModel->save($OrderDetails);
        
    }
}