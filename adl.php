
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
        <div class="col-md-3">
                <label style='margin-bottom:-2px;font-weight:bold' for="">Journal</label>
                <select name="journals_id" id="journals_id" class='form-control'>
                     <option value="0">Please Select</option>
                      <?php
                      $q="select * from journals";
                      $stmt=$conn->query($q);
                      while(($row = $stmt->fetchAssociative())!==false){
                        extract($row);
                      ?>
                      <option value="<?=$journals_id?>"><?=$journal_abbri?></option>
                      <?php
                      }
                      ?>
                </select>
        </div>
        <div class="col-md-2">
             <label style='margin-bottom:-2px;font-weight:bold' for="">Date</label>
                <select name="year" id="year" class='form-control'>
                     <option value="0">Please Select</option>
                      <?php
                     for($i=2011;$i<=date('Y');$i++){
                      ?>
                         <option value="<?=$i?>"><?=$i?></option>
                      <?php
                      }
                      ?>
                </select>
        </div>
        <div class="col-md-3">
            <br/>
           <button onclick="search_journals();" class='btn  mybtn'>Search</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id='datatable_journal' style='width:100%'>
                <thead>
                    <tr style='background-color:#d5d5d5;color:black'>
                        <th>S.No</th>
                        <th>Journal</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
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
	
	  function search_journals(){
      burl="<?=base_url('ajax/get_journalpaper.php')?>";
      journals_id=$("#journals_id").val();
      year=$("#year").val();  
      table=new $('#datatable_journal').DataTable({
        "ajax" : {
            "url": burl, //give your controller & function name
            "type":"post",
                "data":{jid:journals_id,y:year}
            },
        bDestroy:true,
        scrollX: true,
        dom: 'Blfrtip',
        "paging": true,
        lengthMenu: [10, 25, 50, 75, 100],
         "pageLength": 10,
      });
    }
</script>