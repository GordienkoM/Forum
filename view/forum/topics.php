<?php
    use App\Core\Session;
    $topicsDetails = $data['topicsDetails'];
    $sujets = $data['sujets'];
    //var_dump($topicsDetails);
?>
<div>
    <p><a class="uk-button uk-button-small uk-button-primary" href="?ctrl=forum&action=newTopic">Ajouter un sujet</a></p>
</div>
 <table id='adminTable' class='uk-table uk-table-hover uk-table-divider'>
    <thead>
        <tr>
            <th>Statut</th>
            <th>Sujet</th>
            <th>Date création</th>
            <th>Auteur</th>
            <th>Nombre Message</th>
            <th>Derniers Messages</th>
            <?php
                //si l'utilisateur est un administrateur on affiche "Modifier"
                    if(Session::get("user") && Session::get("user")->hasRole("ROLE_ADMIN")){
            ?>  
                <th>Modifier</th>
            <?php
                } 
            ?> 
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($topicsDetails as $topicDetails){
        ?>       
            <tr>
                <td>
                <?php
                //verification de statut de sujet "1"-le sujet est ouvert, "0"-le sujet est fermé
                    if($topicDetails->getSujet()->getStatut()){
                ?>  
                    <a  href="?ctrl=forum&action=lockUnlockTopict&id=<?= $topicDetails->getSujet()->getId() ?>"
                        class="uk-icon-link uk-margin-small-right" uk-icon="unlock">
                    </a>
                <?php
                    } else { 
                ?> 
                    <a href="?ctrl=forum&action=lockUnlockTopict&id=<?= $topicDetails->getSujet()->getId() ?>" 
                        class="uk-icon-link uk-margin-small-right" uk-icon="lock"></a>
                <?php
                    } 
                ?> 
                </td>
                <td>
                    <a href="?ctrl=forum&action=showTopic&id=<?= $topicDetails->getSujet()->getId() ?>">
                        <?= $topicDetails->getSujet()->getTitre() ?> </td>
                    </a>               
                <td><?= $topicDetails->getSujet()->getCreatedAt('d/m/Y') ?> </td>
                <td><?= $topicDetails->getSujet()->getUtilisateur() ?> </td>
                <td><?= $topicDetails->getNombreDeMessages()  ?> </td>
                <td><?= $topicDetails->getMessage()  ?></td>
                <?php
                    //si l'utilisateur est un administrateur on affiche des icônes pour la modification
                    if(Session::get("user") && Session::get("user")->hasRole("ROLE_ADMIN")){
                ?> 
                    <td>
                        <!-- https://getuikit.com/docs/icon -->
                        <a class="uk-icon-link uk-margin-small-right" uk-icon="file-edit" href="?ctrl=forum&action=upDateTopic&id=<?=  $topicDetails->getSujet()->getId() ?>"></a>
                        <a class="uk-icon-link" uk-icon="trash" href="?ctrl=forum&action=delTopic&id=<?=  $topicDetails->getSujet()->getId() ?>"></a>
                    </td>
                <?php
                    } 
                ?> 
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>