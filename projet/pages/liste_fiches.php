<br/><br/>
<div class="row">
    <div class="table-responsive">
        <table class="col-lg-12 table-bordered table-striped table-condensed table-hover">
            <tr class="well">
                <th class="text-center">Du</th>
                <th class="text-center">Au</th>
                <th class="text-center">Salaire brut</th>
                <th class="text-center">Salaire net</th>
                <th class="text-center">Heures prestées</th>
                <th class="text-center">Générer PDF</th>
            </tr>
            <?php
            $data = array("test1", "test2", "test3");
            $max = count($data);

            for ($i = 0; $i < $max; $i++) {
                ?>
                <tr>
                    <td class="text-center">Test 1</td> <!-- Date de debut-->
                    <td class="text-center">Test 2</td> <!-- Date de fin-->
                    <td class="text-center">Test 3</td> <!-- Salaire brut -->
                    <td class="text-center">Test 4</td> <!-- Salaire net -->
                    <td class="text-center">Test 5</td> <!-- Heures prestees -->
                    <td class="text-center">Test 6</td> <!-- Génération PDF -->            
                </tr>
                <?php
            }
            ?>            
    </div>
</div>