<?php

class FileJSON {
  public $directory;
  public $content;
  public function __construct($directory) {
    $this->directory = $directory;
    $this->content = json_decode(file_get_contents($directory), true);
  }
  public function save() {
    file_put_contents($this->directory, json_encode($this->content, JSON_PRETTY_PRINT));
  }
}

class User {
  public $id;
  public $username;
  public $password;
  public $followers;
  public $following;
  public function __construct($id, $username, $password, $followers, $following) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->followers = $followers;
    $this->following = $following;
  }
  public function createPost($id, $title, $body) {
    $posts = new FileJSON("data/posts.json");
    $posts->content[] = new Post($id, $this, $title, $body);
    $posts->save();
  }
}

class Post {
  public $id;
  public $user;
  public $title;
  public $body;
  public $date;
  public $likes = array();
  public $comments = array();
  public function __construct($id, $user, $title, $body) {
    $this->id = $id;
    $this->user = $user;
    $this->title = $title;
    $this->body = $body;
    $this->date = date("Y-m-d H:i:s");
  }
}

class Comment {
  public $user;
  public $body;
  public $date;
  public $likes = array();
  public function __construct($user, $body) {
    $this->user = $user;
    $this->body = $body;
    $this->date = date("Y-m-d H:i:s");
  }
}

?>