
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h3 class="pull-left">Add Project</h3>
        </div>
    </div>
    <hr class="clearfix" />
    <form name="project" method="post">
      <div class="form-group col-md-6">
        <label for="">Prject name</label>
        <input type="text" class="form-control" id="" placeholder="" name="project_name" required value="<?php echo $info['project_name'];?>">
      </div>
      <div class="form-group col-md-6">
        <label for="">Git repository</label>
        <input type="text" class="form-control" id="" placeholder="" name="repository_name" required value="<?php echo $info['repository_name'];?>">
      </div>
      <div class="form-group col-md-6">
        <label for="">Repository?</label>
        <label for="public">Public<input type="radio" class="form-control" id="public" placeholder="" name="repository_type" value="public" required <?php echo ($info['repository_type']=='public')?'checked':'';?>></label>
        <label for="private">Private<input type="radio" class="form-control" id="private" placeholder="" name="repository_type" value="private" required <?php echo ($info['repository_type']=='private')?'checked':'';?>></label>
      </div>
      <div class="form-group col-md-6">
          <label for="">Git Username</label>
          <input type="text" class="form-control" id="" placeholder="" name="git_username" required value="<?php echo $info['git_username'];?>">
      </div>
      <div class="form-group col-md-6">
        <label>Git Password</label>
        <input type="password" class="form-control" id="" placeholder="" name="git_password" required value="<?php echo $info['git_password'];?>">
      </div>
      <div class="form-group col-md-6">
          <label for="">Git Clone Url</label>
          <input type="text" class="form-control" id="" placeholder="" name="git_url" required value="<?php echo $info['git_url'];?>">
      </div>
      <div class="form-group col-md-6">
            <label for="">Project language</label>
            <select name="project_language" required class="form-control">
              <option value="">Select</option>
              <option value="php" <?php echo ($info['project_language']=='php')?'selected':'';?>>PHP</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="">Project framework</label>
            <select name="project_framework" required class="form-control">
              <option value="">Select</option>
              <option value="symphony" <?php echo ($info['project_framework']=='symphony')?'selected':'';?>>Symphony</option>
            </select>
        </div>
        <div class="form-group col-md-6">
          <label for="">Controller Directory</label>
          <input type="text" class="form-control" id="" placeholder="" name="controller_directory" value="<?php echo $info['controller_directory'];?>">
        </div>
        <div class="form-group col-md-6">
          <label for="">Model Directory</label>
          <input type="text" class="form-control" id="" placeholder="" name="model_directory" value="<?php echo $info['model_directory'];?>">
        </div>
        <div class="form-group col-md-6">
          <label for="">Exclude Directory</label>
          <input type="text" class="form-control" id="" placeholder="" name="exclude_directory" value="<?php echo $info['exclude_directory'];?>">
      </div>

        <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
