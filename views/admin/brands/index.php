<h2><?=$title?></h2>

<div class="table-responsive small">

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">
                #
            </th>
            <th scope="col">
                Name
            </th>
            <th scope="col">
                Actions
            </th>
        </tr>

    </thead>
    <tbody>
        <?php foreach ($brands as $brand): ?>
            <tr>
                <td><?=$brand->id?></td>
                <td><?=$brand->name?></td>
                <td><a href="/admin/brands/edit/<?=$brand->id?>" class="btn btn-success">Edit</a>
                <form method="post" action="/admin/brands/destroy/<?=$brand->id?>" class="inline-form">

                <input type="submit" value="destroy" class="btn btn-danger inline">
                </form>
            
            </td>
            </tr>
        <?php endforeach?>
    </tbody>

</table>
</div> 