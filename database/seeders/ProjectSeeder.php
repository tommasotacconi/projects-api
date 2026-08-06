<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(Faker $faker): void
	{
		// Function to create fake projects
		for ($i = 0; $i < 10; $i++) {
			@dump($i);
			$new_project = new Project();
			$new_project->name = $faker->word();
			$new_project->type_id = $faker->numberBetween(1, 4);
			$new_project->authors = '';
			for ($j = 0; $j< 5; $j++) {
					$new_project->authors .= " $faker->name()";
			};
			// $new_project->purpose = $faker->text();
			$new_project->start_date = $faker->dateTimeThisYear();
			$new_project->end_date = $faker->dateTimeThisYear();
			$new_project->save();
		}
	}
}
