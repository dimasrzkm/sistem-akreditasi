<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;

class EvaluationController extends Controller
{
    public function index()
    {
        $this->authorize('evaluation', \App\Models\User::class);
        return view('evaluations.index', [
            'user' => User::find(Auth::user()->id),
        ]);
    }
    
    public function create()
    {
        return view('evaluations.create');
    }

    public function store(Request $request)
    {
        $this->authorize('evaluation', \App\Models\User::class);
        $request->validate([
            'berkas_1' => ['required', File::types(['docx'])->max(5 * 1024)],
            'berkas_2' => ['required', File::types(['jpg'])->max(5 * 1024)],
            // 'berkas_3' => ['required', File::types(['pdf'])->max(5 * 1024)],
            // 'berkas_4' => ['required', File::types(['csv', 'xlsx'])->max(5 * 1024)],
        ]);
        
        for ($i=1; $i < count($request->all()); $i++) { 
            $name = '';
            switch ($i) {
                case 1:
                    $name = 'berkas-penilaian';
                    break;
                case 2:
                    $name = 'berkas-jumlah-mahasiswa';
                    break;
                default:
                    $name = 'yahh';
                    break;
            }
            Auth::user()
                ->addMediaFromRequest('berkas_'.$i)
                ->usingName($name)
                ->toMediaCollection();
        };
        Auth::user()->department->update(['apply_at' => now()]);
        return to_route('prodi.evaluation.index');
    }
    
    public function download()
    {
        $this->authorize('downloadFileEvaluation', \App\Models\User::class);
        return MediaStream::create('your-file.zip')->addMedia(Media::all());
    }
}
