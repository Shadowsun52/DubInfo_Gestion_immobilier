<?php
    use DubInfo_gestion_immobilier\business\LocataireCRUD;
?>
<h2>Liste des Locataires</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
        <div>
            <p><label>Etat : </label></p>
            <p>
                <select id="select_etat" class="filter_option">
                    <option value="">- Filtrer les états -</option>
                    <option value="Potentiel">Potentiel</option>
                    <option value="Actif">Actif</option>
                    <option value="Locataire en cours">Locataire en cours</option>
                    <option value="Locataire confirmé">Locataire confirmé</option>
                    <option value="Abandonné">Abandonné</option>
                </select>
            </p>
        </div>
        <div>
            <p><label>Budget : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_budget" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_budget" type="number" class="filter_option"/>
            </p> 
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
                echo '<td class="budget center">' . $locataire->getBudget() . '</td>';
                echo '<td class="remarques">' . $locataire->getCommentaire() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>
<script type="text/javascript">
    addBorneFilter("budget");
</script>