<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
    <title>Site d'actualités</title>
    
</head>
<body>
    <nav>
        <a href="#" onclick="filtrerArticles('all')">Tous</a>
        <a href="#" onclick="filtrerArticles('1')">Sport</a>
        <a href="#" onclick="filtrerArticles('2')">Santé</a>
        <a href="#" onclick="filtrerArticles('3')">Éducation</a>
        <a href="#" onclick="filtrerArticles('4')">Politique</a>
    </nav>

    <?php
    // Connexion à la base de données
    $serveur = "localhost"; // Adresse du serveur MySQL
    $utilisateur = "root"; // Nom d'utilisateur MySQL
    $motDePasse = ""; // Mot de passe MySQL (vide par défaut sur WampServer)
    $baseDeDonnees = "mglsi_news"; // Nom de la base de données

    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    }

    // Récupérer les articles depuis la base de données
    $sql = "SELECT * FROM Article";
    $resultat = $connexion->query($sql);

    // Afficher les articles dans la page HTML(indexP.php)
    echo "<div class='container'>";
    while ($row = $resultat->fetch_assoc()) {
    echo "<div class='article categorie-" . $row['categorie'] . "'>";
    echo "<div class='article-image' style='background-image: url(\"images/article_" . $row['id'] . ".jpg\");'></div>";
    echo "<div class='article-content'>";
    echo "<div class='article-text'>";
    echo "<h2><a href='article.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['titre']) . "</a></h2>";
    echo "<p>" . substr(htmlspecialchars($row['contenu']), 0, 200) . "...</p>";
    echo "</div>";
    echo "<a href='article.php?id=" . $row['id'] . "' class='read-more'>Lire la suite</a>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";


    $connexion->close();
    ?>

    <script>
        function filtrerArticles(categorie) {
            var articles = document.querySelectorAll('.article');
            articles.forEach(function(article) {
                if (categorie === 'all' || article.classList.contains('categorie-' + categorie)) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        }
                    
    </script>
</body>
</html>
