<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Source;


class StoreGNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $page;
    protected $page_size;
    protected $source_id;

    /**
     * Create a new job instance.
     */
    public function __construct($page,$page_size,$source_id)
    {
        $this->page = $page;
        $this->page_size = $page_size;
        $this->source_id = $source_id;
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log::info("Page {$this->source_id} - Articles fetched and stored successfully.");


        $response = Http::get('https://content.guardianapis.com/search', [
            'q' => 'debate',
            'api-key' => env('GUARDIAN_API_KEY'),
            'page-size' => $this->page_size,
            'page' => $this->page,
            'show-blocks'=>'all'
        ])->json();
        

            // Extract relevant data from the response (modify as per The Guardian API structure)
            $articlesData = $response['response']['results'];

            // Prepare data for batch insertion
            $articlesToInsert = [];
            foreach ($articlesData as $articleData) {
                $articleIdentifier = $articleData['id']; // Replace with the actual unique identifier
                
                // Check if the article already exists
                if (!Article::where('web_id', $articleIdentifier)->exists()) {
                    $articlesToInsert[] = [
                        'title' => $articleData['webTitle'],
                        'body' => $articleData['blocks']['body'][0]['bodyTextSummary'],
                        'source_id' => $this->source_id,
                        'category' => $articleData['sectionName'], // Adjust as needed
                        'publish_date' => Carbon::parse($articleData['webPublicationDate'])->toDateTimeString(),
                        'web_id'=>$articleData['id'],
                        'author'=>'Guardian Community',
                        'url'=>$articleData['webUrl'],
                        'image'=>$articleData['blocks']['main']['elements'][0]['assets'][0]['file'] ?? 'https://via.placeholder.com/150',
                    ];
                }
            }

            // Batch insert the new articles
            Article::insert($articlesToInsert);

            Log::info("Page {$this->page} - Articles fetched and stored successfully.");
        
    }
}
