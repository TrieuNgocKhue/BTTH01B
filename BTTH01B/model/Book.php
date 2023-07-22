<?php
// Implement Book class that inherits from IBook
class Book implements IBook {
    private $title;
    private $author;
    private $publisher;
    private $publicationYear;
    private $ISBN;
    private $chapterList;

    public function __construct($title, $author, $publisher, $publicationYear, $ISBN, $chapterList) {
        $this->title = $title;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->publicationYear = $publicationYear;
        $this->ISBN = $ISBN;
        $this->chapterList = $chapterList;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPublisher() {
        return $this->publisher;
    }

    public function getPublicationYear() {
        return $this->publicationYear;
    }

    public function getISBN() {
        return $this->ISBN;
    }

    public function getChapterList() {
        return $this->chapterList;
    }
}
?>