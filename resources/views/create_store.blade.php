<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Store</title>
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
            background-color: #4CAF50;
            border: none;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        h1 {
            color: #333;
        }
        .form-label {
            font-weight: bold;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create a New Store</h1>
        <div class="card">
            <div class="card-body">
                <form id="storeForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Store Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter store name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Store Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter store description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Store Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create Store</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('storeForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const token = localStorage.getItem('token'); // Get token from localStorage
            if (!token) {
                alert('Unauthorized! Please log in first.');
                window.location.href = '/login';
                return;
            }

            const formData = new FormData(this);

            try {
                const response = await fetch('/api/stores', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`, // Pass token in Authorization header
                    },
                    body: formData,
                });

                if (response.ok) {
                    alert('Store created successfully!');
                    window.location.reload();
                } else {
                    alert('Error creating store. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    </script>
</body>
</html>
