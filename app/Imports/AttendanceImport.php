<?php

namespace App\Imports;

use App\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class AttendanceImport implements ToModel, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $header = array(
            'ID'     => $row[0],
            'check'    => $row[1],
            'type'    => $row[2],
            'unknown1'    => $row[3],
            'unknown2'    => $row[4],
        );
        return new Attendance($header);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "\t",
        ];
    }
}
