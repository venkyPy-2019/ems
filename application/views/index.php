<?php include_once 'includes/header.php'; ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Event List</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Events</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <center> <div class="col-sm-5" style="text-align:center;color:#F40641;">
          <?php
          if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
          }
          ?>
        </div>
      </center>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Events List</h3>
                <button type="button" class="btn btn-primary" style="float:right" data-toggle="modal" data-target="#modal-add-event" title="Add Event">Add Event</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Location</th>
                      <th>Event Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i=1;
                    foreach($event_list as $el){ ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$el['name']?></td>
                        <td><?=$el['description']?></td>
                        <td><?=$el['location']?></td>
                        <td><?=date('dS M Y',strtotime($el['event_date']))?></td>
                        <td>
                          <i class="fa fa-pencil-alt" style="color: orange;cursor: pointer;"
                          title="Edit Events" data-target="#modal-add-event" data-toggle="modal" data-name="<?=$el['name']?>" data-desc="<?=$el['description']?>" data-loc="<?=$el['location']?>" data-evt-date="<?=$el['event_date']?>" data-id="<?=$el['id']?>"></i>&nbsp;&nbsp;
                          <a href="<?php echo base_url() ?>remove_event/<?php echo $el['id']; ?>" onclick="return confirm('Are you want to delete?');"><i class="fa fa-trash" style="color: red;cursor: pointer;"
                            title="Delete Event"></i></a>
                          </td>
                        </tr>
                        <?php 
                        $i++;
                      } ?>

                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <!-- Add Event Modal -->
      <div class="modal fade" id="modal-add-event">
        <div class="modal-dialog modal-lg">

          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Add Event</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo base_url() ?>save_event" method="post" class="form-horizontal">
              <div class="modal-body">
                <input type="hidden" name="event_id" id="event_id">
                <div class="form-group">
                  <label for="event_name">Name</label>
                  <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Enter Event Name" required="">
                </div>
                <div class="form-group">
                  <label for="event_desc">Description</label>
                  <textarea class="form-control" id="event_desc" name="event_desc" placeholder="Enter Event Description.."></textarea>
                </div>
                <div class="form-group">
                  <label for="event_loc">Location</label>
                  <input type="text" class="form-control" id="event_loc" name="event_loc" placeholder="Enter Event Location" required="">
                </div>

                <div class="form-group">
                  <label for="event_date">Event Date</label>
                  <input type="date" class="form-control" id="event_date" name="event_date" placeholder="Enter Event Date.." required="">
                </div>

              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save_btn">Save changes</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


    </div>
    <!-- /.content-wrapper -->
    <?php include_once 'includes/footer.php' ?>
    <script>
      $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });

      $('#modal-add-event').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var name = $(e.relatedTarget).data('name');
    var desc = $(e.relatedTarget).data('desc');
    var loc = $(e.relatedTarget).data('loc');
    var evt_date = $(e.relatedTarget).data('evt-date');
    var id = $(e.relatedTarget).data('id');
    $('#event_name').val(name);
    $('#event_desc').val(desc);
    $('#event_loc').val(loc);
    $('#event_date').val(evt_date);
    $('#event_id').val(id);
    if($('#event_id').val() !=""){
      $('.modal-title').text('Edit Event');
      $('.save_btn').text('Update Changes');
    }else{
      $('.modal-title').text('Add Event');
      $('.save_btn').text('Save Changes');
    }

    
  });
</script>
