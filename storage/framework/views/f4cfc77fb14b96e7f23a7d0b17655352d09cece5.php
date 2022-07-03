
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebarOwner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="layoutSidenav_content">
    <style>
        strong, thead{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <main>
    <div class="container-fluid px-4">
        <div class="card mt-3">
            <div class="card-header text-start">
                <i class="bi bi-table"></i> <strong>Data Rekapitulasi Keuangan</strong> 
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Periode</th>
                            <th>Total Debit</th>
                            <th>Total Kredit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                        ?>
                         <?php $__currentLoopData = $periode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kredit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr>
                             <td><?php echo e($loop->iteration); ?></td>
                             <td><?php echo e($kredit); ?></td>
                             <?php while($i < count($all_debit)): ?>
                                 <td style="color: green">Rp. <?php echo e(number_format($all_debit[$i],2,',','.')); ?></td>
                                 <?php break; ?>
                             <?php endwhile; ?>
                             <?php while($i < count($all_kredit)): ?>
                                 <td style="color: red">Rp. <?php echo e(number_format($all_kredit[$i],2,',','.')); ?></td>
                                 <?php break; ?>
                             <?php endwhile; ?>
                             
                             <td class="text-center">
                                 <a href="/ownerRekapitulasiDetail/<?php echo e($kredit); ?>" class="btn btn-success">Detail</a>
                             </td>
                         </tr>
                         <?php
                             $i += 1;
                         ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\applications\rodirodi\ppl-agro-a1\resources\views/owner/ownerRekapitulasi.blade.php ENDPATH**/ ?>