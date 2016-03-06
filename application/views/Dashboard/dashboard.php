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
        <th>Project Name</th>
        <th>Commit Id</th>
        <th>Username</th>
        <th>Issue</th>
        <th>Commit Date</th>
    </tr>
    </thead>
    <tbody>
        <?php
            if (is_array($setCommitsDetails) && count($setCommitsDetails) > 0) {
                foreach($setCommitsDetails as $commit) { ?>
        <tr>
            <th scope="row"><a href="<?php echo base_url();?>Dashboard/commits?id=<?php echo base64_encode($commit['projectid']); ?>"><?php echo $commit['username']; ?></a></th>
            <td><?php echo $commit['pushid']; ?></td>
            <td><?php echo $commit['username']; ?></td>
            <td><?php echo ($commit['issue_count']) ? $commit['issue_count'] : 0; ?></td>
            <td><?php echo date('F j, Y', strtotime($commit['pushed_date'])); ?></td>
        </tr>
        <?php }
            } else  { ?>
                <tr>
                    <td class="danger text-center" colspan="4">Commits not found.</td>
                </tr>
            <?php
            }
        ?>
    </tbody>
    </table>
</div>
