<!-- elements are grouped in "rows" -->

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_id . $select_id ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_nom . $nom ?></div>
    <div class="cell"><?php echo $label_prenom . $prenom ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">

    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_rue . $rue ?></div>
    <div class="cell"><?php echo $label_numero . $numero ?></div>
    <div class="cell"><?php echo $label_boite . $boite ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">

    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_pays . $select_pays ?></div>
    
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">

    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_cp . $select_cp ?></div>
    <div class="cell"><?php echo $label_villes . $select_villes ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">

    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_num_tel . $num_tel ?></div>
    <div class="cell"><?php echo $label_num_gsm . $num_gsm ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_mail . $mail ?></div>
    <div class="cell"><?php echo $label_num_tva . $num_tva ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell">
        <?php echo $label_lettre_mission ?>
        <div class="radio">
            <?php echo  $lettre_mission_1 . $label_lettre_mission_1 ?>
        </div>
        <div class="radio">
            <?php echo $lettre_mission_0 . $label_lettre_mission_0 ?>
        </div>
    </div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_budget . $budget ?></div>
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

<div class="row last">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $btnsubmit ?></div>
    
    
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
