<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $table = DB::table('countries');
    $table->insert([
      'code'  => "in",
      'title' => "India",
    ]);
    $table->insert([
      'code'  => "us",
      'title' => "USA",
    ]);
    $table->insert([
      'code'  => "cn",
      'title' => "Canada",
    ]);
  }

}