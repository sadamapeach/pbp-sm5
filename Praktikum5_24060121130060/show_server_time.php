<!-- 
    File        : show_server_time.html
    Deskripsi   : menampilkan waktu server dengan ajax
 -->

<?php include('./header.php'); ?>
<div class="row w-75 mx-auto text-center">
    <div class="col">
        <div class="card mt-5">
            <div class="card-header">Ajax Server Time</div>
            <div class="card-body">
                <div class="mb-4 h1" id="showtime"></div>
                <button class="btn btn-success" onclick="get_server_time()">Show Server Time</button>
            </div>
        </div>
    </div>
</div>
<?php include('./footer.php'); ?>