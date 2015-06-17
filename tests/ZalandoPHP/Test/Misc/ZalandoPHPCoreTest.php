<?php
/*
 * Copyright 2013 Jan Eichhorn <exeu65@googlemail.com>
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

namespace ZalandoPHP\Test\Misc;

use ZalandoPHP\ZalandoPHP;
use ZalandoPHP\Configuration\GenericConfiguration;
use ZalandoPHP\Operations\Articles;

class ZalandoPHPIOCoreTest extends \PHPUnit_Framework_TestCase
{
    public function testZalandoPHPRequestPerfomOperation()
    {
        $conf = new GenericConfiguration();
        $operation = new Articles();

        $request = $this->getMock('\ZalandoPHP\Request\Rest\Request', array('perform'));
        $request
            ->expects($this->once())
            ->method('perform')
            ->with($this->equalTo($operation));

        $conf->setRequest($request);

        $zalando = new ZalandoPHP($conf);
        $zalando->runOperation($operation);
    }

    /**
     * @expectedException Exception
     */
    public function testZalandoPHPWithoutConfig()
    {
        $operation = new Articles();
        $zalando = new ZalandoPHP();

        $zalando->runOperation($operation);
    }
}
