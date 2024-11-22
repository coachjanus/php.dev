<h2><?=$title?></h2>

<form method="post" action="/admin/categories/store" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="name" class="form-label">Category name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="mb-3">
        <label for="section_id" class="form-label">Category section</label>
        <select name="section_id" id="section_id" class="form-select">
            <option value="">Choose...</option>
            <?php foreach ($sections as $section): ?>
            <option value="<?=$section->id?>"><?=$section->name?></option>
            <?php endforeach?>
        </select>
    </div>

    <div class="mb-3">
        <label for="formFileLg" class="form-label">Cover for category</label>
        <input class="form-control form-control-lg" id="cover" type="file" name="cover">
    </div>
    
    <div class="mb-3">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>