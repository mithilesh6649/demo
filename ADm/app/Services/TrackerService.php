<?php

namespace App\Services;

use App\Http\Resources\MedicineTrackerResource;
use App\Http\Resources\WeightTrackerResource;
use App\Http\Resources\WeightReminderResource;
use App\Http\Resources\WaterReminderResource;
use App\Http\Resources\WaterTrackerResource;
use App\Http\Resources\PulseTrackerResource;
use App\Http\Resources\StepTrackerResource;
use App\Http\Traits\MedicineTrackerTrait;
use App\Models\WeightReminder;
use App\Models\WeightTracker;
use App\Models\WaterReminder;
use App\Models\WaterTracker;
use App\Models\StepTracker;
use DB;

class TrackerService {

    use MedicineTrackerTrait;

    protected $errorResponse = ['status' => 400, 'success' => false, 'message' => 'Something went wrong!', 'error' => true];

    /**
     * Function: getTrackerList
     *
     * @param object $data
     *
     * @return array
     */
    public function getTrackerList($data)
    {
        $additionalData = null;
        $tracker = [];

        if ($data->has('tracker_type')) {

            //TODO: add more cases eg. medicine, heart, steps
            switch($data->tracker_type) {

                case 'weight':
                    $tracker = $this->getWeightList();
                    $additionalData = [
                        'user_health_status' => auth()->user()->userProfile(),
                        'weight_reminder' => $this->getWeightReminder(),
                        'has_checked_health_status' => auth()->user()->hasCheckedHealthStatus()
                    ];
                    break;

                case 'water':
                    $waterTrackerData = auth()->user()->waterTracker;
                    $tracker = WaterTrackerResource::collection($waterTrackerData);

                    $dateWiseData = $this->getWaterList($data->date_filter);
                    $additionalData = [
                        'glass_count_goal' => ($waterTrackerData->isEmpty()) ? auth()->user()->metadata->water_glass_goal : $waterTrackerData->first()->goal,
                        'glass_count' => ($dateWiseData == null) ? 0 : $dateWiseData->glass_count,
                        'unit' => ($dateWiseData == null) ? 'ml' : $dateWiseData->unit,
                        'timepoint' => [
                            'year' => ($dateWiseData == null) ? now()->format('Y') : $dateWiseData->created_at->format('Y'),
                            'month' => ($dateWiseData == null) ? now()->format('m') : $dateWiseData->created_at->format('m'),
                            'date' => ($dateWiseData == null) ? now()->formatLocalized('%d %b') : $dateWiseData->created_at->formatLocalized('%d %b')
                        ],
                        'water_reminder' => $this->getWaterReminder()
                    ];
                    break;

                case 'medicine':
                    $tracker = $this->getMedicineList();
                    break;

                case 'pulse':
                    $tracker = $this->getPulseList();
                    break;

                case 'step':
                    $tracker = $this->getStepList($data->date_filter);
                    $additionalData = [
                        'step_goal' => auth()->user()->metadata->step_goal,
                        'step_reminder' => auth()->user()->stepReminder->front_cron_time
                    ];
                    break;
            }

            return ['status' => 200, 'success' => true, 'data' => $tracker, 'additional_data' => $additionalData, 'error' => false];
        }

        return $this->errorResponse;
    }

    /**
     * Function: getWeightList
     * Functionality: get the list of weight of the user
     *
     * @return array
     */
    private function getWeightList()
    {
        $weightTrackerData = auth()->user()->weightTracker;
        return WeightTrackerResource::collection($weightTrackerData);
    }

    /**
     * Function: getWeightReminder
     * Functionality: Fetch user weight reminder
     *
     *
     * @return collection
     */
    public function getWeightReminder()
    {
        $weightReminder = auth()->user()->weightReminder;

        if ($weightReminder == null) {

            $weightReminder = new WeightReminder;
            $weightReminder->timepoint = 'Sunday';
            $weightReminder->type = 'day';
            $weightReminder->status = false;
        }

        return new WeightReminderResource($weightReminder);
    }

    /**
     * Function: getWaterReminder
     * Functionality: Fetch user water reminder
     *
     *
     * @return collection
     */
    public function getWaterReminder()
    {
        $waterReminder = auth()->user()->waterReminder;

        if ($waterReminder == null) {

            $waterReminder = new WaterReminder;
            $waterReminder->start_time = "9:00";
            $waterReminder->end_time = "21:00";
            $waterReminder->reminder_type = "once";
            $waterReminder->cron_time = "10:00";
            $waterReminder->status = false;
        }

        return new WaterReminderResource($waterReminder);
    }

