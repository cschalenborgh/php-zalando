<?php

/*
 * Copyright 2015 Chris Schalenborgh <chris@schalenborgh.be>
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/

// php -d display_errors samples/Articles/getArticles.php


require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'bootstrap.php');


use ZalandoPHP\ZalandoPHP;
use ZalandoPHP\Configuration\GenericConfiguration;
use ZalandoPHP\Operations\ArticlesReviews;

$conf = new GenericConfiguration();

try {
    $conf
//        ->setLocale('nl-be')
        ->setLocale('de-DE')
        ->setClientName('zalando-php-wrapper')
        ->setResponseType('array');

} catch (\Exception $e) {
    echo $e->getMessage();
}
$zalandoPHP = new ZalandoPHP($conf);


$reviews = new ArticlesReviews('L8381D00F-G11');
$formattedResponse = $zalandoPHP->runOperation($reviews);

echo '<pre>';
print_r($formattedResponse);
echo '</pre>';