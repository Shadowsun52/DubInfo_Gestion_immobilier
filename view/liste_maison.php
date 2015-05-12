<?php
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    use DubInfo_gestion_immobilier\model\Maison;
?>
<h2>Liste des visites de maison par un investisseur</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
<!--        <div>
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
        </div>-->
    </div>
    <table id="liste">
        <thead>
            <tr>
                <th class="sort" data-sort="titre">Titre</th>
                <th class="sort" data-sort="etat">Etat</th>
                <th class="sort" data-sort="rue">Rue</th>
                <th class="sort" data-sort="numero">N°</th>
                <th class="sort" data-sort="commune">Commune</th>
                <th class="sort" data-sort="contact">Contact</th>
                <th class="sort" data-sort="prix">Prix annoncé</th>
                <th class="sort" data-sort="prix_conseille">Prix Conseillé</th>
                <th class="sort" data-sort="prix_m2">Prix m²</th>
                <th class="sort" data-sort="cout_travaux">Coût travaux</th>
                <th class="sort" data-sort="cout_totale">Coût total</th>
                <th class="sort" data-sort="chambres">Nbre chambres</th>
                <th class="sort" data-sort="sdb">Nbre Sdb</th>
                <th class="sort" data-sort="rendement">rendement</th>
                <th class="sort" data-sort="localisation">localisation</th>
                <th class="sort" data-sort="localisation_indice">localisation indice</th>
                <th class="sort" data-sort="qualite">Qualité</th>
                <th class="sort" data-sort="qualite indice">Qualité indice</th>
                
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
//            //On remplie le tableau avec les rencontres investisseurs
//            $business = new VisiteMaisonInvestisseurCRUD();
//            
//            foreach ($business->readAll() as $visite) {
//                echo '<tr>';
//                echo '<td class="nom">' . $visite->getInvestisseur()->getNom() . ' ' 
//                        . $visite->getInvestisseur()->getPrenom() . '</td>';
//                echo '<td class="etat">' . $visite->getInvestisseur()
//                        ->getEtat()->getLibelle() . '</td>';
//                echo '<td class="maison">' . $visite->getMaison()
//                        ->getTitre(Maison::LANGUAGE_FR) . '</td>';
//                echo '<td class="date center">' 
//                    . $visite->getDate()->format('Y/m/d') . '</td>';
//                echo '<td class="rapport">' . $visite->getRapport() . '</td>';
//                echo '</tr>';
//            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>