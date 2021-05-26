<?php

namespace App\Contracts;

use App\Models\Visitor;

interface VisitorService
{
    /**
     * Получение Визитера.
     *
     * @return Visitor
     */
    public function get(): Visitor;
}
