<?php
namespace Germania\Coupons;

class CouponAbstract implements CouponInterface
{

    /**
     * @var string
     */
    public $code;

    /**
     * @var CouponSheetInterface
     */
    public $coupon_sheet;


    /**
     * @return string
     * @implements CouponInterface
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * @return CouponSheetInterface
     * @implements CouponInterface
     */
    public function getCouponSheet()
    {
        return $this->coupon_sheet;
    }

    /**
     * @return bool
     * @implements ValidCouponInterface
     */
    public function isValid()
    {
        $sheet = $this->getCouponSheet();
        return $sheet and $sheet->isValid();
    }


    /**
     * @return bool
     * @implements ValidCouponInterface
     */
    public function isExpired()
    {
        $sheet = $this->getCouponSheet();
        return $sheet and $sheet->isExpired();
    }


}
