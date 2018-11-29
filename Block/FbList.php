<?php

namespace Amasty\Fbreview\Block;

use Amasty\Fbreview\Helper\Data;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class FbList extends Template
{
    const TABS_BLOCK_NAME = 'product.info.details';

    const TABS_GROUP_NAME = 'detailed_info';

    const CONFIG_STORE_LOCALE_PATH = 'general/locale/code';

    /**
     * @var Data
     */
    private $helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Amasty\Fbreview\Helper\Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->addToTabs();
        $this->setTitle($this->getBlockLabel());
    }

    public function addToTabs()
    {
        $this->addToBlock(self::TABS_BLOCK_NAME);
        $this->getLayout()->addToParentGroup($this->getNameInLayout(), self::TABS_GROUP_NAME);
    }

    /**
     * @param $blockName
     */
    private function addToBlock($blockName)
    {
        if ($this->getLayout()->isBlock($blockName) || $this->getLayout()->isContainer($blockName)) {
            $selfBlockName = $this->getNameInLayout();
            $this->getLayout()->setChild(
                $blockName,
                $selfBlockName,
                'amfbreview'
            );
        }
    }

    /**
     * @return mixed
     */
    public function getCurrentLocale()
    {
        return $this->helper->getConfigValueByPath(
            self::CONFIG_STORE_LOCALE_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getBlockLabel()
    {
        return $this->helper->getConfigValueByPath(
            Data::CONFIG_PATH_GENERAL_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function getConfigValueByPath($value)
    {
        return $this->helper->getConfigValueByPath($value);
    }

    /**
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->escapeUrl(
            $this->_urlBuilder->getCurrentUrl()
        );
    }

    /**
     * @return bool
     */
    public function showAmastyUrl()
    {
        return !$this->helper->isRemoveAmastyUrl();
    }
}
