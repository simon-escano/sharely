<?php

include("classes.php");

$users = new FileJSON("data/users.json");
$posts = new FileJSON("data/posts.json");
$comments = new FileJSON("data/comments.json");

$currentUser = findUser(2);

setcookie("currentUser", $currentUser->id, time() + (86400 * 30), "/");

function findUser($id) {
  global $users;
  foreach($users->content as $user) {
    if ($user["id"] == $id) {
      return new User($user["id"], $user["username"], $user["password"], $user["followers"], $user["following"]);
    }
  }
  return null;
}

function createUser($username, $password) {
  global $users;
  $userAlreadyExists = false;
  foreach($users->content as $user) {
    if ($user["username"] == $username) {
      $userAlreadyExists = true;
      break;
    }
  }
  if (!$userAlreadyExists) {
    $users->content[] = new User(count($users->content) + 1, $username, $password, array(), array());
    $users->save();
  }
}

findUser($currentUser->id)->createPost(count($posts->content) + 1, "Bruh", "Hello");

?>