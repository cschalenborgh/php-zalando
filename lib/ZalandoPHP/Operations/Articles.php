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
 * Articles
 *
 * @see    https://github.com/zalando/shop-api-documentation/wiki/Articles
 * @author Chris Schalenborgh <chris@schalenborgh.be>
 */
class Articles extends AbstractOperation
{
    const SORT_POPULARITY       = 'popularity';
    const SORT_ACTIVATION_DATE  = 'activationDate';
    const SORT_PRICE_DESC       = 'priceDesc';
    const SORT_PRICE_ASC        = 'priceAsc';
    const SORT_SALE             = 'sale';

    protected $endpoint       = 'articles/{articleId}';

    public function __construct($articleId = '')
    {
        $this->endpoint = str_replace('{articleId}', $articleId, $this->endpoint);
    }

    /**
     * Sets the resultpage to a specified value
     * Allows to browse resultsets which have more than one page
     *
     * @param integer $page
     *
     * @return \ZalandoPHP\Operations\Articles
     */
    public function setPage($page)
    {
        if (false === is_numeric($page) || $page < 1) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s is an invalid page value. It has to be numeric and positive',
                    $page
                )
            );
        }

        $this->filter['page'] = $page;

        return $this;
    }

    /**
     * Sets the size of te resultset to a specified value
     *
     * @param integer $pageSize
     *
     * @return \ZalandoPHP\Operations\Articles
     */
    public function setPageSize($pageSize)
    {
        if (false === is_numeric($pageSize) || $pageSize < 1 || $pageSize > 200) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s is an invalid page value. It has to be numeric, positive and between than 1 and 200',
                    $pageSize
                )
            );
        }

        $this->filter['pageSize'] = $pageSize;

        return $this;
    }

    /**
     * Sort the results based on a predefined parameter
     * @see https://github.com/zalando/shop-api-documentation/wiki/Articles#sorting-articles
     *
     * @param string $sort
     *
     * @return \ZalandoPHP\Operations\Articles
     */
    public function setSort($sort)
    {
        $validSortingMethods = array(
            self::SORT_POPULARITY,
            self::SORT_ACTIVATION_DATE,
            self::SORT_PRICE_ASC,
            self::SORT_PRICE_DESC,
            self::SORT_SALE
        );

        if (!in_array($sort, $validSortingMethods)) {
            throw new \InvalidArgumentException(sprintf(
                "Invalid sorting method '%s' passed. Valid types are: '%s'",
                $sort,
                implode(', ', $validSortingMethods)
            ));
        }

        $this->filter['sort'] = $sort;

        return $this;
    }

    /**
     * Allow fulltext search for articles
     * @see https://github.com/zalando/shop-api-documentation/wiki/Articles#fulltext-search-for-articles
     *
     * @param string $search
     *
     * @return \ZalandoPHP\Operations\Articles
     */
    public function setFullText($search)
    {

        if(!Empty($search)) {

            $this->filter['fullText'] = $search;

        }

        return $this;

    }

}
