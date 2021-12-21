<!-- breadcumb -->
<section class="page_title corner-title overflow-visible ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php echo e(__('msg.my_orders')); ?></h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('my-account')); ?>"><?php echo e(__('msg.my_account')); ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?php echo e(__('msg.my_orders')); ?>

                    </li>
                </ol>
                <div class="divider-15 d-none d-xl-block"></div>
            </div>
        </div>
    </div>
</section>
<!-- eof breadcumb -->
<div class="order_track_page main-content">
    <section class="checkout-section ptb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div id="data-step1" class="account-content" data-temp="tabdata">
                        <div id="form-print" class="admission-form-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="heading-part heading-bg mb-30 px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded">
                                        <h2 class="heading m-0"><?php echo e(__('msg.my_orders')); ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-right">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <?php if(isset($data['list']['data']) && isset($data['list']['data']) && count($data['list']['data'])): ?>
                                        <?php $__currentLoopData = $data['list']['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($w->items) && is_array($w->items) && count($w->items)): ?>
                                        <?php $__currentLoopData = $w->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($itm->id) && intval($itm->id)): ?>
                                        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow rounded mb-4">
                                            <div class="dash-bg-right-title">
                                                <h6><?php echo e(__('msg.ordered_id')); ?> : <?php echo e($itm->order_id ?? '-'); ?></h6>
                                                <h6><?php echo e(__('msg.order_date')); ?> :  <?php echo e(isset($itm->date_added) ? date('d-m-Y', strtotime($itm->date_added)) : ''); ?></h6>
                                            </div>
                                            <div class="order-dashboard">
                                                <ul class="order-dash-desc">
                                                    <li>
                                                        <div class="order-img">
                                                            <img class="lazy" data-original="<?php echo e($itm->image); ?>" alt="<?php echo e($itm->name ?? 'Product Image'); ?>">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="order-desc">
                                                            <h4><?php echo e($itm->name); ?></h4>
                                                            <p><?php echo e(__('msg.qty')); ?> : <?php echo e($itm->quantity); ?></p>
                                                            <p><?php echo e(get_price($itm->sub_total)); ?></p>
                                                            <p><?php echo e(__('msg.via')); ?> : <?php echo e(strtoupper($w->payment_method)); ?></p>
                                                            <?php
                                                            $orderColor='';
                                                            if($itm->active_status == "received"){
                                                            $orderColor = 'received_status_bg';
                                                            }elseif($itm->active_status == "processed"){
                                                            $orderColor = 'awaiting_status_bg';
                                                            }elseif($itm->active_status == "shipped"){
                                                            $orderColor = 'shipped_status_bg';
                                                            }elseif($itm->active_status == "delivered"){
                                                            $orderColor = 'delivered_status_bg';
                                                            }elseif($itm->active_status == "cancelled"){
                                                            $orderColor = 'returned_and_cancel_status_bg';
                                                            }elseif($itm->active_status == "returned"){
                                                            $orderColor = 'returned_and_cancel_status_bg';
                                                            }
                                                            ?>
                                                            <p class="order__status <?php echo e($orderColor); ?>"><?php echo e(strtoupper($itm->active_status)); ?></p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <?php if(count($itm->status)): ?>
                                                <?php
                                                $orderPlaced = "";
                                                $orderAwaiting_payment = "";
                                                $orderProcessed = "";
                                                $orderShipped = "";
                                                $orderDelivered = "";
                                                $orderCancelled = "";
                                                $orderReturned = "";
                                                foreach($itm->status as $s){
                                                if($s[0] == "received"){
                                                $orderPlaced = $s[1];
                                                }elseif($s[0] == "awaiting_payment"){
                                                $orderAwaiting_payment = $s[1];
                                                }elseif($s[0] == "processed"){
                                                $orderProcessed = $s[1];
                                                }elseif($s[0] == "shipped"){
                                                $orderShipped = $s[1];
                                                }elseif($s[0] == "delivered"){
                                                $orderDelivered = $s[1];
                                                }elseif($s[0] == "cancelled"){
                                                $orderCancelled = $s[1];
                                                }elseif($s[0] == "returned"){
                                                $orderReturned = $s[1];
                                                }
                                                }
                                                ?>
                                                <div class="track-order">
                                                    <h4><?php echo e(__('msg.track_order')); ?></h4>
                                                    <div class="bs-wizard">
                                                        <?php if($orderPlaced != ""): ?>
                                                        <div class="bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_placed')); ?></div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderPlaced))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date('h:i:s A', strtotime($orderPlaced))); ?></div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if($orderAwaiting_payment != ""): ?>
                                                        <div class="bs-wizard-step complete">
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.awaiting_payment')); ?></div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderPlaced))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date('h:i:s A', strtotime($orderPlaced))); ?></div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if($orderProcessed != ""): ?>
                                                        <div class="bs-wizard-step complete">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_processed')); ?></div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderProcessed))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderProcessed))); ?></div>
                                                        </div>
                                                        <?php elseif($orderCancelled == ""): ?>
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_processed')); ?>

                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#"  class="bs-wizard-dot"></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if($orderShipped != ""): ?>
                                                        <div class="bs-wizard-step complete">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_shipped')); ?></div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderShipped))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderShipped))); ?></div>
                                                        </div>
                                                        <?php elseif($orderCancelled == ""): ?>
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_shipped')); ?></div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if($orderDelivered != ""): ?>
                                                        <div class="bs-wizard-step complete">
                                                            <!-- active -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_delivered')); ?>

                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderDelivered))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderDelivered))); ?></div>
                                                        </div>
                                                        <?php elseif($orderCancelled == ""): ?>
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_delivered')); ?></div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if($orderCancelled != ''): ?>
                                                        <div class="bs-wizard-step complete">
                                                            <!-- active -->
                                                            <div class="text-center bs-wizard-stepnum">
                                                                <?php echo e(__('msg.order_cancelled')); ?>

                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted">
                                                                <?php echo e(date('d-m-Y', strtotime($orderCancelled))); ?>

                                                            </div>
                                                            <div class="bs-wizard-info text-center text-muted">
                                                                <?php echo e(date('h:i:s A', strtotime($orderCancelled))); ?>

                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if($itm->applied_for_return == true): ?>
                                                        <?php if($orderReturned != ""): ?>
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- active -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_returned')); ?>

                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("d-m-Y", strtotime($orderDelivered))); ?></div>
                                                            <div class="bs-wizard-info text-center text-muted"><?php echo e(date("h:i:s A", strtotime($orderDelivered))); ?></div>
                                                        </div>
                                                        <?php elseif($orderCancelled == ""): ?>
                                                        <div class="bs-wizard-step disabled">
                                                            <!-- complete -->
                                                            <div class="text-center bs-wizard-stepnum"><?php echo e(__('msg.order_returned')); ?></div>
                                                            <div class="progress">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <a href="#" class="bs-wizard-dot"></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <div class="call-bill">
                                                    <div class="delivery-man">
                                                    </div>
                                                    <div class="order-bill-slip">
                                                        <a href="<?php echo e(route('order-track-item', $w->id ?? 0)); ?>" class="bill-btn hover-btn"><?php echo e(__('msg.view_details')); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row text-center">
                                            <div class="col-12">
                                                <br><br>
                                                <h3><?php echo e(__('msg.no_orders_found')); ?>.</h3>
                                            </div>
                                            <div class="col-12">
                                                <br><br>
                                                <a href="<?php echo e(route('shop')); ?>" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em> <?php echo e(__('msg.continue_shopping')); ?></a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <?php if(isset($data['last']) && $data['last'] != ""): ?>
                                                <a href="<?php echo e($data['last']); ?>" class="btn btn-primary pull-left"><em class="fa fa-arrow-left"></em> <?php echo e(__('msg.previous')); ?></a>
                                            </div>
                                            </a>
                                            <?php endif; ?>
                                            <div class="col text-end">
                                                <?php if(isset($data['next']) && $data['next'] != ""): ?>
                                                <a href="<?php echo e($data['next']); ?>" class="btn btn-primary pull-right"><?php echo e(__('msg.next')); ?> <em class="ml-2 fa fa-arrow-right"></em></a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><?php /**PATH C:\xampp\htdocs\webbooksbear\resources\views/themes/eCart/user/orders.blade.php ENDPATH**/ ?>