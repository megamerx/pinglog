# pinglog
- Logs ping and displays it via CanvasJS graph 
- Intended for use to monitor internet connection if down or up, graphically, via Ping and CanvasJS graph
- initially intended for For Windows PCS

#requirements
- XAMPP OR minimally apache + php 
- Internet connection

# how to use:
- copy all files under htdocs folder, ex xampp\htdocs\pinglog
- Run ping-1.bat -> should generate pingLog_1.1.1.1.log
- mklink data\ping1111.log pingLog_1.1.1.1.log
- RUN xampp/apache then start browser and open http://localhost/pinglog/livegraph.php

# Tools / References:
- XAMPP - https://www.apachefriends.org/index.html
- Ping with timestamp: https://stackoverflow.com/questions/24906268/ping-with-timestamp
- Canvasjs - https://canvasjs.com/javascript-charts/chart-index-data-label/
- Visual Studio Code - https://code.visualstudio.com/

(c) 2020/merx