<?php
namespace Hyva\MolliePayment\Block\Checkout\Payment\Method;
use Mollie\Payment\Config as MollieConfigProvider;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Locale\Resolver as LocaleResolver;

class CreditCard extends \Magento\Framework\View\Element\Template
{
    protected $mollieConfigProvider;

    protected $storeManager;

    protected $localeResolver;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        MollieConfigProvider $mollieConfigProvider,
        StoreManagerInterface $storeManager,
        LocaleResolver $localeResolver,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->mollieConfigProvider = $mollieConfigProvider;
        $this->localeResolver = $localeResolver;
        $this->storeManager = $storeManager;
    }

    /**
     * @return MollieConfigProvider
     */
    public function getMollieConfigProvider()
    {
        return $this->mollieConfigProvider;
    }

    /**
     * @param int|null $storeId
     * @return string
     */
    public function getLocale($storeId = null)
    {
        if(!$storeId){
            $storeId = $this->storeManager->getStore()->getId();
        }
        $locale = $this->mollieConfigProvider->getLocale($storeId);

        // Empty == autodetect, so use the store.
        if (!$locale || $locale == 'store') {
            return $this->localeResolver->getLocale();
        }

        return $locale;
    }
}
