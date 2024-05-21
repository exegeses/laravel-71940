<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main>
    <div class="mx-auto max-w-4xl py-12 px-8">

        <h1 class="text-2xl font-bold">Panel de administración de destinos</h1>

        <?php if( session('mensaje') ): ?>
            <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
        <?php endif; ?>
        <table class="mx-auto mt-8">
            <thead>
            <tr>
                <th class="py-1 px-3 text-left w1/9">id</th>
                <th class="py-1 px-3 text-left w3/9">Destino</th>
                <th class="py-1 px-3 text-left w1/9">Destino</th>
                <th class="py-1 px-3 text-left w3/9">Región</th>
                <th  class="py-1 px-3 text-right w1/9">
                    <a href="/destino/create"
                       class="inline-flex items-center px-1 py-1 px-3 border-2 rounded-md border-green-400 dark:border-green-600 text-sm font-medium leading-5 text-gray-900 dark:text-green-400 hover:bg-green-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out"
                    >&nbsp; agregar &nbsp;</a>
                </th>
            </tr>
            </thead>

            <tbody>
        <?php $__currentLoopData = $destinos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destino): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="hover:bg-gray-950 odd:bg-gray-700">
                <td class="py-2 px-3"><?php echo e($destino->idDestino); ?></td>
                <td class="py-2 px-3 text-xl"><?php echo e($destino->aeropuerto); ?></td>
                <td class="py-2 px-3 text-xl"><?php echo e($destino->precio); ?></td>
                <td class="py-2 px-3 text-xl"><?php echo e($destino->nombre); ?></td>
                <td class="text-right py-2 px-3">
                    <a href="/destino/edit/<?php echo e($destino->idDestino); ?>"
                       class="inline-flex items-center px-1 py-1 px-3 border-2 rounded-md border-green-400 dark:border-green-600 text-sm font-medium leading-5 text-gray-900 dark:text-green-400 hover:bg-green-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out"
                    >&nbsp; Modificar &nbsp;</a>
                    <a href="/destino/delete/<?php echo e($destino->idDestino); ?>"
                       class="inline-flex items-center px-1 py-1 px-3 border-2 rounded-md border-green-400 dark:border-green-600 text-sm font-medium leading-5 text-gray-900 dark:text-green-400 hover:bg-green-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out"
                    >&nbsp; Eliminar &nbsp;</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>


        <div class="max-w-lg mx-auto sm:px-6 lg:px-8 py-4">
            <?php echo e($destinos->links()); ?>

        </div>

    </div>
</main>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /Users/marcos/Documents/Cursos/Laravel/laravel-71940/agencia/resources/views/destinos.blade.php ENDPATH**/ ?>