<?php
namespace Germania\Coupons;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundException;

class PdoCouponSheetContainer implements ContainerInterface
{

    public $instances = array();
    /**
     * @var callable
     */
    public $sheet_factory;

    public function __construct( callable $sheet_factory )
    {
        $this->sheet_factory = $sheet_factory;
    }

    /**
     * @param  string|int $id
     */
    public function has( $id )
    {
        if (array_key_exists( $id, $this->instances))
            return !empty( $this->instances[ $id ] );

        $sheet_factory = $this->sheet_factory;

        $this->instances[ $id ] = $sheet_factory( $id );
        return !empty( $this->instances[ $id ] );
    }


    /**
     * @param  string|int $id
     */
    public function get( $id )
    {
        if (!empty( $this->instances[ $id ]))
            return $this->instances[ $id ];

        if (!$instance = $sheet_factory( $id ))
            throw new CouponSheetNotFoundException("Could not find a coupon sheet with ID $id");


        $this->instances[ $id ] = $instance;
        return $instance;
    }

}

