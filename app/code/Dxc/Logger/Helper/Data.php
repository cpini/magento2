<?php


/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dxc\Logger\Helper;

use Magento\Framework\App\DeploymentConfig;

/**
 * Dxc Logger data helper
 * @author Cris Pini <cpini@dxc.com>
 */
class Data
{
    /**
     * @var DeploymentConfig
     */
    private $config;

    /**
     * @param DeploymentConfig $config
     * @param PlaceholderFactory $placeholderFactory
     * @param ScopeCodeResolver $scopeCodeResolver
     */
    public function __construct(DeploymentConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Inject container details as first param into Monloog\Logger
     * @author Cristian Pini <cpini@dxc.com>
     * @return string
     */
    public function getKubernetesPodDetails()
    {
        $podName        = trim($this->config->getEnv('K8S_POD_NAME'));
        $nodeName       = trim($this->config->getEnv('K8S_NODE_NAME'));
        $nodeNameSpace  = trim($this->config->getEnv('K8S_POD_NAMESPACE'));
        if ($podName!=='' && $nodeName!=='' && $nodeNameSpace!=='') {
            return sprintf("%s:%s:%s", $nodeNameSpace, $nodeName, $podName);
        }
        return 'main';
    }
}
