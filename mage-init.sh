#!/bin/bash

# sh mage-init.sh -c <k8s cluster name> -z <zone> -p <project>
# sh mage-init.sh -c magento-dev-cluster -z europe-west2-a -p magento-295411
while getopts c:z:p: flag
do
    case "${flag}" in
        c) cluster=${OPTARG};;
        z) zone=${OPTARG};;
        p) project=${OPTARG};;
    esac
done

`gcloud container clusters get-credentials $cluster --zone $zone --project $project`
kubeVersion=$(kubectl version)
echo "gcloud container clusters get-credentials $cluster --zone $zone --project $project"
RET=`kubectl config current-context`
echo "$RET"
cd ./k8s-config
echo "Deploy MySQL"
MYSQL=`kubectl apply -f ./mysql.yml`
echo "Deploy NFS"
NFS=`kubectl apply -f ./nfs.yml`
echo "Deploy Elastic Search"
ELASTIC1=`kubectl apply -f https://download.elastic.co/downloads/eck/1.2.1/all-in-one.yaml`
ELASTIC2=`kubectl apply -f ./elastic.yml`
echo "Deploy Services, Ingresses and Secrets"
TLS_CRT=`gcloud secrets versions access latest --secret=mage-xyz-tls-crt --format='get(payload.data)'`
TLS_KEY=`gcloud secrets versions access latest --secret=mage-xyz-tls-key --format='get(payload.data)'`
#SECRET_CANARY=`kubectl apply -f ./secrets/mage-canary-secrets.yml`
#SECRET=`kubectl apply -f ./secrets/mage-secrets.yml`
SECRET_CANARY=`cat k8s-config/secrets/mage-canary-secrets-test.yml | sed "s/\!\!REPLACE_WITH_WWWMAGESECRET_CRT\!\!/$TLS_CRT/g" | sed "s/\!\!REPLACE_WITH_WWWMAGESECRET_KEY\!\!/$TLS_KEY/g" | kubectl apply -f -`
SECRET=`cat k8s-config/secrets/mage-secrets-test.yml | sed "s/\!\!REPLACE_WITH_WWWMAGESECRET_CRT\!\!/$TLS_CRT/g" | sed "s/\!\!REPLACE_WITH_WWWMAGESECRET_KEY\!\!/$TLS_KEY/g" | kubectl apply -f -`
SERVICE=`kubectl apply -f ./services/magento-service.yml`
SERVICE_CANARY=`kubectl apply -f ./services/magento-service-canary.yml`  
sleep 45
DATA_POP=`kubectl exec -it magento-mysql-0 -- mysql -uroot -pmagento  magento < ../.sql_dumps/mage.xyz.https.es.db.dmp`
echo "Rollout Deployments"
DEP_CANARY=`kubectl apply -f ./deployments/startup/apache-php-canary.yml`
DEP=`kubectl apply -f ./deployments/startup/apache-php.yml`
sleep 180
echo "K8S deployment complete - https://www.mage.xyz/"
exit 1
