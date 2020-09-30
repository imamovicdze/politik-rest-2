<?php
/* @var $title string */
/* @var $data FactionDTO[] */
?>
<div class="container">
    <h1 class="text-center"><?= $title ?></h1>
    <br><br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">updated</th>
            <th scope="col">code</th>
            <th scope="col">name</th>
            <th scope="col">shortName</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $faction) { ?>
            <tr>
                <th scope="row"><?= $faction->id ?> </th>
                <td><?= $faction->updated ?></td>
                <td><?= $faction->code ?></td>
                <td><?= $faction->name ?></td>
                <td><?= $faction->shortName ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
