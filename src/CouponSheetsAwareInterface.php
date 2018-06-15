<?php
namespace Germania\Coupons;

interface CouponSheetsAwareInterface extends CouponSheetsProviderInterface
{


    /**
     * @param array|Traversable $coupon_sheet
     */
    public function setCouponSheets( $coupon_sheets );
}
