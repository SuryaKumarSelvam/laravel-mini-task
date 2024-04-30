<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MINI TASK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-3">
  <form action="{{ route('generate.bill') }}" method="POST">
    @csrf
    <div class="row jumbotron box8">
      <div class="col-sm-12 mx-t3 mb-4">
        <h2 class="text-center text-info">Billing Page</h2>
      </div>
      <div class="col-sm-6 form-group">
        <label for="name-f">Customer Email</label>
        <input type="text" class="form-control" name="email" id="name-f" placeholder="Enter Customer Email" required>
      </div>
<div class="row mt-5">
    <div class="col-sm-6 form-group float-right">
        <button class="btn btn-primary"  onclick="addProductFields(event)">Add New</button>
      </div>
</div>
<h4 class="text-center text-info">Bill Section</h4>
     <div class="row mt-2" id="productFields">
         <div class="col-sm-6 form-group">
        <label for="name-f">Product Id</label>
        <input type="text" class="form-control" name="product_id[]" id="product_id" placeholder="Product Id" required>
      </div>
        <div class="col-sm-6 form-group">
        <label for="name-f">Quantity</label>
        <input type="text" class="form-control" name="qty[]" id="qty-f" placeholder="Quantity" required>
      </div> 
        </div>
        <hr class="mt-3">

         <div class="row">
        <h2 class="text-center text-info">Denominations</h2>
          <div class="col-sm-6 form-group" style="display: flex;gap:30px;">
        <label for="name-f">500</label>
        <input type="text" class="form-control" name="denomination1"  placeholder="Count" required>
      </div> 
      </div>
       <div class="row">
          <div class="col-sm-6 form-group" style="display: flex;gap:30px;">
        <label for="name-f">50</label>
        <input type="text" class="form-control" name="denomination2"  placeholder="Count" required>
      </div> 
      </div>
     <div class="row">
          <div class="col-sm-6 form-group" style="display: flex;gap:30px;">
        <label for="name-f">20</label>
        <input type="text" class="form-control" name="denomination3"  placeholder="Count" required>
      </div> 
      </div>
      <div class="row">
          <div class="col-sm-6 form-group" style="display: flex;gap:30px;">
        <label for="name-f">10</label>
        <input type="text" class="form-control" name="denomination4"  placeholder="Count" required>
      </div> 
      </div>
      <div class="row">
          <div class="col-sm-6 form-group" style="display: flex;gap:30px;">
        <label for="name-f">5</label>
        <input type="text" class="form-control" name="denomination5"  placeholder="Count" required>
      </div> 
      </div>
        <div class="row">
          <div class="col-sm-6 form-group" style="display: flex;gap:30px;">
        <label for="name-f">2</label>
        <input type="text" class="form-control" name="denomination6"  placeholder="Count" required>
      </div> 
      </div>
        <div class="row">
          <div class="col-sm-6 form-group" style="display: flex;gap:30px;">
        <label>1</label>
        <input type="text" class="form-control" name="denomination7"  placeholder="Count" required>
      </div> 
      </div>
       <div class="row mt-4">
          <div class="col-sm-6 form-group">
        <label for="name-f">Cash Paid by Customer</label>
        <input type="text" class="form-control" name="cash"  placeholder="Amount" required>
      </div> 
      </div>
       </div>
    
     </div>
    </div>
    <div class="row">
                  <div class="col-sm-6 form-group" style="margin-left: 990px;">
        <button class="btn btn-danger">Cancel</button>
        <button type="submit" class="btn btn-primary">Generate Bill</button>
      </div> 
    </div>
  </form>
</div>
<script>
    function addProductFields(e){
        e.preventDefault();
      var productFields = document.getElementById("productFields");
            var newRow = document.createElement("div");
            newRow.classList.add("row", "mt-2");
            newRow.innerHTML = `
                <div class="col-sm-6 form-group">
                    <label for="name-f">Product Id</label>
                    <input type="text" class="form-control product-id" name="product_id[]" placeholder="Product Id" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="name-f">Quantity</label>
                    <input type="text" class="form-control qty" name="qty[]" placeholder="Quantity" required>
                </div>`;
            productFields.appendChild(newRow);
    }
</script>
</body>
</html>