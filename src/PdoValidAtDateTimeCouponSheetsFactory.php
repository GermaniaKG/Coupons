<?php
namespace Germania\Coupons;

class PdoValidAtDateTimeCouponSheetsFactory
{

    /**
     * @var PDOStatement
     */
    public $stmt;


    /**
     * @var string
     */
    public $php_class;


    /**
     * @param \PDO   $pdo
     * @param string $sheets_table
     * @param string $coupons_table
     * @param string $php_class
     */
    public function __construct( \PDO $pdo, $sheets_table, $coupons_table, $php_class = null)
    {
        $this->php_class = $php_class ?: CouponSheet::class;

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

        WHERE (valid_until IS NULL OR valid_until >= :datetime_string)
        AND   (valid_from  <= :datetime_string)

        GROUP BY Sheets.id";

        $this->stmt = $pdo->prepare( $sql );
    }


    /**
     * @return ArrayIterator
     */
    public function __invoke( \DateTimeInterface $when, $php_class = null )
    {
        if (!$this->stmt->execute([
            'datetime_string' => $when->format("Y-m-d H:i:s")
        ])) {
            throw new \RuntimeException("Could not execute PDOStatement.");
        }


        $sheets = $this->stmt->fetchAll(\PDO::FETCH_CLASS, $php_class ?: $this->php_class);

        return new \ArrayIterator( $sheets );
    }

}

