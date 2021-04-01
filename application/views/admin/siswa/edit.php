<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Siswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Form Edit Siswa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="<?=site_url('admin/SiswaController/update')?>" method="POST">
        <div class="card-body">
            <input type="hidden" name="id" value="<?=$siswa['id']?>">
            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Enter Nama Siswa" value="<?=$siswa['nama']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="<?=$siswa['email']?>">
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?=$siswa['tempat_lahir']?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?=$siswa['tgl_lahir']?>">
            </div>
            <div class="form-group mb-3">
                <label for="cabang_id">Pilih Cabang</label>
                <select class="form-control" name="cabang_id">
                    <option value="">--Pilih Cabang--</option>
                    <?php foreach ($cabang as $key => $value): ?>
                        <option
                            value="<?=$value['id']?>"
                            <?=$value['id'] == $siswa['cabang_id'] ? 'selected' : ''?>
                        >
                            <?=$value['nama_cabang']?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
    <!-- /.card -->

    <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>