<?php 
    require('../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2> Thống Kê Đơn Hàng <?php echo Carbon::now('Asia/Ho_Chi_Minh');?></h2>
                <div class="block">               
                    <div class="col-md-3">
                        Từ ngày : <input class="form-control" type="text" id="datepicker_from"></p>
                    </div> 
                    <div class="col-md-3">
                        Tới ngày : <input class="form-control" type="text" id="datepicker_to"></p>
                    </div> 
                    <div class="col-md-3">
                        Lọc theo :
                        <select class="form-control">
                            <option>--Lọc Theo--</option>
                            <option>--Lọc Theo 7 ngày--</option>
                            <option>--Lọc Theo 30 ngày--</option>
                            <option>--Lọc Theo 90 ngày--</option>
                            <option>--Lọc Theo 100 ngày--</option>
                        </select>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>