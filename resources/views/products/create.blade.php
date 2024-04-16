<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    @csrf
</head>
<body>

<form method="post" action="{{route('Products.store')}}">
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
        <input type="submit" value="Save A New Product">
    </div>
   
</form>
    
</body>
</html>

<!--    'product_name',
        'description',
        'price',
        'stock_quantity',
        'category_id' -->