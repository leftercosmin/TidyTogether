#!/bin/bash

# call it to locally deploy your solution with all the updates

name="TidyTogether"
source="."
destination="/opt/lampp/htdocs/$name"

sudo rm -r $destination
sudo mkdir $destination
sudo cp -a "$source/." $destination

sudo echo "<?php
	if (!empty(\$_SERVER['HTTPS']) && ('on' == \$_SERVER['HTTPS'])) {
		\$uri = 'https://';
	} else {
		\$uri = 'http://';
	}
	\$uri .= \$_SERVER['HTTP_HOST'];
	header('Location: '.\$uri.'/$name');
	exit;" > p.php

sudo rm /opt/lampp/htdocs/index.php
sudo mv p.php /opt/lampp/htdocs/index.php
