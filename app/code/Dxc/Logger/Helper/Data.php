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
        $podName        = trim($_ENV['K8S_POD_NAME']);
        $nodeName       = trim($_ENV['K8S_NODE_NAME']);
        $nodeNameSpace  = trim($_ENV['K8S_POD_NAMESPACE']);
        if ($podName!=='' && $nodeName!=='' && $nodeNameSpace!=='') {
            return sprintf("%s:%s:%s", $nodeNameSpace, $nodeName, $podName);
        }
        return 'main';
    }
}
