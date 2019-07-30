<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tld extends Model
{
    protected $rate = 2; //3.33;

    public function getRegPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getRetailRegPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getOurRegPriceAttribute()
    {
        $difference = $this->retail_reg_price - $this->reg_price;
        $price = floor($this->reg_price + $difference / $this->rate);
        return $price > $this->reg_price ? $price : $this->reg_price;
    }

    public function getRenewPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getRetailRenewPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getOurRenewPriceAttribute()
    {
        $difference = $this->retail_renew_price - $this->renew_price;
        $price = floor($this->renew_price + $difference / $this->rate);
        return $price > $this->renew_price ? $price : $this->renew_price;
    }

    public function getUpdateContactsPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getUpdateNameserversPriceAttribute($value)
    {
        return $value / 100;
    }
}
