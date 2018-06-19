<?php
namespace Germania\Coupons;

class PdoCouponSheetFactory
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

        WHERE Sheets.id = :id
        LIMIT 1";

        $this->stmt = $pdo->prepare( $sql );

    }

    /**
     * @param  string|int $id
     * @param  string $php_class
     * @return CouponSheet|null
     */
    public function __invoke( $id, $php_class = null )
    {
        if (!$stmt->execute([
            'id' => $id
        ])) {
            throw new \RuntimeException("Could not execute PDOStatement.");
        }

        return $stmt->fetch(\PDO::FETCH_CLASS, $php_class ?: $this->php_class);
    }

}

