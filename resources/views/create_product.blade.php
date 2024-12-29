<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create a New Product</h1>
        <div class="card">
            <div class="card-body">
                <form id="productForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" required>
                    </div>
                    <div class="mb-3">
                        <label for="store_id" class="form-label">Select Store</label>
                        <select name="store_id" id="store_id" class="form-select" required>
                            <option value="">Select a store</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create Product</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('productForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const token = localStorage.getItem('token'); // Get token from localStorage
            if (!token) {
                alert('Unauthorized! Please log in first.');
                window.location.href = '/login';
                return;
            }

            const formData = new FormData(this);

            try {
                const response = await fetch('/api/products', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`, // Pass token in Authorization header
                    },
                    body: formData,
                });

                if (response.ok) {
                    alert('Product created successfully!');
                    window.location.reload();
                } else {
                    alert('Error creating product. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    </script>
</body>
</html>
