<?php
namespace Germania\Coupons;

class PdoAllCouponSheets implements \Countable, \IteratorAggregate
{

    public $coupon_sheets = array();

    /**
     * @param \PDO   $pdo
     * @param string $sheets_table
     * @param string $coupons_table
     * @param string $php_class
     */
    public function __construct( \PDO $pdo, $sheets_table, $coupons_table, $php_class = null)
    {
        $sql = "SELECT
        Sheets.id,
        Sheets.slug,
        Sheets.name,
        Sheets.valid_from,
        Sheets.valid_until,
        GROUP_CONCAT(Coupons.code) AS coupons

        FROM `{$sheets_table}` Sheets

        RIGHT JOIN `{$coupons_table}` Coupons
        ON Coupons.coupon_sheet_id = Sheets.id

        GROUP BY Sheets.id";

        $stmt = $pdo->prepare( $sql );

        if (!$stmt->execute()) {
            throw new \RuntimeException("Could not execute PDOStatement.");
        }

        $this->coupon_sheets = $stmt->fetchAll(\PDO::FETCH_CLASS, $php_class ?: CouponSheet::class);
    }


    public function count()
    {
        return count($this->coupon_sheets);
    }


    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator( $this->coupon_sheets);
    }
}

