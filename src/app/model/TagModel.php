<?php

class TagModel {
    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    public function getAllTags() {
        $query = 
        '   SELECT tag_id, tag_name
            FROM tag;
        ';

        $this->database->query($query);
        $tags = $this->database->fetchAll();

        return $tags;
    }
}
