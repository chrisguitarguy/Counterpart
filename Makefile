.PHONY: test cleancoverage generateapi uploadapi cleanapi clean

test:
	php vendor/bin/phpunit --coverage-html=coverage

cleancoverage:
	rm -rf coverage

generateapi:
	php vendor/bin/sami.php update sami-config.php

uploadapi: generateapi
	aws s3 sync --delete --exclude PROJECT_VERSION --exclude SAMI_VERSION sami/build/ s3://api.counterpartphp.org
	aws s3 sync sami/build/master/ s3://api.counterpartphp.org

cleanapi:
	rm -rf sami

clean: cleancoverage cleanapi
