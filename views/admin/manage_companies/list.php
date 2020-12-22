<main>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h1>List Companies</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
               <ol class="breadcrumb pt-0">
                  <li class="breadcrumb-item">
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Manage Companies</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">List Companies</li>
               </ol>
            </nav>
            <div class="separator mb-5"></div>
         </div>
      </div>


      <div class="col-12">
         <?php if ($this->session->flashdata('error_message')) {?>
         <div class="alert alert-danger alert-dismissible fade show rounded">
            <?php echo $this->session->flashdata('error_message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <?php }?>
         <?php if ($this->session->flashdata('success_message')) {?>
         <div class="alert alert-success alert-dismissible fade show rounded">
            <?php echo $this->session->flashdata('success_message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <?php }?>
      </div>



      <div class="row mb-4">
         <div class="col-12 mb-4">
            <div class="card">
               <div class="card-body">
                  <table id="datatable-list" class="table table-striped table-bordered dt-responsive nowrap">
                     <thead>
                        <tr>
                           <th>Company ID</th>
                           <th>Company Name</th>
                           <th>Join Date</th>
                           <th>Type</th>
                           <th>Rate</th>
                           <th>Payment Type</th>
                           <th>Direct Payment</th>
                           <th>Email</th>
                           <th>Phone No</th>
                           <th>Type</th>
                           <th>State</th>
                           <th>Country</th>
                           <th>Status</th>
                           <th>Assign Agent</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           foreach ($getRecord as $data) {

                            $employer_subscription = $this->db->where('id',$data['employer_subscription_id']);
                            $employer_subscription = $this->db->get('tbl_employer_subscription')->row();
                            

                            ?>
                        <tr>
                           <td><?=$data['company_id']?></td>
                           <td><?php echo ucwords($data['username']) ?></td>
                           <td><?=date('Y-m-d', strtotime($data['created_on']))?></td>
                           <td>
                               <?php
                               if(!empty($employer_subscription) && !empty($data['is_completed']))
                               {
                                    echo $employer_subscription->name;
                               }
                               else
                               {
                                    echo "N/A";
                               }
                               ?>
                           </td>
                           <td>
                               
                            <?php
                                $getDataFee = $this->db->where('id', $data['plan_id']);
                                $getDataFee = $this->db->get('tbl_employer_subscription_plan')->row();
                                if(!empty($employer_subscription) && !empty($data['is_completed']) && !empty($getDataFee))
                                {
                                    if($data['payment_option'] == '2')
                                    {
                                          echo "Invoice";
                                    }
                                    ?>

                                    <br />                                            
                                    Setup Fee : $<?=!empty($employer_subscription->setup_fee) ? $employer_subscription->setup_fee : ''?>
                                      <br />
                                    <?=$getDataFee->plan_name?> : $<?=$getDataFee->price?>

                                                
                                    <?php
                                }   
                                else
                                {   
                                      echo "N/A";
                                }

                            ?>

                           </td>
                            <td>
                                <?php
                                if(!empty($data['is_completed'])) {
                                ?>
                                    <?=($data['hos_payment'] == '1') ? 'Paid' : 'Unpaid'?>
                                <?php }
                                else
                                { 
                                        echo "N/A";
                                    ?>
                                <?php }
                                ?>

                            </td>


                            <td>
                                <?php
                                if(!empty($data['paid_setup']) || !empty($data['subscription_type']) || !empty($data['subscription_price']))
                                { ?>
                                       Setup Fee : <?=$data['paid_setup']?> <br />
                                       Subscription Type : <?=$data['subscription_type']?> <br />
                                       Subscription Price : <?=$data['subscription_price']?> <br />
                               <?php }
                               else
                               {
                                    echo "N/A";
                               }
                                ?>
                            </td>



                           <td><a href="mailto:<?php echo ucwords($data['email']) ?>"><?php echo ucwords($data['email']) ?></a> </td>
                           <td><?php echo ucwords($data['phone_no']) ?></td>
                           <td><?=$data['company_type']?></td>
                           <td><?php echo ucwords($data['state']) ?></td>
                           <td><?php echo ucwords($data['country']) ?></td>

                           <td>
                                  <?php
                                    $approved = $data['is_quote'];
                                  ?>
                                  <select style="width: 100px;" name="is_quote"  class="form-control"  onchange="change_status(this.value, <?php echo $data['user_id']; ?>)">
                                      <option <?php if ($approved == 1) {echo "selected";}?> value="1">Active</option>
                                      <option <?php if ($approved == 0) {echo "selected";}?> value="0">Inactive</option>
                                  </select>
                           </td>

                           <td style="width: 10%">
                              <select name="status"  class="form-control"  onchange="change_status_agent(this.value, <?php echo $data['user_id']; ?>)">
                                 <option value="">Select Agent</option>
                                 <?php
                                    foreach ($getAgent as $agent) {
                                            ?>
                                 <option value="<?php echo $agent['user_id']; ?>" <?=($data['agent_id'] === $agent['user_id']) ? 'selected' : ''?>> (<?php echo ucfirst($agent['email']); ?>) </option>
                                 <?php
                                    }
                                        ?>
                              </select>
                           </td>
                           <td style="text-align:center;">
                              <div class="btn-group">
                                 <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/manage_companies/edit/<?php echo $data['user_id'] ?>" title="Edit"><i class="simple-icon-pencil d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                 <a data-url="<?php echo base_url(); ?>admin/manage_companies/delete/<?php echo $data['user_id'] ?>" href="javascript:void(0);" onclick="deleteRow(this);" title="Delete" data-toggle="modal" data-target="#deleteModal"><i class="iconsminds-remove d-block"></i></a> &nbsp;&nbsp;&nbsp;
                                 <a style="margin-top:3px;" href="<?php echo base_url(); ?>admin/manage_companies/detail/<?php echo $data['user_id'] ?>" title="Detail"><i class="simple-icon-eye d-block"></i></a>
                              </div>
                           </td>
                        </tr>
                        <?php }?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<script>
   function change_status_agent(agent_id,user_id) {
       $.ajax({
           type: 'post',
           url: '<?php echo base_url(); ?>admin/manage_companies/assign_agent',
           data: {
               "agent_id": agent_id,
               "user_id": user_id,
           },
           success: function (data) {
               alert("Agent Successfully Assign!!");
           }
       });
   }
   


  function change_status(status, id) {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>admin/manage_companies/change_approve_status',
      data: {
        "status": status,
        "id": id,
      },
      success: function (data) {
              alert("Status Change Successfully!!");
      }
    });
  }
     
   
</script>
<script type="text/javascript">
   $(document).ready(function() {
       $('#datatable-list').DataTable();
   } );
</script>
