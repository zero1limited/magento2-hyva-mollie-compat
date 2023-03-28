<?php
namespace Hyva\MolliePayment\Magewire;

use Magewirephp\Magewire\Component;
use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Mollie\Payment\Config;
use Magento\Framework\Locale\Resolver as LocaleResolver;
use Psr\Log\LoggerInterface;

class Applepay extends Component
{
    /** @var Session */
    protected $checkoutSession;

    /** @var Config */
    protected $config;

    /** @var LocaleResolver */
    protected $localeResolver;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * @param Session $checkoutSession
     * @param Config $config
     * @param LocaleResolver $localeResolver
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(
        Session $checkoutSession,
        Config $config,
        LocaleResolver $localeResolver,
        LoggerInterface $loggerInterface
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->config = $config;
        $this->localeResolver = $localeResolver;
        $this->logger = $loggerInterface;
    }
    
    /**
     * @return void
     */
    public function log()
    {
        $this->logger->error('Mollie Apple Pay Error', func_get_args());
    }

    /**
     * @return float|null
     */
    public function getBaseGrandTotal(): ?float
    {
        return $this->checkoutSession->getQuote()->getBaseGrandTotal();
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
    public function getStoreCountry(): string
    {
        return $this->_scopeConfig->getValue('general/country/default', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getStoreCurrency(): string
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
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
