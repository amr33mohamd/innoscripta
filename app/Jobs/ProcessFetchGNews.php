<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Source;
use App\Jobs\StoreGNews;


class ProcessFetchGNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get(env('GUARDIAN_URL'), [
            'q' => 'debate',
            'api-key' => env('GUARDIAN_API_KEY'),
            'page-size' => 200,
            'page' => 1,
        ])->json();
        //pages = 190 because this is test api max 
        $pages = 4;
        $source_id = Source::where('name','The Guardian')->first()->id;
        for($i = 1;$i <= $pages;$i++ ){
            StoreGNews::dispatch($i,200,$source_id);
        }
    }
}
