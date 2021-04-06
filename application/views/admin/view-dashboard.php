<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-bug"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Semua Order</span>
        <span class="info-box-number">
          <?php echo $this->db->count_all('tb_order'); ?> Order
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-list"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Order Pending</span>
        <span class="info-box-number">
          <?php echo  count($this->M_order->orderjoinmember("status='pending'")); ?> Order
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-send"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Order Terkirim</span>
        <span class="info-box-number">
          <?php echo  count($this->M_order->orderjoinmember("status='terkirim'")); ?> Order
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Order Selesai</span>
        <span class="info-box-number">
          <?php echo  count($this->M_order->orderjoinmember("status='selesai'")); ?> Order
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>