<div class="container">
    <h3>Commits</h3>
    <hr/>
    <table class="table table-hover">
    <thead>
    <tr>
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
