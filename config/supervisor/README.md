http://supervisord.org
Supervisord is installed in "php-fpm" image.

### Start daemon
```bash
docker exec -it php-fpm supervisord -c /etc/supervisor/supervisord.conf
```

### Commands
```bash
docker exec -it php-fpm supervisorctl status
docker exec -it php-fpm supervisorctl reread
docker exec -it php-fpm supervisorctl update
docker exec -it php-fpm supervisorctl start all
docker exec -it php-fpm supervisorctl stop all
docker exec -it php-fpm supervisorctl restart all
```

### Changing configuration
Everytime you change supervisor/dev/*.conf files you have to rebuild configuration via commands:
```bash
docker exec -it php-fpm supervisorctl reread
docker exec -it php-fpm supervisorctl update
docker exec -it php-fpm supervisorctl restart all
```