    /**
     * Function: getWaterList
     * Functionality: get the list of water tracker of the user
     *
     * @param string $dateFilter
     *
     * @return array
     */
    private function getWaterList($dateFilter)
    {
        $dateWiseWaterTrackerData = WaterTracker::where('user_id', auth()->id())
        ->when($dateFilter, function ($qr) use ($dateFilter) {

           return $qr->whereDate('created_at', now()->parse($dateFilter));
        }, function ($q) {

            return $q->orWhereDate('created_at', today());
        })
        ->first();

        return ($dateWiseWaterTrackerData == null) ? [] : new WaterTrackerResource($dateWiseWaterTrackerData);
    }

    /**
     * Function: getMedicineList
     * Functionality: Get records of medicines
     *
     * @param string $medicineTrackerId
     *
     * @return array
     */
    public function getMedicineList($medicineTrackerId = null)
    {
        if ($medicineTrackerId == null) {

            $tracker = auth()->user()->medicineTracker->load(['medicineType']);
            return MedicineTrackerResource::collection($tracker);

        } else {

            $tracker = auth()->user()->medicineTracker()->where('id', $medicineTrackerId)->with(['doses', 'medicineType', 'medicineServingUnit', 'medicineScheduler'])->first();

            return ['status' => 200, 'success' => true, 'data' => ($tracker == null) ? [] : new MedicineTrackerResource($tracker), 'error' => false ];
        }
    }

    /**
     * Function:manipulateWeightTracker
     * Functionality: This will add/update the user weight based
     * on the current data. Every day has only single record.
     *
     * @param object $data
     *
     * @return array
     */
    public function manipulateWeightTracker($data):array
    {
        try {
            $weightTrackerData = WeightTracker::whereDate('created_at', now()->format('Y-m-d'))->updateOrCreate(['user_id' => auth()->id()], ['weight' => $data->weight, 'weight_unit' => $data->weight_unit]);

            return ['status' => 200, 'success' => true, 'message' => 'Data successfully updated', 'error' => false];

        } catch (\Exception $e) {

            return $this->errorResponse;
        }
    }

    /**
     * Function:manipulateWaterTracker
     * Functionality: This will add/update the user weight based
     * on the current data. Every day has only single record.
     *
     * @param object $data
     *
     * @return array
     */
    public function manipulateWaterTracker($data):array
    {
        $waterTrackerData = [];

        switch ($data->update_type) {

            case 'goal':
                auth()->user()->metadata()->update(['water_glass_goal' => $data->glass_count_goal]);
                $waterTrackerData = $this->getWaterList(null);
                break;

            case 'glass_count':
                $waterTrackerData = new WaterTrackerResource($this->ManageWaterTracker($data));
                break;
        }

        return ['status' => 200, 'success' => true, 'message' => 'Data successfully updated', 'data' => $waterTrackerData, 'error' => false];
    }

    /**
     * Function:setWeightReminder
     * Functionality: save the weight reminder record
     *
     * @param object $data
     *
     * @return array
     */
    public function setWeightReminder($data):array
    {
        try {

            $cronTime = calculateWeightReminderCronTime($data);

            auth()->user()->weightReminder()->updateOrCreate(['user_id' => auth()->id()], ['timepoint' => $data->value, 'type' => ($data->selected_type == "day") ? '1' : '2', 'cron_time' => $cronTime, 'status' => $data->notification]);

            return ['status' => 200, 'success' => true, 'message' => 'Data successfully updated', 'error' => false];

        } catch (\Exception $e) {

            return $this->errorResponse;
        }
    }

    /**
     * Function: ManageWaterTracker
     * Functionality: Update or create the water tracking
     *
     * @param object $data
     *
     * @return object
     */
    private function ManageWaterTracker($data)
    {
        $dateFilter = ($data->date == null) ? now() : now()->parse($data->date);

        $waterTracker = WaterTracker::where('user_id', auth()->id())->whereDate('created_at', $dateFilter)->first();

        if ($waterTracker == null) {

            $waterTracker = new WaterTracker;
            $waterTracker->created_at = now()->parse($dateFilter);
        }

        $waterTracker->glass_count = $data->glass_count;
        $waterTracker->unit = $data->unit;
        $waterTracker->user_id = auth()->id();
        $waterTracker->save();

        return $waterTracker;
    }

    /**
     * Function: setWaterReminder
     * Functionality: Set water reminder for user
     *
     *
     * @param object $data
     *
     * @return array
     */
    public function setWaterReminder($data)
    {
        switch ($data->reminder_type) {

            case 'once':
                $waterReminder = $this->setOnceWaterReminder($data);
                break;

            case 'interval':
                $waterReminder = $this->setIntervalWaterReminder($data);
                break;

            case 'repetition':
                $waterReminder = $this->setRepetitionWaterReminder($data);
                break;

            default:
                $waterReminder = $this->errorResponse;
                break;
        }

        return $waterReminder;
    }

