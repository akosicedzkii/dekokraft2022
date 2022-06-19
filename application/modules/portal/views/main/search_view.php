<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucfirst($module_name);?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
</section>
<button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button>
<!-- Main content -->
<section class="content" >
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title">Enter Keyword</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
       <div class="row">
            <form name="search-form" id="search-form" class="">
                <div class="col-md-12">
                    <input type="text" id="search_query" style="width:100%" class="form-control" id="search-field" placeholder="Search" required="">
                </div>
                <div class="col-md-12">    
                    <button class="btn btn-success pull-right">Search</button>
                </div>
            </form>
       </div>
    </div>
    <div class="box-body" id="content"></div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>
<script>

var main = function(){
    $("#search-form").submit(function(e){
        data = { "search_query" :  $("#search_query").val() }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/search";?>",
                success: function(data){
                    $("#content").html(data)
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
        e.preventDefault();
        
    });
};

$(document).ready(main);

</script>