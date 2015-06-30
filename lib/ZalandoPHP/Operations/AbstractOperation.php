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

abstract class AbstractOperation implements OperationInterface
{

    // used in query string
    protected $filter = array();

    /**
     * {@inheritdoc}
     */
    public function getOperationFilter()
    {
        return $this->filter;
    }

    /**
     * Get the endpoint name
     */
    public function getName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /*
     * Get the endpoint path, relative to the domain
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Magic setter and getter functions
     *
     * @param string $methodName Methodname
     * @param string $filter  Filters
     *
     * @return \ZalandoPHP\Operations\AbstractOperation
     */
    public function __call($methodName, $filter)
    {
        if (substr($methodName, 0, 3) == 'set') {
            $this->filter[lcfirst(substr($methodName, 3))] = array_shift($filter);

            return $this;
        }

        if (substr($methodName, 0, 3) == 'get') {
            $keyName = lcfirst(substr($methodName, 3));

            return isset($this->filter[$keyName]) ? $this->filter[$keyName] : null;
        }

        throw new \BadFunctionCallException(sprintf('The function "%s" does not exist!', $methodName));
    }
}
