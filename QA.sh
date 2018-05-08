#!/bin/bash
declare STRING variable
STRING="Tranfering Files"
#print variable on a screen
echo $STRING
var= scp -r /var/www/html gilles@10.0.1.14:/var/www/



