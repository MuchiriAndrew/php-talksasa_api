<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP/SMS Api</title>
    <link rel="stylesheet" href="style.css">
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

<body>
<div class="bg-light" style="height:100vh">
    <div class="container">
        <div class="row justify justify-content-center">
            <div class="col-11 col-md-8 col-lg-6 col-xl-5">
                <form class="" method="POST" action="index.php">
                    <div class="card" style='background:#AEB2D5'>
                        <div class="row mt-0">
                            <div class="col-md-12 ">
                                <h4 class="text-white"> PHP Integration with Bulk SMS💌</h4>
<!--CODE TO SEND SMS-->
<?php

use Dotenv\Dotenv;
require './vendor/autoload.php';

$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['API_KEY'];
$senderID = $_ENV['SENDER_ID'];

if(isset($_POST['submit'])){
    $baseurl = "https://bulksms.talksasa.com/api/v3/sms/send";
    $ch = curl_init($baseurl);
    $data = array(
        "recipient" => $_POST['phone'],
        "sender_id" => "$senderID",
        "type" => "plain",
        "message" => $_POST['message'],
    );
    $payload = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', "Authorization:Bearer $apiKey", 'Accept:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_encode(curl_exec($ch));
    echo $result;
    curl_close($ch);
}
?>
<!--CODE TO SEND SMS-->
                                </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12 mb-0">
                                <p class="mb-1 text-white">Phone</p> <input id="e-mail" type="text" placeholder="phoneNo.(+254711111111)" name="phone" class="form-control input-box rm-border">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 mb-2">
                                <p class="mb-1 text-white">Message</p> <textarea id="message" type="text" placeholder="Enter your message" name="message" class="form-control input-box rm-border"></textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-12 px-3"> <input type="submit" value="Submit" name="submit" class="btn btn-block btn-purple rm-border"> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
