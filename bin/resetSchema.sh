#!/bin/bash

MYSQL="/opt/lampp/bin/mysql"
FILE="./bin/schema.sql"
ENV="./.env"

if [ -f $ENV ]; then
    export $(grep -v '^#' $ENV | xargs)
else
    echo ".env file not found."
    exit 1
fi

HOST="$DB_HOST"
USER="$DB_USERNAME"
PASS="$DB_PASSWORD"
NAME="$DB_NAME"
PORT="$DB_PORT"

"$MYSQL" -h "$HOST" -P "$PORT" -u "$USER" --password="$PASS" -D "$NAME" < "$FILE"
