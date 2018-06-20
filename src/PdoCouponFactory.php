<?php
namespace Germania\Coupons;

class PdoCouponFactory
{

    /**
     * @var string
     */
    public $php_class;

    /**
     * @var callable
     */
    public $coupon_sheet_factory;


    /**
     * @var PDOStatement
     */
    public $stmt;

    /**
     * @param \PDO   $pdo
     * @param string $coupons_table
     * @param callable $coupon_sheet_factory
     * @param string $php_class
     */
    public function __construct( \PDO $pdo, $coupons_table, callable $coupon_sheet_factory, $php_class = null)
    {
        $this->php_class = $php_class ?: Coupon::class;

        if (!is_subclass_of($this->php_class, CouponInterface::class ))
            throw new \InvalidArgumentException("Class name or instance of CouponInterface expected.");

        $sql = "SELECT
        id,
        code,
        coupon_sheet_id AS coupon_sheet

        FROM `{$coupons_table}`

        WHERE code = :code
        LIMIT 1";

        $this->stmt = $pdo->prepare( $sql );
        $this->stmt->setFetchMode( \PDO::FETCH_CLASS, $this->php_class );

    }

    /**
     * @param  string|CouponInterface $code
     * @return CouponInterface[]
     */
    public function __invoke( $code )
    {
        if ($code instanceOf CouponInterface)
            $code = $code->getCode();

        if (!$this->stmt->execute([
            'code' => $code
        ])) {
            throw new \RuntimeException("Could not execute PDOStatement.");
        }

        $coupon = $this->stmt->fetch();

        if ($coupon and $this->coupon_sheet_factory):
            $coupon_sheet_factory = $this->coupon_sheet_factory;
            $coupon->coupon_sheet = $coupon_sheet_factory( $coupon->coupon_sheet );
        endif;

        return $coupon;
    }

}

