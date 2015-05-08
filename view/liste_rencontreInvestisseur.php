<?php
    use DubInfo_gestion_immobilier\business\RencontreInvestisseurCRUD;
?>
<h2>Liste des rencontres avec les investisseurs</h2>
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
                <th class="sort" data-sort="date">Date rencontre</th>
                <th class="sort" data-sort="budget">Budget</th>
                <th class="sort" data-sort="rapport">Rapport</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les rencontres investisseurs
            $business = new RencontreInvestisseurCRUD();
            
            foreach ($business->readAll() as $rencontre) {
                echo '<tr>';
                echo '<td class="nom">' . $rencontre->getInvestisseur()->getNom() . ' ' 
                        . $rencontre->getInvestisseur()->getPrenom() . '</td>';
                echo '<td class="etat">' . $rencontre->getInvestisseur()
                        ->getEtat()->getLibelle() . '</td>';
                echo '<td class="date center">' 
                    . $rencontre->getDate()->format('Y/m/d') . '</td>';
                echo '<td class="budget center">' 
                    . $rencontre->getInvestisseur()->getBudget() . '</td>';
                echo '<td class="rapport">' . $rencontre->getRapport() . '</td>';
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