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

use ZalandoPHP\Configuration\Locale;

class LocaleTest extends \PHPUnit_Framework_TestCase
{
    public function testLocaleList()
    {
        $this->assertEquals(
            array(
                'da-dk',
                'de-at',
                'de-ch',
                'de-de',
                'en-gb',
                'es-es',
                'fi-fi',
                'fr-be',
                'fr-ch',
                'fr-fr',
                'it-it',
                'nl-be',
                'nl-nl',
                'no-no',
                'pl-pl',
                'sv-se'
            ),
            Locale::getLocales()
        );
    }

    public function testInvalidLocaleWithoutException()
    {
        $this->assertFalse(Locale::isValid(__METHOD__, false));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidLocaleWithExcetion()
    {
        Locale::isValid(__METHOD__);
    }

    public function testValidCountry()
    {
        $this->assertTrue(Locale::isValid('nl-be'));
    }
}
