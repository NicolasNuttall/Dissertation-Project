<?php
class Book{
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function LoadData(){
        $book_id = $_GET["id"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/books/v1/volumes/".$book_id);
        $output = curl_exec($ch);
        curl_close($ch);
        $book = json_decode($output, true);
        return $book;
    }
}