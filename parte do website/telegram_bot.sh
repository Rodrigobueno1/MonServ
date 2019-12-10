#!/bin/bash
while true
do
 ACCESS_TOKEN="914645769:AAHOZv0GDO0mT34P0chw32BHDzXL0Vnn6fE"
 URL="https://api.telegram.org/bot$ACCESS_TOKEN/sendMessage"
 CHAT_ID="296647731" # Telegram id from /getUpdates

 mem=$(free -m)
 mem_usage=$(echo "$mem" | awk 'NR==2{printf "%.2f%%\t\t", $3*100/$2 }')

 disk=$(df -h)
 disk_usage=$(echo "$disk" | awk '$NF=="/"{printf "%s\t\t", $5}')

 avg=$(cat /proc/loadavg | awk '{print "\n1 min: "$1"\n5 min: "$2"\n15 min: "$3}')

up=$(uptime)
uptime=$(echo "$up" | awk -F'( |,|:)+' '{d=h=m=0; if ($7=="min") m=$6; else {if ($7~/^day/) {d=$6;h=$8;m=$9} else {h=$6;m=$7}}} {print d+0,"days,",h+0,"hours,",m+0,"minutes."}'
)
 
 MESSAGE="*USE*:
 Memory Usage: $mem_usage
 Disk Usage: $disk_usage
 Load Average: $avg
 Uptime: $uptime"
 PAYLOAD="chat_id=$CHAT_ID&text=$MESSAGE&disable_web_page_preview=true&parse_mode=Markdown"
 curl -s --max-time 13 --retry 3 --retry-delay 3 --retry-max-time 13 -d "$PAYLOAD" $URL > /dev/null 2>&1 &
	sleep 30
done
