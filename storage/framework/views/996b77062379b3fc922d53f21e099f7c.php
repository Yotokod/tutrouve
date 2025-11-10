
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Slider')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1 class="mb-4">Liste des sliders</h1>
    <a href="<?php echo e(route('sliders.create')); ?>" class="btn btn-primary mb-3">Ajouter un slider</a>
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
    <?php if($sliders->isEmpty()): ?>
        <div class="alert alert-info">Aucun slider trouvé.</div>
    <?php else: ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Lien</th>
                     <th>Titre</th>
                      <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <img src="https://www.tutrouve.com/core/public/sliders/<?php echo e($slider->image); ?>" alt="Slider Image" class="img-thumbnail" style="width: 100px; height: auto;">
                    </td>
                    <td>
                        <a href="<?php echo e($slider->link); ?>" target="_blank"><?php echo e($slider->link ?? 'Pas de lien'); ?></a>
                    </td>
                     <td>
                        <p><?php echo e($slider->titre ?? 'Aucun'); ?></p>
                    </td>
                     <td>
                        <p><?php echo e($slider->description ?? 'Aucun'); ?></p>
                    </td>
                    <td>
                        <a href="<?php echo e(route('sliders.edit', $slider->id)); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="<?php echo e(route('sliders.destroy', $slider->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sur de vouloir supprimer ce slider ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/resources/views/backend/slider/index.blade.php ENDPATH**/ ?>