
<?php
include "header.php";
?>
<!-- <div class="sj-innerbanner">
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="sj-innerbannercontent">
                <h1>International Journal of computer information</h1>
             </div>
        </div>
    </div>
</div>
</div> -->
<div class="container">
    <div class="row" style='padding:2px;margin-top:200px;margin-bottom:20px'>
        <div class="col-md-10">
                <label style='margin-bottom:-2px;font-weight:bold' for="">Search by Content</label>
                <input type='text' id='key' name='key' class='form-control' placeholder='Enter Content' class='form-control'>
        </div>
        <div class="col-md-2">
            <br/>
           <button onclick="search_content();" class='btn  mybtn'>Search</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id='datatable_journal' style='width:100%'>
                <thead>
                    <tr style='background-color:#d5d5d5;color:black'>
                        <th>S.No</th>
                        <th>Paper Title</th>
                        <th>Action</th>
                    </tr>
                    
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</div>


 



<?php
include "footer.php";
?>

 
<script>  
 function search_content(){
      burl="<?=base_url('ajax/get_journalpaper_by_content.php')?>";
      k=$("#key").val();
      table=$('#datatable_journal').DataTable({
        "ajax" : {
            "url": burl, //give your controller & function name
            "type":"post",
                "data":{key:k}
            },
        bDestroy:true,
        scrollX: true,
        dom: 'Blfrtip'
      });
    }
</script>