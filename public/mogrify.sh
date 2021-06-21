#!/bin/bash
#this will convert the uploaded images to smaller versions using mogrify
filepath=$1
user=$2

echo "phplta saatu kuvapath on: $1" >> php_upload.log
echo "phplta saatu user on: $2" >> php_upload.log

string=$filepath
prefix="gallery/"
path1=${string#"$prefix"}
path2=gallery-preview/$path1

#copy the original file to backups
cp --backup=existing $filepath gallery-original/;

#creates preview directory for the based on the nick
mkdir -p gallery-preview/$user;
cp -r $filepath gallery-preview/$user;

#resize with mogrify
mogrify -resize 25% -auto-orient -quality 90 $path2;
mogrify -resize 100% -auto-orient -quality 70 $filepath;

echo "mogrifyn preview path on: $path2" >> php_upload.log
echo "mogrifyn gallery path on: $filepath" >> php_upload.log
echo "end of log" >> php_upload.log
