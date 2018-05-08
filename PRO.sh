#!/bin/bash
declare STRING variable
STRING="Tranfering Files to Production"
#print variable on a screen
echo $STRING
var= scp -r /var/www/html gilles@10.0.1.24:/var/www/



