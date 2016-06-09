#!/usr/bin/make -f

APP=app
cc_green="\033[0;32m" #Change text to green.
cc_end="\033[0m" #Change text back to normal.

build: drush-make mkdirs link copy dump-autoload

lint: lint-sass lint-js lint-php

init:
	@echo ${cc_green}">>> Installing dependencies..."${cc_end}
	composer config --global discard-changes true
	composer install --prefer-dist --no-progress


lint-php:
	@echo ${cc_green}">>> Linting PHP..."${cc_end}
	bin/phpcs \
	--report=full \
	--standard='vendor/drupal/coder/coder_sniffer/Drupal' \
	--extensions='php,module,inc,install,test,profile,theme' \
	--ignore='*/vendor/*' \
	.

test:
	@echo ${cc_green}">>> Running tests..."${cc_end}
	mkdir -p $CIRCLE_TEST_REPORTS/phpunit
	bin/phpunit --log-junit $CIRCLE_TEST_REPORTS/phpunit/junit.xml
