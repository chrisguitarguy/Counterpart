.PHONY: test cleancoverage generateapi uploadapi cleanapi clean

test:
	php vendor/bin/phpunit --coverage-html=coverage

cleancoverage:
	rm -rf coverage

generateapi:
	php vendor/bin/sami.php update sami-config.php

uploadapi: generateapi
	aws s3 sync sami/build/ s3://api.counterpartphp.org

cleanapi:
	rm -rf sami

clean: cleancoverage cleanapi
