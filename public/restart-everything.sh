#!/bin/bash
sudo nginx -t
sudo systemctl restart nginx
sudo systemctl restart php7.4-fpm.service
echo "done"
