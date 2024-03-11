<?php

// Definizione del trait
trait Loggable
{
    public function log($message)
    {
        echo "[" . date('Y-m-d H:i:s') . "] " . $message . "\n";
    }
}

// Definizione della classe base Prodotto
class Prodotto
{
    use Loggable; // Utilizzo del trait Loggable

    public $id;
    public $nome;
    public $descrizione;
    public $prezzo;
    public $immagine;
    public $categoria;
    public $tipoArticolo;

    function __construct($id, $nome, $descrizione, $prezzo, $immagine, $categoria, $tipoArticolo)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new InvalidArgumentException("L'ID deve essere un numero positivo.");
        }

        $this->id = $id;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->immagine = $immagine;
        $this->categoria = $categoria;
        $this->tipoArticolo = $tipoArticolo;

        // Esempio di utilizzo del metodo log del trait Loggable
        $this->log("Prodotto creato: $nome");
    }
}

// Definizione della sottoclasse ProdottoCane che estende Prodotto
class ProdottoCane extends Prodotto
{
    public $razza;

    function __construct($id, $nome, $descrizione, $prezzo, $immagine, $categoria, $tipoArticolo, $razza)
    {
        parent::__construct($id, $nome, $descrizione, $prezzo, $immagine, $categoria, $tipoArticolo);
        $this->razza = $razza;
    }
}

// Definizione della sottoclasse ProdottoGatto che estende Prodotto
class ProdottoGatto extends Prodotto
{
    public $razza;

    function __construct($id, $nome, $descrizione, $prezzo, $immagine, $categoria, $tipoArticolo, $razza)
    {
        parent::__construct($id, $nome, $descrizione, $prezzo, $immagine, $categoria, $tipoArticolo);
        $this->razza = $razza;
    }
}

// Definizione degli oggetti e try e catch
try {
    $prodotti = array(
        new ProdottoCane(1, "Cibo per cani", "Cibo gustoso e nutriente per cani", 10.99, "./assets/img/cibo_cani.jpg", "Cani", "Cibo", "Pastore tedesco"),
        new ProdottoGatto(2, "Gioco per gatti", "Divertente gioco per intrattenere il tuo gatto", 5.99, "./assets/img/gioco_gatti.jpg", "Gatti", "Gioco", "Siberiano"),
        new ProdottoCane(4, "Cuccia per cani", "Comoda cuccia per il tuo cane", 25.99, "./assets/img/cuccia_cani.jpg", "Cani", "Cuccia", "Labrador")
    );
} catch (InvalidArgumentException $e) {
    echo "Errore: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Online</title>

    <!-- my style -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- bootstrap style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <?php foreach ($prodotti as $prodotto) : ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="<?php echo $prodotto->immagine; ?>" class="card-img-top" alt="<?php echo $prodotto->nome; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $prodotto->nome; ?></h5>
                            <p class="card-text"><?php echo $prodotto->descrizione; ?></p>
                            <p class="card-text">Prezzo: $<?php echo $prodotto->prezzo; ?></p>
                            <p class="card-text">Categoria: <?php echo $prodotto->categoria; ?></p>
                            <p class="card-text">Tipo di articolo: <?php echo $prodotto->tipoArticolo; ?></p>
                            <?php if ($prodotto instanceof ProdottoCane || $prodotto instanceof ProdottoGatto) : ?>
                                <p class="card-text">Razza: <?php echo $prodotto->razza; ?></p>
                            <?php endif; ?>
                            <a href="#" class="btn btn-primary">Aggiungi al carrello</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1"></script>
</body>

</html>