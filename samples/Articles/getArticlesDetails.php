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
use ZalandoPHP\Operations\Articles;

$conf = new GenericConfiguration();

try {
    $conf
        ->setLocale('nl-NL')
        ->setClientName('zalando-php-wrapper')
        ->setResponseType('array');

} catch (\Exception $e) {
    echo $e->getMessage();
}
$zalandoPHP = new ZalandoPHP($conf);


$articles = new Articles('IC143F01H-M11');

$formattedResponse = $zalandoPHP->runOperation($articles);

echo '<pre>';
print_r($formattedResponse);
echo '</pre>';