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

        if (!is_subclass_of($this->php_class, CouponSheetInterface::class ))
            throw new \InvalidArgumentException("Class name or instance of CouponSheetInterface expected.");

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
        $this->stmt->setFetchMode( \PDO::FETCH_CLASS, $this->php_class );

    }

    /**
     * @param  string|int $id
     * @return CouponSheet|null
     */
    public function __invoke( $id )
    {
        if (!$this->stmt->execute([
            'id' => $id
        ])) {
            throw new \RuntimeException("Could not execute PDOStatement.");
        }

        return $this->stmt->fetch();
    }

}

