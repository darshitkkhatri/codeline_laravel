<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $now = new DateTime();
    $table = DB::table('users');

    $table->insert([
      'name'       => "test",
      'email'      => "test@test.com",
      'password'   => Hash::make('Test'),
      'created_at' => $now,
    ]);
  }
}
