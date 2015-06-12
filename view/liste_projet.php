<?php
    use DubInfo_gestion_immobilier\business\ProjetCRUD;
    use DubInfo_gestion_immobilier\model\Maison;
?>
<h2>Liste des projets</h2>
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
            <p><label>Date compromis: </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_compromis" type="text" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_compromis" type="text" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Date acte: </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_acte" type="text" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_acte" type="text" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Plan métré fait ? : </label></p>
            <p>
                <span class="low_size">Oui </span>
                <input type="checkbox" name="plan_metre" value="oui" 
                       class="filter_option"/>
                <span class="low_size">Non </span> 
                <input type="checkbox" name="plan_metre" value="non" 
                       class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Devis entrepreneur fait ? : </label></p>
            <p>
                <span class="low_size">Oui </span>
                <input type="checkbox" name="devis" value="oui" class="filter_option"/>
                <span class="low_size">Non </span> 
                <input type="checkbox" name="devis" value="non" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Sélection matériaux faite ? : </label></p>
            <p>
                <span class="low_size">Oui </span>
                <input type="checkbox" name="selection_materiaux" value="oui" 
                       class="filter_option"/>
                <span class="low_size">Non </span> 
                <input type="checkbox" name="selection_materiaux" value="non" 
                       class="filter_option"/>
            </p> 
        </div>
    </div>
    <table id="liste">
        <thead>
            <tr>
                <th class="sort" data-sort="nom">Nom</th>
                <th class="sort" data-sort="etat">Etat</th>
                <th class="sort" data-sort="maison">Maison</th>
                <th class="sort" data-sort="compromis">Date compromis</th>
                <th class="sort" data-sort="acte">Date acte</th>
                <th class="sort" data-sort="plan_metre">Plan métré</th>
                <th class="sort" data-sort="devis">Devis entrepreneur</th>
                <th class="sort" data-sort="selection_materiaux">Sélection matériaux</th>
                <th class="sort" data-sort="remarques">Remarques</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les rencontres investisseurs
            $business = new ProjetCRUD();
            
            foreach ($business->readAll() as $projet) {
                echo '<tr>';
                echo '<td class="nom">' . $projet->getInvestisseur()->getNom() . ' ' 
                        . $projet->getInvestisseur()->getPrenom() . '</td>';
                echo '<td class="etat">' . $projet->getInvestisseur()
                        ->getEtat()->getLibelle() . '</td>';
                echo '<td class="maison">' . $projet->getMaison()
                        ->getTitre(Maison::LANGUAGE_FR) . '</td>';
                echo '<td class="compromis center">' 
                    . ((is_null($projet->getDateSignatureCompromis()))? ' ': $projet->getDateSignatureCompromis()->format('Y/m/d')) . '</td>';
                echo '<td class="acte center">' 
                    . ((is_null($projet->getDateSignatureActe()))? ' ': $projet->getDateSignatureActe()->format('Y/m/d')) . '</td>';
                echo '<td class="plan_metre center">' 
                        . (($projet->getPlanMetreFait()) ? 'Oui' : 'Non') . '</td>';
                echo '<td class="devis center">' 
                        . (($projet->getDevisEntrepreneurConfirmer()) ? 'Oui' : 'Non') 
                        . '</td>';
                echo '<td class="selection_materiaux center">' 
                        . (($projet->getSelectionMateriauxFait()) ? 'Oui' : 'Non') 
                        . '</td>';
                echo '<td class="remarques">' . $projet->getCommentaire() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    <a id="generate_excel">Générer excel</a>
    <div id="doc_excel"></div>
</div>
<script src="./js/liste.js"></script>