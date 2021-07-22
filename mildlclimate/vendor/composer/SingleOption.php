<?php
class SingleOption
{
    /**************************************
     приведение к единому стандарту даты всех таюлиц
     **************************************/
  

    public function OderTime($timecheck)
    {
       /* echo $timecheck;*/
       date_default_timezone_set('UTC');
   /*    echo $timecheck;*/
     /*  echo "<br>";*/
             if(stripos($timecheck, ':') !== false && stripos($timecheck, 'Сьогодні') === false && stripos($timecheck, 'Вчора') === false) { 
              

              $timearr = explode(":", $timecheck);
              $hour = str_replace(" ","",$timearr[0]);
              $minute = $timearr[1];
              $second = $timearr[2];
              $lastmonth2 =  mktime($hour, $minute, $second, date("m")  , date("d"), date("Y"));

              $time11 = date('Y-m-d H:i:s', $lastmonth2) ."\n";
                 
            

              } elseif(stripos($timecheck, '.') !== false && stripos($timecheck, 'мин.назад') === false && stripos($timecheck, 'трав.') === false && stripos($timecheck, 'чер.') === false && stripos($timecheck, 'лип.') === false && stripos($timecheck, 'серп.') === false && stripos($timecheck, 'вер.') === false && stripos($timecheck, 'жовт.') === false && stripos($timecheck, 'лист.') === false && stripos($timecheck, 'груд.') === false)      
              {
              $timearr = explode(".", $timecheck);
              $day = intval(str_replace(" ","",$timearr[0]));
              $month = intval(str_replace(" ","",$timearr[1]));
              $year = intval(str_replace(" ","",$timearr[2]));
              $lastmonth3 =  mktime(date("H"), date("i"), date("s"), $month, $day ,$year);

              $time11 = date('Y-m-d H:i:s', $lastmonth3) ."\n";
                 
                   
              } elseif (stripos($timecheck, 'часовназад') !== false)
              
              {
              $hour = substr($timecheck, 0, -20);
              $hourago =  time() - ($hour  * 60 * 60);  
              $time11 =  date('Y-m-d H:i:s', $hourago);

              
              } elseif(stripos($timecheck, 'часназад') !== false) 
              
              {
              $hour = substr($timecheck, 0, -10);
              $hourago =  time() - ($hour  * 60 * 60);  
              $time11 =  date('Y-m-d H:i:s', $hourago);

              } elseif(stripos($timecheck, 'часаназад') !== false)

              {
              $hour = substr($timecheck, 0, -18);
              $hourago =  time() - ($hour  * 60 * 60);  
              $time11 =  date('Y-m-d H:i:s', $hourago);

              } elseif( stripos($timecheck, 'мин.назад') !== false)
              {
              $minute = substr($timecheck, 0, -17);
              $minuteago =  time() - (1  * $minute * 60);  
              $time11 =  date('Y-m-d H:i:s', $minuteago);
              } elseif(stripos($timecheck, 'Сьогодні') !== false)
              
              {  
              $timearr = explode(":", $timecheck);
              $hour = substr($timearr[0], 16);
              $minute = $timearr[1];
            /*  echo 'second'.$second = $timearr[2];*/
              $lastmonth2 =  mktime($hour, $minute, date("s"), date("m")  , date("d"), date("Y"));

               $time11 = date('Y-m-d H:i:s', $lastmonth2) ."\n";
             } elseif(stripos($timecheck, 'Вчера') !== false )
             {
              $yesterday = time() - (1 * 24 * 60 * 60);
              $time11 = date('Y-m-d h:i:s', $yesterday);

             }  elseif(stripos($timecheck, 'Вчора') !== false )
             {
              $yesterday = time() - (1 * 24 * 60 * 60);
              $time11 = date('Y-m-d h:i:s', $yesterday);

             } elseif(stripos($timecheck, 'Позавчера') !== false )
             {
              $yesterday = time() - (2 * 24 * 60 * 60);
              $time11 = date('Y-m-d h:i:s', $yesterday);

             } elseif(stripos($timecheck, 'трав.') !== false )
             {
              $month = 5;
              $day = substr($timecheck, 0, -5);
              $month3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $month3) ."\n";
              } elseif(stripos($timecheck, 'чер.') !== false )
              {
              $month = 6;
              $day = substr($timecheck, 0, -4);
              $data3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $data3) ."\n";
              }elseif(stripos($timecheck, 'лип.') !== false )
              {
              $month = 7;
              $day = substr($timecheck, 0, -4);
              $data3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $data3) ."\n";
              }elseif(stripos($timecheck, 'серп.') !== false )
              {
              $month = 8;
              $day = substr($timecheck, 0, -4);
              $data3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $data3) ."\n";
              }elseif(stripos($timecheck, 'вер.') !== false )
              {
              $month = 9;
              $day = substr($timecheck, 0, -4);
              $data3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $data3) ."\n";
              }elseif(stripos($timecheck, 'жовт.') !== false )
              {
              $month = 10;
              $day = substr($timecheck, 0, -4);
              $data3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $data3) ."\n";
              }elseif(stripos($timecheck, 'лист.') !== false )
              {
              $month = 11;
              $day = substr($timecheck, 0, -4);
              $data3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $data3) ."\n";
              }elseif(stripos($timecheck, 'груд.') !== false )
              {
              $month = 12;
              $day = substr($timecheck, 0, -4);
              $data3 =  mktime(date("H")  , date("i"), date("s"), $month, $day ,date("Y"));

              $time11 = date('Y-m-d H:i:s', $data3) ."\n";
              }else  echo $time11 = $timecheck;
                   
            
            

                 
                
       
        return $time11;
    }   
        
};