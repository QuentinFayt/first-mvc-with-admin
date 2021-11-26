<?php
function thesectionSelectAll(mysqli $db): array
{
    // requête
    $sql =
        "SELECT idthesection, thesectionTitle
    FROM thesection
    ORDER BY thesectionTitle ASC;";

    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_all($recup, MYSQLI_ASSOC);
}
