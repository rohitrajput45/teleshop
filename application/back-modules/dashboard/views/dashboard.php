 <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
		 <a href="<?php echo base_url().'offices'; ?>">
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <div class="info-box bg-aqua">
				<span class="info-box-icon "><i class="ion ion-ios-gear-outline"></i></span>

				<div class="info-box-content">
				  <span class="info-box-text">Offices</span>
				  <span class="info-box-number"><?php echo $offices; ?><small></small></span>
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
        </a>
        <!-- /.col -->
        <a href="<?php echo base_url().'pits'; ?>">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon "><i class="ion ion-ios-location"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pits</span>
              <span class="info-box-number"><?php echo $pits; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
	</a>
        <!-- fix for small devices only -->
      
		 <a href="<?php echo base_url().'products'; ?>">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon "><i class="ion ion-ios-color-filter"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Products</span>
              <span class="info-box-number"><?php echo $products; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        </a>
        <!-- /.col -->
         <a href="javascript:void(0);">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number"><?php echo $customers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         </a>
        <!-- /.col -->
         	<?php  if($this->session->userdata('userType')==1): ?>
        <a href="<?php echo ($this->session->userdata('userType') ==1)? (base_url().'managers'):'javascript:void(0);'; ?>">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="ion ion-university"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Office Manager</span>
              <span class="info-box-number"><?php echo $officeManager; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         </a>
         <?php endif; ?>
        <!-- /.col -->
         <a href="<?php echo base_url().'drivers'?>">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-gray">
            <span class="info-box-icon"><i class="ion ion-person-stalker"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Drivers</span>
              <span class="info-box-number"><?php echo $drivers; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         </a>
        
        <!-- /.col -->
         <a href="<?php echo base_url().'orders'?>">
         <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-violet">
            <span class="info-box-icon"><i class="ion ion-android-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Orders</span>
              <span class="info-box-number"><?php echo $orders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         </a>
        <!-- /.col -->
        <!-- /.col -->
         <a href="<?php echo base_url().'orders/preorders'?>">
         <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="ion ion-android-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pre-Orders</span>
              <span class="info-box-number"><?php echo $preorders; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         </a>
        <!-- /.col -->
        
         <a href=" <?php echo ($this->session->userdata('userType') ==1)? (base_url().'category'):'javascript:void(0);'; ?>">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-navy   ">
            <span class="info-box-icon"><i class="ion ion-soup-can"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Categories </span>
              <span class="info-box-number"><?php echo $categories; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         </a>
        <!-- /.col -->
         <a href="javascript:void(0);">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box bg-maroon   ">
            <span class="info-box-icon"><i class="ion ion-pricetags"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Coupons </span>
              <span class="info-box-number"><?php echo $coupons; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         </a>
        <!-- /.col -->

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
