<?php
namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{
    public function index()
    {
        $functions = Departments::paginate(10);

        return view('panel.departments.index')
            ->with('functions', $functions);
    }

    public function create()
    {
        return view('panel.departments.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|max:25',
        ]);

        try {
            Departments::create([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()
                ->route('panel_departments')
                ->with('message', 'Departamento cadastrado');
        } catch(\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    public function edit($id)
    {
        $function = Departments::where('id', $id)
            ->get()
            ->first();

        return view('panel.departments.edit')
            ->with('function', $function);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|max:25',
        ]);

        try {
            $function = Departments::where('id', $request->id)->first();
            $function->name = $request->name;
            $function->save();

            DB::commit();

            return redirect()
                ->route('panel_departments')
                ->with('message', 'Departamento atualizado');
        } catch(\Exception $e) {
            return $e;
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $function = Departments::where('id', $id)
            ->get(['id', 'is_active'])
            ->first();

        try {
            $function->is_active = $function->is_active == true ? false : true;
            $function->save();

            DB::commit();

            return back()->with('message', 'Departamento desativado');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }
}
