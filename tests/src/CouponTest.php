<?php
namespace tests;

use Germania\Coupons\CouponInterface;
use Germania\Coupons\CouponSheetInterface;
use Germania\Coupons\ValidCouponInterface;
use Germania\Coupons\Coupon;

class CouponTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation()
    {
        $sut = new Coupon;

        $this->assertInstanceOf( ValidCouponInterface::class, $sut);
        $this->assertInstanceOf( CouponInterface::class, $sut);
    }


    public function testFluidInterface()
    {
        $sut = new Coupon;

        $result = $sut->setCode( "foo" );
        $this->assertEquals($result, $sut);

        $coupon_sheet = $this->prophesize( CouponSheetInterface::class );
        $coupon_sheet_mock = $coupon_sheet->reveal();

        $result = $sut->setCouponSheet( $coupon_sheet_mock );
        $this->assertEquals($result, $sut);

    }

    public function testCodeInterceptors()
    {
        $sut = new Coupon;

        $code = "foo";

        $current = $sut->getCode();
        $this->assertNotEquals($current, $code);

        $result = $sut->setCode( $code )->getCode();
        $this->assertEquals($result, $code);
    }

    public function testCouponSheetInterceptors()
    {
        $sut = new Coupon;

        $coupon_sheet = $this->prophesize( CouponSheetInterface::class );
        $coupon_sheet_mock = $coupon_sheet->reveal();

        $current = $sut->getCouponSheet();
        $this->assertNotEquals($current, $coupon_sheet_mock);

        $result = $sut->setCouponSheet( $coupon_sheet_mock )->getCouponSheet();
        $this->assertEquals($result, $coupon_sheet_mock);
    }

    public function testFromArrayFactory()
    {
        $coupon_sheet = $this->prophesize( CouponSheetInterface::class );
        $coupon_sheet_mock = $coupon_sheet->reveal();

        $raw_data = array(
            'code' => 'abcde',
            'coupon_sheet' => $coupon_sheet_mock
        );

        $result = Coupon::fromArray( $raw_data );
        $this->assertInstanceOf( Coupon::class, $result );
        $this->assertEquals( $result->getCode(), $raw_data['code'] );
        $this->assertEquals( $result->getCouponSheet(), $raw_data['coupon_sheet'] );
        $this->assertEquals( $result->getCouponSheet(), $coupon_sheet_mock );

    }
}
