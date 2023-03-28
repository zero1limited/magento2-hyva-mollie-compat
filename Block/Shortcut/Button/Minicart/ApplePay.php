<?php
namespace Hyva\MolliePayment\Block\Shortcut\Button\Minicart;

use Magento\Catalog\Block\ShortcutInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Mollie\Payment\Config;
use Magento\Framework\Locale\Resolver as LocaleResolver;
use \Magento\Quote\Model\Quote;

class ApplePay extends Template implements ShortcutInterface
{
    protected $_template = 'Hyva_MolliePayment::shortcut/button/minicart/applepay.phtml';

    /**
     * @var Session
     */
    private $checkoutSession;

    /**
     * @var Config
     */
    private $config;

    /** @var LocaleResolver */
    protected $localeResolver;

    protected $cart;

    public function __construct(
        Template\Context $context,
        Session $checkoutSession,
        Config $config,
        LocaleResolver $localeResolver,
        Quote $cart,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        $this->config = $config;
        $this->localeResolver = $localeResolver;
        $this->cart = $cart;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'hyva.mollie.applepay.mini-cart';
    }

    // /**
    //  * @return string
    //  */
    // public function getCountryCode(): string
    // {
    //     return $this->_scopeConfig->getValue('general/country/default', ScopeInterface::SCOPE_STORE);
    // }

    // /**
    //  * @return string
    //  */
    // public function getCurrencyCode(): string
    // {
    //     return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    // }

    // /**
    //  * @return []
    //  */
    // public function getSupportedNetworks() : array
    // {
    //     return ['amex', 'maestro', 'masterCard', 'visa', 'vPay'];
    // }

    // /**
    //  * @return []
    //  */
    // public function getMerchantCapabilities() : array
    // {
    //     return ['supports3DS'];
    // }

    // /**
    //  * @throws \Magento\Framework\Exception\NoSuchEntityException
    //  * @return string
    //  */
    // public function getStoreName(): string
    // {
    //     return $this->_storeManager->getStore()->getName();
    // }

    // /**
    //  * @return string
    //  */
    // public function getAmount(): ?string
    // {
    //     return (string)'aaa';
    // }

    // public function getButtonColor()
    // {
    //     return $this->config->applePayMinicartColor();
    // }

    // public function getLocale()
    // {
    //     return $this->localeResolver->getLocale();
    // }
}


