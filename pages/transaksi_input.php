<?php 
include 'config/main.php';
include 'config/fungsi_auto.php';
 ?>

<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Transaksi Pembelian</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <form action="server.php?p=transaksi" method="post">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Kode Pembelian</label>
                <input type="text" class="form-control" name="id" id="id" placeholder="kode" value="<?php
                 echo $newID; ?>" readonly="" />
            </div>
              <div class="form-group">
                <label>Supplier</label>
                <select class="form-control select2" name="supp" id="supp" style="width: 100%;" />
                </select>
              </div>
              <div class="form-group">
                <label>Lama Tempo / Hari</label>
                <input type="number" class="form-control" name="lama" id="lama" placeholder="Lama Tempo ex: 30" required="" />
            </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Pembelian</label>
                <input type="text" class="form-control" name="tgl"  value="<?php echo date('Y-m-d') ?>" readonly="" />
            </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Admin</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['nama']; ?>" readonly="" />
            </div>
              <!-- /.form-group -->
            </div>


            <!-- /.col -->
            <div class="col-md-12">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ambilbarang"><i class="fa fa-plus"></i> Input Barang</button>
              <hr>
              <table class="table table-bordered" id="table">
                

              </table>
              <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?>">
              <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan Transaksi</button>

            </div>

          </div>
        </form>
          <!-- /.row -->
        </div>
        
      </div>
      <!-- /.box -->



<!-- Modal Ambil Barang -->

<div class="modal fade" id="ambilbarang">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Kode Barang:</label>
            <select class="form-control" name="kode" id="kode" style="width: 100%;">
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nama Barang:</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Barang" readonly="">
          </div>
          <div class="form-group">
            <label class="control-label">Harga:</label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" readonly="">
          </div>
          <div class="form-group">
            <label class="control-label">Stok:</label>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" readonly="">
          </div> 
          <div class="form-group">
            <label class="control-label">Jumlah:</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="tambah" class="btn btn-primary">Simpan</button>
      </div>

    </div>
  </div>
</div>


<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
 <script>

      $(function(){



        var kode;
        var harga;
        var jumlah;
        var nama;
        var stok;
        //mengkosongkan input text dengan masing2 id berikut
                    $("#kode").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                    $("#nama").val("");
                    $("#stok").val("");
          // Disable
          //document.getElementById("lama").disabled = true;

          // load barang
          $("#kode").load("server.php","p=ambilbarang");

          // load supp
          $("#supp").load("server.php","p=ambilsupp");

          // load auto
          $("#trans").load("server.php","p=ambiltrans");


        // load tabel
          $("#table").load("server.php","p=table");
          //jika tombol tambah di klik

                  // kode
                  $("#kode").change(function(){
                        kode=$("#kode").val();
                        
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"server.php",
                            data:"p=ambildata&kode="+kode,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                
                                //masukan isi data ke masing - masing field
                                $("#nama").val(data[0]);
                                $("#harga").val(data[1]);
                                $("#stok").val(data[2]);
                                $("#jumlah").focus();
                            }
                        });
                    });


                    $("#tambah").click(function(){
                        kode=$("#kode").val();
                        harga=$("#harga").val();
                        jumlah=$("#jumlah").val();
                        stok=$("#stok").val();
                        var stok = parseInt(stok);
                        var jumlah = parseInt(jumlah);

                        if(kode=="Kode Barang"){
                            alert("Kode Barang Harus diisi");
                            exit();
                          } else if(jumlah > stok){
                            alert("Stok tidak terpenuhi");
                            $("#jumlah").focus();
                            exit();
                          } else if(jumlah < 1){
                            alert("Jumlah beli tidak boleh 0");
                            $("#jumlah").focus();
                            exit();
                          }
                                               
                        
                        $.ajax({
                            url:"server.php",
                            data:"p=add&kode="+kode+"&harga="+harga+"&jumlah="+jumlah,
                            cache:false,
                            success:function(msg){

                              if (msg) {

                              $("#table").load("server.php","p=table");


                              $("#kode").val("");
                              $("#harga").val("");
                              $("#jumlah").val("");
                              $("#nama").val("");
                              $("#stok").val("");
                            } else {
                              alert("Gagal");
                            }
                            }
                        });
                    });

      });

  
    </script>
 