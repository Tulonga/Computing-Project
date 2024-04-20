<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-12 px-4">

    <form action="{{ route('products.store') }}" method="post" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input type="text" id="product_name" name="product_name" placeholder="Enter name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <input type="text" id="description" name="description" placeholder="Enter description" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
            <input type="number" id="price" name="price" placeholder="Enter price" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-bold mb-2">Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" placeholder="Enter quantity" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
            <input type="text" id="category_id" name="category_id" placeholder="Enter category" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="image_url" class="block text-gray-700 font-bold mb-2">Image URL</label>
            <input type="text" id="image_url" name="image_url" placeholder="Enter image URL" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Create Product</button>
        </div>
    </form>

</body>

</html>

<!--    'product_name',
        'description',
        'price',
        'stock_quantity',
        'category_id' -->