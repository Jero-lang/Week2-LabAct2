<?php

class Book {
    public $title;
    protected $author;
    private $price;

    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function getDetails() {

        return "Title: {$this->title}, Author: {$this->author}, Price: \${$this->price}";

    }

    public function setPrice($price) {

        $this->price = $price;

    }

    public function __call($name, $arguments) {
        if ($name == 'updateStock') {

            echo "Stock updated for '{$this->title}' with arguments: {$arguments[0]}\n";
            echo "Books in the library:\n";

        } else {

            echo "Method '{$name}' does not exist.\n";
        }
    }
}



class Library {
    private $books = [];
    public $name;

    public function __construct($name) {

        $this->name = $name;
    }

    public function addBook(Book $book) {

        $this->books[$book->title] = $book;

    }

    public function removeBook($title) {
        if (isset($this->books[$title])) {
            unset($this->books[$title]);

            echo "Book '{$title}' removed from the library.\n";
        } else {

            echo "'{$title}' not found in library.\n";
        }
    }

    public function listBooks() {

        foreach ($this->books as $book) {

            echo $book->getDetails() . "\n";
        }
    }

    public function __destruct() {

        echo "The library '{$this->name}' is now closed.\n";
    }
}

$library = new Library("City Library");

$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 12.99);
$book2 = new Book("1984", "George Orwell", 8.99);

$library->addBook($book1);
$library->addBook($book2);

$book1->updateStock(50);
$library->listBooks();

$library->removeBook("1984");

echo "Books in the library after removal:\n";
$library->listBooks();

unset($library);

//One of the problems encountered is how to get the title, author, and price in class Book. 
//To access these objects in class Book, their method or function must be in public modifier 
//so they can be accessed by other classes and use it. And last to follow the output in the screenshot 
//i need to put the functions in proper sequence in line 81 to 97.

?>