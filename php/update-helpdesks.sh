#!/bin/bash
cd /opt/swamid-errorurl/php

wget -qO helpdesks.php.tmp https://metadata.swamid.se/getErrorURL.php || exit 1
# shellcheck disable=SC2002
if [ "$(cat helpdesks.php.tmp | wc -l)" -lt 20 ] ; then
	echo "helpdesks.php.tmp too small"
	rm -f helpdesks.php.tmp
	exit 1
fi

if [ -f helpdesks.php ]; then
    diff -U 10 helpdesks.php helpdesks.php.tmp
fi
mv helpdesks.php.tmp helpdesks.php
