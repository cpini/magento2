#!/bin/sh

composer install
#vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist
file="$(ls -l  vendor/bin/phpunit)";
echo $file;