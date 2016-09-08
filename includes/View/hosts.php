<div class="row">
  <h1>Hosts</h1>
</div>

<div class="row">
  <form action="index.php?r=hosts" method="POST" >
  <table class="table">
    <tr>
      <th>Id</th>
      <th>IP Address</th>
      <th>Domain Name</th>
      <th>Actions</th>
    </tr>

    <?php  foreach ($sites as $site): ?>
      <tr>
        <td><?php print $site['id']; ?></td>
        <td><?php print $site['ip']; ?></td>
        <td><?php print $site['hostname']; ?></td>
        <td>
          <?php if ($site['locked'] == 0): ?>
            <a href="#" class="js-hosts-delete" data-id="<?php print $site['id']; ?>">
              <span class="glyphicon glyphicon-trash"></span>
            </a>
          <?php endif; ?>
        </td>
      </tr>
    <?php  endforeach; ?>
  </table>
</div>

<hr />

<div class="row">
  <div class="alert alert-warning">
    <strong>Note:</strong> Upon form submission, your hosts file will be overwritten.
  </div>

  <div class="form-group">
    <label for="ip">IP Address</label>
    <input type="text" name="ip" class="form-control" />
  </div>

  <div class="form-group">
    <label for="domain">Domain Name</label>
    <input type="text" name="domain" class="form-control" />
  </div>

  <div class="form-group">
    <input type="submit" value="Add Site" name="add_site" class="btn btn-primary" />
  </div>
  </form>
</div>
