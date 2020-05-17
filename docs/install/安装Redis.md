## 安装Redis
```
wget http://download.redis.io/releases/redis-4.0.11.tar.gz
tar zxvf redis-4.0.11.tar.gz
cd redis-4.0.11
make && make install

复制配置
cp redis.conf /etc/redis-6379.conf

编辑 /etc/redis-6379.conf 中的daemon no 改为 daemon yes

运行redis
/usr/local/bin/redis-server /etc/redis-6379.conf
```