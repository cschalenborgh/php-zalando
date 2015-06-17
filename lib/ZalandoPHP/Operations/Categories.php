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

/**
 * Categories
 *
 * @see    https://github.com/zalando/shop-api-documentation/wiki/Categories
 * @author Chris Schalenborgh <chris@schalenborgh.be>
 */
class Categories extends AbstractOperation
{
    const TARGET_GROUP_ALL    = 'all';
    const TARGET_GROUP_WOMEN  = 'women';
    const TARGET_GROUP_MEN    = 'men';
    const TARGET_GROUP_KIDS   = 'kids';

    protected $endpoint       = 'categories/{key}';

    public function __construct($category = '')
    {
        $this->endpoint = str_replace('{key}', $category, $this->endpoint);
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

    public function setTargetGroup($targetGroup)
    {
        $validTargetGroups = array(
            self::TARGET_GROUP_ALL,
            self::TARGET_GROUP_WOMEN,
            self::TARGET_GROUP_MEN,
            self::TARGET_GROUP_KIDS
        );

        if (!in_array($targetGroup, $validTargetGroups)) {
            throw new \InvalidArgumentException(sprintf(
                "Invalid targetGroup '%s' passed. Valid types are: '%s'",
                $targetGroup,
                implode(', ', $validTargetGroups)
            ));
        }

        $this->filter['targetGroup'] = $targetGroup;

        return $this;
    }

}
