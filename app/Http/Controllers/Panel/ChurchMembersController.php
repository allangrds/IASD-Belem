<?php
namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\ChurchMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ChurchMembersController extends Controller
{
    public function index()
    {
        $members = ChurchMembers::paginate(10);

        return view('panel.members.index')
            ->with('members', $members);
    }

    public function create()
    {
        return view('panel.members.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|min:3|max:100',
            'born_at' => 'required|date',
            'photo' => 'required|mimes:jpeg,png,jpg|max:30',
        ]);

        try {
            $fileName= $request->id;
            $fileExtension = $request->photo->extension();

            ChurchMembers::create([
               'name' => $request->name,
               'born_at' => $request->born_at,
               'image' => "$fileName.$fileExtension",
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

        return view('panel.members.edit')
            ->with('member', $member);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'name' => 'required|min:3|max:100',
            'born_at' => 'required|date',
            'photo' => 'required|mimes:jpeg,png,jpg|max:30',
        ]);

        try {
            $member = ChurchMembers::where('id', $request->id)
                ->first();

            $member->name = $request->name;
            $member->born_at = $request->born_at;

            if ($request->photo) {
                $fileName = $fileName= $request->id;
                $fileExtension = $request->photo
                    ? $request->photo->extension()
                    : '';

                $upload = $request->photo->storeAs('photos', "$fileName.$fileExtension");

                if (!$upload) {
                    throw new \Exception('Upload unsuccessful');
                }

                $fileToDelete = "/photos/$member->image";
                Storage::delete($fileToDelete);

                if (Storage::exists($fileToDelete)) {
                    throw new \Exception('Old image delete unsuccessful');
                }

                $member->image = "$fileName.$fileExtension";
            }

            $member->save();

            DB::commit();

            return redirect()
                ->route('panel_church_members')
                ->with('message', 'Membro cadastrado');
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
