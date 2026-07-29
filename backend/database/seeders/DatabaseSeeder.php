<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,

            ArticleSeeder::class,
            FullArticleSeeder::class,
            CleanArticleSeeder::class,

            SentimentAnalysisSeeder::class,
            FeatureSnapshotSeeder::class,
            PredictionResultSeeder::class,
            EnsembleResultSeeder::class,
            ScheduledJobSeeder::class,

        ]);
    }
}