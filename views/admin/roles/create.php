<h2><?=$title?></h2>

<form method="post" action="/admin/roles/store">

    <div class="mb-3">
        <label for="name" class="form-label">Role name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    
    
    <div class="mb-3">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>
