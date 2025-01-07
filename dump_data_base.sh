#!/bin/bash
fecha=`date +%d-%m-%Y`
archivo="sqls/farmacia_calendar-$fecha.sql"
#mysqldump --user=root --password=slack142 --host=slackzone.ddns.net gesdoju > $archivo
mysqldump --user=root --password=slack142 --host=slackzone.ddns.net farmacia_calendar > $archivo
chmod 777 $archivo



