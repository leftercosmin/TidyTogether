#!/bin/bash

if [ ! -d /etc/init.d/apache2 ]; then
	sudo /etc/init.d/apache2 stop > temp3434.txt
	rm temp3434.txt
fi

sudo /opt/lampp/xampp start
./bin/build.sh

if [ $# -eq 1 ] && [ $1 == "reset" ] ; then
  ./bin/resetSchema.sh
fi
