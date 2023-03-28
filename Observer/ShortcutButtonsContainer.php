<?php
namespace Hyva\MolliePayment\Observer;

use Magento\Catalog\Block\ShortcutButtons;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Hyva\MolliePayment\Block\Shortcut\Button\Minicart\ApplePay as ApplePayButton;
use Mollie\Payment\Config;

class ShortcutButtonsContainer implements ObserverInterface
{
    /**
     * @var Config
     */
    protected $config;

    protected $objectManager;

    public function __construct(
        Config $config,
        \Magento\Framework\ObjectManagerInterface $objectManagerInterface
    ) {
        $this->config = $config;
        $this->objectManager = $objectManagerInterface;
    }

    public function execute(Observer $observer)
    {
        if(!$observer->getEvent()->getContainer()->getParentBlock()){
            return $this;
        }

        /** @var ShortcutButtons $shortcutButtons */
        $shortcutButtons = $observer->getEvent()->getContainer();
        // This event is fired twice, one for the minicart and one for the PDP page
        // couldn't see a better way to differentiate between the two
        $isPDP = $observer->getEvent()->getContainer()->getParentBlock() instanceof \Magento\Catalog\Block\Product\View;
        if($this->config->isMethodActive('mollie_methods_applepay')){
            if($isPDP){
                // TODO - PDP button
            }else{
                // minicart
                if($this->config->applePayEnableMinicartButton()){
                    $shortcutButtons->addShortcut($shortcutButtons->getLayout()->createBlock(ApplePayButton::class));
                }
            }
        }
    }
}
