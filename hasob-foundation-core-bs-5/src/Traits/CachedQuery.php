<?php

namespace Hasob\FoundationCore\Traits;

use Hasob\FoundationCore\Support\CachedQueryBuilder;

trait CachedQuery
{
    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $conn = $this->getConnection();

        $grammar = $conn->getQueryGrammar();

        return new CachedQueryBuilder($conn, $grammar, $conn->getPostProcessor());
    }
}