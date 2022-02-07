<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main id="main-content">
    <div class="container" id="container-area">
        <div class="row">
            <div class="col-sm-12">
                <h1>404</h1>
                <?php
                // 404-sivun sisällön voi tehdä pinona (stack), niin sitä on helppo muokata C5:ssä
                // ja tarvittaessa tehdä eri kieliversiot. Luo pino ja poista kommentointi alta:
                // $stack = Stack::getByName('404');
                // $stack->display();
                ?>
            </div>
        </div>
    </div>
</main>

<?php  $this->inc('elements/footer.php'); ?>
