<?php
namespace tests;

use Germania\Coupons\CouponSheetInterface;
use Germania\Coupons\CouponSheetAbstract;

class CouponSheetAbstractTest extends \PHPUnit\Framework\TestCase
{

    public function testStringInterceptors()
    {
        $stub = $this->getMockForAbstractClass( CouponSheetAbstract::class );
        $this->assertEmpty( $stub->id );
        $this->assertEmpty( $stub->slug );
        $this->assertEmpty( $stub->name );

        // Some value
        $value = "foo";

        // Test if actual values are different
        $this->assertNotEquals($stub->getId(), $value);
        $this->assertNotEquals($stub->getSlug(), $value);
        $this->assertNotEquals($stub->getName(), $value);

        // Assign new values
        $stub->id   = $value;
        $stub->slug = $value;
        $stub->name = $value;

        $this->assertEquals ($stub->getId(),   $value);
        $this->assertEquals ($stub->getSlug(), $value);
        $this->assertEquals ($stub->getName(), $value);

    }

    public function testCouponsInterceptor()
    {
        $stub = $this->getMockForAbstractClass( CouponSheetAbstract::class );
        $this->assertEmpty( $stub->coupons );

        $coupons = array("foo", "bar");

        $this->assertNotEquals($stub->getCoupons(), $coupons);

        $stub->coupons = $coupons;
        $this->assertEquals($stub->getCoupons(), $coupons);
    }


    public function testDateTimeInterceptors()
    {
        $stub = $this->getMockForAbstractClass( CouponSheetAbstract::class );

        $this->assertEmpty( $stub->valid_from );
        $this->assertEmpty( $stub->valid_until );

        $datetime = new \DateTime;

        $this->assertNotEquals($stub->getValidFrom(), $datetime);
        $this->assertNotEquals($stub->getValidUntil(), $datetime);

        $stub->valid_from = $datetime;
        $stub->valid_until = $datetime;
        $this->assertEquals( $datetime, $stub->getValidFrom() );
        $this->assertEquals( $datetime, $stub->getValidUntil() );
    }


    public function testCouponSheetValid( )
    {
        $stub = $this->getMockForAbstractClass( CouponSheetAbstract::class );
        $this->assertEmpty( $stub->valid_from );
        $this->assertFalse( $stub->isValid() );

        $stub->valid_from = new \DateTime( "2 days ago" );
        $this->assertTrue( $stub->isValid() );

        $stub->valid_from = new \DateTime('first day of next month');
        $this->assertFalse( $stub->isValid() );
    }

    public function testCouponSheetExpired( )
    {
        $stub = $this->getMockForAbstractClass( CouponSheetAbstract::class );
        $this->assertEmpty( $stub->valid_until );
        $this->assertFalse( $stub->isExpired() );

        $stub->valid_until = new \DateTime( "2 days ago" );
        $this->assertTrue( $stub->isExpired() );

        $stub->valid_until = new \DateTime('first day of next month');
        $this->assertFalse( $stub->isExpired() );
    }




}
