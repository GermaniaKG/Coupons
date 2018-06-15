<?php
namespace tests;

use Germania\Coupons\CouponSheetsAwareTrait;

class CouponSheetsAwareTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testCouponSheetsSetter()
    {
        $mock = $this->getMockForTrait( CouponSheetsAwareTrait::class );

        $cs = array("foo", "bar");
        $cs_iterator = new \ArrayIterator( $cs );

        $this->assertEquals( $mock->setCouponSheets($cs), $mock );

        $this->assertObjectHasAttribute( "coupon_sheets", $mock);

        $mock->setCouponSheets( $cs );
        $this->assertEquals( $mock->coupon_sheets, $cs );

        $mock->setCouponSheets( $cs_iterator );
        $this->assertEquals( $mock->coupon_sheets, $cs );

        $this->expectException( \InvalidArgumentException::class );
        $mock->setCouponSheets( "falsy ");
    }
}
