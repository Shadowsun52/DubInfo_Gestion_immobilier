<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_locataire . $select_locataire ?></div>
    <div class="cell"><?php echo $label_id . $select_id ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_maison . $select_maison ?></div>
    <div class="cell"><?php echo $label_chambres . $select_chambres ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_loyer . $loyer ?></div>
    <div class="cell"><?php echo $label_charges . $charges ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_date_debut . $date_debut ?></div>
    <div class="cell"><?php echo $label_date_fin . $date_fin ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <div class="cell">
        <?php echo $label_bail_signe ?>
        <div class="radio">
            <?php echo  $bail_signe_1 . $label_bail_signe_1 ?>
        </div>
        <div class="radio">
            <?php echo $bail_signe_0 . $label_bail_signe_0 ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="row even">
    <div class="cell">
        <?php echo $label_etat_lieux_signe ?>
        <div class="radio">
            <?php echo  $etat_lieux_signe_1 . $label_etat_lieux_signe_1 ?>
        </div>
        <div class="radio">
            <?php echo $etat_lieux_signe_0 . $label_etat_lieux_signe_0 ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="cell">
        <?php echo $label_charte_signee ?>
        <div class="radio">
            <?php echo  $charte_signee_1 . $label_charte_signee_1 ?>
        </div>
        <div class="radio">
            <?php echo $charte_signee_0 . $label_charte_signee_0 ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_garantie_total . $garantie_total ?></div>
    <div class="cell"><?php echo $label_garantie_payee . $garantie_payee ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $btnsubmit ?></div>
    
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>