    /**
     * Function: setOnceWaterReminder
     * Functionality: This will remind the user once a day
     *
     * @param object $data
     *
     * @return array
     */
    private function setOnceWaterReminder($data)
    {
        try {
            $waterReminderData['start_time'] = getCarbonTime($data->start_time);
            $waterReminderData['end_time'] = getCarbonTime($data->end_time);
            $waterReminderData['cron_time'] = getCarbonTime($data->remind_time);

            if(!$waterReminderData['cron_time']->between($waterReminderData['start_time'], $waterReminderData['end_time'], true)) {

                $responseBack = ['status' => 400, 'success' => false, 'message' => 'Time must be in between start & end time', 'error' => true];

            } else {

                $waterReminderData['notification'] = getCarbonTime($data->remind_time);
                $waterReminderData['status'] = $data->notification;
                $waterReminderData['reminder_type'] = $data->reminder_type;
                $waterReminderData['actual_repetition_count'] = 1;
                $waterReminderData['repetition_count'] = 1;
                $waterReminderData['add_time_to_cron_time'] = getCarbonTime($data->remind_time)->addDay();

                $waterReminder = new WaterReminder;
                $waterReminder->updateWaterReminder($waterReminderData);

                $responseBack = ['status' => 200, 'success' => true, 'message' => 'Water reminder successfully set', 'error' => false];
            }

            return $responseBack;

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: setIntervalWaterReminder
     * Functionality: This will remind the user once a day
     *
     * @param object $data
     *
     * @return array
     */
    private function setIntervalWaterReminder($data)
    {
        try {
            $waterReminderData['start_time'] = getCarbonTime($data->start_time);
            $waterReminderData['end_time'] = getCarbonTime($data->end_time);
            $timeFrames = splitTime($waterReminderData['start_time'], $waterReminderData['end_time'], config("common.water_reminder.remind_every.$data->interval_time"));
            $waterReminderData['actual_repetition_count'] = count($timeFrames);
            $waterReminderData['repetition_count'] = count($timeFrames);
            $waterReminderData['add_time_to_cron_time'] = $timeFrames[1];
            $waterReminderData['interval_time'] = $data->interval_time;
            $waterReminderData['reminder_type'] = $data->reminder_type;
            $waterReminderData['status'] = $data->notification;
            $waterReminderData['cron_time'] = $timeFrames[0];

            $waterReminder = new WaterReminder;
            $waterReminder->updateWaterReminder($waterReminderData);

            $responseBack = ['status' => 200, 'success' => true, 'message' => 'Water reminder successfully set', 'error' => false];

            return $responseBack;

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: setRepetitionWaterReminder
     * Functionality: set repetition water reminder
     *
     * @param object $data
     *
     * @return array
     */
    public function setRepetitionWaterReminder($data)
    {
        try {
            $waterReminderData['start_time'] = getCarbonTime($data->start_time);
            $waterReminderData['end_time'] = getCarbonTime($data->end_time);
            $waterReminderData['cron_time'] = $waterReminderData['start_time'];
            $waterReminderData['add_time_to_cron_time'] = splitTimeWithInterval(getCarbonTime($data->start_time), $waterReminderData['end_time'], $data->repetition_count);
            $waterReminderData['actual_repetition_count'] = $data->repetition_count;
            $waterReminderData['repetition_count'] = $data->repetition_count;
            $waterReminderData['reminder_type'] = $data->reminder_type;
            $waterReminderData['status'] = $data->notification;

            $waterReminder = new WaterReminder;
            $waterReminder->updateWaterReminder($waterReminderData);

            return ['status' => 200, 'success' => true, 'message' => 'Water reminder successfully set', 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: setMedicineTracker
     * Function: This will set tracker for user's medicine
     *
     * @param object $data
     *
     * @return array
     */
    public function setMedicineTracker($data)
    {
        try {

            $medicineData['medicine_name'] = $data->medicine_name;
            $medicineData['medicine_id'] = $data->medicine_tracker_id;
            $medicineData['medicine_type_id'] = $this->getId(config('common.md_dropdowns.slug.medicine_type'), $data->medicine_type);
            $medicineData['dose_count'] = $data->dose_count;
            $medicineData['serving_unit_id'] = $this->getId(config('common.md_dropdowns.slug.serving_unit'), $data->medicine_serving_unit);
            $medicineData['scheduler_type'] = $data->scheduler_type ?? 1;
            $medicineData['start_date'] = $data->start_date ?? null;
            $medicineData['end_date'] = $data->end_date ?? null;
            $medicineData['status'] = $data->notification ?? false;
            $medicineData['doses'] = $data->doses ?? null;
            $medicineData['schedule'] = $data->schedule;
            $medicineData['specific_days'] = ($data->schedule) ? $this->getScheduleDays($data->scheduler_type, $medicineData['start_date'], $medicineData['end_date'], $data->specific_days) : null;

            $medicineTracker = new \App\Models\MedicineTracker;
            $medicineTracker->manageMedicineTrackerData($medicineData);

            return ['status' => 200, 'success' => true, 'message' => 'Data successsfully updated', 'error' => false];

        } catch (\Exception $e) {

            return $this->errorResponse;
        }
    }

    /**
     * Function: deleteMedicineDose
     * Functionality: Delete medicine Dose
     *
     * @param object $data
     *
     * @return array
     */
    public function deleteMedicineDose($data)
    {
        try {
            $medicineReminder = new \App\Models\MedicineReminder;
            $medicineReminder->deleteMedicineDose($data);

            return ['status' => 200, 'success' => true, 'message' => 'Successfully deleted', 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: deleteMedicineTracker
     * Functionality: Delete medicine Dose
     *
     * @param string $medicineTrackerId
     *
     * @return array
     */
    public function deleteMedicineTracker($medicineTrackerId)
    {
        try {

            if ($medicineTrackerId != null)  {

                $medicineTracker = new \App\Models\MedicineTracker;
                $medicineTracker->deleteMedicineTracker($medicineTrackerId);

                return ['status' => 200, 'success' => true, 'message' => 'Successfully deleted', 'error' => false];
            }

            return ['status' => 400, 'success' => false, 'message' => 'Please provide medicine tracker id', 'error' => true];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: getPulseList
     * Functionality: This will get the list of the pulse tracker
     * of the user
     *
     * @return array
     */
    public function getPulseList()
    {
        $tracker = auth()->user()->pulseTracker;

        return PulseTrackerResource::collection($tracker);
    }

    /**Function: managePulseTracker
     * Functionality: This will manage the pulse tracker
     * based on date
     *
     * @return array
     */
    public function managePulseTracker()
    {
        try {

            auth()->user()->pulseTracker()->whereDate('created_at', now()->format('Y-m-d'))->updateOrCreate(['user_id' => auth()->id()], ['bpm' => request()->bpm]);

            return ['status' => 200, 'success' => true, 'message' => 'Data successfully saved', 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: getStepList
     * Functionality: This will fetch the step records of the user
     *
     * @param string $dateFilter
     *
     * @return array
     */
    private function getStepList($dateFilter)
    {
        $dateWiseStepTrackerData = StepTracker::where('user_id', auth()->id())
        ->when($dateFilter, function ($qr) use ($dateFilter) {

           return $qr->whereDate('created_at', now()->parse($dateFilter));
        }, function ($q) {

            return $q->orWhereDate('created_at', today());
        })
        ->first();

        return ($dateWiseStepTrackerData == null) ? [] : new StepTrackerResource($dateWiseStepTrackerData);
    }

    /**
     * Function: manageStepsData
     * Functionality: This will update/create the steps of the
     * user based on the date
     *
     * @param object $request
     *
     * @return array
     */
    public function manageStepsData($request)
    {
        try {

            switch ($request->update_type) {

                case 'goal':
                    $stepUpdatedData = $this->updateStepGoalData($request);


                    break;

                case 'step':
                    $stepUpdatedData = new StepTrackerResource($this->updateStepData($request));
                    break;
            }

            return ['status' => 200, 'success' => true, 'message' => 'Step successfully updated', 'data' => $stepUpdatedData, 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: updateStepGoalData
     * Functionality: This will update the step goal data
     *
     * @param object $request
     *
     * @return array
     */
    private function updateStepGoalData($request)
    {
        $goal = auth()->user()->metadata;

        $goal->step_goal = $request->step_goal;
        $goal->save();

        return ['step_goal' => $goal->step_goal];
    }

    /**
     * Function: updateStepGoalData
     * Functionality: This will update the step goal data
     *
     * @param object $request
     *
     * @return array
     */
    private function updateStepData($request)
    {
        $dateFilter = ($request->date == null) ? now() : now()->parse($request->date);

        $stepTracker = StepTracker::where('user_id', auth()->id())->whereDate('created_at', $dateFilter)->first();

        if ($stepTracker == null) {

            $stepTracker = new StepTracker;
            $stepTracker->created_at = now()->parse($dateFilter);
            $stepTracker->user_id = auth()->id();
        }

        $stepTracker->step_count = $request->step;
        $stepTracker->save();

        return $stepTracker;
    }

    public function setStepReminder($request)
    {
        auth()->user()->stepReminder()->updateOrCreate(['user_id' => auth()->id()], ['cron_time' => $request->time]);

        return ['status' => 200, 'success' => true, 'message' => 'Step reminder successfully set', 'error' => false];
    }
}
