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

namespace ZalandoPHP\Configuration;

/**
 * Locale validation according to Zalando API
 * Double check @ https://github.com/zalando/shop-api-documentation/wiki/Domain
 *
 * @author Jan Eichhorn <exeu65@googlemail.com>
 */
final class Locale
{
    /**
     * Possible locales
     * Important for the request endpoints
     *
     * @var array
     */
    private static $localeList = array(
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
    );

    /**
     * Gets all possible countries
     *
     * @return array
     */
    public static function getLocales()
    {
        return self::$localeList;
    }

    /**
     * Checks if the given value is a valid locale
     *
     * @param string $locale
     * @param string $exception false = throw no exception true = throw an exception
     *
     * @return boolean
     */
    public static function isValid($locale, $exception = true)
    {
        $isValid = in_array(strtolower($locale), self::$localeList) ? true : false;

        if (true === $exception && false === $isValid) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid Locale: %s! Possible Locales: %s",
                    $locale,
                    implode(', ', self::$localeList)
                )
            );
        }

        return $isValid;
    }
}
