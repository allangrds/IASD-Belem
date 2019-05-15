<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\News;
use App\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(10);

        return view('panel.news.index')
            ->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:55',
            'description' => 'max:255',
            'published_at' => 'nullable|date',
            'show_on_home' => 'nullable|in:true,false',
            'show_on_informative' => 'nullable|in:true,false',
        ]);

        $title = $request->title;
        $description = $request->description;
        $photos = $request->photo;
        $showOnHome = $request->show_on_home === 'true'
            ? True
            : False;
        $showOnInformative = $request->show_on_informative === 'true'
            ? True
            : False;
        $publishedAt = new Carbon($request->published_at);

        $rules = [];
        $files = $photos ? count($photos) - 1 : 0;

        DB::beginTransaction();

        foreach(range(0, $files) as $index) {
            $rules['photo.' . $index] = 'mimes:jpeg,png,jpg|max:80';
        }

        $validator = Validator::make($request->all() , $rules);

        if ($validator->fails()) {
            DB::rollBack();

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $news = News::firstOrCreate(
                [
                    'title' => $title,
                    'description' => $description,
                    'published_at' => $publishedAt,
                    'show_on_home' => $showOnHome,
                    'show_on_informative' => $showOnInformative,
                ]
            );

            if ($photos) {
                foreach ($photos as $key => $photo) {
                    $fileName = $photo ? sha1(rand(1, 250).$title) : null;
                    $fileExtension = $photo ? $photo->extension() : null;
                    $name = "$fileName.$fileExtension";

                    if ($fileName && $fileExtension) {
                        Photos::create([
                            'photo' => $name,
                            'news_id' => $news->id,
                        ]);

                        $upload = $photo->storeAs('photos', $name);

                        if (!$upload) {
                            throw new \Exception('Upload unsuccessful');
                        }
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('panel_news')
                ->with('message', 'Notícia cadastrada');
        } catch(\Exception $e) {
            return $e;
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::where('id', $id)
            ->get()
            ->first();

        $photos = Photos::where('news_id', $news->id)
            ->get();

        return view('panel.news.edit')
            ->with('photos', $photos)
            ->with('news', $news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:55',
            'description' => 'max:255',
            'published_at' => 'nullable|date',
            'show_on_home' => 'nullable|in:true,false',
            'show_on_informative' => 'nullable|in:true,false',
        ]);

        $title = $request->title;
        $description = $request->description;
        $photos = $request->photo;
        $photosToDelete = $request->photo_exclude;
        $rules = [];
        $files = $photos ? count($photos) - 1 : 0;
        $publishedAt = new Carbon($request->published_at);
        $showOnHome = $request->show_on_home === 'true'
            ? True
            : False;
        $showOnInformative = $request->show_on_informative === 'true'
            ? True
            : False;

        DB::beginTransaction();

        if ($photos) {
            foreach(range(0, $files) as $index) {
                $rules['photo.' . $index] = 'mimes:jpeg,jpg,png,gif|max:80';
            }

            $validator = Validator::make($request->all() , $rules);

            if ($validator->fails()) {
                DB::rollBack();

                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        try {
            News::where('id', $id)
                ->update([
                    'title' => $title,
                    'description' => $description,
                    'published_at' => $publishedAt,
                    'show_on_home' => $showOnHome,
                    'show_on_informative' => $showOnInformative,
                ]);

            if ($photosToDelete) {
                foreach ($photosToDelete as $photo) {
                    Photos::where('photo', $photo)->delete();

                    $fileToDelete = "/photos/$photo";
                    Storage::delete($fileToDelete);

                    if (Storage::exists($fileToDelete)) {
                        throw new \Exception('Old image delete unsuccessful');
                    }
                }
            }

            if ($photos) {
                foreach ($photos as $key => $photo) {
                    $fileName = $photo ? sha1(rand(1, 250).$title) : null;
                    $fileExtension = $photo ? $photo->extension() : null;
                    $name = "$fileName.$fileExtension";

                    if ($fileName && $fileExtension) {
                        Photos::create([
                            'photo'   => $name,
                            'news_id' => $id,
                            'published_at' => $publishedAt,
                        ]);

                        $upload = $photo->storeAs('photos', $name);

                        if (!$upload) {
                            throw new \Exception('Upload unsuccessful');
                        }
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('panel_news')
                ->with('message', 'Notícia atualizada');
        } catch(\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        $news = News::where('id', $id)
            ->get(['id', 'is_active'])
            ->first();

        try {
            $news->is_active = $news->is_active == true ? false : true;
            $news->save();

            DB::commit();

            return back()->with('message', 'Status alterado');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['page' => 'Não foi possível concluir esta ação']);
        }
    }
}
