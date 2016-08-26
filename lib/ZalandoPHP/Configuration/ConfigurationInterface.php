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

interface ConfigurationInterface
{
    /**
     * Gets the client name
     *
     * @return string
     */
    public function getClientName();

    /**
     * Gets the locale name
     *
     * @return string
     */
    public function getLocale();

    /**
     * Gets the timeout
     *
     * @return int
     */
    public function getTimeout();

    /**
     * Gets the connection timeout
     *
     * @return int
     */
    public function getConnectionTimeout();

    /**
     * Gets the requestclass
     *
     * @return string
     */
    public function getRequest();

    /**
     * Gets the responsetransformerclass
     *
     * @return string
     */
//    public function getResponseTransformer();

    /**
     * Gets the request factory callback if it is set
     * This callback can be used to manipulate the request before its returned.
     *
     * @return \Closure|array|string
     */
    public function getRequestFactory();

    /**
     * Gets the responsetransformer factory callback if it is set
     * This callback can be used to manipulate the request before its returned.
     *
     * @return \Closure|array|string
     */
//    public function getResponseTransformerFactory();
}
