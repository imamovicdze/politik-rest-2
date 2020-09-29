<div class="container">
    <h1><?= $title ?></h1>
    <a href="councillors?pageNumber=1" class="btn btn-primary">1</a>
    <a href="councillors?pageNumber=2" class="btn btn-primary">2</a>
    <a href="councillors?pageNumber=3" class="btn btn-primary">3</a>
    <a href="councillors?pageNumber=4" class="btn btn-primary">4</a>
    <a href="councillors?pageNumber=5" class="btn btn-primary">5</a>
    <br><br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">updated</th>
            <th scope="col">active</th>
            <th scope="col">code</th>
            <th scope="col">firstName</th>
            <th scope="col">lastName</th>
            <th scope="col">officialDenomination</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $councillor) { ?>
            <tr>
                <th scope="row"><?= $councillor->id ?></th>
                <td><?= $councillor->updated ?></td>
                <td><?= $councillor->active ? $councillor->active : 0 ?></td>
                <td><?= $councillor->code ?></td>
                <td><?= $councillor->firstName ?></td>
                <td><?= $councillor->lastName ?></td>
                <td><?= $councillor->officialDenomination ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
