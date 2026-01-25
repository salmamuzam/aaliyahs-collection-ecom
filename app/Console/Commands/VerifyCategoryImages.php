<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Http;

class VerifyCategoryImages extends Command
{
    protected $signature = 'images:verify-categories';
    protected $description = 'Check verification status of category images on Cloudinary';

    public function handle()
    {
        $this->info("Verifying Category Images...");

        $categories = DB::table('categories')->get();

        foreach ($categories as $cat) {
            $url = ImageHelper::getUrl($cat->image);

            $this->info("Category: " . $cat->name);
            $this->info("  - DB Path: " . $cat->image);
            $this->info("  - Generated URL: " . $url);

            try {
                $response = Http::head($url);
                if ($response->successful()) {
                    $this->info("  - Status: OK (" . $response->status() . ")");
                } else {
                    $this->error("  - Status: FAILED (" . $response->status() . ")");
                }
            } catch (\Exception $e) {
                $this->error("  - Error: " . $e->getMessage());
            }
            $this->newLine();
        }

        $this->info("Verification Complete.");
    }
}
