<?php

class Movie{
    private $title;
    private $availableCopies;

    public function __construct($title, $availableCopies){
        $this->title = $title;
        $this->availableCopies = $availableCopies;
    }

    public function getTtitle(){
        return $this->title;
    }

    public function getAvailableCopies(){
        return $this->availableCopies;
    }

    public function rentMovie(){
        if($this->availableCopies > 0){
            return $this->availableCopies--;
        }
        else{
            echo "No copies available for {$this->title}\n";
            return false;
        }
        
    }

    public function returnMovie(){
        return $this->availableCopies++;
    }


}

class Customer{
    private $name;

    public function __construct($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function rentMovie(Movie $movie){
        if ($movie->rentMovie()){
            echo "{$this->name} rented 1 copy of {$movie->getTtitle()}\n";
        }
    }

    public function returnMovie(Movie $movie){
        $movie->returnMovie();
        echo "{$this->name} returned 1 copy of {$movie->getTtitle()}\n";
    }
}

$movie_1 = new Movie("Whisper of The Heart", 2);
$movie_2 = new Movie("My Neighbor Totoro", 2);

$customer_1 = new Customer("Nabil");
$customer_2 = new Customer("Ashraful");

$customer_1->rentMovie($movie_1);
$customer_2->rentMovie($movie_2);
$customer_1->rentMovie($movie_1);
$customer_2->rentMovie($movie_2);
$customer_1->rentMovie($movie_1);
$customer_2->rentMovie($movie_2);
$customer_1->returnMovie($movie_1);
$customer_2->returnMovie($movie_2);

echo "-----------------------\n";
echo "Available Copies of {$movie_1->getTtitle()}: {$movie_1->getAvailableCopies()}\n";
echo "Available Copies of {$movie_2->getTtitle()}: {$movie_2->getAvailableCopies()}\n";

?>