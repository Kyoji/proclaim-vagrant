#!/usr/bin/env bash

sudo apt-get install -y apache2
sudo apt-get install -y php7.0
export DEBIAN_FRONTEND=noninteractive
sudo -E apt-get -q -y install mysql-server
sudo apt-get install -y php7.0-mysql
sudo apt-get install -y php7.0-xdebug