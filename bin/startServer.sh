#!/bin/bash

# should be called only once

if [ ! -d /etc/init.d/apache2 ]; then
	sudo /etc/init.d/apache2 stop > temp3434.txt
	rm temp3434.txt
fi

sudo /opt/lampp/xampp start

MYSQL="/opt/lampp/bin/mysql"
HOST="localhost"
USER="root"
FILE="./bin/schema.sql"

"$MYSQL" -h "$HOST" -u "$USER" -p < "$FILE"
./bin/build.sh
