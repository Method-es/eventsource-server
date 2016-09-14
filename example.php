<?php
require 'vendor/autoload.php';

use Igorw\EventSource\Stream;

foreach (Stream::getHeaders() as $name => $value) {
    header("$name: $value");
}

$stream = new Stream();

while (true) {
    $stream
        ->event()
            ->setEvent('simple')
            ->setData("Hello World")
        ->end()
        ->flush();

    $stream
        ->event()
        ->setEvent('complex')
        ->setData(json_encode(['more-complex'=>[1,2,3],'more-data'=>['nested-data'=>'abcdef']]))
        ->end()
        ->flush();

    sleep(2);
}
