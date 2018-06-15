<?php
namespace Germania\Coupons;

interface CouponSheetInterface extends ValidCouponInterface
{
    /**
     * @return int
     */
    public function getId();


    /**
     * @return string
     */
    public function getSlug();


    /**
     * @return string
     */
    public function getName();


    /**
     * @return DateTime
     */
    public function getValidFrom();


    /**
     * @return DateTime
     */
    public function getValidUntil();


    /**
     * @return CouponInterface[]
     */
    public function getCoupons();

}
