<?php

$tittle = "02 - Construct";
$descripcion = "Perform logic operations on variables";

include 'template/header.php';

echo '<section>';

class PlayList
{
    # Attrs
    public $name;
    public $artist = array();
    public $genre = array();
    public $image = array();
    public $year = array();

    # Construct Method
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function setPlayList($artist, $genre, $image, $year)
    {
        $this->artist[] = $artist;
        $this->genre[]  = $genre;
        $this->image[]  = $image;
        $this->year[]   = $year;
    }
    public function getPlayList()
    {
        echo "<h3>PlayList: $this->name</h3>
            <div style='display:flex; gap: 0.4rem; flex-direction: column'>";
        foreach ($this->artist as $i => $artist) {
            echo "<div style='display: flex; gap: 0.4rem; border: 2px solid #0009;'>
                    <img src='{$this->image[$i]}' width='160px'>
                    <div>
                        <h4>Artist: $artist</h4>
                        <h5>Genre: {$this->genre[$i]}</h5>
                        <h5>Year: {$this->year[$i]}</h5>
                    </div>
                </div>";
        }
        echo "</div>";
    }
}

$pl = new PlayList("Merry Christmas");
$pl->setPlayList('Mariah Carey', 'Pop', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpHdLVTONJ3awKQ3Pf7GkugvEt_LxFdJEc5ngHe-3T3PimLFwlC62NrAEK3P83oibkiV-lvzMZ7xdAUKPGoWyqKTDW3q3PW9pAnBbF-PknlA&s=10', 1994);
$pl->setPlayList('Wham!', 'Pop', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyevKWd1uJZnQZigai-5mqHn_Lab0RJpyKQkIBqu-3qPe8yhQRt0AehlNqszpxf-85eHsTY0Yc4bq9wovmo0nfSi2ZPrW6d3RfT1FkZMsLgg&s=10', 1984);
$pl->setPlayList('Michael Bublé', 'Jazz', 'data:image/jpeg;base64,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', 2011);
$pl->getPlayList();
include 'template/footer.php';
