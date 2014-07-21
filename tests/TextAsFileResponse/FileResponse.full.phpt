<?php

/**
 * Test: Joseki\Application\Responses\TextAsFileResponse.
 */

use Joseki\Application\Responses\TextAsFileResponse,
    Nette\Http,
    Tester\Assert;

require __DIR__ . '/../bootstrap.php';

test(
    function () {
        $origData = file_get_contents(__FILE__);
        $fileResponse = new TextAsFileResponse($origData, 'TestFile.txt', null, false);

        ob_start();
        $fileResponse->send(new Http\Request(new Http\UrlScript), new Http\Response);
        Assert::same($origData, ob_get_clean());
    }
);
