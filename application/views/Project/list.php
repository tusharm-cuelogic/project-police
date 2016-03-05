<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h3 class="pull-left">Project list</h3>
            <a href="<?php echo base_url();?>Project/add" class="btn btn-primary pull-right marginTop15"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add project</a>
        </div>
    </div>
    <hr class="clearfix" />
    <table class="table table-striped table-hover">
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
            <td><a href="<?php echo base_url();?>Project/add/<?php echo $projectValue->id; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></td>
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
