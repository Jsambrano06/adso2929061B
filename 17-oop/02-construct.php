<?php

$tittle = "02 - Construct";
$descripcion = "Perform logic operations on variables";

include 'template/header.php';

echo '<section>';

class PlayList
{
    # Attrs
    public $artist;
    public $album;
    public $year;
    public $song;

    # Construct Method
    public function __construct($album, $year, $song, $artist = 'Charrito Negro')
    {
        $this->artist = $artist;
        $this->album  = $album;
        $this->year   = $year;
        $this->song   = $song;
    }
}

$pl = new PlayList('Black Tshirt', 1998, 'Nude Foots', 'monsalve');
echo $pl->artist;

include 'template/footer.php';
