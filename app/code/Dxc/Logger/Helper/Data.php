<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dxc\Logger\Helper;

/**
 * Dxc Logger data helper
 * @author Cris Pini <cpini@dxc.com>
 */
class Data
{
    /**
     * Inject container details as first param into Monloog\Logger
     * @author Cristian Pini <cpini@dxc.com>
     * @return string
     */
    public function getKubernetesPodDetails()
    {
        $podName        = trim($this->getEnvValue('K8S_POD_NAME'));
        $nodeName       = trim($this->getEnvValue('K8S_NODE_NAME'));
        $nodeNameSpace  = trim($this->getEnvValue('K8S_POD_NAMESPACE'));
        $replicaType    = trim($this->getEnvValue('REPLICA_TYPE'));
        if ($podName!=='' && $nodeName!=='' && $nodeNameSpace!=='') {
            return sprintf("%s:%s:%s:%s", $nodeNameSpace, $nodeName, $podName, $replicaType);
        }
        return 'main';
    }

    /**
     * Retrieve value of environment variable by key
     * @param string $placeholder
     * @return string|null
     */
    protected function getEnvValue($key = null)
    {
        // phpcs:disable Magento2.Security.Superglobal
        $val = isset($_ENV[$key]) ? $_ENV[$key] : null;
        // phpcs:enable
        return $val;
    }
}
