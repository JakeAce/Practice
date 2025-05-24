<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold text-dark">🛍️ Product Inventory</h2>
    <button class="btn btn-success shadow" data-toggle="modal" data-target="#myModal">
      <i class="fas fa-plus-circle"></i> Add Product
    </button>
  </div>

  <div class="card shadow border-0">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover text-center mb-0">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Category</th>
              <th>Price</th>
              <th>Top Sale</th>
              <th colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include_once "../config/dbconnect.php";
              $sql = "SELECT * FROM product, category WHERE product.category_id = category.category_id";
              $result = $conn->query($sql);
              $count = 1;
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td><?= $count++ ?></td>
              <td><img src="<?= $row['product_image'] ?>" class="img-thumbnail rounded" style="height: 70px;"></td>
              <td class="text-capitalize"><?= $row['product_name'] ?></td>
              <td class="text-muted small"><?= $row['product_desc'] ?></td>
              <td><span class="badge badge-primary"><?= $row['category_name'] ?></span></td>
              <td><strong class="text-success">$<?= $row['price'] ?></strong></td>
              <td>
                <?= $row['top_sale'] ? "<span class='badge badge-success'>Yes</span>" : "<span class='badge badge-secondary'>No</span>" ?>
              </td>
              <td>
                <button class="btn btn-outline-primary btn-sm" onclick="itemEditForm('<?= $row['product_id'] ?>')">
                  <i class="fas fa-edit"></i>
                </button>
              </td>
              <td>
                <button class="btn btn-outline-danger btn-sm" onclick="itemDelete('<?= $row['product_id'] ?>')">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
            <?php } } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow">
      <form id="productForm" enctype="multipart/form-data" method="POST">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title"><i class="fas fa-box"></i> Add New Product</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body p-4">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label><i class="fas fa-tag"></i> Product Name</label>
              <input type="text" class="form-control" name="p_name" required>
            </div>
            <div class="form-group col-md-6">
              <label><i class="fas fa-dollar-sign"></i> Price</label>
              <input type="number" class="form-control" name="p_price" step="0.01" required>
            </div>
          </div>
          <div class="form-group">
            <label><i class="fas fa-align-left"></i> Description</label>
            <input type="text" class="form-control" name="p_desc" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label><i class="fas fa-layer-group"></i> Category</label>
              <select class="form-control" name="category" required>
                <option disabled selected>Select Category</option>
                <?php
                  $cat = $conn->query("SELECT * FROM category");
                  while ($row = $cat->fetch_assoc()) {
                    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label><i class="fas fa-image"></i> Product Image</label>
              <input type="file" class="form-control-file" name="file" required>
            </div>
          </div>
          <div class="form-check mt-3">
            <input type="checkbox" class="form-check-input" name="top_sale" value="1" id="topSaleCheck">
            <label class="form-check-label" for="topSaleCheck">Mark as <strong>Top Sale</strong></label>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Add Item
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times-circle"></i> Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap & jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Submit Form via AJAX -->
<script>
  $('#productForm').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: './controller/addItemController.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        alert(response);
        $('#myModal').modal('hide');
        location.reload();
      },
      error: function(xhr, status, error) {
        alert("Error: " + error);
      }
    });
  });
</script>
