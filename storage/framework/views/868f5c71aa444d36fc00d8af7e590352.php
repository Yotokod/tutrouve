<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Tags')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4 mt-0">
        <div class="col-12">
            <div class="dashboard__card bg__white padding-20 radius-10 mb-2">
                <div class="dashboard__inner__header">
                    <div class="dashboard__inner__header__flex">
                        <div class="dashboard__inner__header__left">
                            <h4 class="dashboard__inner__header__title"><?php echo e(__('All Tags')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag-bulk-delete')): ?>
                                <?php if (isset($component)) { $__componentOriginal41fc2efab414de3fc9c6739ba1ffcc6e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41fc2efab414de3fc9c6739ba1ffcc6e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.bulk-action','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.bulk-action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41fc2efab414de3fc9c6739ba1ffcc6e)): ?>
<?php $attributes = $__attributesOriginal41fc2efab414de3fc9c6739ba1ffcc6e; ?>
<?php unset($__attributesOriginal41fc2efab414de3fc9c6739ba1ffcc6e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41fc2efab414de3fc9c6739ba1ffcc6e)): ?>
<?php $component = $__componentOriginal41fc2efab414de3fc9c6739ba1ffcc6e; ?>
<?php unset($__componentOriginal41fc2efab414de3fc9c6739ba1ffcc6e); ?>
<?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="dashboard__inner__header__right">
                            <a href="<?php echo e(route('admin.blog.tags.store')); ?>" class="cmnBtn btn_5 btn_bg_blue radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#add_blog_tag_modal"><?php echo e(__('Add New Tag')); ?></a>
                            <div class="btn-wrapper mt-3">
                                <input class="form__control radius-5 search_blog_tag_result" name="string_search" id="string_search" placeholder="<?php echo e(__('Search')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginal4bb59b834d778ff0cb72af5a473e2885 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('validation.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $attributes = $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $component = $__componentOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
                <div class="tableStyle_three mt-4">
                    <div class="table_wrapper custom_Table">
                        <div class="search_blog_tag_result">
                            <?php echo $__env->make('blog::backend.tags.search-tags', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Tag add  Modal -->
    <div class="modal fade" id="add_blog_tag_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal_xl__fixed">
            <div class="popup_contents modal-content">
                <div class="popup_contents__header">
                    <div class="popup_contents__header__flex">
                        <div class="popup_contents__header__contents">
                            <h2 class="popup_contents__header__title"><?php echo e(__('Add Tag')); ?></h2>
                        </div>
                        <div class="popup_contents__header__close" data-bs-dismiss="modal">
                            <span class="popup_contents__close popup_close"> <i class="fas fa-times"></i> </span>
                        </div>
                    </div>
                </div>
                <div class="popup_contents__body">
                    <form action="<?php echo e(route('admin.blog.tags.store')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="lang" value="<?php echo e($default_lang); ?>">
                        <div class="form__input__single">
                            <label for="edit_name" class="form__input__single__label"><?php echo e(__('Name')); ?></label>
                            <input type="text" class="form__control radius-5"  name="name" placeholder="<?php echo e(__('Name')); ?>">
                        </div>
                        <div class="form__input__single">
                            <label for="edit_name" class="form__input__single__label"><?php echo e(__('Status')); ?></label>
                            <select name="status" class="select2_activation" id="edit_status">
                                <option value="draft"><?php echo e(__("Draft")); ?></option>
                                <option value="publish"><?php echo e(__("Publish")); ?></option>
                            </select>
                        </div>
                        <div class="popup_contents__footer flex_btn justify-content-end profile-border-top">
                            <button type="submit" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Submit')); ?></button>
                            <a href="javascript:void(0)" class="cmnBtn btn_5 btn_bg_danger radius-5" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Tag Edit Modal -->
    <div class="modal fade" id="category_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal_xl__fixed">
            <div class="popup_contents modal-content">
                <div class="popup_contents__header">
                    <div class="popup_contents__header__flex">
                        <div class="popup_contents__header__contents">
                            <h2 class="popup_contents__header__title"><?php echo e(__('Edit Tag')); ?></h2>
                        </div>
                        <div class="popup_contents__header__close" data-bs-dismiss="modal">
                            <span class="popup_contents__close popup_close"> <i class="fas fa-times"></i> </span>
                        </div>
                    </div>
                </div>
                <div class="popup_contents__body">
                    <form action="<?php echo e(route('admin.blog.tags.update')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="tag_id">
                        <input type="hidden" name="lang" value="<?php echo e($default_lang); ?>">
                        <div class="form__input__single">
                            <label for="edit_name" class="form__input__single__label"><?php echo e(__('Name')); ?></label>
                            <input type="text" class="form__control radius-5"  name="name"  id="edit_name" placeholder="<?php echo e(__('Name')); ?>">
                        </div>
                        <div class="form__input__single">
                            <label for="edit_name" class="form__input__single__label"><?php echo e(__('Status')); ?></label>
                            <select name="status" class="form__control" id="edit_status">
                                <option value="draft"><?php echo e(__("Draft")); ?></option>
                                <option value="publish"><?php echo e(__("Publish")); ?></option>
                            </select>
                        </div>
                        <div class="popup_contents__footer flex_btn justify-content-end profile-border-top">
                            <button type="submit" class="cmnBtn btn_5 btn_bg_blue radius-5"><?php echo e(__('Update')); ?></button>
                            <a href="javascript:void(0)" class="cmnBtn btn_5 btn_bg_danger radius-5" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tag-bulk-delete')): ?>
        <?php if (isset($component)) { $__componentOriginal996fed7ae655ce20bc4d8081dd84ac5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal996fed7ae655ce20bc4d8081dd84ac5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.bulk-action-js','data' => ['url' => route('admin.blog.tags.bulk.action')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.bulk-action-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.blog.tags.bulk.action'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal996fed7ae655ce20bc4d8081dd84ac5f)): ?>
