<?php

namespace Amasty\Fbreview\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const CONFIG_PATH_GENERAL_APPID = 'amfbreview/general/appid';

    const CONFIG_PATH_GENERAL_TITLE = 'amfbreview/general/title';

    const CONFIG_PATH_GENERAL_PERPAGE = 'amfbreview/general/perpage';

    const CONFIG_PATH_GENERAL_ASCENDING = 'amfbreview/general/ascending';

    const CONFIG_PATH_DISPLAY_WIDTH = 'amfbreview/general/width';

    const CONFIG_PATH_DISPLAY_NOSTYLES = 'amfbreview/general/nostyles';

    const CONFIG_PATH_DISPLAY_CSS = 'amfbreview/general/css';

    const CONFIG_PATH_REMOVE_URL = 'amfbreview/display/disable_amasty_url';

    /**
     * @param $path
     * @param string $scope
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValueByPath(
        $path,
        $scope = ScopeInterface::SCOPE_WEBSITE,
        $storeId = null
    ) {
        return $this->scopeConfig->getValue(
            $path,
            $scope,
            $storeId
        );
    }

    /**
     * @return mixed
     */
    public function isRemoveAmastyUrl()
    {
        return $this->getConfigValueByPath(self::CONFIG_PATH_REMOVE_URL);
    }
}
