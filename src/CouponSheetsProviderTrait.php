<?php
namespace Germania\Coupons;

trait CouponSheetsProviderTrait
{

    /**
     * @var array
     */
    public $coupon_sheets = array();


    /**
     * @return array
     * @implements CouponSheetsProviderInterface
     */
    public function getCouponSheets()
    {
        return $this->coupon_sheets;
    }

}
