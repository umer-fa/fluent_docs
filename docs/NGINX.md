# Nginx Setup

* Open Nginx directory within this repository

`cd ~/starter-app/etc/nginx`

* Create/modify nginx files

* Creating symbolic link (`SUDO` privileges required OR run as `root` user)

`sudo ln -s ~/starter-app/etc/nginx/*.nginx /etc/nginx/sites-enabled`

* Check nginx files

`sudo nginx -t`

* Restart nginx service

`sudo service nginx restart`