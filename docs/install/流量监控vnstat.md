## 安装vnstat监控网卡流量
wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-7.repo
wget -O /etc/yum.repos.d/epel.repo http://mirrors.aliyun.com/repo/epel-7.repo
yum clean all
yum makecache
yum makecache fast
yum install epel-release -y
yum install vnstat -y
vnstat --create -i eth0
chown -R vnstat:vnstat /var/lib/vnstat/
systemctl enable vnstat
systemctl start vnstat
