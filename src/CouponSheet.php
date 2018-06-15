<?php
namespace Germania\Coupons;

class CouponSheet extends CouponSheetAbstract implements CouponSheetInterface
{

    /**
     * @param  string $id
     * @return self Fluid Interface
     */
    public function setId( $id ) {
        $this->id = $id;
        return $this;
    }


    /**
     * @param string $id
     * @return self Fluid Interface
     */
    public function setSlug( $slug ) {
        $this->slug = $slug;
        return $this;
    }


    /**
     * @param string $id
     * @return self Fluid Interface
     */
    public function setName( $name ) {
        $this->name = $name;
        return $this;
    }





    /**
     * @param DateTimeInterface $valid_from
     * @return self Fluid Interface
     */
    public function setValidFrom( \DateTimeInterface $valid_from ) {
        $this->valid_from = $valid_from;
        return $this;
    }


    /**
     * @inheritdoc
     *
     * If the valid_from value is a datetime string (like "Y-m-d H:i:s"),
     * the value will be converted to a DateTime object.
     *
     * @return DateTime
     * @implements CouponSheetInterface
     */
    public function getValidFrom() {
        if ($this->valid_from and is_string($this->valid_from)):
            $this->setValidFrom( \DateTime::createFromFormat("Y-m-d H:i:s", $this->valid_from) );
        endif;
        return $this->valid_from;
    }



    /**
     * @param DateTimeInterface $valid_until
     * @return self Fluid Interface
     */
    public function setValidUntil( \DateTimeInterface $valid_until ) {
        $this->valid_until = $valid_until;
        return $this;
    }

    /**
     * @inheritdoc
     *
     * If the valid_until value is a datetime string (like "Y-m-d H:i:s"),
     * the value will be converted to a DateTime object.
     *
     * @return DateTime
     * @implements CouponSheetInterface
     */
    public function getValidUntil() {
        if ($this->valid_until and is_string($this->valid_until)):
            $this->setValidUntil( \DateTime::createFromFormat("Y-m-d H:i:s", $this->valid_until) );
        endif;

        return $this->valid_until;
    }



    /**
     * @return CouponInterface[]
     * @implements CouponSheetInterface
     */
    public function getCoupons() {
        if ($this->coupons and is_string( $this->coupons ))
            $this->setCoupons( $this->coupons );

        return $this->coupons;
    }


    /**
     * @param array|\Traversable $coupons
     * @return self Fluid Interface
     */
    public function setCoupons( $coupons )
    {
        if ($coupons instanceOf \Traversable ):
            $coupons = iterator_to_array( $coupons, "use_keys");

        elseif (is_string( $coupons )):
            $instances = array();
            foreach(explode(",", $coupons) as $raw_coupon)
                array_push($instances, Coupon::fromArray([
                    'code' => $raw_coupon,
                    'coupon_sheet' => $this
                ]));
            $coupons = $instances;

        elseif (!is_array( $coupons )):
            throw new \InvalidArgumentException("Array or Traversable expected");

        endif;

        $this->coupons = $coupons;
        return $this;
    }


}
