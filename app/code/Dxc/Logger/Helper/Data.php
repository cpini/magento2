<?php


/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dxc\Logger\Helper;

use Magento\Config\Model\Config\Reader\Source\Deployed\SettingChecker;

/**
 * Dxc Logger data helper
 * @author Cris Pini <cpini@dxc.com>
 */
class Data
{
    /**
     * @var Config\Reader\Source\Deployed\SettingChecker
     */
    private $settingChecker;

    /**
     * @param SettingChecker $settingChecker
     */
    public function __construct(SettingChecker $settingChecker)
    {
        $this->settingChecker = $settingChecker;
    }

    /**
     * Inject container details as first param into Monloog\Logger
     * @author Cristian Pini <cpini@dxc.com>
     * @return string
     */
    public function getKubernetesPodDetails()
    {
        $podName        = trim($this->settingChecker->getEnvValue('K8S_POD_NAME'));
        $nodeName       = trim($this->settingChecker->getEnvValue('K8S_NODE_NAME'));
        $nodeNameSpace  = trim($this->settingChecker->getEnvValue('K8S_POD_NAMESPACE'));
        if ($podName!=='' && $nodeName!=='' && $nodeNameSpace!=='') {
            return sprintf("%s:%s:%s", $nodeNameSpace, $nodeName, $podName);
        }
        return 'main';
    }
}
