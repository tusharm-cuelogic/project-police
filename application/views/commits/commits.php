<div class="container">
    <h3>Commits</h3>
    <hr/>
    <table class="table table-hover commit-table">
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
            <td class="toggle-details">
                <div><?php echo $commit['pushid']; ?></div>
                <div class="details" style="display: ;"><span>Duplicate <i>( <?php echo ($commit['duplicate_count']) ? $commit['duplicate_count'] : 0; ?> )</i></span> <span>Queires <i>( <?php echo ($commit['query_count']) ? $commit['query_count'] : 0; ?> )</i></span><span>Wrong use of action <i>( <?php echo ($commit['wrong_action']) ? $commit['wrong_action'] : 0; ?> )</i></span><span> Unwanted methods in module <i>( <?php echo ($commit['unwanted_module']) ? $commit['unwanted_module'] : 0; ?> )</i></span></div>
            </td>
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
