<!-- 
    File        : show_book.php
    Deskripsi   : menampilkan data buku berdasarkan judul yang dicari
 -->

<?php include('./header.php') ?>
<div class="row w-50 mx-auto mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">Show Book Data</div>
            <div class="card-body">
                <div class="form-group">
                    <form action="" method="GET" autocomplete="on">
                        <div class="mb-3">
                            <label for="title" class="form-label">Enter Book's Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php if (isset($booktitle)) echo $booktitle ?>">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="showBook()">Show Detail</button>
                    </form>
                </div>
                <div id="detail_book"></div>
            </div>
        </div>
    </div>
</div>
<?php include('./footer.php') ?>