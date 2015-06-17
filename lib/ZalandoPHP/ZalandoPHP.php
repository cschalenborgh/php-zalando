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

namespace ZalandoPHP;

use ZalandoPHP\Configuration\ConfigurationInterface;
use ZalandoPHP\Operations\OperationInterface;
use ZalandoPHP\Request\RequestFactory;

class ZalandoPHP
{
    const VERSION = '1.0.0-DEV';
    const DEBUG   = true;

    /**
     * Configuration
     *
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration = null)
    {
        $this->configuration = $configuration;
    }

    /**
     * Runs the given operation
     *
     * @param OperationInterface     $operation     The operation object
     * @param ConfigurationInterface $configuration The configuration object
     *
     * @return mixed
     */
    public function runOperation(OperationInterface $operation)
    {
        $configuration = @is_null($configuration) ? $this->configuration : $configuration;

        if (true === is_null($configuration)) {
            throw new \Exception('No configuration passed.');
        }

        $requestObject = RequestFactory::createRequest($configuration);

        $response = $requestObject->perform($operation);

        if($this->configuration->getResponseType() == 'object') {
            return json_decode($response);
        }
        else {
            return json_decode($response, true);
        }
    }
}
