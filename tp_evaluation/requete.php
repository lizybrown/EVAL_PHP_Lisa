<?php

function requete_addArticle($titre, $article, $date, $auteur) {
    $db = connexion_BD();
    $sql = "INSERT INTO articles (titre, article, auteur) VALUES (:titre, :article, :auteur)";
    $req = $db->prepare($sql);
    $result = $req->execute([
        ":titre" => $titre,
        ":article" => $article,
        ":auteur" => $auteur,
    ]);
    return $result;
}

function crea_article ($auteur,$article,$titre){
    $db = connexion_BD();
    $sql = "INSERT INTO articles (titre, article, auteur) VALUES (:titre, :article, :auteur)";
    $req = $db->prepare($sql);
    $result = $req->execute([
        ":titre" => $titre,
        "article" => $article,
        ":auteur" => $auteur
    ]);
    return $result; 
}

function insert_article() {
    $db = connexion_BD();
    $sql = "SELECT * FROM articles ORDER BY article";
    $req = $db->prepare($sql);
    $req->execute([]);
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function requete_displayUsers() {
    $db = connexion_BD();
    $sql = "SELECT * FROM users ORDER BY pseudo";
    $req = $db->prepare($sql);
    $req->execute([]);
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function requete_deleteUser($id) {
    $db = connexion_BD();
    $sql = "DELETE FROM users WHERE id_role = :id";
    $req = $db->prepare($sql);
    $req->execute([
        ":id" => $id
    ]);
}



function requete_findUserName($name) {
    $db = connexion_BD();
    $sql = "SELECT pseudo FROM users WHERE pseudo = :pseudo";
    $req = $db->prepare($sql);
    $req->execute([
        ":pseudo" => $pseudo
    ]);
    $data = $req->fetch(PDO::FETCH_OBJ);
    return $data;
}

function requete_addUser($name, $passwo, $role) {
    $db = connexion_BD();
    $sql = "INSERT INTO users (users_pseudo, users_password, users_id_role) VALUES (:name, :password, :id_role)";
    $req = $db->prepare($sql);
    $result = $req->execute([
        ":pseudo" => $pseudo,
        ":password" => $password,
        ":id_role" => $role,
    ]);
    return $result;
}

function requete_findUser($id) {
    $db = connexion_BD();
    $sql = "SELECT * FROM users WHERE id_role = :id";
    $req = $db->prepare($sql);
    $req->execute([
        ":id" => $id
    ]);
    $data = $req->fetch(PDO::FETCH_OBJ);
    return $data;
}
// **************************************


// function requete_modify($name, $mail, $img, $id) {
//     $db = connexion_BD();
//     $sql = "UPDATE users SET users_name = :name, users_mail = :mail, users_img = :img WHERE id_users = :id";
//     $req = $db->prepare($sql);
//     $result = $req->execute([
//         ":name" => $name,
//         ":mail" => $mail,
//         ":img" => $img,
//         ":id" => $id
//     ]);
//     return $result;
// }

function requete_inscription($pseudo,$password,$role) {
    $db = connexion_BD();
    $sql = "INSERT INTO users (pseudo, password,id_role) VALUES (:pseudo, :password, :role)";
    $req = $db->prepare($sql);
    $result = $req->execute([
        ":pseudo" => $pseudo,
        "password" => $password,
        ":role" => $id_role
    ]);
    return $result;
}

