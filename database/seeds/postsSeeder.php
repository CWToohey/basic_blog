<?php

use Illuminate\Database\Seeder;
use App\posts;
use App\pics;

class postsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Charles "Charlie" Le Chat',
                'isPost' => 0,
                'content' => "Charles “Charlie” Le Chat is a well-loved and respected member of Our Town. Most residents know Charlie through the outstanding work he has done promoting tourism in our community. Vacationers from around the state and country travel to Our Town just to meet Charlie and have their picture taken with him (festive seasonal bowtie added for a small fee).

Charlie is a tireless promoter of our local businesses. Each morning he makes the rounds of Main Street shops, meeting with small-business owners and listening to their concerns. A typical morning might include a bit of chicken or cheese at Tasty Deli, a saucerful of warm milk at Town Market, and a relaxing head scratch at Our Town Auto, followed by a sunbeam siesta and belly rub on the steps of City Hall.

After many weeks spent sunning on the City steps, it’s now time for Charlie to move indoors and upstairs to the big office and the Mayor’s chair. From there, he'll ramp up his work promoting our town’s products and services, with the full resources of City Hall behind him. He'll work to improve services to town residents, increase educational resources for our teachers and students, expand beautification efforts in the community, and enforce leash laws within city limits.

Like Our Town, Charlie proves great things come in small packages. Vote Charles Le Chat for Mayor this November. Our future and his nine lives depend on it.
",
                'created_at' => "2017-03-25 15:31:44",
                'updated_at' => "2018-03-25 18:52:25",
                'path' => "images/samples/toni.jpg"
            ],
            [
                'title' => "Puddles: A Fleeting Fresh-Water Fix",
                'isPost' => 1,
                'content' => "The fresh, clean waters of Our Town are one of our greatest assets. We all enjoy swimming, fishing, and kayaking in Town Lake, but did you know that most of Our Town’s drinking water comes from the same springs that feed the lake?

Join me at noon on June 20th at the Town Lake dock, as I curl up on a sun-warmed bench and listen to a presentation by Ima Amoeba, Town Biologist. Ima will be discussing the health of Our Town Lake, the threats to our water quality, and the actions we can take to preserve our waters.

Bring a lunch, some folding chairs, fishing poles, and any extra sardines you may have hidden in the pantry. If it rains, there’ll be plenty of puddles for lapping and low benches for cover. Human residents, please remember to bring a beverage and an umbrella.",
                'created_at' => "2017-03-25 15:20:37",
                'updated_at' => "2018-03-25 19:29:30",
                'path' => "images/samples/bridge.JPG",
            ],
            [
                'title' => "Barking Out Windows: The Search For A Fair Traffic Solution",
                'isPost' => 1,
                'content' => "Homeowners, local businesses, and commuters have been complaining for years about the increased traffic congestion on Main Street during rush hour. As our population increases and more residents commute into Bigger City for work and recreation, local roadways (and nerves) have become stressed. We need to find a solution that's fair to all residents, while maintaining the quiet charm of our Historic Downtown.

To discuss possible solutions, I’ll be holding a town meeting with Planning Commissioner Redd Bulldozer at City Hall on May 14 at 7:00 p.m. Bring your thinking caps and your soap boxes. Refreshments will be served.

And if for you, a car trip means riding shotgun with your head out the window and the wind in your face? You just keep on keepin' on. But ease up on the barking. Especially you chihuahuas.",
                'updated_at' => "2018-03-25 19:27:05",
                'path' => "images/samples/skyline.JPG"
            ],
            [
                'title' => "Bird-Brained or Brilliant? One Solution To The Affordable Housing Crisis
",
                'isPost' => 1,
                'content' => "Like many communities, Our Town has struggled with ways to provide affordable housing for all our residents: humans, pets, and wildlife alike.

While watching volunteers from Our Town High School erect birdhouses for our delicious winged residents, it occurred to me that small spaces might work for human residents, too. After all, the dogs have their dog houses. Why not affordable tiny houses for the lesser limbed members of our community?

Is this idea wise like an owl? Or crazy as a cuckoo? Let me know. I’ll be hosting a meet-greet-and-pet potluck at the Town Library on April 1 at 8:00 p.m. Please contact Head Librarian Rita Book if you plan on attending. Last-minute drop-ins are welcome.

Stop by. Bring a treat. Don’t forget the tuna fish and catnip.",
                'created_at' => "2017-03-26 15:26:19",
                'updated_at' => "2018-03-25 19:15:24",
                'path' => "images/samples/birdhouse.JPG"
            ]
        ];



        foreach ($data as $posting) {
            $image = $posting['path'];
            $pic = new pics();
            $pic->path = $image;
            $pic->save();

            unset($posting['path']);
            $posting['pics'] = $pic->id;

            posts::create($posting);
        }

    }
}
