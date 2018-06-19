<?php
namespace Germania\Coupons;

class PdoCouponsFactory
{

    /**
     * @var string
     */
    public $php_class;


    /**
     * @var PDOStatement
     */
    public $stmt;

    /**
     * @param \PDO   $pdo
     * @param string $coupons_table
     * @param string $php_class
     */
    public function __construct( \PDO $pdo, $coupons_table, $php_class = null)
    {
        $this->php_class = $php_class ?: Coupon::class;

        $sql = "SELECT
        -- id field twice here due to FETCH_UNIQUE
        id,
        id,
        code,
        coupon_sheet_id

        FROM `{$coupons_table}`

        WHERE coupon_sheet_id = :sheet_id";

        $this->stmt = $pdo->prepare( $sql );

    }


    public function __invoke( $sheet_id, $php_class = null )
    {
        if ($sheet_id instanceOf CouponSheetInterface)
            $sheet_id = $sheet_id->getId();

        if (!$this->stmt->execute([
            'sheet_id' => $sheet_id
        ])) {
            throw new \RuntimeException("Could not execute PDOStatement.");
        }

        return $this->stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_UNIQUE, $php_class ?: $this->php_class );

    }

}

