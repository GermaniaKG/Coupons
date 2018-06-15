<?php
namespace Germania\Coupons;

interface CouponInterface extends ValidCouponInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @return CouponSheetInterface
     */
    public function getCouponSheet();


}
