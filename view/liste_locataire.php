<?php
    use DubInfo_gestion_immobilier\business\LocataireCRUD;
?>
<h2>Liste des Locataires</h2>
<div id="table_of_item">
    <div id="filter">
        <!--<input class="search" placeholder="Search" />-->
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
            $business = new LocataireCRUD();
            
            foreach ($business->readAll() as $locataire) {
                echo '<tr>';
                echo '<td class="nom">' . $locataire->getNom() . ' ' 
                        . $locataire->getPrenom() . '</td>';
                echo '<td class="etat">' . $locataire->getEtat()->getLibelle() 
                        . '</td>';
                echo '<td class="num_tel">' . $locataire->getNumTelephone() . '</td>';
                echo '<td class="num_gsm">' . $locataire->getNumGsm() . '</td>';
                echo '<td class="mail">' . $locataire->getMail() . '</td>';
                echo '<td class="budget number">' . $locataire->getBudget() . '</td>';
                echo '<td class="remarques">' . $locataire->getCommentaire() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>