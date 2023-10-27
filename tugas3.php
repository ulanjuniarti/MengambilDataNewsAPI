<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            height: 95%;
        }

        .card-img-top {
            width: 100%; height: 50%;
        }
    </style>
</head>
<body>
<?php
$kataKunci = "politik indonesia";
$sortBy = "date";
$apiKey = "8b674514515b4cdbbab8b073868b5bce";
$alamatAPI = "http://newsapi.org/v2/everything?" ."q={$kataKunci}&sortBy={$sortBy}&apiKey={$apiKey}";
// Link news API = https://newsapi.org/v2/everything?q=politik%20indonesia&sortBy=date&apiKey=8b674514515b4cdbbab8b073868b5bce

try {
    $data = @file_get_contents($alamatAPI);
    if ($data === false) {
        throw new Exception("Error! Coba cek kembali code program milikmu");
    }
    $dataBerita = json_decode($data);
    if ($dataBerita->status === "ok") {
        echo '<div class="container">';
        echo '<h1 class=text-center>Berita Politik Terkini</h1>';
        echo '<div class="row">';
        foreach ($dataBerita->articles as $berita) {
            echo '<div class="col-md-4">';
            echo '<div class="card mb-4">';
            if (!empty($berita->urlToImage)) {
                echo "<img src='{$berita->urlToImage}' alt='{$berita->title}' class='card-img-top'>";
            }
            echo '<div class="card-body">';
            echo "<h5 class='card-title'><a href='{$berita->url}'>{$berita->title}</a></h5>";
            echo "<p class='card-text'>" . substr($berita->description, 0, 100) . "...</p>";
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        throw new Exception("Error! Coba cek kembali code program milikmu");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
</body>
</html>
