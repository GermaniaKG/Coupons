<?php
namespace Germania\Coupons;

class CouponSheetAbstract implements CouponSheetInterface
{

    /**
     * @var int|string
     */
    public $id;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $name;

    /**
     * @var DateTime|null
     */
    public $valid_from;

    /**
     * @var DateTime|null
     */
    public $valid_until;

    /**
     * @var string
     */
    public $coupons;


    /**
     * @return int
     * @implements CouponSheetInterface
     */
    public function getId() {
        return $this->id;
    }


    /**
     * @return string
     * @implements CouponSheetInterface
     */
    public function getSlug(){
        return $this->slug;
    }


    /**
     * @return string
     * @implements CouponSheetInterface
     */
    public function getName() {
        return $this->name;
    }


    /**
     * @return DateTime
     * @implements CouponSheetInterface
     */
    public function getValidFrom() {
        return $this->valid_from;
    }


    /**
     * @return DateTime
     * @implements CouponSheetInterface
     */
    public function getValidUntil() {
        return $this->valid_until;
    }


    /**
     * @return CouponInterface[]
     * @implements CouponSheetInterface
     */
    public function getCoupons() {
        return $this->coupons;
    }


    /**
     * @return bool
     * @implements ValidCouponInterface
     */
    public function isValid()
    {
        if (!$valid_from = $this->getValidFrom()
        or  !$valid_from instanceOf \DateTimeInterface )
            return false;

        // is valid_from in future?
        if ( mktime() < $valid_from->getTimestamp())
            return false;

        // So there's only to check if expired.
        return !$this->isExpired();

    }


    /**
     * @return bool
     * @implements ValidCouponInterface
     */
    public function isExpired()
    {
        if (!$valid_until = $this->getValidUntil()
        or  !$valid_until instanceOf \DateTimeInterface)
            return false;

        return (mktime() > $valid_until->getTimestamp() );
    }


}
