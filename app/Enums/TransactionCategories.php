<?php

namespace App\Enums;

class TransactionCategories
{
    public const ELECTRONICS = [
        "name" => "Electronics",
        "eligibleForPoints" => true
    ];

    public const TRAVEL = [
        "name" => "Travel",
        "eligibleForPoints" => true
    ];

    public const GROCERY = [
        "name" => "Grocery",
        "eligibleForPoints" => true
    ];

    public const DINING = [
        "name" => "Dining",
        "eligibleForPoints" => true
    ];

    public const UTILITIES = [
        "name" => "Utiities",
        "eligibleForPoints" => true
    ];

    public const GAS = [
        "name" => "GAS",
        "eligibleForPoints" => true
    ];

    public const PAYMENT = [
        "name" => "Payment",
        "eligibleForPoints" => false
    ];

    public const FINANCE_CHARGE = [
        "name" => "Finance Charge",
        "eligibleForPoints" => false
    ];

    public const CASH_ADVANCE = [
        "name" => "Cash Advance",
        "eligibleForPoints" => false
    ];
}