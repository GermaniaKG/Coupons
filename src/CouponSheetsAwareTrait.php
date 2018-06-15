<?php
namespace Germania\Coupons;

trait CouponSheetsAwareTrait
{

    use CouponSheetsProviderTrait;

    /**
     * @param array|Traversable $coupon_sheet
     * @implements CouponSheetsAwareInterface
     * @return self Fluid Interface
     */
    public function setCouponSheets( $coupon_sheets )
    {
        if ($coupon_sheets instanceOf \Traversable)
            $coupon_sheets = iterator_to_array( $coupon_sheets, "use_keys");

        elseif (!is_array($coupon_sheets))
            throw new \InvalidArgumentException("Array or Traversable expected");


        $this->coupon_sheets = $coupon_sheets;
        return $this;
    }



}
