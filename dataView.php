<?php
    require('./config.php');

    $sql = "SELECT id, link, phone,description,meta_title,og_description, og_title ,socialLinks,created_at FROM webcontent ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['connection'], $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data View OF Webscraping</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
</head>
<body>

<div class="col-sm-12">
    <h2 class="text-center">Website Data</h2>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Index</th>
                <th>Link</th>
                <th>Phone</th>
                <th style="min-width:20vw;">Meta Content</th>
                <th>Social Links</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
            ?> 

                    <tr>
                        <td></td>
                        <td><?=$row['link']; ?></td>
                        <td><?php
                            $phone = json_decode($row['phone']);
                            if($phone && $phone != '' && COUNT($phone)>0){
                                foreach($phone as $phonenum){
                                    echo $phonenum."<br>";
                                }
                            }else{
                                echo "-";
                            }
                        ?></td>
                        <td>
                            <strong>Meta Description:</strong>
                            <?="<br>"; ?>
                            <?=$row['description']; ?>
                            <?="<br><br>"; ?>

                            <strong>Og Description:</strong>
                            <?="<br>"; ?>
                            <?=$row['og_description']; ?>
                            <?="<br><br>"; ?>
                            
                            <strong>Title:</strong>
                            <?="<br>"; ?>
                            <?=$row['meta_title']; ?>
                            <?="<br><br>"; ?>

                            <strong>Og Title:</strong>
                            <?="<br>"; ?>
                            <?=$row['og_title']; ?>
                            
                        </td>
                        <td><?php
                            $links = json_decode($row['socialLinks']);
                            if(COUNT($links)>0){
                                foreach($links as $link){
                                    echo $link."<br>";
                                }
                            }else{
                                echo "-";
                            }
                        ?></td>
                        <td><?=date("d-m-Y H:i:s", strtotime($row['created_at'])); ?></td>
                    </tr>

            <?php                        
                    }
                } else {
            ?>
                 <tr>
                    <td colspan="5">No record found</td>
                 </tr>
            <?php
                }
            ?>

            
        </tbody>
    </table>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        var t = $('#example').DataTable();
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script>

</body>
</html>
