Image Gallery demo
==================

```
sudo chmod +a "www-data allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs web
sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs web
```