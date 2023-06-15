#!/bin/bash

php /var/www/html/fetchQuotes.php
service apache2 start
tail -f /dev/null

