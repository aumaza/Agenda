#!/bin/bash
fecha=`date +%d-%m-%Y`
archivo="agenda_dpyegp-$fecha.sql"
mysqldump --user=root --password=slack142 --host=slackzone.ddns.net agenda_dpyegp > $archivo
chmod 777 $archivo
mv $archivo core/sqls/


