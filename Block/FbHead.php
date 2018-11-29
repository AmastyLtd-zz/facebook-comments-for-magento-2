<?php

namespace Amasty\Fbreview\Block;

use Amasty\Fbreview\Helper\Data;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;

class FbHead extends Template
{
    /**
     * @var Product
     */
    private $product = null;

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

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
        \Magento\Framework\Registry $registry,
        Data $helper,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->product) {
            $this->product = $this->coreRegistry->registry('product');
        }

        return $this->product;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->helper->getConfigValueByPath(Data::CONFIG_PATH_GENERAL_APPID);
    }
}
