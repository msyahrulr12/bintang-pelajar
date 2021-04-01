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
              <li class="breadcrumb-item active">Data Siswa</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel berisi seluruh data siswa</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="<?=site_url('admin/SiswaController/create')?>" class="btn btn-sm btn-primary mb-2">
                    <i class="fas fa-plus-alt"></i> Tambah Siswa
                </a>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Cabang</th>
                        <th></th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($siswa as $key => $value): ?>
                        <tr>
                            <td><?=$value['nama']?></td>
                            <td><?=$value['email']?></td>
                            <td><?=date('d M Y', strtotime($value['tgl_lahir']))?></td>
                            <td><?=$value['tempat_lahir']?></td>
                            <td><?=$value['nama_cabang']?></td>
                            <td>
                                <a href="<?=site_url('admin/SiswaController/edit/'.$value['id'])?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?=site_url('admin/SiswaController/delete/'.$value['id'])?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Cabang</th>
                        <th></th>
                        <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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