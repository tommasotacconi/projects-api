<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\ProjectTranslation;
use Illuminate\Console\Command;

class MigrateProjectTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:migrate-translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy existing project texts into project_translations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Project::all() as $project) {
            ProjectTranslation::firstOrCreate([
                'project_id' => $project->id,
                'locale' => 'it',
                'description' => $project->arguments,
            ]);

            $this->info("Migrated project {$project->id}");
        }

        $this->info('Migration completed.');
    }
}