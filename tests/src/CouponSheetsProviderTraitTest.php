<?php
namespace tests;

use Germania\Coupons\CouponSheetsProviderTrait;

class CouponSheetsProviderTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testCouponSheetsSetter()
    {
        $mock = $this->getMockForTrait( CouponSheetsProviderTrait::class );

        $cs = array("foo", "bar");
        $this->assertNotEquals( $mock->getCouponSheets(), $cs);

        $this->assertObjectHasAttribute( "coupon_sheets", $mock);
        $mock->coupon_sheets = $cs;

        $this->assertEquals( $mock->getCouponSheets(), $cs);
    }
}