<?php $attributes = $__attributesOriginal996fed7ae655ce20bc4d8081dd84ac5f; ?>
<?php unset($__attributesOriginal996fed7ae655ce20bc4d8081dd84ac5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal996fed7ae655ce20bc4d8081dd84ac5f)): ?>
<?php $component = $__componentOriginal996fed7ae655ce20bc4d8081dd84ac5f; ?>
<?php unset($__componentOriginal996fed7ae655ce20bc4d8081dd84ac5f); ?>
<?php endif; ?>
    <?php endif; ?>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                    // change status
                    $(document).on('click','.swal_status_change',function(e){
                        e.preventDefault();
                        Swal.fire({
                            title: '<?php echo e(__("Are you sure to change status complete? Once you done you can not revert this !!")); ?>',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: "<?php echo e(__('Yes, change it!')); ?>"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(this).next().find('.swal_form_submit_btn').trigger('click');
                            }
                        });
                    });

                $(document).on('change','#langchange',function(e){
                    $('#langauge_change_select_get_form').trigger('submit');
                });

                $(document).on('click','.category_edit_btn',function(){
                    var el = $(this);
                    var id = el.data('id');
                    var name = el.data('name');
                    var status = el.data('status');
                    var modal = $('#category_edit_modal');
                    modal.find('#tag_id').val(id);
                    modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                    modal.find('#edit_name').val(name);
                });


                // live search
                $(document).on('keyup','.search_blog_tag_result',function(){
                    let string_search = $(this).val();
                    $.ajax({
                        url:"<?php echo e(route('admin.blog.tags.search')); ?>",
                        method:'GET',
                        data:{string_search:string_search},
                        success:function(res){
                            if(res.status=='nothing'){
                                $('.search_blog_tag_result').html('<h5 class="text-center text-danger">'+"<?php echo e(__('Nothing Found')); ?>"+'</h5>');
                            }else{
                                $('.search_blog_tag_result').html(res);
                            }
                        }
                    });
                });
                // pagination
                $(document).on('click', '.pagination li a', function(e){
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    let string_search = $('#string_search').val();
                    notices(page,string_search);
                });
                function notices(page,string_search){
                    $.ajax({
                        url:"<?php echo e(route('admin.blog.tags.paginate').'?page='); ?>" + page,
                        data:{string_search:string_search},
                        success:function(res){
                            $('.search_blog_tag_result').html(res);
                        }
                    });
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/Modules/Blog/resources/views/backend/tags/all-tags.blade.php ENDPATH**/ ?>