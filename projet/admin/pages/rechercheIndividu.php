<br/><br/>
<div class="bootstrap-iso">
    <div class="container">
        <div class="row">
            <div class="row col-xs-12">
                <div class="well table-responsive">
                    <input type="text" id="myInputByMatricule" onkeyup="searchInTable(0)" placeholder="Recherche par matricule">
                    <input type="text" id="myInputByName" onkeyup="searchInTable(1)" placeholder="Recherche par nom">
                    <table id="table" class="table-bordered table-condensed table-hover">
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Adresse</th>
                            <th>Telephone</th>
                            <th>Conges</th>
                            <th>Anciennete</th>
                            <?php
                            $info = new InfoIndividuDB($cnx);
                            $data = $info->getAllIndividu();
                            $length = count($data);
                            for($i=0;$i<$length;$i++){
                            ?>
                            <tr>
                                <td><?php echo ucfirst($data[$i]->__get('num_individu'))?></td>
                                <td><?php echo ucfirst($data[$i]->__get('nom_individu'))?></td>
                                <td><?php echo ucfirst($data[$i]->__get('prenom_individu')) ?></td>
                                <?php
                                    $adresse = ucfirst($data[$i]->__get('adresse_individu'));
                                    $codepostal = $data[$i]->__get('cp_individu');
                                    $localite = $data[$i]->__get('localite_individu');
                                ?>
                                <td><?php echo $adresse." - ".$codepostal." ".$localite?></td>
                                <td><?php echo $data[$i]->__get('tel_individu')?></td>
                                <td><?php echo $data[$i]->__get('nb_conges_individu')?></td>
                                <td><?php echo $data[$i]->__get('anciennete')?></td>
                            </tr>
                            <?php
                            }?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function searchInTable(colonne) {

  var input, filter, table, tr, td, i;
  
  if(colonne===0){
    input = document.getElementById("myInputByMatricule");
    filter = input.value.toUpperCase();
  }else{
    input = document.getElementById("myInputByName");
    filter = input.value.toUpperCase();     
  }
  
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");


  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[colonne];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>