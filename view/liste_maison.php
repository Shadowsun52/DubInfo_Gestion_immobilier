<?php
    use DubInfo_gestion_immobilier\business\MaisonCRUD;
    use DubInfo_gestion_immobilier\business\CommuneCRUD;
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
            <p><label>Commune : </label></p>
            <p>
                <select id="select_commune" class="filter_option">
                    <option value="">- Filtrer les Communes -</option>
                <?php
                    $business_commune = new CommuneCRUD();
                    foreach ($business_commune->readList() as $commune) {
                        echo '<option value="'. $commune->getLibelle() .'">' 
                                . $commune->getLibelle() . '</option>';
                    }
                ?>
                </select>
            </p>
        </div>
        <div>
            <p><label>Prix conseillé : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_prix_conseille" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_prix_conseille" type="number" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Nombre chambres : </label></p>
            <p>
                <select id="select_chambres" class="filter_option">
                    <option value="">- Filtrer les chambres -</option>
                <?php
                    for ($i = 0; $i <= 20 ; $i++) {
                        echo '<option value="'. $i .'">' . $i . '</option>';
                    }
                ?>
                </select>
            </p>
        </div>
        <div>
            <p><label>Nombre Salle de bains : </label></p>
            <p>
                <select id="select_sdb" class="filter_option">
                    <option value="">- Filtrer les sdb -</option>
                <?php
                    for ($i = 1; $i <= 5 ; $i++) {
                        echo '<option value="'. $i .'">' . $i . '</option>';
                    }
                ?>
                </select>
            </p>
        </div>
        <div>
            <p><label>Rendement : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_rendement" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_rendement" type="number" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Indice localisation : </label></p>
            <p>
                <select id="select_localisation_indice" class="filter_option">
                    <option value="">- Filtrer la localisation -</option>
                <?php
                    for ($i = 0; $i <= 3 ; $i++) {
                        echo '<option value="'. $i .'">' . $i . '</option>';
                    }
                ?>
                </select>
            </p>
        </div>
        <div>
            <p><label>Indice Qualité : </label></p>
            <p>
                <select id="select_qualite_indice" class="filter_option">
                    <option value="">- Filtrer la qualité -</option>
                <?php
                    for ($i = 0; $i <= 3 ; $i++) {
                        echo '<option value="'. $i .'">' . $i . '</option>';
                    }
                ?>
                </select>
            </p>
        </div>
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
                <th class="sort" data-sort="rendement">Rendement</th>
                <th class="sort" data-sort="localisation">Localisation</th>
                <th class="sort" data-sort="localisation_indice">Localisation indice</th>
                <th class="sort" data-sort="qualite">Qualité</th>
                <th class="sort" data-sort="qualite_indice">Qualité indice</th>
                <th class="sort" data-sort="remarques">Remarques</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les rencontres investisseurs
            $business = new MaisonCRUD();
            
            foreach ($business->readAll() as $maison) {
                echo '<tr>';
                echo '<td class="titre">' 
                    . $maison->getTitre(Maison::LANGUAGE_FR) . '</td>';
                echo '<td class="etat">'. $maison->getEtat()->getLibelle() 
                        . '</td>';
                echo '<td class="rue">'. $maison->getAdresse()->getRue() 
                        . '</td>';
                echo '<td class="numero">'. $maison->getAdresse()->getNumero() 
                        . '</td>';
                echo '<td class="commune">'. $maison->getCommune()->getLibelle() 
                        . '</td>';
                $contacts = "";
                for($i = 0; $i < count($maison->getContacts()); $i++) {
                    if($i > 0) {
                        $contacts .= "</br>";
                    }
                    $contact = $maison->getContact($i);
                    $contacts .=  $contact->getNom() . ' ' . $contact->getPrenom();
                }
                echo '<td class="contact">' . $contacts . '</td>';
                echo '<td class="prix center">' . $maison->getPrix() . '</td>';
                echo '<td class="prix_conseille center">' 
                    . $maison->getPrixConseille() . '</td>';
                echo '<td class="prix_m2 center">' 
                    . $maison->getPrixMetreCarre() . '</td>';
                echo '<td class="cout_travaux center">' 
                    . $maison->getCoutTravaux() . '</td>';
                echo '<td class="cout_total center">'. ($maison->getCoutTravaux()
                        + $maison->getPrixConseille()) . '</td>';
                echo '<td class="chambres center">'
                    . count($maison->getChambres()) . '</td>';
                echo '<td class="sdb center">' 
                    . $maison->getNbSalleDeBain() . '</td>';
                echo '<td class="rendement center">' 
                    . $maison->getRendement() . '</td>';
                echo '<td class="localisation">' 
                    . $maison->getLocalisation() . '</td>';
                echo '<td class="localisation_indice center">' 
                    . $maison->getLocalisationIndice() . '</td>';
                echo '<td class="qualite">' 
                    . $maison->getQualite() . '</td>';
                echo '<td class="qualite_indice center">' 
                    . $maison->getQualiteIndice() . '</td>';
                echo '<td class="remarques center">' 
                    . $maison->getCommentaire() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    <a id="generate_excel">Générer excel</a>
    <div id="doc_excel"></div>
</div>
<script src="./js/liste.js"></script>