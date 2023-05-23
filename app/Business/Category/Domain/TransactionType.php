<?php

namespace App\Business\Category\Domain;

enum TransactionType: int {
    case DEBIT = 1;
    case CREDIT = 2;
}
