#!/usr/bin/env bash

sudo cp /srv/config/apache/local.proclaim.dev.conf /etc/apache2/sites-available/
sudo a2ensite local.proclaim.dev.conf
sudo a2enmod rewrite
sudo service apache2 reload
#if [ -d /var/www/html ]; then
#    sudo rm -r /var/www/html
#fi