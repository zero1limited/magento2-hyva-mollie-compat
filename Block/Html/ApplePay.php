<?php
namespace Hyva\MolliePayment\Block\Html;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Mollie\Payment\Config;
use Magento\Framework\Locale\Resolver as LocaleResolver;
use \Magento\Quote\Model\Quote;

class ApplePay extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Config
     */
    private $config;

    /** @var LocaleResolver */
    protected $localeResolver;

    /** @var Quote */
    protected $cart;

    public function __construct(
        Template\Context $context,
        Config $config,
        LocaleResolver $localeResolver,
        Quote $cart,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->localeResolver = $localeResolver;
        $this->cart = $cart;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->_scopeConfig->getValue('general/country/default', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }

    /**
     * @return []
     */
    public function getSupportedNetworks() : array
    {
        return ['amex', 'maestro', 'masterCard', 'visa', 'vPay'];
    }

    /**
     * @return []
     */
    public function getMerchantCapabilities() : array
    {
        return ['supports3DS'];
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->_storeManager->getStore()->getName();
    }

    /**
     * @return string
     */
    public function getButtonColor()
    {
        return $this->config->applePayMinicartColor();
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->localeResolver->getLocale();
    }
}
