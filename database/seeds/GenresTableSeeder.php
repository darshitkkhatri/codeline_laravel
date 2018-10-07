<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {

    $now = new DateTime();

    $table = DB::table('genres');
    $table->insert([
      'slug'       => "drama",
      'name'       => "Drama",
      'created_at' => $now,
    ]);

  

    $table->insert([
      'slug'       => "action",
      'name'       => "Action",
      'created_at' => $now,
    ]);


    $table->insert([
      'slug'       => "sci-fi",
      'name'       => "Sci-Fi",
      'created_at' => $now,
    ]);

  }
}