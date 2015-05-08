<?php
    use DubInfo_gestion_immobilier\business\InvestisseurCRUD;
?>
<h2>Liste des investisseurs</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
    </div>
    <table id="locataire-list">
        <thead>
            <tr>
                <th class="sort" data-sort="nom">Nom</th>
                <th class="sort" data-sort="etat">Etat</th>
                <th class="sort" data-sort="num_tel">Téléphone</th>
                <th class="sort" data-sort="num_gsm">Gsm</th>
                <th class="sort" data-sort="mail">Mail</th>
                <th class="sort" data-sort="budget">Budget</th>
                <th class="sort" data-sort="remarques">Remarques</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les locataires
            $business = new InvestisseurCRUD();
            
            foreach ($business->readAll() as $investisseur) {
                echo '<tr>';
                echo '<td class="nom">' . $investisseur->getNom() . ' ' 
                        . $investisseur->getPrenom() . '</td>';
                echo '<td class="etat">' . $investisseur->getEtat()->getLibelle() 
                        . '</td>';
                echo '<td class="num_tel">' . $investisseur->getNumTelephone() . '</td>';
                echo '<td class="num_gsm">' . $investisseur->getNumGsm() . '</td>';
                echo '<td class="mail">' . $investisseur->getMail() . '</td>';
                echo '<td class="budget center">' . $investisseur->getBudget() . '</td>';
                echo '<td class="remarques">' . $investisseur->getCommentaire() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>
<script type="text/javascript">
//    addBorneFilter("budget");
</script>