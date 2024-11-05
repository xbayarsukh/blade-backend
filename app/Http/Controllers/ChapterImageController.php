<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ChapterImage;
use App\Models\Chapter;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;
use App\CustomClass\FireBasePushNotification;

class ChapterImageController extends Controller
{
    private $fcmService;

    public function __construct()
    {
        $this->fcmService = new FireBasePushNotification();
    }

    public function index($manga_id, $chapter_id) {
        $images = Chapter::join('chapter_images', 'chapter_images.chapter_id', 'chapters.id')
        ->join('mangas', 'mangas.id', 'chapters.manga_id')
        ->where('chapters.manga_id', $manga_id)
        ->where('chapters.id', $chapter_id)
        ->orderBy('chapter_images.count', 'ASC')
        ->select("chapter_images.*", "chapters.title as chapter_title", "mangas.title as manga_title")->get();
        return view('chapter_image.list', compact('images', 'manga_id', 'chapter_id'));
    }

    public function store(Request $request, $manga_id, $chapter_id) {
        $images = $request->file('images'); 
        $chapter = Chapter::where('manga_id', $manga_id)->where('id', $chapter_id)->first();
        $uploadedImages = []; // To store uploaded image data
        if ($images && $chapter) {
            foreach ($images as $key => $image) {
                $chapter_image = new ChapterImage;
    
                // Use the image from the loop
                $filename = $image->getClientOriginalName(); // Get the original file name
                $doubleValue = $this->convertImageNameToDouble($filename);
    
                // Convert the image to base64
                $other = new OtherController;
                $chapter_image->image = $other->getBase64Image($image); // Pass the correct image file
                
                $chapter_image->count = $doubleValue;
                $chapter_image->chapter_id = $chapter_id;
                $chapter_image->save();
    
                // Collect the base64 or image URL for response
                $uploadedImages[] = $chapter_image->image;
            }
            return response()->json(['images' => $uploadedImages], 200);
        }
        return response()->json(['message' => 'No images were uploaded'], 400);
    }

    public function convertImageNameToDouble($filename){
        if (preg_match('/^(\d+)(?:\.(\d+))?\.(?:png|jpeg|jpg|webp)$/', $filename, $matches)) {
            $integerPart = $matches[1];
            $decimalPart = isset($matches[2]) ? $matches[2] : '0';
            return (float)($integerPart . '.' . $decimalPart);
        }
        return 1.0;
    }

    public function destroy($manga_id, $chapter_id, $id) {
        $chapter = Chapter::where('manga_id', $manga_id)->where('id', $chapter_id)->first();
        if ($chapter) {
            $chapter_image = ChapterImage::find($id);
            $chapter_image->delete();
        }
       
        return Redirect::route('image-list', ["manga_id"=>$manga_id,"chapter_id"=>$chapter_id])->with('message', 'Амжилттай устгагдлаа.');
    }

    public function sendNotification($id) {
        $chapter = Chapter::find($id);
        if($chapter->manga->type != "premium"){
            $title = "Бүлэг нэмэгдлээ";
            $body = $chapter->manga->title . " манганы " . $chapter->title . " нэмэгдлээ";
            $response = $this->fcmService->toTopic("all", $body, $title);
        }
        return Redirect::route('chapter-list', $chapter->manga_id)->with('message', "Амжилттай илгээгдлээ.");
    }
}