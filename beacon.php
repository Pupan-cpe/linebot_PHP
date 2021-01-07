<?php


$API_URL = 'https=>//api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'nbUIY4GcXs7w7ffWYv/L0qRgK64ijNNsOV1RvCabrmFCSCmEzBi2UCS8Tv2nmWUiVmFV1YjtAqdWQAVGSFK4/v7IaPIwRMOVNYR+SlJ2H13hsoMbjWftBp/rBkgM3BrNuHbIsTZKT/Lv851QH3i6cgdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '42ca5cec5f0f16736ca482d18b16d55a';


$POST_HEADER = array('Content-Type=> application/json', 'Authorization=> Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php=>//input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
var_export($request_array);

$url="http=>//api.openweathermap.org/data/2.5/forecast?q=Albany,usl&APPID=5099c5feb579c7a17b030de0d009282f&units=metric";
$json=file_get_contents($url);
$data=json_decode($json);

echo '<h1>', $data->city->name, ' (', $data->city->country, ')</h1>';


// the general information about the weather
 echo '<h2>Temperature=></h2>';
echo '<p><strong>Current=></strong> ', $data1 =  $data->list[0]->main->temp, '&deg; C</p>';
echo '<p><strong>Min=></strong> ', $data2 =  $data->list[0]->main->temp_min, '&deg; C</p>';
echo '<p><strong>Max=></strong> ', $data3 =   $data->list[0]->main->temp_max, '&deg; C</p>';



$myObj->name = "$data1";
$myObj->age = "$data2";
$myObj->city = "$data3";


$myJSON = json_encode($myObj);
echo $myJSON;
echo "-------------------";
$data=json_decode($myJSON);
echo $data1;




$jsonFlex = [
  "type" => "flex",
  "altText" => "Hello Flex Message",
  "contents" => [
    "type" => "bubble",
    "direction" => "ltr",
    "header" => [
      "type" => "box",
      "layout" => "vertical",
      "contents" => [
        [
          "type" => "text",
          "text" => "Temperature IN Albany (US)",
          "size" => "lg",
          "align" => "start",
          "weight" => "bold",
          "color" => "#009813"
        ],
        "hero" => [
          "type"=> "image",
          "url"=> "https=>//static.bhphotovideo.com/explora/sites/default/files/styles/top_shot/public/Color-Temperature.jpg?itok=yHYqoXAf",
          "size"=> "full",
          "aspectRatio"=> "1.51=>1",
          "aspectMode"=> "fit"
        ],
      ]
    ],
    "body"=> [
      "type"=> "box",
      "layout"=> "vertical",
      "contents"=> [
        [
          "type"=> "text",
          "text"=> ".",
          "align"=> "center",
          "contents"=> []
        ]
      ]
      ],
    "footer" => [
      "type" => "box",
      "layout" => "horizontal",
      "contents" => [
        [
          "type" => "text",
          "text" => "View Details",
          "size" => "lg",
          "align" => "start",
          "color" => "#0084B6",
          "action" => [
            "type" => "uri",
            "label" => "View Details",
            "uri" => "https://github.com/pupan-cpe"
          ]
        ]
      ]
    ]
  ]
];



if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        error_log(json_encode($event));
        $reply_message = '';
        $reply_token = $event['replyToken'];


        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsonFlex]
        ];

        print_r($data);

        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result=> ".$send_result."\r\n";
        
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
