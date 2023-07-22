<?php
// Define IBook interface
interface IBook {
    public function getTitle();
    public function getAuthor();
    public function getPublisher();
    public function getPublicationYear();
    public function getISBN();
    public function getChapterList();
}
?>