<?php


namespace App;


class Helper
{

    static function calculateTax($amount, $tax){
        return round(($amount * ($tax / 100)));
    }

    static function getStatus($status){
        switch (strtolower($status)){
            case "pending":
                return "<span style='color:#ed7b1d; font-weight: bold; font-style: italic'>Pending</span>";
                break;
            case "completed":
                return "<span style='color:green; font-weight: bold; font-style: italic'>Completed</span>";
                break;
            case "off":
                return "<span style='color:darkorange; font-weight: bold; font-style: italic'>OFF</span>";
                break;
            case "on":
                return "<span style='color:green; font-weight: bold; font-style: italic'>ON</span>";
                break;
            case "active":
                return "<span style='color:#f02145; font-weight: bold; font-style: italic'>In-Active</span>";
                break;
            case "in-active":
                return "<span style='color:green; font-weight: bold; font-style: italic'>Active</span>";
                break;
            default:
                break;
        }
    }
}