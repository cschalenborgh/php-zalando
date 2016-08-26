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

use ZalandoPHP\Configuration\Locale;

/**
 * A generic configurationclass
 *
 * @author Jan Eichhorn <exeu65@googlemail.com>
 */
class GenericConfiguration implements ConfigurationInterface
{
    /**
     * The locale
     *
     * @var string
     */
    protected $locale;

    /**
     * The available response types
     *
     * @var string
     */
    protected $responseTypes = ['object', 'array'];

    /**
     * The response type
     *
     * @var string
     */
    protected $responseType;

    /**
     * The accesskey
     *
     * @var string
     */
    protected $clientName;

    /**
     * The requestclass
     * By default its set to the provided restful request
     *
     * @var string
     */
    protected $request = "\ZalandoPHP\Request\Rest\Request";

    /**
     * A callback which is called before returning the request by the factory
     *
     * @var \Closure|array|string
     */
    protected $requestFactory = null;

    /**
     * The responsetransformerclass
     * By default its set to null which means that no transformer will be applied
     *
     * @var string
     */
    protected $responseTransformer = null;

    /**
     * A callback which is called before returning the responsetransformer by the factory
     *
     * @var \Closure|array|string
     */
    protected $responseTransformerFactory = null;

    /**
     * The timeout
     *
     * @var int
     */
    protected $timeout = null;

    /**
     * The connection timeout
     *
     * @var int
     */
    protected $connection_timeout = null;

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Sets an validates the locale
     *
     * @param string $locale
     *
     * @return \ZalandoPHP\Configuration\GenericConfiguration
     */
    public function setLocale($locale)
    {
        Locale::isValid($locale);

        $this->locale = strtolower($locale);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * Sets the response type
     *
     * @param string $response_type
     */
    public function setResponseType($responseType)
    {
        if(in_array(strtolower($responseType), $this->responseTypes)) {
            $this->responseType = strtolower($responseType);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Sets the clientName
     *
     * @param string $clientName
     *
     * @return \ZalandoPHP\Configuration\GenericConfiguration
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the requestclass
     *
     * @param string $request
     *
     * @return \ZalandoPHP\Configuration\GenericConfiguration
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestFactory()
    {
        return $this->requestFactory;
    }

    /**
     * Sets the request factory callback
     *
     * @param \Closure|array|string $callback
     *
     * @return \ZalandoPHP\Configuration\GenericConfiguration
     */
    public function setRequestFactory($callback)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException("Given argument is not callable");
        }

        $this->requestFactory = $callback;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Sets the timeout
     *
     * @param string $timeout
     *
     * @return \ZalandoPHP\Configuration\GenericConfiguration
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnectionTimeout()
    {
        return $this->connection_timeout;
    }

    /**
     * Sets the connection_timeout
     *
     * @param string $connection_timeout
     *
     * @return \ZalandoPHP\Configuration\GenericConfiguration
     */
    public function setConnectionTimeout($connection_timeout)
    {
        $this->connection_timeout = $connection_timeout;

        return $this;
    }
}
