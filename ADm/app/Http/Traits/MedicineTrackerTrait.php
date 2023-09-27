<?php

namespace App\Http\Traits;

trait MedicineTrackerTrait
{
    public function getId($slug, $value)
    {
        return \App\Models\MdDropdown::where(['slug' => $slug, 'value' => $value])->value('id');
    }

    /**
     * Function: getScheduleDays
     * Functionality: This will return the weekdays user have selected
     *
     * @param string $type
     * @param object $startDate
     * @param object $endDate
     * @param array $specificDays
     *
     * @return array
     */
    public function getScheduleDays($type, $startDate, $endDate, $specificDays = [])
    {
        $allWeekdays = [0, 1, 2, 3, 4, 5, 6];

        $actualStartDate = now()->parse($startDate);
        $endDate = now()->parse($endDate);

        if ($type == 1 && $actualStartDate->diffInDays($endDate) >= 7) {

            $weekDays = $allWeekdays;

        } else if ($type == 2 ) {

            $i = count($specificDays);
            $j = 0;

            while ($j < $i) {

                $weekDays[] = config("common.week_days.$specificDays[$j]");

                $j++;
            }

        } else {

            $i = 0;

            while ($i < 7) {

                $actualStartDate = now()->parse($startDate);
                $newStartDate = $actualStartDate->addDays($i);

                if ($newStartDate->lt($endDate)) {

                    $weekDays[] = $newStartDate->weekday();
                }
                $i++;
            }
        }

        return $weekDays;
    }
}
