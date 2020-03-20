<?php
//pinglog doc
// read file param log then output map data [{"t": "ms"}]
// default ready last 100 lines

# params:
# $filepath = $_GET['filepath'];

$filepath = 'data\ping1111.log';

$lines = file($filepath);
$num = count($lines);
$maxRead = 75;

//forward 
# $maxLines = $num >= $maxRead ?  $maxRead : $num;
#$start = 0;

//backward
$maxLines = $num >= $maxRead ?  $maxRead : $num;
$start = $num - 1;
$end = $start - $maxRead;

$map = array();

#echo ' Start: '. $start; echo ' End: '. $end; echo ' MaxLines: '. $maxLines;
#die;


// for ($i=$start; $i < $maxLines; $i++ ) { // read forward
for ($i=$start; $i >= $end; $i--) { // read backward 
    
    $line = $lines[$i];
    
    // example lines to parse:
    // 19/03/2020 19:01:18 Request timed out.
    // 19/03/2020 19:01:22 Reply from 1.1.1.1: bytes=32 time=5ms TTL=57
    
    $data = array();

    $val = explode(' ', $line);    
    $nVal = count($val);

    if ($nVal < 1) {
        // @todo
        // some error; shoudl i log? 
        continue;
    } elseif (strpos($line, 'Request timed out') > 0) {
        // rto
        //$dt = $val[0] . ' ' . $val[1];
        $time = $val[1] === '' ? $val[2] : $val[1];

        list($day, $month, $year) = explode('/', $val[0]);
        list($hr, $min, $sec) = explode(':', $time);
        $dt = strtotime("$year-$month-$day $hr:$min:$sec");
        
        //$str = str_replace($dt, '', $line);
        $data[$dt] = 1;

    } elseif ($nVal > 5) {
        // normally param0 =date, param1 = time, param6 = time
        $time = $val[1] === '' ? $val[2] : $val[1];
        $ms = $val[1] === '' ? $val[7] : $val[6];        

        $dt = $val[0] . ' ' . $val[1];
        list($day, $month, $year) = explode('/', $val[0]);
        list($hr, $min, $sec) = explode(':', $time);
        $dt = strtotime("$year-$month-$day $hr:$min:$sec");

        $t = str_replace(array('time=','ms'), "" , $ms);
        $data['date'] = $dt;
        $data['units'] = (int)$t;
    }

    $map[]  = $data;
}

#print_r($map);
header('Content-type', 'text/json');
echo json_encode($map);
/*
target output
[
  {
            158 464 432 2000
    "date": 149 392 260 0000,
    "units": 320
  },
  {
    "date": 1494009000000,
    "units": 552
  },
  {
    "date": 1494095400000,
    "units": 342
  },
  {
    "date": 1494181800000,
    "units": 431
  },
  {
    "date": 1494268200000,
    "units": 251
  },
  {
    "date": 1494354600000,
    "units": 445
  }
]
*/