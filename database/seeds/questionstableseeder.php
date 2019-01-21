<?php

use Illuminate\Database\Seeder;

class questionstableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\question::create([
            'Title' =>'How to create a repository in github?',
            'Description' =>'How to create repository in github and how to clone that repository?',
            'Tags' => 'git,github,vcs',
        ]);
          App\question::create([
            'Title' =>'what is codetrek?',
            'Description' =>'Please tell me something about the colored cow and codetrek and the company started and how it came to tehri ?',
            'Tags' => 'codetrek,colored cow,tehri',
        ]);
           App\question::create([
            'Title' =>'how to learn web development?',
            'Description' =>'I want to know more about the front end back end and the frameworks on which these websites are build like bootstrap,laravel,wordpress and many more.',
            'Tags' => 'web,coding,frontend,backend',
        ]);
            App\question::create([
            'Title' =>'how is thdc ihet???????',
            'Description' =>'please tell me the insights of thdc ihet?????',
            'Tags' => 'tehri,thdc,ihet,college',
        ]);
    }
}
