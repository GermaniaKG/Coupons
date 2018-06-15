<?php
namespace tests;

use Germania\Coupons\ValidCouponsFilterIterator;
use Germania\Coupons\ValidCouponInterface;

class ValidCouponsFilterIteratorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideValidCouponInterfaceMockData
     */
    public function testFilter( $filter_status, $result1, $result2, $strange_thingy, $expected_count )
    {
        $o1_mock = $this->prophesize( ValidCouponInterface::class );
        $o1_mock->isValid()->willReturn( $result1 );

        $o2_mock = $this->prophesize( ValidCouponInterface::class );
        $o2_mock->isValid()->willReturn( $result2 );

        $things = new \ArrayIterator([
            $o1_mock->reveal(),
            $o2_mock->reveal(),
            $strange_thingy
        ]);

        $this->sut = new ValidCouponsFilterIterator( $things, $filter_status );

        $filtered_count = iterator_count( $this->sut );
        $this->assertEquals( $expected_count, $filtered_count);
    }


    public function provideValidCouponInterfaceMockData()
    {
        return array(
            [ true,     true,  false, null,     1 ],
            [ false,    true,  false, null,     2 ],

            [ true,     true,  true,  "foo",    2 ],
            [ false,    true,  true,  "foo",    1 ],

            [ true,     false, false,  1,       0 ],
            [ false,    false, false,  1,       3 ],
        );
    }
}
