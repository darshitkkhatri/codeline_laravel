<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $table = DB::table('films');
    $now = new DateTime();

   
    $table->insert([
      'name'          => "Sholay",
      'slug'          => 'sholay',
      'description'   => 'Sholay (About this sound pronunciation (help·info), meaning “Embers”) is a 1975 Indian action-adventure film in Hindi language, written by Salim-Javed, directed by Ramesh Sippy, and produced by his father G. P. Sippy. The film is about two criminals, Veeru and Jai (played by Dharmendra and Amitabh Bachchan, respectively), hired by a retired police officer (Sanjeev Kumar) to capture the ruthless dacoit Gabbar Singh (Amjad Khan). Hema Malini and Jaya Bhaduri also star, as Veeru and Jai’s love interests. Sholay is considered a classic and one of the best Indian films. It was ranked first in the British Film Institute’s 2002 poll of “Top 10 Indian Films” of all time. In 2005, the judges of the 50th Filmfare Awards named it the Best Film of 50 Years.',
      'realease_date' => '14-11-1972',
      'rating'        => 5,
      'ticket_price'  => 100,
      'country_id'    => $this->getCountry('id')->id,
      'genre_id'      => $this->getGenre('action')->id,
      'photo_id'      => $this->uploadPhoto('sholay.jpg')->id,
      'created_at'    => $now,
    ]);

    
    $table->insert([
      'name'          => "The Avengers (2012 film)",
      'slug'          => 'avenger',
      'description'   => "Marvel’s The Avengers[6] (classified under the name Marvel Avengers Assemble in the United Kingdom and Ireland),[3][7] or simply The Avengers, is a 2012 American superhero film based on the Marvel Comics superhero team of the same name, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures.[N 1] It is the sixth film in the Marvel Cinematic Universe (MCU)",
      'realease_date' => '11-04-2012',
      'rating'        => 5,
      'ticket_price'  => 200,
      'country_id'    => $this->getCountry('us')->id,
      'genre_id'      => $this->getGenre('sci-fi')->id,
      'photo_id'      => $this->uploadPhoto('avenger.jpg')->id,
      'created_at'    => $now,
    ]);

   
    $table->insert([
      'name'          => "The Shawshank Redemption",
      'slug'          => "shawshank-redemption",
      'description'   => "the Shawshank Redemption is a 1994 American drama film written and directed by Frank Darabont, based on the 1982 Stephen King novella Rita Hayworth and Shawshank Redemption. It tells the story of banker Andy Dufresne (Tim Robbins), who is sentenced to life in Shawshank State Penitentiary for the murder of his wife and her lover, despite his claims of innocence.",
      'realease_date' => '15-08-1975',
      'rating'        => 5,
      'ticket_price'  => 300,
      'country_id'    => $this->getCountry('cn')->id,
      'genre_id'      => $this->getGenre('drama')->id,
      'photo_id'      => $this->uploadPhoto('tsr.jpg')->id,
      'created_at'    => $now,
    ]);



  }

  /**
   * @param string $countryCode
   * @return \App\Country
   */
  private function getCountry(string $countryCode) {
    return \App\Country::where('code', '=', $countryCode)->firstOrFail();
  }

  /**
   * @param string $genreSlug
   * @return \App\Genre
   */
  private function getGenre(string $genreSlug) {
    return \App\Genre::where('slug', '=', $genreSlug)->firstOrFail();
  }

  /**
   * @param $filename
   * @return \App\Image
   */
  private function uploadPhoto($filename) {


    $ext = mb_strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $name = uniqid() . ".$ext";
    $imagePath = "/uploads/$name";

    $from = base_path("/films-seeder/images/$filename");
    $dest = public_path($imagePath);

    File::copy($from, $dest);

    $image = new \App\Image();
    $image->path = $imagePath;
    $image->save();

    return $image;
  }

}
