<!DOCTYPE html>
<html>
<head>
    <title>Article</title>
    <style>
        .article-full {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .article-image {
            width: 100%;
            height: 400px;
            background-size: cover;
            background-position: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <nav>
        <a href="indexP.php">Retour à l'accueil</a>
    </nav>

    <div class="article-full">
        <?php
        // Connexion à la base de données (utilisez les mêmes paramètres que dans index.php)
        $serveur = "localhost";
        $utilisateur = "root";
        $motDePasse = "";
        $baseDeDonnees = "mglsi_news";

        $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

        if ($connexion->connect_error) {
            die("La connexion à la base de données a échoué : " . $connexion->connect_error);
        }

        // Récupérer l'ID de l'article depuis l'URL
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Récupérer l'article spécifique
        $sql = "SELECT * FROM Article WHERE id = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultat = $stmt->get_result();

        if ($article = $resultat->fetch_assoc()) {
            echo "<h1>" . htmlspecialchars($article['titre']) . "</h1>";
            echo "<div class='article-image' style='background-image: url(\"images/article_" . $article['id'] . ".jpg\");'></div>";
            echo "<p>" . nl2br(htmlspecialchars($article['contenu'])) . "</p>";
        } else {
            echo "<p>Article non trouvé.</p>";
        }

        $connexion->close();
        ?>
    </div>
</body>
</html>