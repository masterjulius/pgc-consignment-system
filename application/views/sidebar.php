<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$materialize_URL = base_url( '/materialize' );
?>
<!--Side-nav-->
<div class="cnsgnmnt-Sidenav">
  <ul id="slide-out" class="side-nav fixed">
    <img src="<?php echo $materialize_URL; ?>/img/1.png" />
    <li><a href="<?php echo base_url('/administrator/'); ?>"><i class="icon-cnsgnmnt-dashboard"></i>Dashboard</a></li>
    <li><a href="<?php echo base_url('/administrator/consignmentrequest/'); ?>"><i class="icon-cnsgnmnt-request"></i>Consignment Request</a></li>
    <li><a href="<?php echo base_url('/administrator/consignmentoffer/'); ?>"><i class="icon-cnsgnmnt-offer"></i>Consignment Offer</a></li>
    <li><a href="<?php echo base_url('/administrator/consignmentorderreorder/'); ?>"><i class="icon-cnsgnmnt-offerv2"></i>Consignment Order/Reorder</a></li>
    <li><a href="<?php echo base_url('/administrator/delivery'); ?>"><i class="icon-cnsgnmnt-delivery"></i>Delivery</a></li>
    <li><a href="<?php echo base_url('/administrator/utilization/'); ?>"><i class="icon-cnsgnmnt-utility"></i>Utilization</a></li>
    <li><a href="<?php echo base_url('/administrator/glossary/'); ?>"><i class="icon-cnsgnmnt-glossary"></i>Glossary</a></li>
    <li><a href="<?php echo base_url('/administrator/inventory/'); ?>"><i class="icon-cnsgnmnt-inventory"></i>Inventory</a></li>
    <li><a href="<?php echo base_url('/administrator/utilizationreport/'); ?>"><i class="icon-cnsgnmnt-report"></i>Utilization Report</a></li>
    <li><a href="<?php echo base_url('/administrator/payment/'); ?>"><i class="icon-cnsgnmnt-reorder"></i>Payment</a></li>
    <li><a href="<?php echo base_url('/administrator/users/'); ?>"><i class="icon-cnsgnmnt-fingerprintv2"></i>Users</a></li>
    <li><a href="<?php echo base_url('/administrator/roles/'); ?>"><i class="icon-cnsgnmnt-role"></i>Roles</a></li>
    <li><a href="<?php echo base_url('/administrator/settings/'); ?>"><i class="icon-cnsgnmnt-settings"></i>Settings</a></li>
  </ul>
</div>