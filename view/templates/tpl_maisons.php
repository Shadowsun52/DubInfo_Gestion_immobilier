<div id="form_maison">

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_id . $select_id ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
 <div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_titre . $titre ?></div>
    <div class="cell"><?php echo $label_reference . $reference ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
 <div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_titre_site . $titre_site ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_rue . $rue ?></div>
    <div class="cell"><?php echo $label_numero . $numero ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_commune . $select_commune ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>    

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_source . $select_source ?></div>
    <div class="cell"><?php echo $label_reference_source . $reference_source ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_contact ?>
        <div id="contact1">
            <?php echo $select_contact1 ?>
        </div>
    </div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_prix . $prix ?></div>
    <div class="cell"><?php echo $label_prix_conseille . $prix_conseille ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_superficie_habitable . $superficie_habitable ?></div>
    <div class="cell"><?php echo $label_prix_mcarre . $prix_mcarre ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_chambres . $select_chambres ?></div>
    <div class="cell"><?php echo $label_sdb . $select_sdb ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_rendement . $rendement ?></div>
    <div class="cell"><?php echo $label_cout_travaux . $cout_travaux ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell">
        <?php echo $label_dossier ?>
        <div class="radio">
            <?php echo  $dossier_1 . $label_dossier_1 ?>
        </div>
        <div class="radio">
            <?php echo $dossier_0 . $label_dossier_0 ?>
        </div>
    </div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>    

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_localisation . $localisation ?></div>
    <div class="cell"><?php echo $label_localisation_indice . $select_localisation_indice ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_qualite . $qualite ?></div>
    <div class="cell"><?php echo $label_qualite_indice . $select_qualite_indice ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_etat . $select_etat ?></div>   
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
    
<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell">
        <?php echo $label_show ?>
        <div class="radio">
            <?php echo  $show_1 . $label_show_1 ?>
        </div>
        <div class="radio">
            <?php echo $show_0 . $label_show_0 ?>
        </div>
    </div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>  
    
<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_remarque . $remarque ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row optional">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_raison_abandon . $raison_abandon ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $btnsubmit ?></div>
    
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

</div>