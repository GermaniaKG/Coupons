<?php
namespace Germania\Coupons;

class Coupon extends CouponAbstract implements CouponInterface
{

    public function setCode( $code )
    {
        $this->code = $code;
        return $this;
    }

    public function setCouponSheet( CouponSheetInterface $coupon_sheet )
    {
        $this->coupon_sheet = $coupon_sheet;
        return $this;
    }

   public static function fromArray( array $array) {
       $instance = new self();
       $instance->code         = $array['code'];
       $instance->coupon_sheet = $array['coupon_sheet'];
       return $instance;
   }
}
