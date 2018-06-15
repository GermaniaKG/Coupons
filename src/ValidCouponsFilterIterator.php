<?php
namespace Germania\Coupons;

class ValidCouponsFilterIterator extends \FilterIterator
{

    /**
     * @var boolean
     */
    public $status = true;


    /**
     * @param \Traversable $coupons
     * @param boolean      $status
     */
    public function __construct( \Traversable $coupons, $status = true)
    {
        parent::__construct( new \IteratorIterator( $coupons ));
        $this->status = $status;
    }


    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        if ($current instanceOf ValidCouponInterface):
            return $current->isValid() == $this->status;
        endif;

        return !$this->status;
    }
}
