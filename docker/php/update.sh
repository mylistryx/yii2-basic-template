#!/usr/bin/env bash

composer install
yii migrate --interactive=0
yii cache/flush-all

exit 0