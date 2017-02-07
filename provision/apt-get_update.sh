#!/bin/bash

apt-key adv --quiet --keyserver "hkp://keyserver.ubuntu.com:80" --recv-key E5267A6C 2>&1 | grep "gpg:"
apt-key export E5267A6C | apt-key add -

#sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get -y upgrade
sudo apt-get -y update
sudo apt-get autoremove -y
sudo apt-get autoremove -y