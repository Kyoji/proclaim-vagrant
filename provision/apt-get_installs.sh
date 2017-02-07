#!/bin/bash

sudo apt-get -y install apache2
sudo apt-get -y install php7.0
export DEBIAN_FRONTEND=noninteractive
sudo -E apt-get -q -y install mysql-server
sudo apt-get -y install php7.0-mysql
sudo apt-get -y install php7.0-xdebug