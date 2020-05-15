.PHONY: ci

ci:
	./vendor/bin/phpunit; ./vendor/bin/phpstan analyse
