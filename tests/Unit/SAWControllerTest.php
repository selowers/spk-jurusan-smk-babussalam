<?php

namespace Tests\Unit;

use App\Http\Controllers\SAWController;
use PHPUnit\Framework\TestCase;

class SAWControllerTest extends TestCase
{
    public function test_bobot_kriteria_mengikuti_rumus_excel(): void
    {
        $controller = new SAWController();

        $kriteria = collect([
            (object) ['id_kriteria' => 1, 'nama_kriteria' => 'Pengetahuan Kognitif', 'bobot' => 5 / 12],
            (object) ['id_kriteria' => 2, 'nama_kriteria' => 'Minat dan Bakat', 'bobot' => 4 / 12],
            (object) ['id_kriteria' => 3, 'nama_kriteria' => 'Psikotes', 'bobot' => 3 / 12],
        ]);

        $bobot = $controller->getBobotKriteria($kriteria);

        $this->assertEqualsWithDelta(5 / 12, $bobot[1], 0.000001);
        $this->assertEqualsWithDelta(4 / 12, $bobot[2], 0.000001);
        $this->assertEqualsWithDelta(3 / 12, $bobot[3], 0.000001);
    }
}
