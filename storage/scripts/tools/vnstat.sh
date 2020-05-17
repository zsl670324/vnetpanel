#!/bin/bash
yum install -y wget sqlite-devel gcc
wget https://github.com/vergoh/vnstat/releases/download/v2.1/vnstat-2.1.tar.gz
tar zxvf vnstat-2.1.tar.gz
cd vnstat-2.1
./configure --prefix=/usr --sysconfdir=/etc && make
make install
systemctl enable vnstat
systemctl start vnstat
vnstat -l
