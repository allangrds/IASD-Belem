<?php
namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\ChurchMembers;
use App\MemberFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MembersFunctionController extends Controller
{
    public function index()
    {
        $functions = MemberFunction::paginate(10);

        return view('panel.function.index')
            ->with('functions', $functions);
    }

    public function create()
    {
        return view('panel.function.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|max:25',
        ]);

        try {
            MemberFunction::create([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()
                ->route('panel_members_function')
                ->with('message', 'Cargo cadastrado');
        } catch(\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    public function edit($id)
    {
        $function = MemberFunction::where('id', $id)
            ->get()
            ->first();

        return view('panel.function.edit')
            ->with('function', $function);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|max:25',
        ]);

        try {
            $function = MemberFunction::where('id', $request->id)->first();
            $function->name = $request->name;
            $function->save();

            DB::commit();

            return redirect()
                ->route('panel_members_function')
                ->with('message', 'Cargo atualizado');
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

        $function = MemberFunction::where('id', $id)
            ->get(['id', 'is_active'])
            ->first();

        try {
            $function->is_active = $function->is_active == true ? false : true;
            $function->save();

            DB::commit();

            return back()->with('message', 'Cargo desativado');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }
}
