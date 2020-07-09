#!/bin/sh

exitCode=0

################################################################
##   ~~~~ CodeSniffer for non core mods ~~~~
vendor/squizlabs/php_codesniffer/bin/phpcs --standard=vendor/magento/magento-coding-standard/Magento2/ --ignore=/app/code/Magento --extensions=php,phtml app/code
#vendor/squizlabs/php_codesniffer/bin/phpcs --standard=vendor/magento/magento-coding-standard/Magento2/ --ignore=/app/code/Magento --extensions=php,phtml --severity=error app/code
status=$?
if test "$status" -eq 0
then
	# do nothing
    echo "$status"
else
	echo "$status"
    exitCode=1
fi

################################################################
##   ~~~~ Unit Test for all mods ~~~~
#vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist
#status=$?
#if test "$status" -eq 0
#then
#	echo "SUCCESS"
#else
#	echo "$status"
#fi

exit $exitCode
