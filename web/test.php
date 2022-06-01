<?php
$api_url = 'https://api.thingspeak.com/channels/1755530/feeds.json?api_key=JILE4HUXIVMTY0WJ&results=3';
// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data->feeds;

// Cut long data into small & select only first 10 records
$user_data = array_slice($user_data, 0, 3);

echo count($user_data);
// Print data if need to debug
//print_r($user_data);

// Traverse array and display user data
foreach ($user_data as $user) {
    echo "entry_id: ".$user->entry_id;
    echo "<br />";
    echo "Created: ".$user->created_at;
    echo "<br />";
	echo "Temp: ".$user->field1;
	echo "<br />";
	echo "Humidity: ".$user->field2;
    echo "<br />";
	echo "Gas Level: ".$user->field3;
    echo "<br />";
	echo "Raining?: ".$user->field4;
	echo "<br /> <br />";
}

echo $user_data[2]->field3;
str_replace('T','-',$feed->field4);
?>