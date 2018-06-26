<div class="container">
    <div class="card">
        <form action="/loadImage" enctype="multipart/form-data" method="post">
        @csrf
        <input type="file" name="file" id="file" class='form-group'><br>
        <input type="submit" value="Load" class='btn btn-info'>
        </form>
    </div>
</div>