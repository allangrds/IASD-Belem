<?php
namespace App\Http\Controllers\Panel;

use App\Departments;
use App\Http\Controllers\Controller;
use App\ChurchMembers;
use App\MemberFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChurchMembersController extends Controller
{
    public function index()
    {
        $functions = MemberFunction::get(['id', 'name']);
        $departments = Departments::get(['id', 'name']);
        $members = ChurchMembers::paginate(10);

        return view('panel.members.index')
            ->with('members', $members)
            ->with('departments', $departments)
            ->with('functions', $functions);
    }

    public function create()
    {
        $functions = MemberFunction::get(['id', 'name']);
        $departments = Departments::get(['id', 'name']);

        return view('panel.members.create')
            ->with('departments', $departments)
            ->with('functions', $functions);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|min:3|max:100',
            'born_at' => 'required|date',
            'photo' => 'mimes:jpeg,png,jpg|max:80',
            'function' => 'integer',
            'department' => 'integer',
            'telephone' => 'max:50',
            'email' => 'max:50',
        ]);

        try {
            $fileName = $request->photo ? rand(1, 250).$request->name : '';
            $fileExtension = $request->photo ? $request->photo->extension() : '';

            ChurchMembers::create([
               'name' => $request->name,
               'born_at' => $request->born_at,
               'image' => $fileName.'.'.$fileExtension,
               'function_id' => $request->function,
               'department_id' => $request->department,
               'email' => $request->email,
               'telephone' => $request->telephone,
            ]);

            if ($request->photo) {
                $upload = $request->photo->storeAs('photos', "$fileName.$fileExtension");

                if (!$upload) {
                    throw new \Exception('Upload unsuccessful');
                }
            }

            DB::commit();

            return redirect()
                ->route('panel_church_members')
                ->with('message', 'Membro cadastrado');
        } catch(\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    public function edit($id)
    {
        $member = ChurchMembers::where('id', $id)
            ->get()
            ->first();
        $functions = MemberFunction::get(['id', 'name']);
        $departments = Departments::get(['id', 'name']);

        return view('panel.members.edit')
            ->with('functions', $functions)
            ->with('departments', $departments)
            ->with('member', $member);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|min:3|max:100',
            'born_at' => 'required|date',
            'photo' => 'mimes:jpeg,png,jpg|max:80',
            'function' => 'integer',
            'department' => 'integer',
            'telephone' => 'max:14',
            'email' => 'max:50',
        ]);

        try {
            $member = ChurchMembers::where('id', $request->id)
                ->first();

            $member->name = $request->name;
            $member->born_at = $request->born_at;
            $member->telephone = $request->telephone;
            $member->email = $request->email;
            $member->function_id = $request->function;
            $member->department_id = $request->department;

            if ($request->photo) {
                $fileName = $fileName= $request->id;
                $fileExtension = $request->photo
                    ? $request->photo->extension()
                    : '';

                if($member->image) {
                    $fileToDelete = "/photos/$member->image";
                    Storage::delete($fileToDelete);

                    if (Storage::exists($fileToDelete)) {
                        throw new \Exception('Old image delete unsuccessful');
                    }
                }

                $upload = $request->photo->storeAs('photos', "$fileName.$fileExtension");

                if (!$upload) {
                    throw new \Exception('Upload unsuccessful');
                }

                $member->image = "$fileName.$fileExtension";
            }

            $member->save();

            DB::commit();

            return redirect()
                ->route('panel_church_members')
                ->with('message', 'Membro cadastrado');
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

        $member = ChurchMembers::where('id', $id)
            ->get(['id', 'is_active'])
            ->first();

        try {
            $member->is_active = $member->is_active == true ? false : true;
            $member->save();

            DB::commit();

            return back()->with('message', 'Membro desativado');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }
}
