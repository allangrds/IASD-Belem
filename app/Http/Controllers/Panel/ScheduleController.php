<?php
namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Departments;
use App\Schedule;
use App\ScheduleDescription;
use App\ScheduleTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $functions = Schedule::paginate(10);

        return view('panel.schedules.index')
            ->with('functions', $functions);
    }

    public function create()
    {
        return view('panel.schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25',
            'week_day' => 'nullable|max:7|in:segunda,terca,quarta,quinta,sexta,sabado,domingo',
            'specific_day' => 'nullable|date',
        ]);

        $times = $request->time;
        $titles = $request->title;
        $weekDay = $request->week_day;
        $specificDay = $request->specific_day;
        $timeLength = count($times);

        if (!$specificDay && !$weekDay) {
            return back()
                ->withErrors([
                    'page' => 'Vocẽ precisa escolher um dia para publicá-lo'
                ]);
        }

        DB::beginTransaction();

        try {
            $schedule = Schedule::create([
                'name' => $request->name,
                'week_day' => $weekDay,
                'specific_day' =>$specificDay,
            ]);

            for ($i = 0; $i < $timeLength; $i++) {
                $timeIstance = ScheduleTime::where('schedule_id', $schedule->id)
                    ->where('time', $times[$i])
                    ->get()
                    ->first();

                if (!$timeIstance) {
                    $timeIstance = ScheduleTime::firstOrCreate(
                        [
                            'schedule_id' => $schedule->id,
                            'time' => $times[$i],
                        ]
                    );
                }

                ScheduleDescription::firstOrCreate(
                    [
                        'schedule_time_id' => $timeIstance->id,
                        'name' => $titles[$i]
                    ]
                );
            }

            DB::commit();

            return redirect()
                ->route('panel_schedule')
                ->with('message', 'Programação cadastrada');
        } catch(\Exception $e) {
            return $e;
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    public function edit($id)
    {
        $function = Schedule::where('id', $id)
            ->get()
            ->first();

        return view('panel.schedules.edit')
            ->with('function', $function);
    }

    public function update(Request $request, $id)
    {
        $times = $request->time;
        $titles = $request->title;
        $timeLength = count($times);
        $weekDay = $request->week_day;
        $specificDay = $request->specific_day;

        DB::beginTransaction();

        $request->validate([
            'name' => 'required|max:25',
        ]);

        if (!$specificDay && !$weekDay) {
            return back()
                ->withErrors([
                    'page' => 'Vocẽ precisa escolher um dia para publicá-lo'
                ]);
        }

        $schedule = Schedule::where('id', $id)->first(['id', 'name']);

        try {
            $schedule->name = $request->name;
            $schedule->week_day = $weekDay;
            $schedule->specific_day = $specificDay;
            $schedule->save();

            $scheduleTime = ScheduleTime::where('schedule_id', $schedule->id);
            $scheduleTime->delete();

            for ($i = 0; $i < $timeLength; $i++) {
                $timeIstance = ScheduleTime::where('schedule_id', $schedule->id)
                    ->where('time', $times[$i])
                    ->get()
                    ->first();

                if (!$timeIstance) {
                    $timeIstance = ScheduleTime::firstOrCreate(
                        [
                            'schedule_id' => $schedule->id,
                            'time' => $times[$i],
                        ]
                    );
                }

                ScheduleDescription::firstOrCreate(
                    [
                        'schedule_time_id' => $timeIstance->id,
                        'name' => $titles[$i]
                    ]
                );
            }

            DB::commit();

            return redirect()
                ->route('panel_schedule')
                ->with('message', 'Programação editada.');
        } catch(\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $function = Schedule::where('id', $id)
            ->get(['id', 'is_active'])
            ->first();

        try {
            $function->is_active = $function->is_active == true ? false : true;
            $function->save();

            DB::commit();

            return back()->with('message', 'Status alterado');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }
}
