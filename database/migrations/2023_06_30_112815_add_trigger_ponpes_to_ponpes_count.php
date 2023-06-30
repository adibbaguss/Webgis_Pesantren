<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER ponpes_added_trigger AFTER INSERT ON ponpes
        FOR EACH ROW
        BEGIN
            DECLARE year_value INT;
            SET year_value = YEAR(NEW.standing_date);

            INSERT INTO ponpes_count (year, count, created_at, updated_at)
            VALUES (year_value, 1, NOW(), NOW())
            ON DUPLICATE KEY UPDATE count = count + 1;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS ponpes_added_trigger');
    }
};

// Digunakan untuk menampilkan perkembangan ponpes mulai tahun tertentu
// SELECT t1.year, (
//     SELECT SUM(t2.count)
//     FROM ponpes_count t2
//     WHERE t2.year <= t1.year
//   ) AS total_count
//   FROM ponpes_count t1
//   WHERE t1.year >= 2000
//   GROUP BY t1.year
//   ORDER BY t1.year;

// Digunakan untuk menampilkan perkembangan ponpes setiap tahun
// SELECT t1.year, (
//     SELECT SUM(t2.count)
//     FROM ponpes_count t2
//     WHERE t2.year <= t1.year
//   ) AS total_count
//   FROM ponpes_count t1
//   GROUP BY t1.year
//   ORDER BY t1.year;
