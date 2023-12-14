<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 5:53 PM
 */

namespace App\Http\Services;


use App\Http\Repository\AppointmentRepository;
use App\Models\Appointment;
use App\Models\Calendar;
use App\Models\Clinic;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\Task;
use App\Models\TimeSchedule;
use App\Models\UnregisteredUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppointmentService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new AppointmentRepository();
        parent::__construct($this->repository);
    }

    public function adminAddEdit($request)
    {
        if (!empty($request->schedule_end_time) && $request->schedule_end_time <= $request->schedule_at) {
            return [
                'status' => false,
                'message' => __('Appointment end time should be greater than start time'),
                'data' => null
            ];
        }
        try {
            $customer = Customer::where('user_id', Auth::id())->first();
            $clinic = Clinic::where(['id' => $request->clinic_id, 'customer_id' => $customer->id, 'status' => ACTIVE_STATUS])->first();
            if (empty($clinic)) {
                return [
                    'status' => false,
                    'message' => __('Invalid location'),
                    'data' => null
                ];
            }
            $doctor = Calendar::where(['clinic_id' => $clinic->id, 'id' => $request->calendar_id, 'status' => ACTIVE_STATUS])->first();
            if (empty($doctor)) {
                return [
                    'status' => false,
                    'message' => __('Invalid calendar'),
                    'data' => null
                ];
            }
            $service = Service::where(['clinic_id' => $clinic->id, 'id' => $request->service_id, 'status' => ACTIVE_STATUS])->first();
            if (empty($service)) {
                return [
                    'status' => false,
                    'message' => __('Invalid service'),
                    'data' => null
                ];
            }
            $scheduleStartTime = new Carbon($request->schedule_at);
            $day = $scheduleStartTime->format('l');
            $dayIndex = array_search($day, weekDays());
            $timeSchedule = TimeSchedule::where(['clinic_id' => $clinic->id, 'day' => $dayIndex])->first();

            if (empty($timeSchedule)) {
                return [
                    'status' => false,
                    'message' => __('Please set time schedule first on') . ' ' . $day,
                    'data' => null
                ];
            } elseif ($timeSchedule->is_holiday) {
                return [
                    'status' => false,
                    'message' => __('The day you selected is holiday'),
                    'data' => null
                ];
            }
            $startAt = $scheduleStartTime->format('H:i');
            $startAt = explode(':', $startAt);
            $scheduleStart = explode(':', $timeSchedule->start_time);
            $scheduleEnd = explode(':', $timeSchedule->end_time);
            if (($startAt[0] < $scheduleStart[0]) || (($startAt[0] == $scheduleStart[0]) && ($startAt[1] < $scheduleStart[1]))) {
                return [
                    'status' => false,
                    'message' => __('You set the appointment before the schedule start on :day', ['day' => $day]),
                    'data' => null
                ];
            } elseif (($startAt[0] > $scheduleEnd[0]) || (($startAt[0] == $scheduleEnd[0]) && ($startAt[1] > $scheduleEnd[1]))) {
                return [
                    'status' => false,
                    'message' => __('You set the appointment after the schedule end on :day', ['day' => $day]),
                    'data' => null
                ];
            }
            /*
            if ($timeSchedule->close_at_lunch_hour) {
                $lunchStart = explode(':', $timeSchedule->lunch_hour_start_time);
                $lunchEnd = explode(':', $timeSchedule->lunch_hour_end_time);

                if ((($startAt[0] > $lunchStart[0]) && ($startAt[0] < $lunchEnd[0])) ||
                    (($startAt[0] == $lunchStart[0]) && ($startAt[1] >= $lunchStart[1])) ||
                    (($startAt[0] == $lunchEnd[0]) && ($startAt[1] <= $lunchEnd[1]))
                ) {
                    return [
                        'status' => false,
                        'message' => __('You set the appointment at lunch hour on :day', ['day' => $day]),
                        'data' => null
                    ];
                }
            }*/

            $subscriber = Subscriber::where(['customer_id' => $customer->id])->first();
            $subscriberEndTIme = new Carbon($subscriber->end_date);
            if ($scheduleStartTime->format('Y-m-d') > $subscriberEndTIme->format('Y-m-d')) {
                return [
                    'status' => false,
                    'message' => __('You set the appointment after end of your subscription'),
                    'data' => null
                ];
            }
            $user = User::where(['phone' => $request->phone, 'role' => USER_ROLE, 'subscriber_id' => $subscriber->id])->first();
            $unregisteredUser = false;
            if (empty($user)) {
                return [
                    'status' => false,
                    'message' => __('User not found. Please create user first'),
                    'data' => null
                ];
            }

            DB::beginTransaction();
            if ($request->schedule_end_time) {
                $endTime = new Carbon($request->schedule_end_time);
            } else {
                $startTime = new Carbon($request->schedule_at);
                $defaultTime = allSetting('default_appointment_time_' . Auth::id());
                $defaultTime = empty($defaultTime) ? DEFAULT_TIME : $defaultTime;
                $endTime = $startTime->addMinutes($defaultTime);
            }

            if ($request->status == APPOINTMENT_REJECT_STATUS) {
                $taskStatus = PENDING_STATUS;
            } else {
                $taskStatus = ACTIVE_STATUS;
            }

            if ($request->id) {
                $totalDuration = $endTime->diffInMinutes($scheduleStartTime);
                $appointment = $this->getById($request->id);
                if ($appointment->calendar_id == $doctor->id) {
                    $task = Task::where(['calendar_id' => $doctor->id, 'appointment_id' => $request->id])->first();
                    if (($task->start_time != $scheduleStartTime) || ($task->end_time != $endTime)) {
                        $appointmentAlreadyExists = Appointment::where(['calendar_id' => $doctor->id])->where('id', '!=', $appointment->id)->where('status', '!=', APPOINTMENT_REJECT_STATUS)->whereBetween('scheduled_at', [$scheduleStartTime, $endTime])->first();
                        if ($appointmentAlreadyExists && ($request->status != APPOINTMENT_REJECT_STATUS)) {
                            DB::rollBack();

                            return [
                                'status' => false,
                                'message' => __('Appointment already exists at this time for this calendar'),
                                'data' => null
                            ];
                        }

                        $task->update([
                            'start_time' => $scheduleStartTime,
                            'end_time' => $endTime,
                            'duration' => $totalDuration,
                            'status' => $taskStatus
                        ]);
                    } else {
                        $task->update([
                            'start_time' => $scheduleStartTime,
                            'end_time' => $endTime,
                            'duration' => $totalDuration,
                            'status' => $taskStatus
                        ]);
                    }
                } else {
                    $appointmentAlreadyExists = Appointment::where(['calendar_id' => $doctor->id])->where('status', '!=', APPOINTMENT_REJECT_STATUS)->whereBetween('scheduled_at', [$scheduleStartTime, $endTime])->first();
                    if ($appointmentAlreadyExists && ($request->status != APPOINTMENT_REJECT_STATUS)) {
                        DB::rollBack();

                        return [
                            'status' => false,
                            'message' => __('Appointment already exists at this time for this calendar'),
                            'data' => null
                        ];
                    }

                    Task::updateOrCreate(['appointment_id' => $request->id], [
                        'calendar_id' => $doctor->id,
                        'start_time' => $scheduleStartTime,
                        'end_time' => $endTime,
                        'duration' => $totalDuration,
                        'status' => $taskStatus
                    ]);
                }

                $this->update(['id' => $request->id], [
                    'user_id' => $user->id,
                    'clinic_id' => $clinic->id,
                    'service_id' => $service->id,
                    'calendar_id' => $doctor->id,
                    'scheduled_at' => $scheduleStartTime,
                    'unregistered_user' => $unregisteredUser,
                    'details' => $request->details,
                    'status' => $request->status
                ]);
                DB::commit();

                if ($request->status == APPOINTMENT_SUCCESS_STATUS) {
                    $service = new PushNotificationService();
                    $input = [
                        'title' => $customer->company_name,
                        'body' => __('Your appointment has been confirmed to :time', ['time' => $scheduleStartTime->format('d-m-Y H:i')]),
                        'appointment_id' => $request->id,
                        'subscriber_id' => isset($customer->subscriber) ? $customer->subscriber->id : null
                    ];
                    $service->sendConfirmation($input['title'], $input['body'], $input, $user->id);
                }

                return [
                    'status' => true,
                    'message' => __('Appointment has been updated successfully'),
                    'data' => null
                ];
            } else {
                $appointmentAlreadyExists = Appointment::where(['calendar_id' => $doctor->id])->where('status', '!=', APPOINTMENT_REJECT_STATUS)->whereBetween('scheduled_at', [$scheduleStartTime, $endTime])->first();
                if ($appointmentAlreadyExists) {
                    DB::rollBack();

                    return [
                        'status' => false,
                        'message' => __('Appointment already exists at this time for this calendar'),
                        'data' => null
                    ];
                }
                $appointment = $this->create([
                    'user_id' => $user->id,
                    'clinic_id' => $clinic->id,
                    'service_id' => $service->id,
                    'calendar_id' => $doctor->id,
                    'scheduled_at' => $scheduleStartTime,
                    'unregistered_user' => $unregisteredUser,
                    'details' => $request->details,
                    'status' => $request->status
                ]);

                $totalDuration = $endTime->diffInMinutes($scheduleStartTime);
                Task::create([
                    'calendar_id' => $doctor->id,
                    'appointment_id' => $appointment->id,
                    'start_time' => $scheduleStartTime,
                    'end_time' => $endTime,
                    'duration' => $totalDuration,
                    'status' => $taskStatus
                ]);
                DB::commit();

                return [
                    'status' => true,
                    'message' => __('Appointment has been added successfully'),
                    'data' => null
                ];
            }
        } catch (\Exception $exception) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => __('Something went wrong. Please try again') . $exception->getMessage() . $exception->getLine(),
                'data' => null
            ];
        }
    }

    public function adminDelete($id)
    {
        try {
            $id = decrypt($id);
            $task = Task::where(['appointment_id' => $id])->first();
            if (!empty($task)) {
                $task->status = DELETE_STATUS;
                $task->update();
            }
            $this->delete($id);

            return [
                'status' => true,
                'message' => __('Appointment has been deleted successfully'),
                'data' => null
            ];
        } catch (\Exception $exception) {
            return [
                'status' => false,
                'message' =>  __('Something went wrong. Please try again') . $exception->getMessage(),
                'data' => null
            ];
        }
    }

    public function createAppointment(Request $request)
    {
        $user = Auth::user();
        try {
            $subscriber = Subscriber::where(['id' => $user->subscriber_id, 'status' => ACTIVE_STATUS])->first();
            if (empty($subscriber)) {
                return [
                    'success' => false,
                    'message' => __('Invalid subscriber'),
                    'data' => null
                ];
            }
            $subscriberEndDate = new Carbon($subscriber->end_date);
            $subscriberStartDate = new Carbon($subscriber->start_date);
            $carbon = new Carbon();
            if ($subscriberStartDate->format('Y-m-d') > $carbon->now()->format('Y-m-d')) {
                return [
                    'success' => false,
                    'message' => __('Your client\'s subscription package has not started yet'),
                    'data' => null
                ];
            }

            if ($subscriberEndDate->format('Y-m-d') < $carbon->now()->format('Y-m-d')) {
                return [
                    'success' => false,
                    'message' => __('Your client\'s subscription package has been expired'),
                    'data' => null
                ];
            }
            $location = Clinic::where(['customer_id' =>  $subscriber->customer->id, 'id' => $request->location_id, 'status' => ACTIVE_STATUS])->first();
            if (empty($location)) {
                return [
                    'success' => false,
                    'message' => __('Invalid location'),
                    'data' => null
                ];
            }
            $service = Service::where(['clinic_id' =>  $location->id, 'id' => $request->service_id, 'status' => ACTIVE_STATUS])->first();
            if (empty($service)) {
                return [
                    'success' => false,
                    'message' => __('Invalid service'),
                    'data' => null
                ];
            }

            if (!$user->is_phone_verified) {
                return [
                    'success' => true,
                    'message' => __('You need to verify your phone before placing an appointment'),
                    'data' => [
                        'phone_verification' => false
                    ]
                ];
            }

            $scheduleStartTime = new Carbon($request->scheduled_time);
            $day = $scheduleStartTime->format('l');
            $dayIndex = array_search($day, weekDays());
            $timeSchedule = TimeSchedule::where(['clinic_id' => $location->id, 'day' => $dayIndex])->first();
            if (empty($timeSchedule)) {
                return [
                    'success' => false,
                    'message' => __('There is no schedule on') . ' ' . $day,
                    'data' => null
                ];
            } elseif ($timeSchedule->is_holiday) {
                return [
                    'success' => false,
                    'message' => __('The day you selected is holiday'),
                    'data' => null
                ];
            }

            $startAt = $scheduleStartTime->format('H:i');
            $startAt = explode(':', $startAt);
            $scheduleStart = explode(':', $timeSchedule->start_time);
            $scheduleEnd = explode(':', $timeSchedule->end_time);
            if (($startAt[0] < $scheduleStart[0]) || (($startAt[0] == $scheduleStart[0]) && ($startAt[1] < $scheduleStart[1]))) {
                return [
                    'status' => false,
                    'message' => __('You set the appointment before the schedule start on :day', ['day' => $day]),
                    'data' => null
                ];
            } elseif (($startAt[0] > $scheduleEnd[0]) || (($startAt[0] == $scheduleEnd[0]) && ($startAt[1] > $scheduleEnd[1]))) {
                return [
                    'status' => false,
                    'message' => __('You set the appointment after the schedule end on :day', ['day' => $day]),
                    'data' => null
                ];
            }

            DB::beginTransaction();
            $this->create([
                'user_id' => $user->id,
                'clinic_id' => $location->id,
                'service_id' => $service->id,
                'scheduled_at' => $scheduleStartTime,
                'status' => PENDING_STATUS
            ]);
            DB::commit();

            return [
                'success' => true,
                'message' => __('Appointment booking request has been placed successfully. Please wait for the confirmation from call center.'),
                'data' => null
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('Some thing went wrong. Please try again'),
                'data' => null
            ];
        }
    }

    public function appointmentList(Request $request)
    {
        $appointments = Appointment::with(['clinic', 'service'])->select(['id', 'scheduled_at', 'clinic_id', 'service_id', 'status'])->where(['user_id' => Auth::id(), 'unregistered_user' => 0])->where('status', '!=', DELETE_STATUS);
        if ($request->is_upcoming) {
            $appointments = $appointments->whereRaw("scheduled_at >= NOW()")->orderBy('scheduled_at', 'asc');
        } else {
            $appointments = $appointments->whereRaw("scheduled_at < NOW()");
        }
        $appointments = $appointments->paginate(15)->appends($request->all());

        $appointments->each(function ($item) {
            $item->scheduled_on = $item->scheduled_at;
            $item->clinic = (string)$item->clinic->name;
            $item->service = $item->service->title;
            $item->status = appointmentStatus($item->status);
            $item->unsetRelation('clinic')->unsetRelation('service');
        });

        return [
            'success' => true,
            'message' => '',
            'data' => [
                'appointments' => $appointments
            ]
        ];
    }

    public function appointmentCancel($appointmentId)
    {
        $appointment = Appointment::where(['user_id' => Auth::id(), 'id' => $appointmentId])->first();
        if (empty($appointment)) {
            return [
                'success' => false,
                'message' => __('No appointment found'),
                'data' => null
            ];
        }
        $carbon = new Carbon();
        if ($appointment->scheduled_at <= $carbon->now()) {
            return [
                'success' => false,
                'message' => __('Your schedule time has been passed'),
                'data' => null
            ];
        }
        $appointment->status = APPOINTMENT_PENDING_CANCELLATION_STATUS;
        $appointment->update();

        return [
            'success' => true,
            'message' => __('Your appointment has been placed for cancellation'),
            'data' => null
        ];
    }
}
