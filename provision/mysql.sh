#!/usr/bin/env bash

mysql -uroot -e "drop database if exists proclaim"
mysql -uroot -e "create database proclaim"
mysql -uroot proclaim < /srv/database/default/proclaim_default.sql