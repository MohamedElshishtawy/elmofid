<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Video;
use App\Models\Educater;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {

        $videos = Video::all()->groupBy('class');

        return view('educator.video.index', [

            'videos_1' => $videos->get('1', collect()),

            'videos_2' => $videos->get('2', collect()),

            'videos_3' => $videos->get('3', collect()),

        ]);

    }

    public function add(int $class)
    {

        return view('educator.video.add', [

            'class' => $class,

            'class_human' => Educater::class_human_read($class),

            'groups' => Group::where('class', $class)->get(),

        ]);

    }
    public function getYouTubeUrlFromEmbedCode($embedCode)
    {
        // Extract the src attribute value using regular expression
        preg_match('/src="([^"]+)"/', $embedCode, $matches);

        // Get the URL from the first capturing group
        $srcAttribute = isset($matches[1]) ? $matches[1] : '';

        // Use Laravel's Str class to extract the URL from the src attribute
        $url = Str::between($srcAttribute, 'src="', '"');

        return $url;
    }

    public function uploadvideoForClass(Request $request,int $class)
    {


        $url = $this->getYouTubeUrlFromEmbedCode($request->video_url);

        $availability = $request->has('availability') ? 1 : 0;
        $request->validate([
            'name' => 'required|string|max:25',
        ]);

        // Store data in the Videos database table
        Video::create([
            'name' => $request->name,
            'class' => $class,
            'link' => $url,
            'availability' => $availability
        ]);

        return redirect()->route('video_index')->with('تم تحميل الفيديو');

    }


    public function edit_video(int $class, int $id)
    {
        $video = Video::findOrFail($id);
        return view('educator.video.edit', [
            'video' => $video,
            'class_human' => Educater::class_human_read($class),
            'class' => $class
        ]);
    }

    public function save_edit_video(Request $request, int $class, int $id)
    {

        $availability = $request->has('availability') ? 1 : 0;

        $request->validate([
            'name' => 'required|string|max:25',
        ]);

        $video = Video::findOrFail($id)->update([
            'name' => $request->name,
            'availability' => $availability
        ]);
        return redirect()->route('video_index')->with('success', 'تم تعديل الفيديو');
    }

    public function delete($class, $video_id){

        Video::findOrFail($video_id)->delete();

        return redirect()->back()->with('success', 'تم حذف الفيديو');

    }

    public function show_videos() // For Students
    {

        $class =  Auth::user()->groups->class;

        $videos = Video::all()->where('class', $class)->where('availability', 1);

        return view('student.video.videos', [

            'aveleble_videos' => $videos

        ]);


    }

    public function show_video(int $video)
    {
        $video = Video::where('id', $video)->first();

        return view('student.video.show', [
           'video' => $video,
        ]);

    }
}
