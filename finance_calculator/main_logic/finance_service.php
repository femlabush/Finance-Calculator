<?php

class FinanceService {

    // Simple Interest
    // rate in %
    // $time is in years
    public static function simpleInterest($principal, $rate, $time) {
        $interest = ($principal * $rate * $time) / 100;
        $total = $principal + $interest;

        return [
            'interest' => $interest,
            'total' => $total
        ];
    }

    // Compound Interest
    public static function compoundInterest($principal, $rate, $time) {
        $amount = $principal * pow((1 + $rate / 100), $time);
        $interest = $amount - $principal;

        return [
            'interest' => $interest,
            'total' => $amount
        ];
    }
}