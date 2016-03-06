<div class="container">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

          var arrMainDtata = [['Element', 'Density']];

          var data = google.visualization.arrayToDataTable([
                ['Element', 'Density'],
                <?php
                    foreach ($setProjectDetails as $projectKey => $projectValue) {
                        ?>
                        ['<?php echo $projectValue->repository_name; ?>',<?php echo ($projectValue->commit_errors) ? $projectValue->commit_errors : 0 ; ?>],
                        <?php } ?>
            ]);

          var options = {
            title: '',
            hAxis: {
              title: 'Projects',
            },
            vAxis: {
              title: 'Issues'
            }
          };

          var chart = new google.visualization.ColumnChart(
            document.getElementById('top_x_div'));

          chart.draw(data, options);
        }
    </script>
    <h3>Dashboard</h3>
    <hr/>
    <div id="top_x_div" style="width: 100%; height: 400px;"></div>
    <hr/>
    <table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Last commit errors</th>
        <th>Commit date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php
            if (is_array($setProjectDetails) && count($setProjectDetails) > 0) {
                foreach($setProjectDetails as $projectKey => $projectValue) { ?>
        <tr>
            <th scope="row"><?php echo $projectValue->repository_name; ?></th>
            <td><?php echo $projectValue->commit_errors; ?></td>
            <td><?php echo date('F j, Y', strtotime($projectValue->created)); ?></td>
            <td><a href="<?php echo base_url();?>Project/add?id=<?php echo base64_encode($projectValue->id); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></td>
        </tr>
        <?php }
            } else  { ?>
                <tr>
                    <td class="danger text-center" colspan="4">Project not found.</td>
                </tr>
            <?php
            }
        ?>
    </tbody>
    </table>
</div>
