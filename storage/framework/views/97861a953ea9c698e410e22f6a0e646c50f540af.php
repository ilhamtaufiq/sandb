<?php $__env->startSection('title', 'Data Kontrak'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/sweetalert2.css')); ?>">


<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h5><?php echo e($title); ?></h5>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Kegiatan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6></h6>
                        <div class="card-header-right">
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                data-bs-target="#modal-pekerjaan" data-bs-original-title="" title=""> <span
                                    class="fa fa-edit"></span>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table id="example1" class="display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Program</th>
                                        <th>Kegiatan</th>
                                        <th>Pagu</th>
                                        <th>Tahun Anggaran</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                    ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $number = $item->pagu;
                                            $pagu = 'Rp' . number_format($number, 2, ',', '.');
                                        ?>
                                        <tr>
                                            <td><?php echo e($i++); ?></td>
                                            <td><?php echo e($item->kegiatan->sub_kegiatan); ?></td>
                                            <td><a href="/pekerjaan/<?php echo e($item->id); ?>"><?php echo e($item->nama_pekerjaan); ?></a>
                                            </td>
                                            <td><?php echo e($pagu); ?></td>
                                            <td><?php echo e($item->tahun_anggaran); ?></td>
                                            <td>
                                                <div class="card-body btn-showcase">
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modal-hapus<?php echo e($item->id); ?>"><i
                                                            class="fa fa-trash"></i></button>
                                                    <button class="btn btn-warning btn-edit" data-bs-toggle="modal"
                                                        data-bs-target="#modal-ubah" id="edit-item"
                                                        data-id="<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>"><i
                                                            class="fa fa-edit"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal-pekerjaan" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kegiatan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" action="<?php echo e(route('pekerjaan.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label>Program</label>
                                    <select id="program_id" name="program_id" class="form-control select2 select2-offscreen"
                                        required style="width: 100%;">
                                        <option selected disabled value="">Pilih Program/Kegiatan/Sub Kegiatan
                                        </option>
                                        <optgroup label="Pembangunan MCK">
                                            <option value="1">Pembangunan MCK Komunal</option>
                                            <option value="2">Pembangunan MCK Skala Individu</option>
                                        </optgroup>
                                        <optgroup label="SPALD-T">
                                            <option value="3">Pembangunan IPAL Skala Permukiman minimal 50 KK</option>
                                            <option value="4">Pembangunan IPAL Skala Permukiman kombinasi MCK minimal 50 KK</option>
                                        </optgroup>
                                        <optgroup label="SPALD-S">
                                            <option value="5">Pembangunan tangki septik komunal (5-10 KK) </option>
                                            <option value="6">Pembangunan tangki septik skala individual perdesaan minimal 50 KK </option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label>Kecamatan</label>
                                        <select id="kecamatan_id" name="kecamatan_id" class="form-control select2"
                                            style="width: 100%;" required>
                                            <option value="">Pilih Kecamatan</option>
                                            <?php $__currentLoopData = $kec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->n_kec); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div>
                                        <label class="form-label">Pilih Desa</label>
                                        <select name="desa_id" id="desa_id" class="form-control select2"
                                            style="width: 100%;" required>
                                            <option selected value="">Pilih Desa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div>
                                        <label for="nama_pekerjaan">Nama Pekerjaan</label>
                                        <input type="text" id="nama_pekerjaan" name="nama_pekerjaan"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 mb-3">
                                    <div>
                                        <label for="Pagu">Pagu</label>
                                        <input class="form-control input-mask" name="pagu" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div>
                                        <label for="">Tahun Anggaran</label>
                                        <select name="tahun_anggaran" class="form-control select2" required>
                                            <option value="" selected>Pilih Tahun</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade bd-example-modal-lg" id="modal-hapus<?php echo e($d->id); ?>" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">                       
                        <h3>Apakah anda yakin?</h3>
                        <div class="text-muted">Hapus Data Kontrak Kegiatan <?php echo e($d->nama_pekerjaan); ?></div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Batal
                                    </a></div>
                                <form action="<?php echo e(route('pekerjaan.destroy', $d->id)); ?>" method="post">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
                                    <div class="col">
                                        <button class="btn btn-danger w-100" type="submit">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bd-example-modal-lg" id="modal-ubah" name="modal-ubah" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Kegiatan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Program</label>
                                <select id="program" name="program_id" class="form-control select2 select-ubah"
                                    required style="width: 100%;">
                                    <option selected disabled value="">Pilih Program/Kegiatan/Sub Kegiatan</option>
                                    <optgroup label="Pembangunan MCK">
                                        <option value="1">Pembangunan MCK Komunal</option>
                                        <option value="2">Pembangunan MCK Skala Individu</option>
                                    </optgroup>
                                    <optgroup label="SPALD-T">
                                        <option value="3">Pembangunan IPAL Skala Permukiman minimal 50 KK</option>
                                        <option value="4">Pembangunan IPAL Skala Permukiman kombinasi MCK minimal 50 KK</option>
                                    </optgroup>
                                    <optgroup label="SPALD-S">
                                        <option value="5">Pembangunan tangki septik komunal (5-10 KK) </option>
                                        <option value="6">Pembangunan tangki septik skala individual perdesaan minimal
                                            50 KK </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pekerjaan_id">Nama Pekerjaan</label>
                                <input id="pekerjaan" type="text" name="nama_pekerjaan" class="form-control"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <label>Kecamatan</label>
                                        <select id="kec" name="kecamatan_id"
                                            class="form-control select2 select-ubah" style="width: 100%;" required>
                                            <option value="">Pilih Kecamatan</option>
                                            <?php $__currentLoopData = $kec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->n_kec); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label class="form-label">Pilih Desa</label>
                                        <select id="desa" value="" name="desa_id"
                                            class="form-control select2 select-ubah" style="width: 100%;" required>
                                            <option value="">Pilih Desa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 mb-3">
                                    <div>
                                        <label for="Pagu">Pagu</label>
                                        <input id="n_pagu" class="form-control input-mask" name="pagu"
                                            placeholder="Input Pagu" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div>
                                        <label for="">Tahun Anggaran</label>
                                        <select id="ta" name="tahun_anggaran"
                                            class="form-control select2 select-ubah" required>
                                            <option selected>Pilih Tahun</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script>
        $(document).on('change', function() {
            $(".input-mask").inputmask({
                alias: 'numeric',
                groupSeparator: '.',
                radixPoint: ',',
                autoGroup: true,
                prefix: 'Rp',
                placeholder: '0',
                autoUnmask: true,
                removeMaskOnSubmit: true
            });
        });
    </script>
    <script>
        <?php if($errors->any()): ?>
            Swal.fire({
                title: 'Error!',
                html: '<?php echo implode('', $errors->all('<div>:message</div>')); ?>',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        <?php endif; ?>
        <?php if(session()->has('message')): ?>
            swal.fire({
                title: 'Simpan Data',
                text: '<?php echo e(session('message')); ?>',
                icon: 'success',
                timer: 3000,
            });
        <?php endif; ?>
    </script>
    <script>
        $(document).on('click', '.btn', function() {
            var id = $(this).data('id');
            jQuery($('#kecamatan_id,#kec')).on('change', function() {
                var KecID = jQuery(this).val();
                if (KecID) {
                    jQuery.ajax({
                        url: '/desa/' + KecID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $($('#desa_id,#desa')).empty();
                            jQuery.each(data, function(key, value) {
                                function populate(selector) {
                                    $(selector)
                                    .append('<option value="' + key + '">' + value +'</option>')
                                }
                                populate('#desa_id,#desa');
                            });
                        }
                    });
                } else {
                    $($('#desa_id')).empty();
                }
            });
        })
    </script>
    <script>
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('edit/pekerjaan')); ?>",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('form').attr('action', "<?php echo e(url('pekerjaan')); ?>/" + res.id);
                    $('#pekerjaan').val(res.nama_pekerjaan);
                    $('#n_pagu').val(res.pagu);
                    $('#ta').val(res.tahun_anggaran);
                    var $1 = $("<option selected='selected'></option>").val(res.program_id)
                        .text(res.kegiatan.sub_kegiatan);
                    $("#program").append($1);
                    var $2 = $("<option selected='selected'></option>").val(res.desa_id)
                        .text(res.desa.n_desa);
                    $("#desa").append($2);
                    var $3 = $("<option selected='selected'></option>").val(res.kecamatan_id)
                        .text(res.kec.n_kec);
                    $("#kec").append($3);
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                ordering: true,
                info: true,
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                ]
            });
            $('#example1_filter input').addClass('form-control form-control-sm'); // <-- add this line
            $('#example1_filter label').addClass('text-muted'); // <-- add this line
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery($('#pagu')).on('change', function() {
                var pagu = jQuery(this).val();
                $($('#harga_kontrak')).val(pagu.replace(/\D/g, ""));

            })

        })
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery($('#kecamatan_id,#desa_id,#program_id')).change(function() {
                $('#nama_pekerjaan').val($("#program_id option:selected").text() + " Desa " + $(
                    "#desa_id option:selected").text() + " Kec. " + $(
                    "#kecamatan_id option:selected").text());
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhamtaufiq/www/ams/resources/views/pages/pekerjaan/index.blade.php ENDPATH**/ ?>