<?php
$ok = 0.5;

function weather_feels($temp,$rain)
{
$weather_feels = ($temp>35 && !$rain)
        ? 'Sunny'
        : (($temp>29 && !$rain)
        ? 'Partly Sunny'
        : 'Overcast');
return $weather_feels;        
}

echo weather_feels(40,0);
echo '<br>';
echo weather_feels(31,0);
echo '<br>';
echo weather_feels(40,1);

?>