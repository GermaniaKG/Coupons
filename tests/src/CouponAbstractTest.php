<?php
namespace tests;

use Germania\Coupons\CouponSheetInterface;
use Germania\Coupons\CouponAbstract;

class CouponAbstractTest extends \PHPUnit\Framework\TestCase
{

    public function testCodeGetter()
    {
        $stub = $this->getMockForAbstractClass( CouponAbstract::class );
        $this->assertEmpty( $stub->code );

        $code = "foo";

        $this->assertNotEquals($stub->getCode(), $code);

        $stub->code = $code;
        $this->assertEquals ($stub->getCode(), $code);

    }

    public function testCouponSheetGetter()
    {
        $stub = $this->getMockForAbstractClass( CouponAbstract::class );
        $this->assertEmpty( $stub->coupon_sheet );

        $coupon_sheet = $this->prophesize( CouponSheetInterface::class );
        $coupon_sheet_mock = $coupon_sheet->reveal();

        $this->assertNotEquals($stub->getCouponSheet(), $coupon_sheet_mock);

        $stub->coupon_sheet = $coupon_sheet_mock;
        $this->assertEquals($stub->getCouponSheet(), $coupon_sheet_mock);
    }


    /**
     * @dataProvider provideBooleans
     */
    public function testCouponSheetValid( $result )
    {
        $stub = $this->getMockForAbstractClass( CouponAbstract::class );

        $this->assertEmpty( $stub->coupon_sheet );
        $this->assertFalse( $stub->isValid() );

        $coupon_sheet = $this->prophesize( CouponSheetInterface::class );
        $coupon_sheet->isValid()->willReturn( $result );
        $coupon_sheet_mock = $coupon_sheet->reveal();

        $stub->coupon_sheet = $coupon_sheet_mock;
        $this->assertEquals( $result, $stub->isValid() );
    }


    /**
     * @dataProvider provideBooleans
     */
    public function testCouponSheetExpired( $result )
    {
        $stub = $this->getMockForAbstractClass( CouponAbstract::class );

        $this->assertEmpty( $stub->coupon_sheet );
        $this->assertFalse( $stub->isExpired() );

        $coupon_sheet = $this->prophesize( CouponSheetInterface::class );
        $coupon_sheet->isExpired()->willReturn( $result );
        $coupon_sheet_mock = $coupon_sheet->reveal();

        $stub->coupon_sheet = $coupon_sheet_mock;
        $this->assertEquals( $result, $stub->isExpired() );
    }


    public function provideBooleans()
    {
        return array(
            [ true ],
            [ false ]
        );
    }
}
