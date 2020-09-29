<div class="container">
    <h1><?= $title ?></h1>
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
        <?php foreach ($data as $councillor) { ?>
            <tr>
                <th scope="row"><?= $councillor->id ?> </th>
                <td><?= $councillor->updated ?></td>

                <td><?= $councillor->code ?></td>
                <td><?= $councillor->name ?></td>
                <td><?= $councillor->shortName ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
