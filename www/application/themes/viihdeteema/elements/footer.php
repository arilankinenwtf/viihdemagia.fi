<?php use Concrete\Core\Validation\CSRF\Token;

defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6 footer-first">
        <?php
        // new GlobalArea('nimi') luo yleisen alueen (jos sen nimistä ei vielä ole)
        $a = new GlobalArea('Footer First');
        $a->display();
        ?>
      </div>
      <div class="col-md-6 footer-second">
        <?php
        $a = new GlobalArea('Footer Second');
        $a->display();
        ?>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12 footer-forth">
        <?php
        // new GlobalArea('nimi') luo yleisen alueen (jos sen nimistä ei vielä ole)
        $a = new GlobalArea('Footer Forth');
        $a->display();
        ?>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12 footer-third">
        <?php
        // new GlobalArea('nimi') luo yleisen alueen (jos sen nimistä ei vielä ole)
        $a = new Area('Footer Third');
        $a->display();
        ?>
      </div>
  </div>
  <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
</div>


<?php $this->inc('elements/footer_bottom.php');?>
