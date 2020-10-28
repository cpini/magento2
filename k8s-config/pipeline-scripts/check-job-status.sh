#!/bin/bash

while getopts c:z: flag
do
    case "${flag}" in
        c) cluster=${OPTARG};;
        z) zone=${OPTARG};;
    esac
done

`gcloud components install kubectl`
`gcloud container clusters get-credentials $cluster --zone $zone`
kubeVersion=$(kubectl version)
echo "gcloud container clusters get-credentials $cluster --zone $zone"
echo "kubectl version: $kubeVersion"
while true; do
    status=$(kubectl --request-timeout 2m wait --for=condition=complete job/pre-release-actions)
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
    echo "Job deleted: $ret"
    exit 0
fi  
exit 1
