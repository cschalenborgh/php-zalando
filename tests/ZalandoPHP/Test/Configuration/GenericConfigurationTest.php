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

namespace ZalandoPHP\Test\Configuration;

use ZalandoPHP\Configuration\GenericConfiguration;

class GenericConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ZalandoPHP\Configuration\GenericConfiguration
     */
    private $genericConfiguration;

    protected function setUp()
    {
        $this->genericConfiguration = new GenericConfiguration();
        parent::setUp();
    }

    public function testSetRequestFactoryExeptsClosure()
    {
        $this->genericConfiguration->setRequestFactory(function(){});
    }

    public function testSetRequestFactoryExeptsCallable()
    {
        $this->genericConfiguration->setRequestFactory(array(__NAMESPACE__ . '\CallableClass', 'foo'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetRequestFactoryThrowExceptionIfArgumentIsNotCallable()
    {
        $this->genericConfiguration->setRequestFactory("");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testLocaleException()
    {
        $object = new GenericConfiguration();
        $object->setLocale('no locale');
    }

    public function testLocaleSetter()
    {
        $object = new GenericConfiguration();
        $object->setLocale('nl-be');

        $this->assertEquals('nl-be', $object->getLocale());
    }

    public function testTimeoutSetter()
    {
        $object = new GenericConfiguration();
        $object->setTimeout(123);

        $this->assertEquals(123, $object->getTimeout());
    }

    public function testConnectionTimeoutSetter()
    {
        $object = new GenericConfiguration();
        $object->setConnectionTimeout(456);

        $this->assertEquals(456, $object->getConnectionTimeout());
    }
}

class CallableClass
{
    public static function foo()
    {
    }
}
