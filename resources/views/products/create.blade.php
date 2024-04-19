<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>

<form action="{{ route('products.store') }}" method="post">
    @csrf
    <div>
        <label for="">Name</label>
        <input type="string" placeholder="name" />
    </div>

    <br>

    <div>
        <label for="">Description</label>
        <input type="text" placeholder="description" />
    </div>

    <br>

    <div>
        <label for="">Price</label>
        <input type="decimal" placeholder="price" />
    </div>

    <br>

    <div>
        <label for="">Quantity</label>
        <input type="integer" placeholder="qty" />
    </div>

    <br>

    <div>
        <label for="">Category</label>
        <input type="string" placeholder="category" />
    </div>

    <br>

    <div>
        <button type="submit">Create Product</button>
    </div>
   
</form>
    
</body>
</html>

<!--    'product_name',
        'description',
        'price',
        'stock_quantity',
        'category_id' -->