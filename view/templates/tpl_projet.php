<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_investisseur . $select_investisseur ?></div>
    <div class="cell"><?php echo $label_id . $select_id ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_maison . $select_maison ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_date_signature_compromis 
            . $date_signature_compromis ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_date_signature_acte . $date_signature_acte ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell">
        <?php echo $label_plan_metre_fait ?>
        <div class="radio">
            <?php echo  $plan_metre_fait_1 . $label_plan_metre_fait_1 ?>
        </div>
        <div class="radio">
            <?php echo $plan_metre_fait_0 . $label_plan_metre_fait_0 ?>
        </div>
    </div>
    <div class="cell">
        <?php echo $label_selection_materiaux_fait ?>
        <div class="radio">
            <?php echo  $selection_materiaux_fait_1 
                    . $label_selection_materiaux_fait_1 ?>
        </div>
        <div class="radio">
            <?php echo $selection_materiaux_fait_0 
                    . $label_selection_materiaux_fait_0 ?>
        </div>
    </div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell">
        <?php echo $label_devis_entrepreneur_confirme ?>
        <div class="radio">
            <?php echo  $devis_entrepreneur_confirme_1 
                    . $label_devis_entrepreneur_confirme_1 ?>
        </div>
        <div class="radio">
            <?php echo $devis_entrepreneur_confirme_0 . 
                    $label_devis_entrepreneur_confirme_0 ?>
        </div>
    </div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell">
        <?php echo $label_commande_mobilier_fait ?>
        <div class="radio">
            <?php echo  $commande_mobilier_fait_1 
                    . $label_commande_mobilier_fait_1 ?>
        </div>
        <div class="radio">
            <?php echo $commande_mobilier_fait_0 . 
                    $label_commande_mobilier_fait_0 ?>
        </div>
    </div>
    <div class="cell"><?php echo $label_date_livraison_mobilier 
            . $date_livraison_mobilier ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <div class="cell"><?php echo $label_date_reception_chantier 
            . $date_reception_chantier  ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_etat . $select_etat ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_remarque . $remarque ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $btnsubmit ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>