<?php
return [
    "wells/([0-9+])" => [
        Router::GET => "well/get/$1",
        Router::PUT => "well/update/$1",
        Router::DELETE => "well/delete/$1"
    ],
    "wells" => [
        Router::GET => "well/get",
        Router::POST => "well/add",
    ]
];