#!/bin/bash

`gcloud container clusters get-credentials magento-dev-cluster --zone europe-west2-a`
while true; do
    status=$(kubectl wait --for=condition=complete job/pre-release-actions)
    response='job.batch/pre-release-actions condition met'
    if test "$status" == "$response"
    then
        echo "$status >> $response"
        break
    else
        echo "Still running"
        sleep 10
    fi
done
ret=$(kubectl delete job pre-release-actions)
if test "ret" != ""
then
    exit 0
fi  
exit 1
