<?php

namespace App\Business\Category\Port\Application;

interface DeleteCategory {
    public function execute(int $id): void;
}