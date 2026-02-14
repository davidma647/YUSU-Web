<?php
/**
 * Global Modals
 * 全局模态框 - 通过 footer.php 在每个页面加载
 * 包含: leadGenModal (询盘表单) + imageZoomModal (图片放大)
 */
?>

<!-- 注册/询盘模态框 (Lead Generation) -->
<div class="modal fade" id="leadGenModal" tabindex="-1" aria-labelledby="leadGenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title font-serif fw-bold" id="leadGenModalLabel">
                    <?php echo esc_html__('Get Access', 'bootscore-child'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-secondary mb-4 small modal-desc">
                    <?php echo esc_html__('Please complete the form to proceed with your request.', 'bootscore-child'); ?>
                </p>
                <form>
                    <div class="mb-3">
                        <label for="leadName" class="form-label small text-secondary fw-bold text-uppercase">
                            <?php echo esc_html__('Full Name', 'bootscore-child'); ?>
                        </label>
                        <input type="text" class="form-control bg-light border-0" id="leadName" required>
                    </div>
                    <div class="mb-3">
                        <label for="leadEmail" class="form-label small text-secondary fw-bold text-uppercase">
                            <?php echo esc_html__('Business Email', 'bootscore-child'); ?>
                        </label>
                        <input type="email" class="form-control bg-light border-0" id="leadEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="leadCompany" class="form-label small text-secondary fw-bold text-uppercase">
                            <?php echo esc_html__('Company Name', 'bootscore-child'); ?>
                        </label>
                        <input type="text" class="form-control bg-light border-0" id="leadCompany">
                    </div>
                    <input type="hidden" id="leadContext" value="">
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary py-2 text-uppercase letter-spacing-1">
                            <?php echo esc_html__('Submit Request', 'bootscore-child'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 图片放大模态框 (Image Zoom) -->
<div class="modal fade" id="imageZoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-lg-down border-0">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-body p-0 position-relative d-flex align-items-center justify-content-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <img loading="lazy" src="" id="zoomImage" class="rounded shadow-lg"
                    style="max-width: 100%; max-height: 90vh; object-fit: contain;"
                    alt="<?php echo esc_attr__('Product Zoom', 'bootscore-child'); ?>">
            </div>
        </div>
    </div>
</div>

<!-- 证书展示模态框 (Certificate View) -->
<div class="modal fade" id="certificateModal" tabindex="-1" aria-labelledby="certificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-serif fw-bold" id="certificateModalLabel">Certificate View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="" id="certModalImage" class="img-fluid w-100" alt="Certificate">
                <div class="p-4 bg-white">
                    <h4 class="mb-1" id="certModalName">Patent Name</h4>
                    <p class="text-muted small mb-0" id="certModalType">Patent Type</p>
                </div>
            </div>
        </div>
    </div>
</div>