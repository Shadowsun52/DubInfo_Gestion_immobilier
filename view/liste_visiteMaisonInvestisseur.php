<?php
    use DubInfo_gestion_immobilier\business\VisiteMaisonInvestisseurCRUD;
    use DubInfo_gestion_immobilier\model\Maison;
?>
<h2>Liste des visites de maison par un investisseur</h2>
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
                    <option value="Propriétaire">Propriétaire</option>
                    <option value="Abandonné">Abandonné</option>
                </select>
            </p>
        </div>
        <div>
            <p><label>Date : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_date" type="text" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_date" type="text" class="filter_option"/>
            </p> 
        </div>
    </div>
    <table id="liste">
        <thead>
            <tr>
                <th class="sort" data-sort="nom">Nom</th>
                <th class="sort" data-sort="etat">Etat</th>
                <th class="sort" data-sort="maison">Maison</th>
                <th class="sort" data-sort="date">Date visite</th>
                <th class="sort" data-sort="rapport">Rapport</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les rencontres investisseurs
            $business = new VisiteMaisonInvestisseurCRUD();
            
            foreach ($business->readAll() as $visite) {
                echo '<tr>';
                echo '<td class="nom">' . $visite->getInvestisseur()->getNom() . ' ' 
                        . $visite->getInvestisseur()->getPrenom() . '</td>';
                echo '<td class="etat">' . $visite->getInvestisseur()
                        ->getEtat()->getLibelle() . '</td>';
                echo '<td class="maison">' . $visite->getMaison()
                        ->getTitre(Maison::LANGUAGE_FR) . '</td>';
                echo '<td class="date center">' 
                    . $visite->getDate()->format('Y/m/d') . '</td>';
                echo '<td class="rapport">' . $visite->getRapport() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>