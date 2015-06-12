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

namespace ZalandoPHP\Request\Rest;

use ZalandoPHP\ZalandoPHP;
use ZalandoPHP\Configuration\ConfigurationInterface;
use ZalandoPHP\Operations\OperationInterface;
use ZalandoPHP\Request\RequestInterface;
use ZalandoPHP\Request\Util;

/**
 * Basic implementation of the rest request
 *
 * @see    http://docs.aws.amazon.com/AWSECommerceService/2011-08-01/DG/AnatomyOfaRESTRequest.html
 * @author Jan Eichhorn <exeu65@googlemail.com>
 */
class Request implements RequestInterface
{
    /**
     * Connection time out in seconds
     *
     * @var int
     */
    const CONNECTION_TIMEOUT = CURLOPT_CONNECTTIMEOUT;

    /**
     * Time out in seconds
     *
     * @var int
     */
    const TIMEOUT = CURLOPT_TIMEOUT;

    /**
     * Enable/Disable location following
     *
     * @var int
     */
    const FOLLOW_LOCATION = CURLOPT_FOLLOWLOCATION;

    /**
     * Useragent
     *
     * @var string
     */
    const USERAGENT = CURLOPT_USERAGENT;

    /**
     * curl options
     *
     * @var array
     */
    private $options = array();

    /**
     * The requestscheme
     *
     * @var string
     */
    protected $requestScheme = "http://api.zalando.com/";

    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * Initialize instance
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->options = array(
            self::USERAGENT          => "ZalandoPHP [" . ZalandoPHP::VERSION . "]",
            self::CONNECTION_TIMEOUT => 10,
            self::TIMEOUT            => 10,
            self::FOLLOW_LOCATION    => 1
        );
        $this->setOptions($options);
    }

    /**
     * Sets the curl options
     *
     * @param array $options
     */
    public function setOptions(array $options = array())
    {
        foreach ($options as $currentOption => $currentOptionValue) {
            $this->options[$currentOption] = $currentOptionValue;
        }
        $this->options[CURLOPT_RETURNTRANSFER] = 1; // force the return transfer
    }

    /**
     * return the current curl options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function perform(OperationInterface $operation)
    {
        $ch = curl_init();

        if (false === $ch) {
            throw new \RuntimeException("Cannot initialize curl resource");
        }

        //$preparedRequestParams = $this->prepareRequestFilters($operation);
        //$queryString = $this->buildQueryString($preparedRequestParams);
        $headers = $this->buildHeaders();

        $options = $this->options;
        $options[CURLOPT_HTTPHEADER] = $headers;
        $options[CURLOPT_URL] = $this->requestScheme . $operation->getEndpoint(). '?' .http_build_query($operation->getOperationFilter());


//        print_r($operation->getOperationFilter());
        echo $this->requestScheme . $operation->getEndpoint(). '?' .http_build_query($operation->getOperationFilter());
//        exit;

        // show curl debug?
        if(ZalandoPHP::DEBUG) {
            $options[CURLOPT_VERBOSE] = true;
        }

        foreach ($options as $currentOption => $currentOptionValue) {
            if (false === curl_setopt($ch, $currentOption, $currentOptionValue)) {
                throw new \RuntimeException(
                    sprintf(
                        "An error occurred while setting %s with value %s",
                        $currentOption,
                        $currentOptionValue
                    )
                );
            }
        }

        $curlError = false;
        $errorNumber = null;
        $errorMessage = null;

        $result = curl_exec($ch);

        if (false === $result) {
            $curlError = true;
            $errorNumber = curl_errno($ch);
            $errorMessage = curl_error($ch);
        }

        curl_close($ch);

        if ($curlError) {
            throw new \RuntimeException(
                sprintf(
                    "An error occurred while sending request. Error number: %d; Error message: %s",
                    $errorNumber,
                    $errorMessage
                )
            );
        }

        return $result;
    }

    /**
     * Prepares the parameters for the request
     *
     * @param OperationInterface $operation
     *
     * @return array
     */
//    protected function prepareRequestFilters(OperationInterface $operation)
//    {
//        $baseRequestParams = array(
////            'Operation'         => $operation->getName(),
////            'Version'           => '2011-08-01',
////            'Timestamp'         => Util::getTimeStamp()
//        );
//
//        $operationParams = $operation->getOperationFilter();
//
//        foreach ($operationParams as $key => $value) {
//            if (true === is_array($value)) {
//                $operationParams[$key] = implode(',', $value);
//            }
//        }
//
//        $fullParameterList = array_merge($baseRequestParams, $operationParams);
//        ksort($fullParameterList);
//
//        return $fullParameterList;
//    }

    /**
     * Builds the http headers
     *
     * @param array $params
     *
     * @return array
     */
    protected function buildHeaders()
    {
        $headers = [];
        $headers['x-client-name']       = $this->configuration->getClientName();
        $headers['Accept-Language']     = $this->configuration->getLocale();
        $headers['Signature']           = 'ZalandoPHP';

        return $headers;
    }

    /**
     * Builds the final query string
     *
     * @param array $params
     *
     * @return string
     */
//    protected function buildQueryString(array $params)
//    {
//        $parameterList = array();
//        foreach ($params as $key => $value) {
//            $parameterList[] = sprintf('%s=%s', $key, rawurlencode($value));
//        }
//
//        //$parameterList[] = 'Signature=' . rawurlencode($this->buildSignature($parameterList));
//
//        return implode("&", $parameterList);
//    }

    /**
     * Calculates the signature for the request
     *
     * @param array $params
     *
     * @return string
     */
//    protected function buildSignature(array $params)
//    {
//        $template = "GET\nwebservices.amazon.%s\n/onca/xml\n%s";
//
//        return Util::buildSignature(
//            sprintf(
//                $template,
//                $this->configuration->getLocale(),
//                implode('&', $params)
//            ),
//            $this->configuration->getSecretKey()
//        );
//    }
}
