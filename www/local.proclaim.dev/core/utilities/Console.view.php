<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/18/17
 * Time: 12:46 PM
 */
?>

<style>
    #php-console {
        width: 100%;
        height: auto;
        padding: 2rem;
    }
</style>
<div id="php-console">
    <?php
        foreach ($messages as $message)
        {
            echo $message;
        }
    ?>

</div>
