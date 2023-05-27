<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TestImport implements ToCollection, WithHeadingRow
{
    private $rows = [];
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $this->rows = $rows;

        return;
    }

    public function getRows()
    {
        return $this->rows;
    }
}
