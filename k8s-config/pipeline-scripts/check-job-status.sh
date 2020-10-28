#!/bin/bash

`gcloud components install kubectl`
`gcloud container clusters get-credentials magento-dev-cluster --zone europe-west2-a`
while true; do
    status=$(kubectl wait --for=condition=complete job/pre-release-actions)
    response='job.batch/pre-release-actions condition met'
    if test "$status" == "$response"
    then
        echo "$status >> $response"
        $(kubectl delete job pre-release-actions)
        break
    else
        echo "Still running"
        sleep 10
    fi
done
exit 0
