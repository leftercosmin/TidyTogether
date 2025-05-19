#!/bin/bash

# should be called only once

sudo /opt/lampp/xampp start

MYSQL="/opt/lampp/bin/mysql"
HOST="localhost"
USER="root"
FILE="./bin/schema.sql"

"$MYSQL" -h "$HOST" -u "$USER" -p < "$FILE"
./bin/build.sh
