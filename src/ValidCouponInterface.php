<?php
namespace Germania\Coupons;

interface ValidCouponInterface
{
    /**
     * @return bool
     */
    public function isValid();


    /**
     * @return bool
     */
    public function isExpired();

}
