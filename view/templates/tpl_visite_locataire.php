<style>
    .check #label_candidat_0 {
        display: inline;
        margin: 0 10px;
    }
</style>
<!-- elements are grouped in "rows" -->
<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_investisseur . $select_investisseur ?></div>
    <div class="cell"><?php echo $label_id . $select_id ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">

    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_date_visite . $date_visite ?></div>
    <div class="cell"><?php echo $label_maison . $select_maison ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_participants . $select_participants ?></div>
    <div class="cell check"><?php echo $label_candidat  . $label_candidat_0 . $candidat_0?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row even">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $label_rapport . $rapport ?></div>
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>

<div class="row">
    <!-- things that need to be side-by-side go in "cells" -->
    <div class="cell"><?php echo $btnsubmit ?></div>
    
    
    <!-- once we're done with "cells" we *must* place a "clear" div -->
    <div class="clear"></div>
</div>
