<?php
namespace tests;

use Germania\Coupons\CouponSheetInterface;
use Germania\Coupons\CouponSheet;

class CouponSheetTest extends \PHPUnit\Framework\TestCase
{
    public function testStringSetters()
    {
        $sut = new CouponSheet;
        $value = "foo";

        $this->assertEmpty( $sut->getId() );
        $this->assertEmpty( $sut->getSlug() );
        $this->assertEmpty( $sut->getName() );

        $this->assertEquals($sut->setId( $value )->getId(), $value);
        $this->assertEquals($sut->setSlug( $value )->getSlug(), $value);
        $this->assertEquals($sut->setName( $value )->getName(), $value);
    }


    public function testDateTimeSetters()
    {
        $sut = new CouponSheet;

        $dt = new \DateTime;

        $this->assertEmpty( $sut->getValidFrom() );
        $this->assertEmpty( $sut->getValidUntil() );

        $this->assertEquals($sut->setValidFrom( $dt )->getValidFrom(), $dt);
        $this->assertEquals($sut->setValidUntil( $dt )->getValidUntil(), $dt);
    }


    public function testDateTimeGetters()
    {
        $sut = new CouponSheet;

        $dt_string = '2017-11-11 11:11:11';

        $this->assertEmpty( $sut->getValidFrom() );
        $this->assertEmpty( $sut->getValidUntil() );

        $sut->valid_from  = $dt_string;
        $sut->valid_until = $dt_string;

        $converted_valid_from  = $sut->getValidFrom();
        $converted_valid_until = $sut->getValidUntil();

        $this->assertInstanceOf ( \DateTime::class, $converted_valid_from);
        $this->assertInstanceOf ( \DateTime::class, $converted_valid_until);

        $this->assertEquals ( $dt_string, $converted_valid_from->format("Y-m-d H:i:s"));
        $this->assertEquals ( $dt_string, $converted_valid_until->format("Y-m-d H:i:s"));
    }


    public function testCouponSheetSetter()
    {
        $sut = new CouponSheet;

        $cs = array("foo", "bar");
        $cs_iterator = new \ArrayIterator( $cs );

        $this->assertEmpty( $sut->getCoupons() );

        $this->assertEquals($sut->setCoupons( $cs )->getCoupons(), $cs);
        $this->assertEquals($sut->setCoupons( $cs_iterator )->getCoupons(), $cs);

        $sut->setCoupons( "foo,bar" );
        $this->assertInternalType( "array", $sut->getCoupons());

        $this->expectException( \InvalidArgumentException::class );
        $sut->setCoupons( 42);
    }


    public function testCouponSheetGetter()
    {
        $sut = new CouponSheet;
        $this->assertEmpty( $sut->getCoupons() );

        $coupons_string = "foo,bar";
        $sut->coupons = $coupons_string;

        $this->assertInternalType("array", $sut->getCoupons());
    }


}
