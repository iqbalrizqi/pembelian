<!-- Modal Ambil Kategori -->
<div class="modal fade" id="modalKategori">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" method="post" action="simpan.php">

      <div class="modal-body">
          <input type="hidden" name="type" value="kategori">
          <input type="hidden" name="cmd" value="tambah">
          <div class="form-group">
            <label>Kategori</label>
            <input type="text" class="form-control" name="nama" placeholder="Nama" value=""/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="tambah" class="btn btn-primary">Simpan</button>
      </div>

    </form>
    </div>
  </div>
</div>


<!-- Modal Ambil Produk -->
<div class="modal fade" id="modalProduk">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" method="post" action="simpan.php">

      <div class="modal-body">
          <input type="hidden" name="type" value="produk">
            <input type="hidden" name="cmd" value="tambah">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" required="" maxlength="30" />
              </div>
              <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control">
                  <?php 
                  $cek = mysql_query("SELECT * FROM kategori");
                    while ($row=mysql_fetch_array($cek)) {
                      echo '<option value='.$row['id_kategori'].'>'.$row['nama_kategori'].' </option>';
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Satuan</label>
                <select name="satuan" class="form-control">
                  <option value="pcs">Pcs</option>
                  <option value="lbr">Lbr</option>
                  <option value="unit">Unit</option>
                  <option value="box">Box</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" required="" />
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input type="number" class="form-control" name="harga" placeholder="Harga" required="" />
              </div>
              <div class="form-group">
                <label>Ukuran</label>
                <input type="text" class="form-control" name="ukuran" placeholder="ukuran" required="" />
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="3" name="desk" placeholder="Deskripsi"></textarea>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="tambah" class="btn btn-primary">Simpan</button>
      </div>

    </form>
    </div>
  </div>
</div>



<!-- Modal Ambil Supplier -->
<div class="modal fade" id="modalSupplier">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" method="post" action="simpan.php">

      <div class="modal-body">
          <input type="hidden" name="type" value="supplier">
              <input type="hidden" name="cmd" value="tambah">
              <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama Supplier" required="" maxlength="30" />
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" rows="3" name="alamat" placeholder="Alamat"></textarea>
              </div>
              <div class="form-group">
                <label>No Telp</label>
                <input type="text" class="form-control" name="telp" placeholder="No Telp/Hp" required="" />
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="tambah" class="btn btn-primary">Simpan</button>
      </div>

    </form>
    </div>
  </div>
</div>


<!-- Modal Ambil User -->
<div class="modal fade" id="modalUser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" method="post" action="simpan.php">

      <div class="modal-body">
          <input type="hidden" name="type" value="data_user">
          <input type="hidden" name="cmd" value="tambah">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="username" required="" />
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" placeholder="Nama" required="" />
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" value="" required="" />
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="tambah" class="btn btn-primary">Simpan</button>
      </div>

    </form>
    </div>
  </div>
</div>


