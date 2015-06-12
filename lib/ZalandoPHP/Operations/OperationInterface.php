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

namespace ZalandoPHP\Operations;

interface OperationInterface
{
    /**
     * Gets the name of the operation
     *
     * @return string
     */
    public function getName();

    /**
     * Gets the endpoint of the operation
     *
     * @return string
     */
    public function getEndpoint();

    /**
     * Returns all parameters belonging to the current operation
     *
     * @return array
     */
//    public function getOperationParameter();

    /**
     * Returns all filters belonging to the current operation
     *
     * @return array
     */
    public function getOperationFilter();
}
