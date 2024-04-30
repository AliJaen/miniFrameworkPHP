<?php loadheader($data); ?>
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h1><?php echo $data["page_name"]; ?></h1>
                            <?php debug($data) ?>
                            <button class="btn d-flex border-dark" id="btnRecord"><i class="ti ti-video fs-6"></i><span class="mb-0 fs-3">&MediumSpace;Record Screen</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php loadfooter($data); ?>