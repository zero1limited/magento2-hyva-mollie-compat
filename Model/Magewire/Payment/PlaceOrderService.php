<?php

namespace Hyva\MolliePayment\Model\Magewire\Payment;

use Hyva\Checkout\Model\Magewire\Payment\AbstractPlaceOrderService;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Model\Quote;
use Magento\Payment\Helper\Data as PaymentHelper;
use Magento\Sales\Api\OrderRepositoryInterface;

class PlaceOrderService extends AbstractPlaceOrderService
{
    /**
     * @var PaymentHelper
     */
    protected $paymentHelper;

    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @param CartManagementInterface $cartManagement
     * @param PaymentHelper $paymentHelper
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        CartManagementInterface $cartManagement,
        PaymentHelper $paymentHelper,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->paymentHelper = $paymentHelper;
        $this->orderRepository = $orderRepository;
        parent::__construct($cartManagement);
    }

    /**
     * @param Quote $quote
     * @param int|null $orderId
     * @return string
     */
    public function getRedirectUrl(Quote $quote, ?int $orderId = null): string
    {
        $paymentMethod = $this->paymentHelper->getMethodInstance($quote->getPayment()->getMethod());
        $order = $this->orderRepository->get($orderId);
        $checkoutUrl = $paymentMethod->startTransaction($order);
        return $checkoutUrl;
    }
}