<?php

declare(strict_types=1);

namespace Hyva\MolliePayment\Magewire;

use Magewirephp\Magewire\Component;
use Magento\Checkout\Model\Session as SessionCheckout;

class CreditCard extends Component
{
    /** @var SessionCheckout */
    protected $sessionCheckout;

    public function __construct(
        SessionCheckout $sessionCheckout
    ){
        $this->sessionCheckout = $sessionCheckout;
    }

    /**
     * Store card token returned by Mollie API
     *
     * @param string $token
     * @return void
     */
    public function setToken($token)
    {
        $quote = $this->sessionCheckout->getQuote();
        $quote->getPayment()->setAdditionalInformation(
            'card_token',
            $token
        );
        $quote->getPayment()->save();
    }
}