<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
if($categories->getCategoryType() == 3 ){
    echo $categories->getContent();
}
