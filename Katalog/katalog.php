<?php
$knihy = [
    [
        'nazev' => 'Harry Potter 1',
        'autor' => 'J. K. Rowling',
        'rok' => 2005,
        'kategorie' => "Fantasy"
    ],
    [
        'nazev' => 'Harry Potter 2',
        'autor' => 'J. K. Rowling',
        'rok' => 2007,
        'kategorie' => "Fantasy"
    ],
    [
        'nazev' => 'Harry Potter 3',
        'autor' => 'J. K. Rowling',
        'rok' => 2009,
        'kategorie' => "Fantasy"
    ],
    [
        'nazev' => 'Osamělý vlk',
        'autor' => 'Jo Nesbø',
        'rok' => 2017,
        'kategorie' => "Detektivní"
    ],
    [
        'nazev' => 'Krvavé slzy',
        'autor' => 'Vlastimil Vondruška',
        'rok' => 1985,
        'kategorie' => "Historická"
    ]
];

$vybranyAutor = isset($_GET['fullText']) ? $_GET['fullText'] : '';
$kategorie = isset($_GET['kategorie']) ? $_GET['kategorie'] : '0';

if (isset($_POST['nazev']) && isset($_POST['autor']) && isset($_POST['rok']) && isset($_POST['kategorie'])){
    $novaKniha =[
        'nazev' => $_POST['nazev'],
        'autor' => $_POST['autor'],
        'rok' => $_POST['rok'],
        'kategorie' => $_POST['kategorie']
    ];
    array_push($knihy, $novaKniha);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Filtrování:</h2>
    <form method="get">
        <input type="text" name="fullText" placeholder="Zadejte autora" value="<?= htmlspecialchars($vybranyAutor) ?>">
        <select name="kategorie">
            <option value="0">Vyberte kategorii</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Detektivní">Detektivní</option>
            <option value="Historická">Historická</option>
        </select>
        <button type="submit">Vyhledat</button>
    </form>

    <h2>Seznam knih:</h2>
    <table>
        <tr>
            <th>Název</th>
            <th>Autor</th>
            <th>Rok</th>
            <th>Kategorie</th>
        </tr>
        <?php foreach ($knihy as $kniha):
            $fullTextShoda = empty($vybranyAutor) || stripos($kniha['nazev'], $vybranyAutor) !== false || stripos($kniha['autor'], $vybranyAutor) !== false;
            $kategorieShoda = $kategorie === '0' || $kniha['kategorie'] === $kategorie;
            if ($fullTextShoda && $kategorieShoda): ?>
                <tr>
                    <td><?= htmlspecialchars($kniha['nazev']) ?></td>
                    <td><?= htmlspecialchars($kniha['autor']) ?></td>
                    <td><?= htmlspecialchars($kniha['rok']) ?></td>
                    <td><?= htmlspecialchars($kniha['kategorie']) ?></td>
                </tr>
            <?php endif; endforeach; ?>
    </table>

    <h2>Přidat novou knihu:</h2>
    <form method="post">
        <label for="nazev">Název:</label>
        <input type="text" name="nazev" required>
        <br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" required>
        <br>
        <label for="rok">Rok:</label>
        <input type="number"name="rok" required>
        <br>
        <label for="kategorie">Kategorie:</label>
        <input type="text" name="kategorie" required>
        <br>
        <button type="submit">Přidat</button>
    </form>
</body>
</html>