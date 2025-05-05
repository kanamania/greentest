<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    public function processUpload(Request $request)
    {
        if(!$request->hasFile('file')){
            session('status', ['type'=> 'error', 'message' => 'No file provided']);
            return back();
        }
        $file = $request->file('file');
        $file = fopen($file->getRealPath(), 'r');
        fgetcsv($file);
        $delay = 1;
        while(false !== ($line = fgetcsv($file))){
            SendEmailJob::dispatch($line)->delay(now()->addMinutes($delay))->onQueue('emails');
            $delay++;
        }
        session('status', ['type'=> 'success', 'message' => 'Emails queued to be sent']);
        return back();
    }

    public function queue()
    {
    }
}
