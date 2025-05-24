<div class="container p-5">
  <h4 class="mb-4 text-primary">Edit Product Detail</h4>

  <?php
    include_once "../config/dbconnect.php";
    $ID = $_POST['record'];
    $qry = mysqli_query($conn, "SELECT * FROM product WHERE product_id='$ID'");
    $numberOfRow = mysqli_num_rows($qry);
    if ($numberOfRow > 0) {
      while ($row1 = mysqli_fetch_array($qry)) {
        $catID = $row1["category_id"];
  ?>

  <form id="update-Items" onsubmit="updateItems(event)" enctype="multipart/form-data" class="needs-validation" novalidate>
    
    <input type="hidden" id="product_id" value="<?= htmlspecialchars($row1['product_id']) ?>">

    <div class="form-group">
      <label for="p_name" class="font-weight-bold">Product Name</label>
      <input type="text" class="form-control" id="p_name" value="<?= htmlspecialchars($row1['product_name']) ?>" required>
      <div class="invalid-feedback">Please enter the product name.</div>
    </div>

    <div class="form-group">
      <label for="p_desc" class="font-weight-bold">Product Description</label>
      <input type="text" class="form-control" id="p_desc" value="<?= htmlspecialchars($row1['product_desc']) ?>" required>
      <div class="invalid-feedback">Please enter the product description.</div>
    </div>

    <div class="form-group">
      <label for="p_price" class="font-weight-bold">Unit Price</label>
      <input type="number" step="0.01" class="form-control" id="p_price" value="<?= htmlspecialchars($row1['price']) ?>" required>
      <div class="invalid-feedback">Please enter a valid price.</div>
    </div>

    <div class="form-group">
      <label for="category" class="font-weight-bold">Category</label>
      <select id="category" class="form-control" required>
        <?php
          $sql = "SELECT * FROM category WHERE category_id='$catID'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['category_id'] . "' selected>" . htmlspecialchars($row['category_name']) . "</option>";
            }
          }
          $sql = "SELECT * FROM category WHERE category_id!='$catID'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['category_id'] . "'>" . htmlspecialchars($row['category_name']) . "</option>";
            }
          }
        ?>
      </select>
      <div class="invalid-feedback">Please select a category.</div>
    </div>

    <div class="form-group">
      <label class="font-weight-bold d-block mb-2" style="color: white; font-variant: small-caps;">Current Image</label>
      <div class="card mb-3" style="width: 220px;">
        <img src="<?= htmlspecialchars($row1["product_image"]) ?>" class="card-img-top" alt="Product Image" style="height: 150px; object-fit: cover;">
      </div>
      <input type="text" id="existingImage" class="form-control mb-2" value="<?= htmlspecialchars($row1['product_image']) ?>" hidden>
      <label for="newImage" class="font-weight-bold" style="color: white; font-variant: small-caps;">Choose New Image (optional):</label>
      <input type="file" id="newImage" class="form-control-file" accept="image/*" style="color: white; font-variant: small-caps;">
    </div>

    <!-- Top Sale Checkbox -->
    <div class="form-group form-check mb-4">
      <input type="checkbox" class="form-check-input" id="top_sale" <?= $row1['top_sale'] ? 'checked' : '' ?>>
      <label class="form-check-label font-weight-bold" for="top_sale" style="color: white; font-variant: small-caps;">Mark as Top Sale</label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block" style="height:50px; font-weight:bold;">Update Item</button>
  </form>

  <script>
    // Bootstrap form validation
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var form = document.getElementById('update-Items');
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
          } else {
            updateItems(event);
          }
        }, false);
      }, false);
    })();

    function updateItems(event) {
      event.preventDefault();

      var formData = new FormData();
      formData.append("product_id", document.getElementById("product_id").value);
      formData.append("p_name", document.getElementById("p_name").value);
      formData.append("p_desc", document.getElementById("p_desc").value);
      formData.append("p_price", document.getElementById("p_price").value);
      formData.append("category", document.getElementById("category").value);
      formData.append("top_sale", document.getElementById("top_sale").checked ? 1 : 0);

      const newImage = document.getElementById("newImage").files[0];
      if (newImage) {
        formData.append("file", newImage);
      } else {
        formData.append("existingImage", document.getElementById("existingImage").value);
      }

      $.ajax({
        url: './controller/updateItemController.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          alert(response);
          location.reload();
        },
        error: function(xhr, status, error) {
          alert("Error: " + error);
        }
      });
    }
  </script>

  <?php
      }
    }
  ?>
</div>
